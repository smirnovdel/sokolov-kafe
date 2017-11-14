<?php
namespace app\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\QueryParamAuth;
use yii\filters\AccessControl;

class FoodController extends ActiveController
{
    public $modelClass = 'app\models\Food';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
       $behaviors['contentNegotiator'] = [
           'class' => ContentNegotiator::className(),
           'formats' => [
               'application/json' => Response::FORMAT_JSON,
           ],
       ];
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete', 'index'],
            'rules' => [
                [
                    'actions' => ['create', 'update', 'delete', 'index'],
                    'allow' => true,
                    'roles' => ['admin'],
                ],
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['user'],
                ],
            ],
        ];

        return $behaviors;
    }


}