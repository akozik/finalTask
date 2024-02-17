<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rtdata $model */

$this->title = 'Create Rtdata';
$this->params['breadcrumbs'][] = ['label' => 'Rtdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rtdata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
