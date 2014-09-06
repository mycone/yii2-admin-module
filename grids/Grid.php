<?php


namespace asdfstudio\admin\grids;


use Yii;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

class Grid extends GridView
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->columns = array_merge(
            $this->columns(),
            $this->actions()
        );
        parent::init();
    }

    /**
     * List of grid columns
     * @return array
     */
    public function columns()
    {
        $columns = [];
        $models = $this->dataProvider->getModels();
        $model = reset($models);
        if (is_array($model) || is_object($model)) {
            foreach ($model as $name => $value) {
                $columns[] = $name;
            }
        }
        return $columns;
    }

    /**
     * List of grid actions
     * @return array
     */
    public function actions()
    {
        $entity = \Yii::$app->getRequest()->getQueryParam('entity', null);
        return [
            [
                'class' => ActionColumn::className(),
                'buttons' => [
                    'view' => function($url, $model, $key) use ($entity) {
                        return Html::a(
                            Yii::t('admin', 'View'),
                            ['manage/view', 'entity' => $entity, 'id' => $model->id],
                            ['class' => 'btn btn-primary']
                        );
                    },
                    'update' => function($url, $model, $key) use ($entity) {
                        return Html::a(
                            Yii::t('admin', 'Edit'),
                            ['manage/update', 'entity' => $entity, 'id' => $model->id],
                            ['class' => 'btn btn-warning']
                        );
                    },
                    'delete' => function($url, $model, $key) use ($entity) {
                        return Html::a(
                            Yii::t('admin', 'Delete'),
                            ['manage/delete', 'entity' => $entity, 'id' => $model->id],
                            ['class' => 'btn btn-danger', 'data' => [
                                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],]
                        );
                    },
                ],
            ]
        ];
    }
}
