<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[GameData]].
 *
 * @see GameData
 */
class GameDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GameData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GameData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}