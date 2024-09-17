<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class LoanRequest extends ActiveRecord
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const STATUS_PROCESSING_BY = 'processing_by_';
    

    public static function hasApprovedRequestForUser($userId)
    {
        return self::find()
            ->where(['user_id' => $userId, 'status' => self::STATUS_APPROVED])
            ->exists();
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function hasApprovedRequest()
    {
        return self::hasApprovedRequestForUser($this->user_id);
    }

}