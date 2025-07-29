<?php

namespace app\models;
use yii\base\Model;

class Register extends Model
{
	public $login;
	public $name;
	public $surname;
	public $phone;
	public $school;
	public $job;
	public $password;
	public $secret;

	public function rules()
    {
        return [
            [['login', 'name', 'surname', 'phone', 'school', 'job', 'password', 'secret'], 'required', 'message' => "Maydonni to'ldirish shart"],
            [['school'], 'integer'],
            [['name', 'surname', 'phone', 'job'], 'string', 'max' => 255, 'message' => "255ta belgidan iborat bo'lishi kerak!"],
            ['login', 'unique', 'targetClass' => '\app\models\Teachers', 'message' => 'Bu login band!'],
            ['login', 'string', 'min' => 6, 'max' => 255, 'tooShort' => "Login kamida 6ta belgidan iborat bo'lishi kerak!", 'tooLong' => "Login ko'pi bilan 255ta belgidan iborat bo'lishi kerak!"],
            ['phone', 'match', 'pattern' => '/^\+998 \(\d{2}\) \d{3}-\d{2}-\d{2}$/', 'message' => 'Telefon raqamni formati noto‘g‘ri!'],
            ['password', 'string', 'min' => 8, 'max' => 255, 'tooShort' => "Parol kamida 8ta belgidan iborat bo'lishi kerak!", 'tooLong' => "Parol ko'pi bilan 255ta belgidan iborat bo'lishi kerak!"],
            ['password', 'match',  'pattern' => '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', 'message' => 'Parolda katta harf, kichik harf va raqam bo‘lishi shart!']
        ];
    }

    protected function save() {
        if ($this->validate()) {
            $user = new Teachers();
            $user->login = $this->login;
            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->phone = $this->phone;
            $user->school = $this->school;
            $user->job = $this->job;
            $user->setPassword($this->password);
            return $user->save();
        }
    }

    public function register() {
    	return $this->save();
    }
}