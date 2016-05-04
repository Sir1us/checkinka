<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;

class CashdeskTimesheetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (isset($_POST["datepicker"])) {
            $postDate = $_POST["datepicker"];


            $cashdeskTS = Yii::$app->db->createCommand("SELECT * FROM cashdesk_timesheet WHERE opendt
            BETWEEN '$postDate' AND
            (date '$postDate' + interval '1 month') or closedt
            BETWEEN '$postDate' AND
            (date '$postDate' + interval '1 month')")
                ->queryAll();


            $cashdeskActions = Yii::$app->db->createCommand("SELECT * FROM cashdesk_actions WHERE dt
            BETWEEN '$postDate' AND
            (date '$postDate' + interval '1 month')")
                ->queryAll();

            $wrong_timesheets = array();
            foreach ($cashdeskTS as $tkey => $tvalue) {
                $open = $tvalue['opendt'];
                $close = $tvalue['closedt'];
                $cashierId = $tvalue['cashier'];
                $cashdeskNum = $tvalue['cashdesk'];
                $open_OK = False;
                $close_OK = False;
                foreach ($cashdeskActions as $avalue) {
                    $cashierIdA = $avalue['cashier'];
                    $cashdeskNumA = $avalue['cashdesk'];
                    $dt = $avalue['dt'];
                    $action = $avalue['cs_action'];
                    if ($open == $dt && $action == 1 && $cashierId == $cashierIdA && $cashdeskNum == $cashdeskNumA) {
                        $open_OK = True;
                    }
                }

                foreach ($cashdeskActions as $avalue) {
                    $cashierIdA = $avalue['cashier'];
                    $cashdeskNumA = $avalue['cashdesk'];
                    $dt = $avalue['dt'];
                    $action = $avalue['cs_action'];
                    if ($close == $dt && $action == 4 && $cashierId == $cashierIdA && $cashdeskNum == $cashdeskNumA) {
                        $close_OK = True;
                    }
                }

                if ($open_OK == False || $close_OK == False) {
                    $wrong_timesheets[$tkey] = $tvalue;
                }


            }

            return $this->render('index', [
                'wrong_timesheets' => $wrong_timesheets,
            ]);
        }
    }
}