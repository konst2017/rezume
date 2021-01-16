<?php
 
namespace frontend\common;
 
use yii\captcha\CaptchaAction as DefaultCaptchaAction;
 
class NumericCaptcha extends DefaultCaptchaAction
{
    protected function generateVerifyCode()
    {
        //Р”Р»РёРЅР°
        $length = 5;
 
        //Р¦РёС„СЂС‹, РєРѕС‚РѕСЂС‹Рµ РёСЃРїРѕР»СЊР·СѓСЋС‚СЃСЏ РїСЂРё РіРµРЅРµСЂР°С†РёРё
        $digits = '12356789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
        $code = '';
        for($i = 0; $i < $length; $i++) {
            $code .= $digits[mt_rand(0,63 )];
        }
        return $code;
    }
}
?>