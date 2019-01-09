<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Streams');
$this->params['breadcrumbs'][] = $this->title;

?>


<link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/stream/list.css' ?>" />

<?php
echo ListView::widget([
    'dataProvider'=>$dataProvider,
    'itemView'=>'show_list',
]);

?>

<script type="text/javascript" src="<?= Yii::getAlias('@web') . '/js/stream/index.js' ?>"></script>
