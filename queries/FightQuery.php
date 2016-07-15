<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Fight]].
 *
 * @see \app\models\Fight
 */
class FightQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Fight[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Fight|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}