<?php

namespace cyberz\language\components;

use cyberz\language\models\Language;
use yii\web\UrlManager;


class LanguageUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){

            $lang = Language::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Language::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            $lang = Language::getCurrent();
        }

        $url = parent::createUrl($params);

        if( $url == '/' ){
            return '/'.$lang->url;
        }else{
            return '/'.$lang->url.$url;
        }
    }
}