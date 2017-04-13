<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m170413_141902_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'theme' => $this->string(32)->notNull(),
            'author' => $this->string(32)->notNull(),
            'publisher_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
