<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'تنظیمات';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table td, table th {
        text-align: center;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <?= Html::a('افزودن <i class="material-icons">add</i>', ['create'], ['class' => 'btn btn-success']) ?>
                <h4 class="card-title">جدول تنظیمات</h4>
                <p class="card-category">تظیمات کلی و اصلی پنل</p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'variable',
                            [
                                'label'=>'مقدار',
                                'format'=>'raw',
                                'value'=>function($model){
                                    if($model->type == 'text'){
                                        return $model->value;
                                    }else if($model->type == 'color') {
                                        return '<div style="background-color: '.$model->value.'" class="color-type"><label>'.$model->value.'</label></div>';
                                    }else {
                                        return '<div class="image-type"><img src="'.Yii::getAlias("@web").'/img/sample.jpg'.'" /></div>';
                                    }
                                }
                            ],
                            'status',

                            [
                                'label'=>'',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return ' <a href="/config/update?id='.$model->id.'" title="به روزرسانی" aria-label="Update" data-pjax="0"><i class="fa fa-edit"></i></a></td>';
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".table-responsive").html($(".grid-view").html());
    $(".table").removeClass('table-striped');
    $(".table").removeClass('table-bordered');
</script>


