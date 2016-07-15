<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Chat]].
 *
 * @see \app\models\Chat
 */
class ChatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Chat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Chat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}