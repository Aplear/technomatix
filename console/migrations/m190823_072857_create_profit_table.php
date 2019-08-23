<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profit}}`.
 */
class m190823_072857_create_profit_table extends Migration
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

        $this->createTable('{{%profit}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'product_id' => $this->integer(),
            'value' => $this->float(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-owner_id-profit',
            'profit',
            'owner_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-product_id-profit',
            'profit',
            'product_id',
            'products',
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
        $this->dropForeignKey('fk-owner_id-profit', 'profit');
        $this->dropForeignKey('fk-product_id-profit', 'profit');
        $this->dropTable('{{%profit}}');
    }
}
