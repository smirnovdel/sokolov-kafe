<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Category;
use app\models\FoodCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Food;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {   $behaviors = parent::behaviors();
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
               [
                   'actions' => ['index'],
                   'allow' => true,
                   'roles' => ['?'],
               ],
           ],
           //'denyCallback' => function ($rule, $action) {
           //    throw new ForbiddenHttpException('You are not allowed to access this page');
          // }
       ];
       
        
            $behaviors['verbs'] = [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ];
        return $behaviors;
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex($id = false,$del = false)
    {
        if($id){

        $model = Food::findOne($id);
        $cart = new Cart;
        $cart->addFood($model,$del);

        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->orderby(['sorting'=>SORT_ASC]),
    'pagination' => false]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Food();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $food_category = new FoodCategory();

            $food_category->saveCategory($model);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    
    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
