<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property int $companions_id
 *
 * @property Catalog[] $catalogs
 * @property Companions $companions
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'companions_id'], 'required'],
            [['price'], 'number'],
            [['companions_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['companions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companions::class, 'targetAttribute' => ['companions_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'companions_id' => 'Companions ID',
        ];
    }

    /**
     * Gets query for [[Catalogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Companions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanions()
    {
        return $this->hasOne(Companions::class, ['id' => 'companions_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['product_id' => 'id']);
    }
}
