<?php

namespace frontend\controllers;

use frontend\models\forms\SearchForm;
use Yii;
use yii\web\Controller;


class SearchController extends Controller
{
    public function actionIndex()
    {
        $model = new SearchForm();

        if ($model->load(Yii::$app->request->post()) && $result = $model->search()) {
            return $this->render('index', [
                'model' => $model,
                'result' => $result,
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
