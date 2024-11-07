<?php
class User {
    public $user_id;
    public $user_name;
    public $username;
    public $password;
    public $role_name;
    public $role_id;

    function __construct($user_id, $user_name, $username, $password, $role_name, $role_id) {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->username = $username;
        $this->password = $password;
        $this->role_name = $role_name;
        $this->role_id = $role_id;
    }
}