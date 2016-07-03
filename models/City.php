<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property string $city.id
 * @property string $city.name
 * @property integer $city.author.id
 * @property integer $city.world.id
 * @property integer $city.create.time
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city.name', 'city.author.id', 'city.world.id', 'city.create.time'], 'required'],
            [['city.author.id', 'city.world.id', 'city.create.time'], 'integer'],
            [['city.name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city.id' => 'City ID',
            'city.name' => 'City Name',
            'city.author.id' => 'City Author ID',
            'city.world.id' => 'City World ID',
            'city.create.time' => 'City Create Time',
        ];
    }

    /**
     * @inheritdoc
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
