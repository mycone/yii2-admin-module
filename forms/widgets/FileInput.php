<?php

namespace asdfstudio\admin\forms\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Class FileInput
 * @package asdfstudio\admin\forms\widgets
 */
class FileInput extends Base
{
    /**
     * HTML input type
     * @var string
     */
    public $type = 'file';

    public $imageClass;
    public $imageAttribute = 'image';
    public $filenameTemplate = '{filename}.{ext}';

    /**
     * @inheritdoc
     */
    public function renderInput($value, $attribute = null)
    {
        return Html::activeInput($this->type, $this->model, $attribute ? $attribute : $this->attribute, [
            'class' => 'form-control',
        ]);
    }
}
