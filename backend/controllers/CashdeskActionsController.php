<?php

namespace backend\controllers;
use backend\models\CashdeskActions;

class CashdeskActionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
