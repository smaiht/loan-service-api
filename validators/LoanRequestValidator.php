<?php

namespace app\validators;

use app\models\User;
use Yii;

// use app\services\AuthService;

class LoanRequestValidator extends AbstractValidator
{
    public function validateDoCreate(): array
    {
        $data = $this->fetchRequired(['user_id', 'amount', 'term']);

        $rules = [
            [['user_id', 'amount', 'term'], 'integer'],
            
            ['amount', 'compare', 'compareValue' => 0, 'operator' => '>'],
            ['term', 'compare', 'compareValue' => 0, 'operator' => '>'],
            
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
        ];

        $this->runValidation($data, $rules);
        return $data;
    }

}