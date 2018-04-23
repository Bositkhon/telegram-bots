<?php
/**
 * Created by PhpStorm.
 * User: Bositkhon
 * Date: 18.04.2018
 * Time: 0:39
 */

class CustomKeyboard extends \Telegram\Bot\Keyboard\Keyboard
{
    public static function languageKeyboard(){
        $buttons = array();
        $layout = array();
        array_push($buttons, self::button(['text' => \Telegram\Bot\Helpers\Emojify::text(':uz: O\'zbek tili :uz:')]));
        array_push($buttons, self::button(['text' => \Telegram\Bot\Helpers\Emojify::text(':ru: Русский язык :ru:')]));
        array_push($buttons, self::button(['text' => \Telegram\Bot\Helpers\Emojify::text(':us: English :us:')]));
        array_push($layout, $buttons);
        $keyboard = self::make([
            'keyboard' => $layout,
            'resize_keyboard' => true
        ]);
        return $keyboard;
    }
}