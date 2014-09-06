<?php
use yii\helpers\Html;
use asdfstudio\admin\components\AdminFormatter;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $modelsProvider
 * @var \asdfstudio\admin\base\Entity $entity
 */

$this->title = $entity->labels()[1];
$this->params['breadcrumbs'][] = $this->title;

$grid = $entity->grid();
$grid = isset($grid['class']) ? $grid['class'] : $grid;
?>
<div class="row">
    <div class="form-group">
        <?php echo Html::a(Yii::t('admin', 'Create'), ['create', 'entity' => $entity->id], ['class' => 'btn btn-success'])?>
    </div>
</div>

<div class="row">
    <?php echo $grid::widget([
        'dataProvider' => $modelsProvider,
        'formatter' => [
            'class' => AdminFormatter::className(),
        ],
    ])?>
</div>