<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pact_list".
 *
 * @property string $pact_list_id
 * @property string $pact_list_name
 * @property integer $pact_list_visibility
 * @property integer $pact_list_exchange
 */
class PactList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pact_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pact_list_name', 'pact_list_visibility', 'pact_list_exchange'], 'required'],
            [['pact_list_visibility', 'pact_list_exchange'], 'integer'],
            [['pact_list_name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pact_list_id' => 'Pact List ID',
            'pact_list_name' => 'Pact List Name',
            'pact_list_visibility' => 'Pact List Visibility',
            'pact_list_exchange' => 'Pact List Exchange',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\PactListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\PactListQuery(get_called_class());
    }
}
