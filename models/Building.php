<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property string $building_id
 * @property string $building_name
 * @property integer $building_cost
 * @property integer $building_id_need
 * @property integer $building_gold_income
 * @property integer $building_petrol_income
 * @property string $building_description
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_name', 'building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income', 'building_description'], 'required'],
            [['building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income'], 'integer'],
            [['building_name'], 'string', 'max' => 128],
            [['building_description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'building_id' => 'Building ID',
            'building_name' => 'Building Name',
            'building_cost' => 'Building Cost',
            'building_id_need' => 'Building Id Need',
            'building_gold_income' => 'Building Gold Income',
            'building_petrol_income' => 'Building Petrol Income',
            'building_description' => 'Building Description',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\BuildingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BuildingQuery(get_called_class());
    }
}
