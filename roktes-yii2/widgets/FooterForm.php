<?php

namespace app\widgets;

use Yii;
use app\models\Fform;
use yii\web\HttpException;

class FooterForm extends \yii\bootstrap\Widget
{
    public function run(){
        $model = new Fform();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendForm(Yii::$app->params['offerEmail'])){
                $answer = '<div class="form-info-success">';
                $answer .= "Скоро наши менеджеры ответят на Ваш вопрос." . '<br />' . "Это займет не более 24 часа." . '<br />' . "Спасибо!";
                $answer .= '</div>';
                return $answer;
            }else{
                return $model->getErrors();
            }
    	} else {
    	    return $this->render('viewFooterForm', [
    	    	'model' => $model,
    	    ]);
    	}
    }		
}
