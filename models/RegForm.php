<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UserRecord;

class RegForm extends Model{

	public $username;
	public $email;
    public $password;

    public function rules(){
    	return [
    	[['username', 'email', 'password'], 'required'],
        ['email', 'email'],
        ['email', 'getEmail'],
        ['username','string', 'min' => 4, 'max'=>30],
        ['password','string', 'min'=>5, 'max'=>10]
    ];
    }

    public function getEmail($attribute, $params){
        if (!$this->hasErrors()) {
            $user=UserRecord::findOne(['email'=>$this->email]);
            if (isset($user)) {
                $this->addError($attribute, 'User is exist. Please choose other login');
            }
        }    
    }

    public function Add(){
        $NewUser=new UserRecord();
        $NewUser->username=$this->username;
        $NewUser->email=$this->email;
        $NewUser->SetPassword($this->password);
        $NewUser->SetActiveHex($this->password);
        $NewUser->status=0;
        return $NewUser->save();
    }

    public function SendMessage(){
        $active_hex=UserRecord::findOne(['email'=>$this->email])->active_hex;
        Yii::$app->mailer->compose()
            ->setFrom('from@myyii.com')
            ->setTo($this->email)
            ->setSubject('Активация профиля')
            ->setHtmlBody('Подтверждение регистрации. <a href="http://myyii.com/user/activate/?key='.$active_hex.'">Актировать</a><br>Логин: '.$this->email.'<br> Пароль:'. $this->password)
            ->send();
    }

    public function Activate_User($key){
        $user=UserRecord::findOne(['active_hex'=>$key]);
        if (isset($user)){
            UserRecord::updateAll(['status' => 1],['email'=>$user->email]);
        }
    }

    
    

}