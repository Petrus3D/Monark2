<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\ChatRead]].
 *
 * @see \app\models\ChatRead
 */
class ChatReadyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ChatRead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ChatRead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}