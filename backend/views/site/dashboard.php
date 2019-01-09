<?php
/**
 * Created by PhpStorm.
 * User: sadegh
 * Date: 1/9/19
 * Time: 4:53 PM
 */
$user = \common\models\User::get_user();
$open = \common\models\Stream::get_stream_open();
$close = \common\models\Stream::get_stream_close();

?>
<div class="container">

    <div class="row">
        <div class="col-md-3 panel panel-primary">
            <h4>TOTAL USERS : <?= $user ?></h4>
        </div>
        <div class="col-md-3 panel panel-primary">
            <h4>TOTAL OPEN STREAM : <?= $open ?></h4>
        </div>
        <div class="col-md-3 panel panel-primary">
            <h4>TOTAL FINISH STREAM : <?= $close ?></h4>
        </div>
    </div>
</div>
