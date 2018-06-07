<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UserRecord;
use yii\web\IdentityInterface;

class AuthForm extends Model{

    public $email;
    public $password;

    public function rules(){
        return [[['email', 'password'], 'required'],
                [['email'], 'email'],
                [['email'], 'checkemail'],
                [['password'], 'string', 'min'=>5, 'max'=>10],
                [['password'], 'checkPassword']       
    ];
    }

    public function checkemail($attribute, $params){
       if (!$this->hasErrors()) {
        $user=$this->getUser();
        if (!$user) {
            $this->addError($attribute, 'This User is not exists');
        }
       } 
    }

    public function checkPassword($attribute, $params){ 
        if (!$this->hasErrors()) {
            $user=$this->getUser();
            $hash=$user->password;
            if (!$user || !$user->issetPassword($this->password, $hash)) {
                $this->addError($attribute, 'Password is not true!');
            }
        }
    }

    public function getUser(){
        return UserRecord::findOne(['email'=>$this->email]);
    }

    public function getUserStatus(){
        return $this->getUser()->status;
    }
    
}