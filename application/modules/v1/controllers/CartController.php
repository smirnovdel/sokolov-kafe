<?php
namespace app\modules\v1\controllers;
use Yii;
use app\models\Cart;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController as Controller;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\auth\QueryParamAuth;
use yii\filters\AccessControl;

class CartController extends Controller
{
   public $modelClass = 'app\models\Cart';

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
                    'roles' => ['Super-admin'],
                ],
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];


        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],
            'prepareDataProvider' => function () {
                return new ActiveDataProvider([
                    'query' => Cart::find()->where(['user_id' => Yii::$app->user->id])
                    // 'query' => Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->with('food')
                ]);
            }
        ];
    return $actions;
}

    public function checkAccess($action, $model = null, $params = [])
    {
        if ( Yii::$app->user->id == $model->user_id)

            {
                throw new \yii\web\ForbiddenHttpException('You can\'t '.$action.' this product.');
            }

    }


}