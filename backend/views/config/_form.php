<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
$types = Yii::$app->params['variableTypes'];
$model->user_id = Yii::$app->user->id;
$priority = [1,2,3,4,5,6,7,8,9];
?>
<style>
    .field-config-id, .field-config-user_id {
        display: none;
    }
    .config-form {
        direction: rtl;
        text-align: right;
    }
    .control-label {
        width: 100%;
    }
</style>
<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group field-config-type required">
        <label class="control-label" for="config-type">نوع</label>
        <select id="config-type" class="form-control" name="Config[type]" aria-required="true">
            <?php
                foreach ($types as $type) { ?>
                 <option value="<?= $type ?>"><?= $type ?></option>
            <?php    }
            ?>
        </select>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'variable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <div class="form-group field-config-status required">
        <label class="control-label" for="config-type">اولویت</label>
        <select id="config-status" class="form-control" name="Config[status]" aria-required="true">
            <?php
            foreach ($priority as $pri) { ?>
                <option value="<?= $pri ?>"><?= $pri ?></option>
            <?php    }
            ?>
        </select>

        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ایجاد', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
