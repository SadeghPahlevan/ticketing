<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {


        $menuItems[] = '<li>'

            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )

            . Html::endForm()
            . '</li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" style="padding: 100px 0">
        <div class="col-md-9">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>
</div>
<div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">

    <div class="logo">

        <a href="<?= Url::toRoute('site/index') ?>" class="simple-text">
            ADMIN
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">

            <li class="active">
                <a href="<?= Url::toRoute('site/dashboard') ?>">
                    <i class="material-icons">trending_up</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="<?= Url::toRoute('user/index') ?>">
                    <i class="material-icons">person</i>
                    <p>Users</p>
                </a>
            </li>

            <li>
                <a href="<?= Url::toRoute('subject/index') ?>">
                    <i class="material-icons">subject</i>
                    <p>Subject</p>
                </a>
            </li>
            <li>
                <a href="<?= Url::toRoute('usersubject/index') ?>">
                    <i class="material-icons text-gray">assignment_ind</i>
                    <p>User-Subject</p>
                </a>
            </li>
            <li>
                <a href="<?= Url::toRoute('site/rate') ?>">
                    <i class="material-icons text-gray">grade</i>
                    <p>RATE</p>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar-background" style="background-image: url(../assets/img/sidebar-1.jpg) "></div></div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
