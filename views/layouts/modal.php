<?php
/* @var $this \yii\web\View */
/* @var $content string */

$assetBundle = Yii::$app->controller->module->assetBundle;
$assetBundle::register($this);
?>
<div class="container-fluid" style="padding: 20px">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <?= $content ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
