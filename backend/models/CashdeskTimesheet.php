<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cashdesk_timesheet".
 *
 * @property integer $id
 * @property integer $cashier
 * @property integer $cashdesk
 * @property string $opendt
 * @property string $closedt
 */
class CashdeskTimesheet extends \yii\db\ActiveRecord
{
    public static function cashdeskTS($postDate) {

        return Yii::$app->db->createCommand("SELECT * FROM cashdesk_timesheet WHERE opendt
            BETWEEN '$postDate' AND
            (date '$postDate' + interval '1 month') or closedt
            BETWEEN '$postDate' AND
            (date '$postDate' + interval '1 month')")
            ->queryAll();
    }
    



    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['id', 'cashier', 'cashdesk', 'opendt'], 'required'],
            [['id', 'cashier', 'cashdesk'], 'integer'],
            [['opendt', 'closedt'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cashier' => 'Cashier',
            'cashdesk' => 'Cashdesk',
            'opendt' => 'Opendt',
            'closedt' => 'Closedt',
        ];
    }
}
