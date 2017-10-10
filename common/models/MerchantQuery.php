<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Merchant]].
 *
 * @see Merchant
 */
class MerchantQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Merchant[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Merchant|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
