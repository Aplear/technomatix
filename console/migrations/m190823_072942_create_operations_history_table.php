<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%operations_history}}`.
 */
class m190823_072942_create_operations_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%operations_history}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'model' => $this->string(),
            'model_id' => $this->integer(),
            'operation' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-owner_id-operations_history',
            'operations_history',
            'owner_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-owner_id-operations_history', 'operations_history');
        $this->dropForeignKey('fk-product_id-operations_history', 'operations_history');
        $this->dropTable('{{%operations_history}}');
    }
}
