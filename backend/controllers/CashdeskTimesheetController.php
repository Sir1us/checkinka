<?php

namespace backend\controllers;

use backend\models\CashdeskActions;
use backend\models\CashdeskTimesheet;
use Yii;


class CashdeskTimesheetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (!empty($_POST["datepicker"])) {
            $postDate = $_POST["datepicker"];

            $cashdeskTS = CashdeskTimesheet::cashdeskTS($postDate);
            $wrong_actions_open = array();
            $wrong_actions_close = array();
            $wrong_timesheets = array();
            foreach ($cashdeskTS as $tkey => $tvalue) {
                $open = $tvalue['opendt'];
                $close = $tvalue['closedt'];
                $cashierId = $tvalue['cashier'];
                $cashdeskNum = $tvalue['cashdesk'];
                $open_OK = False;
                $close_OK = False;

                $openActions = CashdeskActions::findopenActions($open, $cashierId, $cashdeskNum);

                $closeActions = CashdeskActions::findcloseActions($open, $cashierId, $cashdeskNum);

                foreach ($openActions as $akey => $ovalue) {
                    $cashierIdA = $ovalue['cashier'];
                    $cashdeskNumA = $ovalue['cashdesk'];
                    $dt = $ovalue['dt'];
                    $action = $ovalue['cs_action'];
                    if ($open_OK == false) {
                        if ($open == $dt && $action == 1 && $cashierId == $cashierIdA && $cashdeskNum == $cashdeskNumA) {
                            $open_OK = True;
                        }
                    }
                }
                    foreach ($closeActions as $key => $cvalue) {
                        $cashierIdA = $cvalue['cashier'];
                        $cashdeskNumA = $cvalue['cashdesk'];
                        $dt = $cvalue['dt'];
                        $action = $cvalue['cs_action'];
                        if ($close_OK == false) {
                            if ($close == $dt && $action == 4 && $cashierId == $cashierIdA && $cashdeskNum == $cashdeskNumA) {
                                $close_OK = True;
                            }
                        }
                    }

                if ($open_OK == False) {
                        $wrong_actions_open = @$ovalue;
                    $wrong_timesheets[$tkey] = $tvalue;
                }
                if ($close_OK == False) {
                    $wrong_actions_close = @$cvalue;
                    $wrong_timesheets[$tkey] = $tvalue;
                }
            }

            return $this->render('index', [
                'wrong_timesheets' => $wrong_timesheets,
                'wrong_actions_open' => $wrong_actions_open,
                'wrong_actions_close' => $wrong_actions_close,
            ]);
        }
        return $this->render('index');
    }
    public function actionTest()
    {
        $ids = [1, 7, 10, 5];
        foreach ($ids as $id1) {
            $res = CashdeskTimesheet::Test($id1);// получить запись
                    var_dump($res);
        }
    }
}