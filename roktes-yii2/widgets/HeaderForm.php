<?php

namespace app\widgets;

use Yii;
use app\models\Hform;

class HeaderForm extends \yii\bootstrap\Widget
{
    public function run(){
        $model = new Hform();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	if ($model->sendForm(Yii::$app->params['offerEmail'])){
                $answer = '<div class="form-info-success">';
                $answer .= "Скоро наши менеджеры отправят Вам КП или перезвонят если есть вопросы по доставке \ комплектации \ ТЗ." . '<br />' . "Это займет не более 24 часа." . '<br />' . "Спасибо!";
                $answer .= '</div>';
                return $answer;
            }
            return $model->getErrors();
    	} else {
    	    return $this->render('viewHeaderForm', [
    	    	'model' => $model,
    	    ]);
    	}
    }		
}
