<?php
namespace cyberz\language\widgets;

class Switcher extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('switcher', [
            'current' => \cyberz\language\models\Language::getCurrent(),
            'langs' => \cyberz\language\models\Language::find()->where('id != :current_id', [':current_id' => \cyberz\language\models\Language::getCurrent()->id])->all(),
        ]);
    }
}