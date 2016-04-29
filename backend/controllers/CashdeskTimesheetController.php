<?php

namespace backend\controllers;

use Yii;
use backend\models\CashdeskTimesheet;
use backend\models\CashdeskActions;

use yii\data\Pagination;

class CashdeskTimesheetController extends \yii\web\Controller
{
    public function actionIndex()
    {

        
        $cashdesk = Yii::$app->db->createCommand('SELECT * FROM cashdesk_timesheet')
            ->queryAll();





        $cashdeskActions = Yii::$app->db->createCommand('SELECT * FROM cashdesk_actions')
            ->queryAll();


        return $this->render('index', [
            'cashdesk' => $cashdesk,
            'cashdeskActions' => $cashdeskActions,
        ]);
    }

}