<?php
/**
 * Created by PhpStorm.
 * User: Bositkhon
 * Date: 23.04.2018
 * Time: 23:21
 */

require '../../vendor/autoload.php';

class BotHelper extends \Telegram\Bot\Api
{

    public function sendWelcomeMessage(){
        $this->sendMessage([
            'reply_to_message_id' => $this->getUpdates(),
            'chat_id' => $msg->getChat()->getId(),
            'text' => \Telegram\Bot\Helpers\Emojify::text($i18n->format('common', 'Добро пожаловать', [$firstname, $firstname, $firstname])),
            'parse_mode' => 'Markdown',
            'reply_markup' => CustomKeyboard::languageKeyboard(),
        ]);
    }

}