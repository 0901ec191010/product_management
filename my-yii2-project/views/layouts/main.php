<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\BootstrapAsset;
use yii\web\YiiAsset;
use yii\bootstrap4\BootstrapDatePickerAsset;

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100 w-100">
<head>
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        html,body{
            overflow: hidden;
        }
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #f4f4f9;
            color: #333;
            transition: background 0.3s ease;
        }
        .container-fluid {
            padding: 0;
        }
        .full-width-image {
            width: 100%;
            height: auto;
        }
        header {
            background: #343a40;
            color: #fff;
            transition: background 0.3s ease;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
        }
        main {
            /* margin-top: 60px; */
            transition: margin-top 0.3s ease;
        }
        footer {
            background: #343a40;
            color: #fff;
            padding: 10px 0;
            transition: background 0.3s ease;
        }
        .footer span {
            display: block;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .container {
            animation: fadeInUp 1s ease-in-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="d-flex flex-column h-100 w-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::encode(Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container ">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="footer mt-auto bg-dark">
    <div class="container">
        <div class="row row-success text-center py-2 text-white" style="vertical-align:middle;">
            <span>Product Catalog Management</span>
            <span> &copy; copyright 2024</span>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
