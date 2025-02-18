<?php

namespace app\models;

use Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $cover
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Author[] $authors
 */
class Book extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'book';
    }

    public function rules()
    {
        return [
            [['title', 'year'], 'required'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['title', 'isbn', 'cover'], 'string', 'max' => 255],
            [['isbn'], 'unique']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название книги',
            'year' => 'Год издания',
            'description' => 'Описание книги',
            'isbn' => 'ISBN',
            'cover' => 'Обложка книги',
            'created_at' => 'Дата создания записи',
            'updated_at' => 'Дата обновления записи',
            'authors' => 'Авторы',
        ];
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

    /**
     * @param mixed $post
     * @return void
     * @throws Exception
     */
    public function linkAuthors(mixed $post): void
    {
        $authorId = ArrayHelper::getValue($post, 'Book.authors', []);
        $this->unlinkAll('authors', true);

        if ($author = Author::findOne($authorId)) {
            $this->link('authors', $author);
        }
    }
}
