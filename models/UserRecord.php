<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class UserRecord extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
    {
        return '{{user}}';
    }
	
	public function SetPassword($word){
    	$this->password=Yii::$app->getSecurity()->generatePasswordHash($word);
	}

	public function SetActiveHex($word){
		$this->active_hex=md5($word);
	}

	public function issetPassword($password, $hash){
		return Yii::$app->getSecurity()->validatePassword($password, $hash);
	}
	
	public static function findIdentity($id)
	{
	      return static::findOne($id);
  	}

  	public function getId()
    {
           return $this->id;
    }
 
    public static function findIdentityByAccessToken($token, $type = null)
    {
          // return static::findOne(['access_token' => $token]);
    }
 
    public function getAuthKey()
    {
          // return $this->authKey;
    }
 
    public function validateAuthKey($authKey)
    {
          // return $this->authKey === $authKey;
    }
	
}