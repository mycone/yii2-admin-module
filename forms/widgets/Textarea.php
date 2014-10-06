<?php

namespace asdfstudio\admin\forms\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Class Select
 * @package asdfstudio\admin\widgets
 *
 * Renders active select widget with related models
 */
class Textarea extends Base
{
    /**
     * Textarea columns count
     * @var int
     */
    public $cols = 5;
    /**
     * Textarea rows count
     * @var int
     */
    public $rows = 5;

    /**
     * @inheritdoc
     */
    public function renderInput($value, $attribute = null)
    {
        return Html::activeTextarea($this->model, $attribute ? $attribute : $this->attribute, [
            'class' => 'form-control',
            'cols' => $this->cols,
            'rows' => $this->rows,
        ]);
    }
}
