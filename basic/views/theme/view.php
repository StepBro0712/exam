<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Theme $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="theme-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'text:ntext',
            'date',

        ],
    ]) ?>

    <?php $form = ActiveForm::begin(['action'=>'/answer/create']); ?>

    <?= $form->field($answer, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($answer, 'id_theme')->hiddenInput(['value'=>$model->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить ответ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.name',
            'text:ntext',
            [
                'attribute' => 'date',
                'format' => ['date', 'dd-MM-Y HH:i:s']
            ],

        ],
    ]); ?>
</div>
