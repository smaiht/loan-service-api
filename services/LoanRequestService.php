<?php

namespace app\services;

use Yii;
use app\models\LoanRequest;

class LoanRequestService
{
    public function create(array $data): LoanRequest
    {
        $loanRequest = new LoanRequest($data);
        $loanRequest->save();

        return $loanRequest;
    }

    public function process($delay)
    {
        $processGuid = Yii::$app->security->generateRandomString(16);
        $processingStatus = LoanRequest::STATUS_PROCESSING_BY . $processGuid;

        Logger::log("Starting loan requests processing with delay: $delay", "process-$processGuid");

        $affectedRows = LoanRequest::updateAll(
            ['status' => $processingStatus],
            ['status' => LoanRequest::STATUS_PENDING]
        );

        Logger::log("Selected $affectedRows pending requests for processing.", "process-$processGuid");

        $requests = LoanRequest::find()
            ->where(['status' => $processingStatus])
            ->all();

        foreach ($requests as $request) {
            $this->processRequest($request, $delay);
        }

        Logger::log("Loan requests processing completed. Processed {$affectedRows} requests.", "process-$processGuid");
    }

    private function processRequest($request, $delay)
    {
        try {
            sleep($delay);

            $request->status = ( !$request->hasApprovedRequest() && $this->isRequestApproved() )
                ? LoanRequest::STATUS_APPROVED
                : LoanRequest::STATUS_DECLINED;

            $request->updated_at = new \yii\db\Expression('NOW()');
            $request->save();

            Logger::log("Processed request ID: {$request->id}, New status: {$request->status}", "{$request->status}");
            
        } catch (\Exception $e) {
            Yii::error("Error processing request ID {$request->id}: " . $e->getMessage(), "{$request->status}");
            Logger::log("Error processing request ID {$request->id}: " . $e->getMessage(), "{$request->status}");

            $request->status = LoanRequest::STATUS_PENDING;
            $request->save();
        }

    }

    private function isRequestApproved(): bool
    {
        return (mt_rand(1, 100) <= 10);
    }

}