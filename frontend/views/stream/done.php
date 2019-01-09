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
<input type="hidden" value="<?= \yii\helpers\Url::toRoute('ticket/add') ?>" id="stream-url"/>
<input type="hidden" value="<?= \yii\helpers\Url::toRoute('stream/status') ?>" id="stream-status-url"/>

<?php foreach ($user_subjects as $user_subject) { ?>

    <?php $subject_id = $user_subject['subject_id'] ?>
    <?php $streams = Stream::get_streams($subject_id); ?>
    <?php foreach ($streams as $stream) { ?>

        <?php if ( $stream['status'] == 2 ){?>
            <h3 style="direction: rtl">  <?= $stream['title'] ?> </h3>


            <?php $tickets = Ticket::get_ticket($stream['id']) ?>
            <div id="text-container-<?= $stream['id'] ?>"></div>
            <?php foreach ($tickets as $ticket) { ?>

                <?php $role = $ticket['user_type']; ?>
                <?php if ($role == 1) { ?>
                    <p style="direction: rtl">expert: <?= $ticket['response']; ?></p>
                <?php } else { ?>
                    <p style="color: red">user: <?= $ticket['response']; ?></p>

                <?php } ?>




            <?php } ?>


        <?php } ?>



    <?php } ?>
<?php } ?>


<script type="text/javascript" src="<?= Yii::getAlias('@web') . '/js/stream/kartabl.js' ?>"></script>








