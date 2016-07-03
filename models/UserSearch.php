<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UserSearch represents the model behind the search form about `app\models\Users`.
 */
class UserSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user.id', 'user.reg.time', 'user.reg.ip', 'user.log.time', 'user.log.ip'], 'integer'],
            [['user.name', 'user.pass', 'user.mail', 'user.reg.pass', 'user.reg.mail'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user.id' => $this->user.id,
            'user.reg.time' => $this->user.reg.time,
            'user.reg.ip' => $this->user.reg.ip,
            'user.log.time' => $this->user.log.time,
            'user.log.ip' => $this->user.log.ip,
        ]);

        $query->andFilterWhere(['like', 'user.name', $this->user.name])
            ->andFilterWhere(['like', 'user.pass', $this->user.pass])
            ->andFilterWhere(['like', 'user.mail', $this->user.mail])
            ->andFilterWhere(['like', 'user.reg.pass', $this->user.reg.pass])
            ->andFilterWhere(['like', 'user.reg.mail', $this->user.reg.mail]);

        return $dataProvider;
    }
}
