<?php

namespace app\validators;

use \yii\web\BadRequestHttpException;
use InvalidArgumentException;
use Yii;
use yii\base\DynamicModel;

abstract class AbstractValidator
{
    public function fetchRequired(array $fields, string $source="body") : array
    {
        $request = Yii::$app->request;
        $this->checkArgumentSource($source);
        $method = $source === "body" ? "getBodyParam" : "get";
        $missing = [];
        $values = [];

        foreach ($fields as $field) {
            $value = $request->{$method}($field);

            if (!is_null($value)) {
                $values[$field] = $value;
            } else {
                $missing[] = $field;
            }
        }

        if (!empty($missing)) {
            $s = count($missing) === 1 ? "" : "s";
            $article = count($missing) === 1 ? "is" : "are";
            $missingString = implode("', '", $missing);
            throw new BadRequestHttpException("Required field{$s} '{$missingString}' {$article} missing", 400);
        }

        return $values;
    }

    public function fetchOptional(array $fields, string $source="body", $defaultValue=null, bool $skipIfEmpty=false) : array
    {
        $request = Yii::$app->request;
        $this->checkArgumentSource($source);
        $method = $source === "body" ? "post" : "get";
        $values = [];

        foreach ($fields as $field) {
            $value = $request->{$method}($field);

            if (!is_null($value) || !$skipIfEmpty) {
                $values[$field] = !is_null($value) ? $value : $defaultValue;
            }
        }

        return $values;
    }

    public function runValidation(array $data, array $rules) : void
    {
        $validation = DynamicModel::validateData($data, $rules);

        if ($validation->hasErrors()) {
            throw new BadRequestHttpException('Error', 400);
        }
    }

    private function checkArgumentSource(string $source) : void
    {
        $allowedSources = ["body", "query"];

        if (!in_array($source, $allowedSources)) {
            $allowedSourcesString = implode("','", $allowedSources);

            throw new InvalidArgumentException("Unexpected type. Allowed: '{$allowedSourcesString}' but '{$source}' given");
        }
    }

    

}
