<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public function getLoanRequests()
    {
        return $this->hasMany(LoanRequest::class, ['user_id' => 'id']);
    }
}