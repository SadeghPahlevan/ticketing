<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Usersubject */

$this->title = Yii::t('app', 'Create Usersubject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usersubjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usersubject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
