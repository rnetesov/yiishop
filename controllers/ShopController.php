<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ShopController extends Controller
{
    public function actions()
    {
        return [
            'error' => ErrorHandler::className()
        ];
    }

    public function actionIndex()
    {
        $search = $this->request->get('search');
        $q = trim($this->request->get('q'));

        $query = $this->getProducts($search, $q);
        $products = [];

        $pages = null;

        if ($query) {
            $pages = $this->getPagination();
            $pages->totalCount = $query->count();
            $products = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        }

        return $this->render('index', compact('products', 'pages', 'search', 'q'));
    }

    public function actionCategory()
    {
        $category = Category::findCategoryByTitle($this->getCategoryTitle());
        if (!$category) throw new NotFoundHttpException('Category Not Found');

        $query = $category->getProducts();
        $pages = $this->getPagination();
        $pages->totalCount = $query->count();
        $products = $query
            ->where(['status' => ['active', 'on main']])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('category', compact('products', 'pages'));
    }

    public function actionProduct()
    {
        $product = Product::findOne($this->request->get('code'));
        if (!$product) throw new NotFoundHttpException('Product Not Found');
        return $this->render('product', compact('product'));
    }

    private function getProducts($search = null, $q = null)
    {
        if (!is_null($search)) {
            if ($q) {
                return Product::find()
                    ->where(['like', 'productName', $q])
                    ->orWhere(['like', 'productLine', $q])
                    ->orWhere(['like', 'productVendor', $q]);
            }
            return null;
        }
        return Product::find()->where(['status' => 'on main'])->orderBy('productName');
    }

    private function getPagination(): Pagination
    {
        return new Pagination([
            'pageSizeParam' => false,
            'pageSize' => 8,
        ]);
    }

    private function getCategoryTitle()
    {
        return str_replace('-', ' ', $this->request->get('name'));
    }
}