<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class Teachers extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'name', 'surname', 'phone', 'school', 'job', 'password'], 'required', 'message' => "Maydonni to'ldirish shart!"],
            [['school'], 'integer'],
            [['login', 'name', 'surname', 'phone', 'job', 'password'], 'string', 'max' => 255],
            ['login', 'unique', 'message' => 'Bu login band!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'school' => 'School',
            'job' => 'Job',
            'password' => 'Password',
        ];
    }

    public static function findIdentity($id)
    {
        return self::find()->select(['id', 'name', 'surname', 'school', 'job'])->where(['id' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return self::find()->select(['id', 'login', 'password'])->where(['login' => $login])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
    }

    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
