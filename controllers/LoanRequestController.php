<?php

namespace app\controllers;

use Yii;
use yii\web\Response;

class LoanRequestController extends AbstractController
{
    public function actionCreate()
    {
        return $this->render('create', []);
    }

    public function actionDoCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $validatedData = $this->validate($this->action, 'assoc');

            $loanRequest = Yii::$app->loanRequestService->create($validatedData);

            Yii::$app->response->statusCode = 201;
            return [
                'result' => true,
                'id' => $loanRequest->id,
            ];

        } catch (\Throwable $e) {
            Yii::$app->response->statusCode = 400;
            return [
                'result' => false,
            ];
        }
    }



}