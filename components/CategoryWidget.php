<?php

namespace app\components;

use app\models\Category;
use yii\base\Widget;

class CategoryWidget extends Widget
{
    public function run()
    {
        $categories = Category::find()->where(['status' => 'enable'])->with('products') ->all();
        return $this->render('category', compact('categories'));
    }
}