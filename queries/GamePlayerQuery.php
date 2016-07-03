<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[GamePlayer]].
 *
 * @see GamePlayer
 */
class GamePlayerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GamePlayer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GamePlayer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}