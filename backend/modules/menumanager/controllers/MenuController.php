<?php


namespace backend\modules\menumanager\controllers;


use common\models\Category;
use common\models\Info;
use common\models\LeaderCategory;
use common\models\PostCategory;
use common\models\Subcategory;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;

use yii\web\Controller;

class MenuController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionGetValue()
    {

        $options = '';
        $type = $_GET['type'];
        if ($type == 'category') {
            $options = $this->categories();
        }
        if ($type == 'page') {
            $options = $this->pages();
        }

        if ($type == 'file') {
            $options = $this->files();
        }

        if ($type == 'leader') {
            $options = $this->leaders();
        }

        if ($type == 'news') {
            $options = $this->news();
        }

        if ($type == 'c-action') {
            $options = $this->sections();
        }

        return Html::tag('select', $options, [
            'id' => 'tree-url_value',
            'class' => 'form-control',
            'name' => 'Menu[url_value]'
        ]);

    }

    private function categories()
    {
        $categories = Category::find()->all();
        $options = Html::tag('option', "Kategoriyani tanlang...");
        foreach ($categories as $category) {
            $options .= Html::tag('option', $category->name_uz, ['value' => $category->slug]);
        }

        return $options;
    }
    private function pages()
    {
        $pages = Info::find()->all();
        $options = Html::tag('option', "Sahifani tanlang...");
        foreach ($pages as $page) {
            $options .= Html::tag('option', $page->title, ['value' => $page->slug]);
        }

        return $options;
    }

    private function files()
    {
        $files = Subcategory::find()->all();
        $options = Html::tag('option', "Sahifani tanlang...");
        foreach ($files as $file) {
            $options .= Html::tag('option', $file->name, ['value' => $file->slug]);
        }

        return $options;
    }

    private function leaders()
    {
        $leaders = LeaderCategory::find()->all();
        $options = Html::tag('option', "Sahifani tanlang...");
        foreach ($leaders as $leader) {
            $options .= Html::tag('option', $leader->name, ['value' => $leader->slug]);
        }

        return $options;
    }

    private function news()
    {
        $news = PostCategory::find()->all();
        $options = Html::tag('option', "Sahifani tanlang...");
        foreach ($news as $new) {
            $options .= Html::tag('option', $new->name, ['value' => $new->slug]);
        }

        return $options;
    }

    private function sections()
    {
        $sections = Yii::$app->getModule('menumanager')->sections();
        $options = Html::tag('option', "Sahifani tanlang ... ");
        foreach ($sections as $route => $label) {
            $options .= Html::tag('option', $label, ['value' => $route]);
        }
        return $options;
    }

}