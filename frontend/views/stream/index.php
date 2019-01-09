<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Streams');
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="<?= Url::toRoute('stream/create') ?>">ایجاد</a>
        </div>
        <div class="col-md-6">
            <a href="<?= Url::toRoute('stream/list')?>">لیست</a>
        </div>

    </div>

</div>