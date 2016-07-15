<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Difficulty]].
 *
 * @see \app\models\Difficulty
 */
class DifficultyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Difficulty[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Difficulty|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}