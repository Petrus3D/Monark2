<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Land]].
 *
 * @see \app\models\Land
 */
class LandQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Land[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Land|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}