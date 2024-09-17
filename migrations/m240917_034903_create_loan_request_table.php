<?php

use yii\db\Migration;

class m240917_034903_create_loan_request_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('loan_request', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'term' => $this->integer()->notNull(),
            'status' => $this->string()->notNull()->defaultValue('pending'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-loan_request-user_id',
            'loan_request',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-loan_request-user_id', 'loan_request', 'user_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-loan_request-user_id', 'loan_request');
        $this->dropTable('loan_request');
    }
}
