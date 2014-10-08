<?php

namespace asdfstudio\admin\forms\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Class Select
 * @package asdfstudio\admin\widgets
 *
 * Renders active input widget
 */
class Input extends Base
{
    /**
     * HTML input type
     * @var string
     */
    public $type = 'text';

    /**
     * @inheritdoc
     */
    public function renderInput($value, $attribute = null)
    {
        return Html::activeInput($this->type, $this->model, $attribute ? $attribute : $this->attribute, [
            'class' => 'form-control',
            'value' => $value,
        ]);
    }
}
