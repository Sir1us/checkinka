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
            $wrong_timesheets = array();
            foreach ($cashdeskTS as $tskey => $tvalue) {
                $open = $tvalue['opendt'];
                $close = $tvalue['closedt'];
                $cashierId = $tvalue['cashier'];
                $cashdeskNum = $tvalue['cashdesk'];
                $open_OK = False;
                $close_OK = False;
                $openActions = CashdeskActions::findopenActions($open, $cashierId, $cashdeskNum);
                foreach ($openActions as $okey => $ovalue) {
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


                $closeActions = CashdeskActions::findcloseActions($open, $cashierId, $cashdeskNum);
                    foreach ($closeActions as $ckey => $cvalue) {
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
                
                if (empty($closeActions) && empty($openActions)) {
                    $tvalue['error'] = ['Нет данных'];
                    $wrong_timesheets[$tskey] = $tvalue;
                } elseif (empty($closeActions)) {
                    $tvalue['error'] = ['Ошибка в данных'];
                    $wrong_timesheets[$tskey] = $tvalue;
                } elseif (empty($openActions)) {
                    $tvalue['error'] = ['Ошибка в данных'];
                    $wrong_timesheets[$tskey] = $tvalue;
                } elseif (!empty($openActions)) {
                    if ($close_OK == false) {
                        $tvalue['error'] = ['Ошибка с датой закрытия'];
                        $wrong_timesheets[$tskey] = $tvalue;
                    }
                } elseif (!empty($closeActions)) {
                    if ($open_OK == false) {
                        $tvalue['error'] = ['Ошибка с датой открытия'];
                        $wrong_timesheets[$tskey] = $tvalue;
                    }
                }
                
            }

            return $this->render('index', [
                'wrong_timesheets' => $wrong_timesheets,

            ]);
        }
        return $this->render('index');
    }
}