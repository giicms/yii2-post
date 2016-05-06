<?php

namespace giicms\post\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use giicms\post\controllers\PostController;

/**
 * AdminController implements the CRUD actions for Post model.
 */
class AdminController extends PostController
{

    public function getType()
    {
        return 'post';
    }

}
