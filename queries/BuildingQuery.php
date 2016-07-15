<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Building]].
 *
 * @see \app\models\Building
 */
class BuildingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Building[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Building|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}