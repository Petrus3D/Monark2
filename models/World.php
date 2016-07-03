<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "world".
 *
 * @property string $world.id
 * @property string $world.name
 * @property integer $world.author.id
 * @property integer $world.create.time
 */
class World extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'world';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['world.name', 'world.author.id', 'world.create.time'], 'required'],
            [['world.author.id', 'world.create.time'], 'integer'],
            [['world.name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'world.id' => 'World ID',
            'world.name' => 'World Name',
            'world.author.id' => 'World Author ID',
            'world.create.time' => 'World Create Time',
        ];
    }

    /**
     * @inheritdoc
     * @return WorldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorldQuery(get_called_class());
    }
}
