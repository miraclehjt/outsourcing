<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MerchantPrice]].
 *
 * @see MerchantPrice
 */
class MerchantPriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MerchantPrice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MerchantPrice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
