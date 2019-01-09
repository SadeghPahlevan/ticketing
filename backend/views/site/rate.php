<?php

use common\models\Rate;
use common\models\Stream;
use common\models\Usersubject;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$rates = Rate::get_rate();


?>

    <table class="table table-hover ">
        <tr class="danger">
            <th> STREAM</th>
            <th> EXPERT</th>
            <th> RATE</th>
        </tr>

        <?php foreach ($rates as $rate) { ?>


            <?php $stream_id = $rate['stream_id'] ?>
            <?php $stream = Stream::get_streams_rates($stream_id) ?>
            <?php $subject_id = $stream ['subject_id'] ?>
            <?php $users = Usersubject::get_user_subject_rates($subject_id) ?>
            <?php foreach ($users as $user) { ?>

                <?php $user_id = $user['user_id'] ?>

                <?php $username = User::get_user_name($user_id) ?>

                <tr>
                    <td class="info"><?= $rate['stream_id'] ?></td>
                    <td class="success"><?= $username ['username'] ?></td>
                    <td class="info"><?= $rate['rate'] ?></td>
                </tr>


            <?php } ?>
        <?php } ?>
    </table>

