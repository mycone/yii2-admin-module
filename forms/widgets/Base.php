<?php


namespace asdfstudio\admin\forms\widgets;


use yii\helpers\Html;
use yii\widgets\InputWidget;

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
     * @param $attribute string
     * @param $value string
     * @return string
     */
    abstract public function renderInput($attribute, $value);

    public function run()
    {
        $res = '';
        if (is_array($this->model->{$this->attribute})) {
            $values = $this->model->{$this->attribute};
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
