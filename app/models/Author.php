<?php

namespace app\models;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $full_name
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'author';
    }

    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['full_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО автора',
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('book_author', ['author_id' => 'id']);
    }
}
