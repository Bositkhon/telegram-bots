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
        array_push($buttons, self::button(['text' => 'lang1']));
        array_push($buttons, self::button(['text' => 'lang2']));
        array_push($layout, $buttons);
        $keyboard = self::make([
            'keyboard' => $layout,
            'resize_keyboard' => true
        ]);
        return $keyboard;
    }
}