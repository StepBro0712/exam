<?php

/* @var $this yii\web\View $this */

$this->title = 'My Yii Application';

use yii\grid\GridView; ?>
<div class="site-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format'=>'html',
                'value' => function ($data) {
                    return \yii\helpers\Html::a($data-> name, '/theme/view/?id='.$data->id);
                },
            ],
            'text:ntext',
            [
                'attribute' => 'Ответы',
                'value' => function ($data) {
                    return count($data->answers);
                },
            ],

        ],
    ]); ?>
</div>

