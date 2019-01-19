<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 20:15
 */

namespace App\Models;


class User extends BaseModel
{
    public $username;
    public $email;
    public $password;

    public function __construct()
    {
        parent::__construct();
        $this->setTableDB('users');
    }

    public function save()
    {
        $this->create(['username', 'email', 'password'], [$this->username, $this->email,
            password_hash($this->password, PASSWORD_DEFAULT)]);
    }

    public function validateUser($username, $password){
        $user = $this->getByKeys(["username" => $username])[0];
        if (isset($user)) {
            return password_verify ( $password, $user['password'] );
        }
        return false;
    }
}