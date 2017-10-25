<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m171024_105542_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey()->notNull(),
            'food' => $this->string(50)->notNull(),
            'weight' => $this->integer(5)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'time_id' => $this->string(5),
            'picture' => $this->string(50),
            'createdata' => $this->dateTime(),
            'sostav' => $this->string(),
            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
