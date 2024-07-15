<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use hail812\adminlte3\assets\AdminLteAsset;

AdminLteAsset::register($this);
$this->title = "Teste Cezar Login Cookies";



$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>

<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
