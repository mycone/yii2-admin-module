<?php


namespace asdfstudio\admin\details;


use yii\widgets\DetailView;

class Detail extends DetailView
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->attributes = $this->attributes();
        parent::init();
    }

    /**
     * List of attributes using in detail view
     * @return array
     */
    public function attributes()
    {
        return null;
    }
}
