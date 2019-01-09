<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Config */

$this->title = 'ایجاد تنظیمات';
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <?= Html::a('بازگشت <i class="material-icons">arrow_back</i>', ['index'], ['class' => 'btn btn-default']) ?>
                <h4 class="card-title">ایجاد تنظیمات</h4>
                <p class="card-category">افزودن یه تنظیمات جدید برای سایت</p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

