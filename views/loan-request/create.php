<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Create Loan Request';
?>

<div class="loan-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="loan-request-form">
        <form action="/requests" method="post">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" id="user_id" name="user_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="term">Term (days)</label>
                <input type="number" id="term" name="term" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</div>