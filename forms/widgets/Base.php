<?php


namespace asdfstudio\admin\forms\widgets;


use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class Base
 * @package asdfstudio\admin\forms\widgets
 * @property ActiveRecord $model
 */
abstract class Base extends InputWidget
{
    /**
     * If true renders "add" button
     * @var bool
     */
    public $appendable = false;
    /**
     * Input "disabled" attribute
     * @var bool
     */
    public $disabled = false;

    /**
     * @param $value string
     * @param $attribute string
     * @return string
     */
    abstract public function renderInput($value, $attribute);

    public function run()
    {
        $res = '';
        if ((is_array($this->model->{$this->attribute}) || $this->appendable) && static::className() !== AppendableList::className()) {
            $values = $this->model->{$this->attribute};
            $values = array_unique(is_array($values) ? $values : [$values]);
            $last = end($values);
            reset($values);
            foreach ($values as $key => $value) {
                $input = $this->renderInput($value, $this->attribute . '[]');
                $res .= $this->appendable
                    ? $this->wrapAppendable($input, $value == $last)
                    : $input;
            }
        } else {
            $input = $this->renderInput($this->model->{$this->attribute}, $this->attribute);
            $res = $this->appendable
                ? $this->wrapAppendable($input)
                : $input;
        }

        return $res;
    }

    public function wrapAppendable($content, $append = true)
    {
        $button = '<span class="input-group-btn"><button type="button" class="btn ' .
            ($append ? 'btn-default btn-add' : 'btn-danger btn-remove') . '">' .
            ($append ? '+' : '–' ) . '</button></span>';
        return Html::tag('div',
            $content . $button,
            [
                'class' => 'form-group input-group',
                'disabled' => $this->disabled,
            ]
        );
    }
}
