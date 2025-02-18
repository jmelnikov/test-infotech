<?php

namespace app\models;

use yii\db\ActiveRecord;

class Subscription extends ActiveRecord
{
    public static function tableName()
    {
        return 'subscription';
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'author_id' => 'ID Автора',
        ];
    }

    public function rules()
    {
        return [
            [['phone', 'author_id'], 'required'],
            [['phone'], 'string', 'max' => 255],
            [['author_id'], 'integer'],
            [['phone', 'author_id'], 'unique', 'targetAttribute' => ['phone', 'author_id'], 'message' => 'Вы уже подписаны на этого автора.'],
            [['author_id'], 'exist', 'targetClass' => Author::class, 'targetAttribute' => 'id'],
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
