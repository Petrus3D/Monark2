<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Ressource]].
 *
 * @see \app\models\Ressource
 */
class RessourceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Ressource[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Ressource|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}