<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/2/19
 * Time: 10:21 AM
 */

use common\models\Stream;
use common\models\Ticket;
use common\models\Usersubject;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$user_subjects = Usersubject::get_user_subject();
?>

<link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/stream/kartabl.css' ?>" />

<input type="hidden" value="<?= \yii\helpers\Url::toRoute('ticket/add-ticket') ?>" id="stream-url"/>
<input type="hidden" value="<?= \yii\helpers\Url::toRoute('stream/status') ?>" id="stream-status-url"/>

<?php foreach ($user_subjects as $user_subject)
 { ?>

    <?php $subject_id = $user_subject['subject_id'] ?>
    <?php $streams = Stream::get_streams($subject_id); ?>
    <?php foreach ($streams as $stream) { ?>

    <?php if ($stream['status'] == 1) { ?>
         <div class="box-kartabl">
        <a id="stream-<?= $stream['id'] ?>" class="get_stream_id" href="#">
            <h3
                    style="direction: rtl">  <?= $stream['title'] ?>  </h3></a>


        <?php $tickets = Ticket::get_ticket($stream['id']) ?>
        <div class="add" id="sh-<?= $stream['id'] ?>">

            <?php foreach ($tickets as $ticket) { ?>

                <?php $role = $ticket['user_type']; ?>
                <?php if ($role == 1) { ?>
                    <p class="border-ticket">expert: <?= $ticket['response']; ?></p>
                <?php } else { ?>
                    <p class="border-ticket-user"> user:<?= $ticket['response']; ?></p>

                <?php } ?>


            <?php } ?>
        </div>

         <div id="text-container-<?= $stream['id'] ?>"></div>
        <div class="row">
            <div  style="direction: rtl">
                <textarea placeholder="ایجاد" class="add-<?= $stream['id'] ?>"></textarea>
                <a id="add-<?= $stream['id'] ?>" href="#" class="add-text btn btn-primary">ثبت</a>
            </div>
        </div>


        <div class="row">
            <div  style="direction: rtl">
                <a id="finish-stream-<?= $stream['id'] ?>" href="#" class="finish-stream btn btn-primary">پایان</a>
            </div>
        </div>
         </div>
    <?php } ?>


<?php } ?>

<?php } ?>


<script type="text/javascript" src="<?= Yii::getAlias('@web') . '/js/stream/kartabl.js' ?>"></script>








