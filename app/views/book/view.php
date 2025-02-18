<?php

use app\models\Book;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно удалить эту книгу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'year',
            'description:ntext',
            'isbn',
            'cover' => [
                'attribute' => 'cover',
                'format' => ['image', ['width' => '200']],
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            'updated_at' => [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            'authors' => [
                'attribute' => 'authors',
                'value' => function (Book $model) {
                    return implode(', ', array_map(function ($author) {
                        return $author->full_name;
                    }, $model->authors));
                },
            ],
        ],
    ]) ?>

</div>
