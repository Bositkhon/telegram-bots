<?php
/**
 * Created by PhpStorm.
 * User: Bositkhon
 * Date: 18.04.2018
 * Time: 0:26
 */

class Custom
{
    public static function sendMessage(\Telegram\Bot\Api $telegram, $text)
    {
        try{
            $telegram->sendMessage([
                'chat_id' => '519636610',
                'message' => $text
            ]);
        }catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
}