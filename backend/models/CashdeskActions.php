<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cashdesk_actions".
 *
 * @property integer $id
 * @property integer $cashdesk
 * @property string $dt
 * @property integer $cs_action
 * @property integer $cashier
 */
class CashdeskActions extends \yii\db\ActiveRecord
{
    
    public static function findopenActions($open, $cashierId, $cashdeskNum)
    {

        return Yii::$app->db->createCommand("SELECT * FROM cashdesk_actions 
                                                        WHERE cs_action = 1 
                                                           AND 
                                                         cashdesk = '$cashdeskNum' AND 
                                                         cashier = '$cashierId' AND 
                                                         dt = '$open'
                                                         ORDER BY cashdesk, cashier LIMIT 1")
            ->queryAll();

    }

    public static function findcloseActions($open, $cashierId, $cashdeskNum)
    {

        return Yii::$app->db->createCommand("SELECT * FROM cashdesk_actions 
                                                        WHERE cs_action = 4 
                                                           AND 
                                                         cashdesk = '$cashdeskNum' AND 
                                                         cashier = '$cashierId' AND 
                                                         dt > '$open'
                                                         ORDER BY dt ASC LIMIT 1")
            ->queryAll();

    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cashdesk', 'dt', 'cs_action'], 'required'],
            [['id', 'cashdesk', 'cs_action', 'cashier'], 'integer'],
            [['dt'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cashdesk' => 'Cashdesk',
            'dt' => 'Dt',
            'cs_action' => 'Cs Action',
            'cashier' => 'Cashier',
        ];
    }
}
