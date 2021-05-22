<?php


namespace app\modules\admin\controllers;

use app\models\Category;
use app\modules\admin\models\CategorySearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->get());
        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionView()
    {
        $model = Category::findOne($this->getCategoryTitle());
        if (!$model) throw new NotFoundHttpException('Category not found');
        return $this->render('view', compact('model'));
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Category was success created');
            return $this->redirect(['view', 'title' => $model->productLine]);
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate()
    {
        $model = Category::findOne($this->getCategoryTitle());
        if (!$model) throw new NotFoundHttpException();

        if ($model->load($this->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Category was success  updated');
            return $this->redirect(['view', 'title' => $model->productLine]);
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete()
    {
        $category = Category::findOne($this->getCategoryTitle());
        if (!$category) throw new NotFoundHttpException();
        if ($category->delete()) {
            \Yii::$app->session->setFlash('success','Category was success deleted');
            return $this->redirect(['index']);
        }
        throw new Exception('Oops, Something went wrong!');
    }

    private function getCategoryTitle()
    {
        return str_replace('-', ' ', $this->request->get('title'));
    }
}