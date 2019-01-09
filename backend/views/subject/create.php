<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subject */

$this->title = Yii::t('app', 'Create Subject');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
