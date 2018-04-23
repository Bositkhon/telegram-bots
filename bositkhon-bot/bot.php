<?php
/**
 * Created by PhpStorm.
 * User: Bositkhon
 * Date: 16.04.2018
 * Time: 0:18
 */

require '../vendor/autoload.php';

$loader = new Nette\Loaders\RobotLoader();

$loader->addDirectory(__DIR__ . '/helpers');
$loader->setTempDirectory(__DIR__ . '/temp');
$loader->register();

$env = new \Dotenv\Dotenv(__DIR__);
$env->load();

$db = new DbHelper([
    'host' => getenv('DB_HOST'),
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
    'db' => getenv('DB_NAME'),
]);

$i18n = new \o80\i18n\I18N();
$i18n->setPath(__DIR__ . '/langs');
$telegram = new \Telegram\Bot\Api( getenv(BOT_TOKEN) );

try{
//    $updates = $telegram->getUpdates();
    $update = $telegram->getWebhookUpdate();
}catch (Exception $e){
    error_log($e->getMessage());
}

//$update = array_pop($updates);
$msg = null;

if($update->getMessage() != null){
    $msg = $update->getMessage();
}else{
    $msg = $update->getEditedMessage();
}

if($msg != null){
    error_log(json_encode($msg));
    $user = $msg->getFrom();
    $chat = $msg->getChat();
    $user_id = $user->getId();
    $firstname = $chat->getFirstName();
    $lastname = $chat->getLastName();
    $username = $chat->getUsername();

    if($db->userExists($user_id)){
        $lang = $db->getUserLanguage($user_id);
        $i18n->setDefaultLang($lang);
    }else{
        $i18n->setDefaultLang('common');
    }

    if(strtolower($chat->getType()) == 'private'){
        $text = strtolower($msg->getText());
        if(!is_null($text)){
            if($text == '/start'){
                if($db->userExists()){
                    $telegram->sendMessage([
                        'reply_to_message_id' => $msg->getMessageId(),
                        'chat_id' => $msg->getChat()->getId(),
                        'text' => \Telegram\Bot\Helpers\Emojify::text($i18n->format('common', 'Welcome new user', [$firstname, $firstname, $firstname])),
                        'parse_mode' => 'Markdown',
                        'reply_markup' => CustomKeyboard::languageKeyboard(),
                    ]);
                }else{
                    $telegram->sendMessage([
                        'reply_to_message_id' => $msg->getMessageId(),
                        'chat_id' => $msg->getChat()->getId(),
                        'text' => \Telegram\Bot\Helpers\Emojify::text($i18n->format('common', 'Welcome new user', [$firstname, $firstname, $firstname])),
                        'parse_mode' => 'Markdown',
                        'reply_markup' => CustomKeyboard::languageKeyboard(),
                    ]);
                }
            }elseif (stristr($text, 'Руссий язык')){
                $telegram->sendMessage([
                    'reply_to_message_id' => $msg->getMessageId(),
                    'chat_id' => $msg->getChat()->getId(),
                    'text' => \Telegram\Bot\Helpers\Emojify::text($i18n->format('common', 'Welcome new user', [$firstname, $firstname, $firstname])),
                    'parse_mode' => 'Markdown',
                    'reply_markup' => CustomKeyboard::languageKeyboard(),
                ]);
            }
        }
    }

}


?>