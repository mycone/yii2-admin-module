<?php

use yii\helpers\Html;
use asdfstudio\admin\components\AdminFormatter;

/**
 * @var yii\web\View $this
 * @var yii\db\ActiveRecord $model
 * @var asdfstudio\admin\base\Entity $entity
 */

$this->title = $entity->labels()[0];
$this->params['breadcrumbs'][] = ['label' => $entity->labels()[1], 'url' => ['manage/index', 'entity' => $entity->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'View');

$detail = $entity->detail();
$detail = isset($detail['class']) ? $detail['class'] : $detail;
?>
<div class="model-view">
    <p>
        <?= Html::a(Yii::t('admin', 'Edit'), ['update', 'entity' => $entity->id, 'id' => $model->primaryKey], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'entity' => $entity->id, 'id' => $model->primaryKey], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <?php echo $detail::widget([
            'model' => $model,
            'formatter' => [
                'class' => AdminFormatter::className(),
            ],
        ])?>
    </div>

</div>
