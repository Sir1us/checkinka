<?php

namespace backend\controllers;

use backend\models\CashdeskActions;
use backend\models\CashdeskTimesheet;
use \yii\db\Expression;
use Yii;


class CashdeskTimesheetController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $postDate = Yii::$app->request->post('datepicker');
        $pattern = '(^(((\d\d)(([02468][048])|([13579][26]))-02-29)|(((\d\d)(\d\d)))-((((0\d)|(1[0-2]))-((0\d)|(1\d)|(2[0-8])))|((((0[13578])|(1[02]))-31)|(((0[1,3-9])|(1[0-2]))-(29|30)))))$)';
        if (isset($postDate) && !empty($postDate)) {
            if (preg_match($pattern, $postDate)) {


                $wtf = [':dt1' => $postDate];
                $cashdeskTS = CashdeskTimesheet::find()->
                where(['BETWEEN', 'opendt', $postDate, new Expression('(:dt1::date + interval \'1 month\')', $wtf)], $wtf)->
                orWhere(['BETWEEN', 'closedt', $postDate, new Expression('(:dt1::date + interval \'1 month\')', $wtf)], $wtf)->
                asArray()->all();


                $wrong_timesheets = array();
                foreach ($cashdeskTS as $tskey => $tvalue) {
                    $open = $tvalue['opendt'];
                    $close = $tvalue['closedt'];
                    $cashierId = $tvalue['cashier'];
                    $cashdeskNum = $tvalue['cashdesk'];
                    $open_OK = False;
                    $close_OK = False;


                    $openActions = CashdeskActions::find()->
                    where(['cs_action' => 1])->
                    andWhere(['cashier' => $cashierId])->
                    andWhere(['cashdesk' => $cashdeskNum])->
                    andWhere(['dt' => $open])->
                    orderBy('cashier')->
                    orderBy('cashdesk')->
                    limit(1)->
                    asArray()->all();

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


                    $closeActions = CashdeskActions::find()->
                    where(['cs_action' => 4])->
                    andWhere(['cashier' => $cashierId])->
                    andWhere(['cashdesk' => $cashdeskNum])->
                    andWhere(['>', 'dt', $open])->
                    orderBy('dt')->
                    limit(1)->
                    asArray()->all();

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
                    }
                    if (!empty($closeActions)) {
                        if ($close_OK == false) {
                            $tvalue['error'] = ['Ошибка с датой закрытия'];
                            $wrong_timesheets[$tskey] = $tvalue;
                        }
                    }
                    if (!empty($openActions)) {
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
        } else {
            return $this->render('index');
        }
        return $this->render('error');
    }

}
