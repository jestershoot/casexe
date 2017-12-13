<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `prize`
 */
class m171213_185106_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'prize_id' => $this->integer()->notNull(),
            'reciever' => $this->string(255),
            'zip' => $this->integer()->notNull(),
            'country' => $this->string(64),
            'state' => $this->string(64),
            'city' => $this->string(64),
            'address' => $this->string(255),
            'status' => $this->integer()->notNull()->defaultValue(0)
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-address-user_id',
            'address',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-address-user_id',
            'address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `prize_id`
        $this->createIndex(
            'idx-address-prize_id',
            'address',
            'prize_id'
        );

        // add foreign key for table `prize`
        $this->addForeignKey(
            'fk-address-prize_id',
            'address',
            'prize_id',
            'prize',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-address-user_id',
            'address'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-address-user_id',
            'address'
        );

        // drops foreign key for table `prize`
        $this->dropForeignKey(
            'fk-address-prize_id',
            'address'
        );

        // drops index for column `prize_id`
        $this->dropIndex(
            'idx-address-prize_id',
            'address'
        );

        $this->dropTable('address');
    }
}
