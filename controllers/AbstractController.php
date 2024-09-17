<?php

namespace app\controllers;

use yii\base\Action;
use yii\web\Controller;
use yii\helpers\Inflector;

abstract class AbstractController extends Controller
{
    /*
        $returnType can be either 'numeric' or 'assoc'
    */
    protected function validate(Action $action, string $returnType="numeric") : array
    {
        $validated = [];
        $validatorClass = $this->getValidatorClass($action->controller::class);
        $validatorAction = $this->getValidatorAction($action->id);
        
        if (class_exists($validatorClass) && method_exists($validatorClass, $validatorAction)) {
            $validated = (new $validatorClass)->{$validatorAction}();
        }

        return $returnType === "numeric" ? array_values($validated) : $validated;
    }

    protected function getValidatorClass(string $controllerClass)
    {
        $validatorClass = $controllerClass;
        $validatorClass = str_replace("app\\controllers", "app\\validators", $validatorClass);
        $validatorClass = str_replace("Controller", "Validator", $validatorClass);
        
        return $validatorClass;
    }

    protected function getValidatorAction(string $actionId)
    {
        return "validate" . Inflector::id2camel($actionId);
    }
}
