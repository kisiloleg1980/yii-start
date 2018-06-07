<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegForm;
use app\models\AuthForm;


class UserController extends Controller
{

  public function actionReg(){
    $model=new RegForm();
   if ($model->load(Yii::$app->request->post())) {
      $model->attributes = Yii::$app->request->post('RegsForm');
            if ($model->validate()){
                $model->Add();
                $model->SendMessage();
                 return $this->render('Message1');
            }
    }
    return $this->render('RegView',['model'=>$model]);
  }

  public function actionActivate($key){
    $model=new RegForm();
    $model->Activate_User($key);
    return $this->goHome();
  }

  public function actionAuth(){
    $model=new AuthForm();
    if ($model->load(Yii::$app->request->post())) {
        $model->attributes = Yii::$app->request->post('AuthForm');
        if ($model->validate()) {
          if (!$model->getUserStatus()) {
            return $this->render('Message1');
          } else {
            Yii::$app->user->login($model->getUser());
            return $this->goHome();
          } 
        }
    }
    return $this->render('AuthView',['model'=>$model]);
  }

  public function actionLogout(){
    Yii::$app->user->logout();
    return $this->goHome();
  }

  

}
