<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            //'population',
            [
                'label' => 'populasi',
                'attribute' => 'population',
                'value' => function($model){
                    $popu = $model->population;
                    if ($popu > 1000000000)
                        $popu = number_format((float)$popu / 1000000000, 2, '.', '')." Billion";
                    elseif ($popu > 1000000)
                        $popu = number_format((float)$popu / 1000000, 2, '.', '')." million";
                    return $popu;
                }
            ],

            //'id',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}', //{view}{template}{delete}
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                            ]);
                        },
                //     'template' => function ($url, $model) {
                //     return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                //                 'title' => Yii::t('app', 'lead-update'),
                //     ]);
                //    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                        ]);
                    }
      
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url ='index.php?r=country/view&id='.$model->id;
                      return $url;
                  }
      
                //   if ($action === 'update') {
                //       $url ='index.php?r=country/update&id='.$model->id;
                //       return $url;
                //   }
                  if ($action === 'delete') {
                      $url ='index.php?r=country/delete&id='.$model->id;
                      return $url;
                  }
      
                }
                ],
            ],
        ]); ?>


</div>
