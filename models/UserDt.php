<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_dt".
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property string $correct
 * @property string $wrong
 * @property string $selected
 * @property string $date
 */
class UserDt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_dt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'correct', 'wrong', 'selected'], 'required'],
            [['user_id', 'test_id'], 'integer'],
            [['date'], 'safe'],
            [['correct', 'wrong', 'selected'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_id' => 'Test ID',
            'correct' => 'Correct',
            'wrong' => 'Wrong',
            'selected' => 'Selected',
            'date' => 'Date',
        ];
    }
}
