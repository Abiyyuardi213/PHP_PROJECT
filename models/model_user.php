<?php
require_once 'nodes/node_user.php';
require_once 'models/model_role.php';

class modelUser {
    private $users = [];
    private $roleModel;

    public function __construct() {
        $this->roleModel = new modelRole();

        if (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
        } else {
            $this->initializeDefaultUser();
        }
    }

    private function getLastIDUser() {
        $maxIdUser = 0;
        foreach ($this->users as $user) {
            if ($user->user_id > $maxIdUser) {
                $maxIdUser = $user->user_id;
            }
        }
        return $maxIdUser;
    }

    public function initializeDefaultUser() {
        if (empty($this->users)) {
            $this->addUser("Amelia Sofia", "Amelyas05", "pass1234", 1);
            $this->saveToSession();
        }
    }

    public function addUser($user_name, $username, $password, $role_id) {
        try {
            $newIdUser = $this->getLastIDUser() + 1;
            $role_name = $this->roleModel->getRoleNameById($role_id);
                
            if ($role_name === null) {
                $_SESSION['message'] = "Role not found";
            }
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $user = new User($newIdUser, $user_name, $username, $hashedPassword, $role_name, $role_id);
            $this->users[] = $user;
            $this->saveToSession();
            $_SESSION['message'] = "User added successfully";

        } catch (\Throwable $th) {
            $_SESSION['message'] = "User added failed";
        }
    }

    public function saveToSession() {
        $_SESSION['users'] = serialize($this->users);
    }

    public function getAllUsers() {
        foreach ($this->users as $user) {
            $user->role_name = $this->roleModel->getRoleNameById($user->role_id);
        }
        return $this->users;
    }

    public function updateUser($user_id, $user_name, $username, $password, $role_id) {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                $user->user_name = $user_name;
                $user->username = $username;
                $user->password = ($user->password === $password) ? $password : password_hash($password, PASSWORD_DEFAULT);
                $user->role_id = $role_id;
                $user->role_name = $this->roleModel->getRoleNameById($role_id);
                break;
            }
        }
        $this->saveToSession();
    }
        
    public function deleteUser($user_id) {
        foreach ($this->users as $key => $user) {
            if ($user->user_id == $user_id) {
                unset($this->users[$key]);
                break;
            }
        }
        $this->users = array_values($this->users);
        $this->saveToSession();
    }

    public function getUserById($user_id) {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                return $user;
            }
        }
        return null;
    }

    public function getUserNameById($user_id) {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                return $user->user_name;
            }
        }
        return "Unknown User";
    }
}