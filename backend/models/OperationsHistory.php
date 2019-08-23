<?php

namespace backend\models;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "operations_history".
 *
 * @property int $id
 * @property int $owner_id
 * @property string $model
 * @property int $model_id
 * @property string $operation
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $owner
 */
class OperationsHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operations_history';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'owner_id',
                'updatedByAttribute' => 'owner_id'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'operation'], 'required'],
            [['owner_id', 'model_id', 'created_at', 'updated_at', 'model_id'], 'integer'],
            [['operation', 'model'], 'string', 'max' => 255],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner_id' => 'Owner',
            'model_id' => 'Model ID',
            'model' => 'Model',
            'operation' => 'Operation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
