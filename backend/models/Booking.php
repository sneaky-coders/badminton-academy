<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $court_id
 * @property string $transactionid
 * @property string $orderid
 * @property int $amount
 * @property string $status
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Court $court
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['court_id', 'transactionid', 'orderid', 'amount'], 'required'],
            [['court_id', 'amount'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['transactionid', 'status'], 'string', 'max' => 100],
            [['orderid'], 'string', 'max' => 300],
            [['court_id'], 'exist', 'skipOnError' => true, 'targetClass' => Court::className(), 'targetAttribute' => ['court_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'court_id' => 'Court ID',
            'transactionid' => 'Transactionid',
            'orderid' => 'Orderid',
            'amount' => 'Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Court]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourt()
    {
        return $this->hasOne(Court::className(), ['id' => 'court_id']);
    }
}
