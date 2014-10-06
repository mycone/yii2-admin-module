<?php


namespace asdfstudio\admin\forms\widgets;
use asdfstudio\admin\forms\Form;
use yii\base\InvalidConfigException;


/**
 * Class Button
 * @package asdfstudio\admin\forms\widgets
 */
class Group extends Base
{
    /**
     * Form
     * @var Form
     */
    public $form;
    /**
     * Allow append values
     * @var bool
     */
    public $appendable = true;
    /**
     * Fields list
     * @var array
     */
    public $fields = [];

    public function init()
    {
        parent::init();
        $this->options['name'] = $this->name;
    }

    public function renderWidget()
    {
        $res = '';
        /* @var Base $field */
        foreach ($this->fields as $attribute => $field) {
            if (is_array($field)) {
                $field = \Yii::createObject(array_merge($field, [
                    'model' => $this->model,
                    'attribute' => "{$this->attribute}[{$attribute}]",
                ]));
            }
            $res .= $field->renderWidget();
        }
        return $res;
    }
}
