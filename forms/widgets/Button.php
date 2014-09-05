<?php


namespace asdfstudio\admin\forms\widgets;


/**
 * Class Button
 * @package asdfstudio\admin\forms\widgets
 */
class Button extends \yii\bootstrap\Button
{
    /**
     * Action called on button click
     * @var string|callable
     */
    public $action;
    /**
     * Button name
     * @var string
     */
    public $name;

    /**
     * Visible
     */
    public $visible = true;

    public function init()
    {
        parent::init();
        $this->options['name'] = $this->name;
    }
}
