<?php

namespace cyberz\language\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property integer $default
 * @property integer $created_at
 * @property integer updated_at
 */
class Language extends \yii\db\ActiveRecord
{
    //Переменная, для хранения текущего объекта языка
    static $current = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['createTime', 'updateTime'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updateTime'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'local', 'name', 'created_at', 'updated_at'], 'required'],
            [['default', 'createTime', 'updateTime'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255]
        ];
    }

    static function getCurrent()
    {
        if( self::$current === null ){
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->local;
    }

    static function getDefaultLang()
    {
        try{
            $l = Language::find()->where('`default` = :default', [':default' => 1])->one();
            if($l){
                return $l;
            }
        }
        catch(Exception $e){
        }

        return \Yii::$app->language;
    }

    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Language::find()->where('url = :url', [':url' => $url])->one();
            if ( $language === null ) {
                return null;
            }else{
                return $language;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'local' => Yii::t('app', 'Local'),
            'name' => Yii::t('app', 'Name'),
            'default' => Yii::t('app', 'Default'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }
}
