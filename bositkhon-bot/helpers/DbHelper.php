<?php
/**
 * Created by PhpStorm.
 * User: Bositkhon
 * Date: 16.04.2018
 * Time: 0:21
 */

class DbHelper extends \DB\SafeMySQL{
    public function changeUserLanguage($user_id, $lang)
    {
        return $this->query('UPDATE users SET ?u WHERE user_id = ?s', ['lang' => $lang] , $user_id);
    }

    public function userExists($user_id)
    {
        return boolval($this->getOne('SELECT * FROM users WHERE user_id = ?s', $user_id));
    }

    public function getUserLanguage($user_id)
    {
        return $this->getOne('SELECT lang FROM users WHERE user_id = ?s', $user_id);
    }



}

?>