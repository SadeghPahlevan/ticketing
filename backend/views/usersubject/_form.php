<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Usersubject */
/* @var $form yii\widgets\ActiveForm */
$subject = \common\models\Subject::get_subject();
$experts = \common\models\User::get_user_expert();
?>

<div class="usersubject-form">

    <?php $form = ActiveForm::begin(); ?>


    <select id="usersubject-subject_id" class="form-control" name="Usersubject[subject_id]">
        <?php foreach ($subject as $sub) { ?>
            <option value="<?= $sub['id'] ?>"><?= $sub['title'] ?></option>
        <?php } ?>
    </select>




   <!--  <?= $form->field($model, 'user_id')->checkbox()?>  -->

    <div class="form-group field-usersubject-user_id has-error">

        <input type="hidden" name="Usersubject[user_id]" value="0">
        <?php foreach ($experts as $exp) { ?>
        <label>
            <input type="checkbox" id="usersubject-user_id" name="Usersubject[user_id]" value="<?= $exp['id'] ?>"> <?= $exp['username'] ?>
        </label>
        <?php } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
