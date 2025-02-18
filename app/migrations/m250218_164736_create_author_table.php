<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m250218_164736_create_author_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('author');
    }
}
