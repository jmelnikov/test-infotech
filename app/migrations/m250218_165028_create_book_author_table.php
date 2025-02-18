<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m250218_165028_create_book_author_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('book_author', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'PRIMARY KEY(book_id, author_id)',
        ]);

        $this->addForeignKey('fk-book_author_book', 'book_author', 'book_id', 'book', 'id', 'CASCADE');
        $this->addForeignKey('fk-book_author_author', 'book_author', 'author_id', 'author', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-book_author_book', 'book_author');
        $this->dropForeignKey('fk-book_author_author', 'book_author');
        $this->dropTable('book_author');
    }
}
