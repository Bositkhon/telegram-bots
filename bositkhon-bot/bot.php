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

/*$db = new DbHelper([
    'host' => getenv('DB_HOST'),
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
    'db' => getenv('DB_NAME'),
]);*/

$i18n = new \o80\i18n\I18N();
$i18n->setPath(__DIR__ . '/langs');
$i18n->setDefaultLang('en');

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
    $user = $msg->getFrom();
    $chat = $msg->getChat();

    $telegram->sendMessage([
        'reply_to_message_id' => $msg->getMessageId(),
        'chat_id' => $msg->getChat()->getId(),
        'text' => \Telegram\Bot\Helpers\Emojify::text( $i18n->get('common', 'Добро пожаловать') . ':bangbang:'),
        'parse_mode' => 'Markdown',
        'reply_markup' => CustomKeyboard::languageKeyboard(),
    ]);
}

error_log('asdasd');


?>