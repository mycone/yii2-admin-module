<?php

namespace asdfstudio\admin\forms\widgets;

use asdfstudio\admin\components\AdminFormatter;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use asdfstudio\admin\helpers\AdminHelper;

/**
 * Class Select
 * @package asdfstudio\admin\widgets
 *
 * Renders active select widget with related models
 */
class Select extends Base
{
    /**
     * @var ActiveQuery|array
     */
    public $query;
    /**
     * @var string
     */
    public $labelAttribute;
    /**
     * @var array
     */
    public $items = [];
    /**
     * @var bool
     */
    public $multiple = false;
    /**
     * @var bool Allows empty value
     */
    public $allowEmpty = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (is_callable($this->query)) {
            $this->query = call_user_func($this->query, $this->model);
        }
        if ($this->query instanceof ActiveQuery) {
            if (!$this->labelAttribute) {
                throw new InvalidConfigException('Parameter "labelAttribute" is required');
            }
            $this->items = $this->query->all();
            foreach ($this->items as $i => $model) {
                $this->items[$i] = AdminHelper::resolveAttribute($this->labelAttribute, $model);
            }
        }
        if ($this->allowEmpty) {
            $this->items = ArrayHelper::merge([
                null => Yii::t('yii', '(not set)')
            ], $this->items);
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function renderInput($value, $attribute = null)
    {
        return Html::activeDropDownList($this->model, $attribute ? $attribute : $this->attribute, $this->items, [
            'class' => 'form-control',
            'multiple' => $this->multiple,
        ]);
    }
}
