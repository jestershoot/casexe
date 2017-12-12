<?php

use yii\db\Migration;

/**
 * Class m171212_120840_prize
 */
class m171212_120840_prize extends Migration
{
    /**
     * @inheritdoc
     */
    public function Up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('prize', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->smallInteger()->null(),
            'amount' => $this->integer()->defaultValue(0),
            'cnt' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function Down()
    {
        $this->dropTable('prize');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171212_120840_prize cannot be reverted.\n";

        return false;
    }
    */
}
