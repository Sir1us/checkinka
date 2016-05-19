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
    
    public static function findActions()
    {
        
        return 'cashdesk_actions';
        
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
