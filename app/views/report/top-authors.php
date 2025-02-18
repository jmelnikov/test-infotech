<?php

/**
 * @var array $authors
 * @var int $year
 */

use yii\helpers\Html;

$this->title = "ТОП-10 авторов по количеству книг за {$year}";
?>

<h1><?= Html::encode($this->title) ?></h1>
<form method="get">
    <label for="year">Выберите год:</label>
    <div class="input-group mb-3">
        <input type="number" class="form-control" id="year" name="year" value="<?= $year ?>" min="1900"
               max="<?= date('Y') ?>">
        <button class="btn btn-outline-primary" type="submit">Показать</button>
    </div>
</form>

<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Автор</th>
        <th>Выпущено книг</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($authors as $index => $author): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= Html::encode($author['full_name']) ?></td>
            <td><?= $author['book_count'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
