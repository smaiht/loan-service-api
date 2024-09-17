<?php

use yii\db\Migration;
use Faker\Factory;

class m240917_034642_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add Fake Users
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $this->insert('user', [
                'full_name' => $faker->name,
            ]);
        }
    }

    public function safeDown()
    {
        $this->dropTable('user');
    }
}
