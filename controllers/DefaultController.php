<?php

namespace giicms\news\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use giicms\news\models\Post;
use giicms\news\controllers\FrontendController;

class DefaultController extends FrontendController
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['type' => 'news'])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->view->title = 'News';
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
