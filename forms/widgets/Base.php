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
     * Renders widget
     * @return string
     */
    abstract public function renderWidget();

    public function run()
    {
        if ($this->appendable) {
            return Html::tag('div',
                $this->renderWidget(). '<span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>',
                [
                    'class' => 'form-group input-group',
                    'disabled' => $this->disabled,
                ]
            );
        }
        return $this->renderWidget();
    }
}
