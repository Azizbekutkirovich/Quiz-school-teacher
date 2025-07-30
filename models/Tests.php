<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property int $teach_id
 * @property int $school
 * @property int $class
 * @property string $job
 * @property string $name
 * @property string $test_name
 * @property string $date
 * @property int $time
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teach_id', 'school', 'class', 'job', 'name', 'test_name', 'time'], 'required'],
            [['teach_id', 'school', 'class', 'time'], 'integer'],
            [['date'], 'safe'],
            [['job', 'name', 'test_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teach_id' => 'Teach ID',
            'school' => 'School',
            'class' => 'Class',
            'job' => 'Job',
            'name' => 'Name',
            'test_name' => 'Test Name',
            'date' => 'Date',
            'time' => 'Time',
        ];
    }
}
