<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "court".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $contact
 * @property string|null $address
 * @property string|null $date
 * @property string|null $starttime
 * @property string|null $endtime
 * @property int $adults
 * @property int $children
 * @property int $young_children
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Booking[] $bookings
 */
class Court extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'court';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adults', 'children', 'young_children'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'date', 'starttime', 'endtime'], 'string', 'max' => 100],
            [['contact'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'contact' => 'Contact',
            'address' => 'Address',
            'date' => 'Date',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'adults' => 'Adults',
            'children' => 'Children',
            'young_children' => 'Young Children',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['court_id' => 'id']);
    }
}
