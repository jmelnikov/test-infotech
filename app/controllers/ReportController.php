<?php

namespace app\controllers;

use yii\db\Query;
use yii\web\Controller;

class ReportController extends Controller
{
    /**
     * @param $year
     * @return string
     */
    public function actionTopAuthors($year = null): string
    {
        $year = $year ?? date('Y'); // По умолчанию — текущий год

        $authors = (new Query())
            ->select(['author.id', 'author.full_name', 'COUNT(book.id) AS book_count'])
            ->from('author')
            ->innerJoin('book_author', 'author.id = book_author.author_id')
            ->innerJoin('book', 'book.id = book_author.book_id')
            ->where(['book.year' => $year])
            ->groupBy(['author.id'])
            ->orderBy(['book_count' => SORT_DESC])
            ->limit(10)
            ->all();

        return $this->render('top-authors', [
            'authors' => $authors,
            'year' => $year,
        ]);
    }
}
