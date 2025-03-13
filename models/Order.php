<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property float $total_price
 * @property int $status_id
 * @property string $address
 * @property string $phone
 * @property string $created_at
 * @property string $date
 * @property string $time
 * @property string $other_reason
 *
 * @property Product $product
 * @property Status $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'total_price', 'status_id', 'address', 'phone', 'date', 'time', 'other_reason'], 'required'],
            [['user_id', 'product_id', 'status_id'], 'integer'],
            [['total_price'], 'number'],
            [['created_at', 'date', 'time'], 'safe'],
            [['address', 'phone', 'other_reason'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заявки',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'created_at' => 'Время создания заказа',
            'date' => 'Дата получения заказа',
            'time' => 'Время получения заказа',
            'product_id' => 'Товар',
            'total_price' => 'Итоговая цена заказа',
            'status_id' => 'Статус',
            'other_reason' => 'Причина отмены заказа',
            'user_id' => 'Клиент',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
