<?php

use yii\db\Migration;

/**
 * Handles the creation of table `eittime`.
 */
class m171024_105247_create_eittime_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('eittime', [
            'id' => $this->primaryKey(),
            'title' => $this->integer(4),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('eittime');
    }
}
