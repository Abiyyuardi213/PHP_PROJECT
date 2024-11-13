<?php
require_once 'models/model_user.php';
require_once 'models/model_role.php';

class ControllerUser {
    private $obj_role;
    private $obj_user;

    public function __construct() {
        $this->obj_role = new modelRole();
        $this->obj_user = new modelUser();
    }

    public function handleRequestUser($fitur) {
        $obj_user = new modelUser();
        $obj_role = new modelRole();
        
        switch ($fitur) {
            case 'add':
                $this->addUser();
                break;
            case 'update':
                $this->updateUser();
                break;
            case 'delete':
                $this->deleteUser();
                break;
            default:
                $users = $this->obj_user->getAllUsers();
                include 'views/user_list.php';
        }
    }

    private function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];

            $this->obj_user->addUser($user_name, $username, $password, $role_id);
            $_SESSION['message'] = 'User added successfully';
            header('Location: index.php?modul=user&fitur=list');
            exit();
        }
        $roles = $this->obj_role->getAllRoles();
        include 'views/user_add.php';
    }

    private function updateUser() {
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $users = $this->obj_user->getAllUsers();
            $current_user = null;

            foreach ($users as $user) {
                if ($user->user_id == $user_id) {
                    $current_user = $user;
                    break;
                }
            }

            if ($current_user === null) {
                header('Location: index.php?modul=user&fitur=list');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_name = $_POST['user_name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role_id = $_POST['role_id'];

                $this->obj_user->updateUser($user_id, $user_name, $username, $password, $role_id);
                $_SESSION['message'] = 'User updated successfully';
                header('Location: index.php?modul=user&fitur=list');
                exit();
            }

            $roles = $this->obj_role->getAllRoles();
            include 'views/user_update.php';
        } else {
            header('Location: index.php?modul=user&fitur=list');
            exit();
        }
    }

    private function deleteUser() {
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];
            $this->obj_user->deleteUser($user_id);

            $_SESSION['message'] = 'User deleted successfully';
            header('Location: index.php?modul=user&fitur=list');
            exit();
        } else {
            header('Location: index.php?modul=user&fitur=list');
            exit();
        }
    }

    private function listUsers() {
        $users = $this->obj_user->getAllUsers();
        include 'views/user_list.php';
    }
}