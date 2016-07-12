<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Buy]].
 *
 * @see \app\models\Buy
 */
class BuyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Buy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Buy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}