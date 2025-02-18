<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m250218_164927_create_book_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'year' => $this->integer()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(20)->unique(),
            'cover' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('book');
    }
}
