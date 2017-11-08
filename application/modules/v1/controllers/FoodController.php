<?php
namespace app\modules\v1\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use app\models\User;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBearerAuth;
use dektrium\user\helpers\Password;
class FoodController extends ActiveController
{
    public $modelClass = 'app\models\Food';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
          $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
             'auth' => function ($username,$password) {
                 $user = User::find()->where(['username' => $username])->one();
                 return $user;},
         ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
       /* $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
           /'only' => ['auth']

        ];*/
        return $behaviors;
    }


}