<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use asdfstudio\admin\grids\Grid;
use asdfstudio\admin\components\AdminFormatter;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $modelsProvider
 * @var \asdfstudio\admin\base\Entity $entity
 */
$this->title = $entity->labels()[1];
$this->params['breadcrumbs'][] = $this->title;

$grid = $entity->grid();
$grid['entity'] = $entity;

$class = ArrayHelper::remove($grid, 'class', Grid::className());
$defaultGrid = [
    'dataProvider' => $modelsProvider,
    'formatter' => [
        'class' => AdminFormatter::className(),
    ],
];
$grid = ArrayHelper::merge($defaultGrid, $grid);
?>
<div class="row">
    <div class="form-group">
        <?php echo Html::a(Yii::t('admin', 'Create'), ['create', 'entity' => $entity->id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<div class="row">
    <?= $class::widget($grid); ?>
</div>
