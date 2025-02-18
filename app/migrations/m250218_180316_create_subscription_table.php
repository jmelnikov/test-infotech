<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription}}`.
 */
class m250218_180316_create_subscription_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('subscription', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(255)->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-subscription-author', 'subscription', 'author_id', 'author', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-subscription-author', 'subscription');
        $this->dropTable('subscription');
    }
}
