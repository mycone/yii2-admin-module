<?php

namespace asdfstudio\admin\forms\widgets;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class FileInput
 * @package asdfstudio\admin\forms\widgets
 */
class FileInput extends InputWidget
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
    public function run()
    {
        return Html::activeInput($this->type, $this->model, $this->attribute, [
            'class' => 'form-control',
        ]);
    }
}
