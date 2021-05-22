<?php


namespace app\modules\admin\controllers;


use app\models\Product;
use app\modules\admin\models\ProductSearch;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->get());

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView($code = null)
    {
        $model = Product::findOne($code);
        if (!$model) throw new NotFoundHttpException('Product Not Found');
        return $this->render('view', compact('model'));
    }

    public function actionUpdate($code = null)
    {
        $model = Product::findOne($code);
        if (!$model) throw new NotFoundHttpException('Product Not Found');

        if ($model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Product was success updated');
            return $this->redirect(Url::to(['view', 'code' => $model->productCode]));
        }

        return $this->render('update', compact('model'));
    }

    public function actionCreate()
    {
        $model = new Product();

        if ($model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Product was success created');
            return $this->redirect(Url::to(['view', 'code' => $model->productCode]));
        }

        return $this->render('create', compact('model'));
    }

    public function actionDelete($code = null)
    {
        $model = Product::findOne($code);
        if (!$model) throw new NotFoundHttpException('Product Not Found');
        if ($model->delete()) {
            \Yii::$app->session->setFlash('success', 'Product was success deleted');
            return $this->redirect(['index']);
        }
        throw new Exception('Oops, Something went wrong!');
    }
}