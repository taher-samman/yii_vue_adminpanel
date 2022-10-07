<?php

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => fn () => new ActiveDataProvider(
                [
                    'query' => $this->modelClass::find(),
                    'pagination' => false,
                ]
            ),
        ];
        return $actions;
    }
}
