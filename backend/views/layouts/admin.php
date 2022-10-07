<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Button;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Offcanvas;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-row h-100">
    <?php $this->beginBody() ?>
    <?php
    $items = [
        ['label' => FA::icon('home') . ' Dashboard', 'url' => ['/site/index']],
        ['label' => FA::icon('user') . ' Users', 'url' => ['/site/users']],
    ];
    Offcanvas::begin([
        'placement' => Offcanvas::PLACEMENT_START . ' sidebar-offcanvas show',
        'id' => 'sidebaroffcanvas',
        'scrolling' => true,
        'backdrop' => false,
        'title' => Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'logo']),
        'closeButton' => false,
    ]);
    // echo Button::widget([
    //     'encodeLabel' => false,
    //     'label' => FA::icon('bars'),
    //     'options' => [
    //         'class' => 'offcanvas-btn',
    //         'type' => "button",
    //         'data-bs-toggle' => "offcanvas",
    //         'data-bs-target' => "#sidebaroffcanvas", 
    //         'aria-controls' => "sidebaroffcanvas"
    //     ]
    // ]);
    echo Nav::widget([
        'options' => ['class' => 'sidebar-menu'],
        'items' => $items,
        'encodeLabels' => false
    ]);
    Offcanvas::end();
    ?>
    <div class="sidebar-offcanvas-space"></div>
    <main role="main" id="main">
        <header>
            <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar navbar-expand-md',
                ],
            ]);
            echo '<div class="refresh-div" id="refresh-div"></div>';
            if (Yii::$app->user->isGuest) {
                echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
            } else {
                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link btn-logout text-decoration-none']
                    )
                    . Html::endForm();
            }
            NavBar::end();
            ?>
        </header>
        <div class="container-content">
            <div class="container">
                <?= $content ?>
            </div>
        </div>
    </main>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
