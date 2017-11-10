<?php

namespace app\controllers;

use Yii;
use app\models\Category;

use app\models\Cart;
use app\models\CartFood;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
$session = Yii::$app->session;
class CartController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Cart models.
     * @return mixed
     */
    public function actionIndex()
    {

      $dataProvider = new ActiveDataProvider([
            'query' => Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->with('food'),
            'pagination' => false]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

     //var_dump(Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->all());
    }


    
    /**
     * Displays a single Cart model.
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
     * Updates an existing Cart model.
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
     * Deletes an existing Cart model.
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
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
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
    
  
    public function actionAddToCart($id, $del = false)
    {
        $model = \app\models\Food::findOne($id);

        $cart = new Cart;

        $cart->addFood($model,$del);
        $dataProvider = new ActiveDataProvider([
            'query' => Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->with('food'),
            'pagination' => false]);



        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
        
    
    public function actionСleart()
    {

        return $this->redirect(['menu/index']);
          
    }
    
    
}
