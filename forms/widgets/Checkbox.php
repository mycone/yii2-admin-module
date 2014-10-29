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
class Checkbox extends Base
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
        return Html::activeCheckbox($this->model, $attribute ? $attribute : $this->attribute, [
            'style' => 'float: left; margin-right: 4px;', // ugly hack
            'value' => $value,
            'label' => null,
        ]);
    }
}
