<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Stream */
/* @var $form yii\widgets\ActiveForm */
 $subject = \common\models\Subject::get_subject();

?>

<div class="stream-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <select id="stream-subject_id" class="form-control" name="Stream[subject_id]">
        <?php foreach ($subject as $sub) { ?>
        <option value="<?= $sub['id'] ?>" ><?= $sub['title'] ?></option>
        <?php } ?>
    </select>

    <?= $form->field($model, 'priority')->dropDownList(['1'=> 'ضروری', '2'=> 'عادی' ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
