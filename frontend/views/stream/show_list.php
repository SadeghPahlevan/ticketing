<?php

use common\models\Ticket;
use yii\helpers\Url;
use common\models\Rate;

?>



<input type="hidden" value="<?= \yii\helpers\Url::toRoute('ticket/add-ticket') ?>" id="stream-url"/>


<a class="get_stream_id" href="<?= Url::toRoute('ticket/tickets') ?>"><h3><?= $model->title ?></h3></a>

<?php $streamid = $model->id  ?>
<?php $tickets = Ticket::get_ticket($streamid) ?>
<div class="add" id="sh-<?= $model->id ?>">
    <div id="text-container-<?= $streamid ?>"></div>

    <?php foreach ($tickets as $ticket) { ?>
        <?php $role = $ticket['user_type']; ?>
        <?php if ($role == 0) { ?>

            <p class="border-ticket">user: <?= $ticket['response']; ?></p>
        <?php } else { ?>
            <p class="border-ticket-expert"> expert: <?= $ticket['response']; ?></p>
        <?php } ?>
    <?php }
    ?>



</div>
<?php if ($model->status==1){ ?>
<div>
    <textarea placeholder="ایجاد" class="add-<?= $streamid ?>"></textarea>
    <a id="add-<?= $model->id ?>" href="#" class="add-text btn btn-primary">ثبت</a>

</div>


<?php }else{ ?>
    <?php if (1==1){ ?>

        <a class="add-rate" href="#">please put your idea</a>
    <div class="add" id="show-rate<?= $model->id ?>">
  <form method="post" action="<?= Url::toRoute('stream/rate') ?>">
      <textarea name="text" class="form-control" placeholder="text"></textarea>
      <h5> امتیاز</h5>
      <input   type="radio"  name="rate" value="<?= Rate::BAD ?>"> ضعیف<br>
      <input   type="radio" name="rate" value="<?= Rate::NORMAL ?>"> متوسط<br>
      <input type="radio" name="rate" value="<?= Rate::EXCELLENT ?>"> عالی
      <input type="hidden" class="form-control" name="stream_id" value="<?= $model -> id ?>"  placeholder="stream_id"><br>
      <button type="submit">ثبت</button>
  </form>
    </div>

<?php } ?>

<?php } ?>


