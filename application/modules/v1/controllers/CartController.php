<?php
namespace app\modules\v1\controllers;
use Yii;
use app\models\Cart;
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

   /* public function actionIndex()
    {

        return Cart::parser();
    }

    public function actionCreate()
    {//получить данные из запроса
        $model = new Cart();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return false;
        }

    }*/


}