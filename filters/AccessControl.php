<?php


namespace asdfstudio\admin\components;


class AccessControl extends \yii\filters\AccessControl
{
    public $entity = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->entity) {
            $this->rules = array_merge(
                $this->entity
            );
        }
        parent::init();
    }
}
