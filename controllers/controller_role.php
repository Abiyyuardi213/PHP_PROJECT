<?php
require_once 'models/model_role.php';

class ControllerRole {
    private $obj_role;

    public function __construct() {
        $this->obj_role = new modelRole();
    }

    public function handleRequestRole($fitur) {
        switch ($fitur) {
            case 'add':
                $this->addRole();
                break;
            case 'update':
                $this->updateRole();
                break;
            case 'delete':
                $this->deleteRole();
                break;
            default:
                $this->listRoles();
                break;
        }
    }

    private function addRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];
            $role_salary = $_POST['role_salary'];
            $role_status = $_POST['role_status'];
            $this->obj_role->addRole($role_name, $role_description, $role_salary, $role_status);

            $_SESSION['message'] = 'Role added successfully';
            header('Location: index.php?modul=role&fitur=list');
            exit();
        }
        include 'views/role_add.php';
    }

    private function updateRole() {
        if (isset($_GET['role_id'])) {
            $role_id = $_GET['role_id'];
            $roles = $this->obj_role->getAllRoles();
            $current_role = null;

            foreach ($roles as $role) {
                if ($role->role_id == $role_id) {
                    $current_role = $role;
                    break;
                }
            }

            if ($current_role === null) {
                header('Location: index.php?modul=role&fitur=list');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $role_name = $_POST['role_name'];
                $role_description = $_POST['role_description'];
                $role_salary = $_POST['role_salary'];
                $role_status = $_POST['role_status'];

                $this->obj_role->updateRole($role_id, $role_name, $role_description, $role_salary, $role_status);
                $_SESSION['message'] = 'Role updated successfully';
                header('Location: index.php?modul=role&fitur=list');
                exit();
            }

            include 'views/role_update.php';
        } else {
            header('Location: index.php?modul=role&fitur=list');
            exit();
        }
    }

    private function deleteRole() {
        if (isset($_GET['id'])) {
            $role_id = $_GET['id'];
            $this->obj_role->deleteRole($role_id);

            $_SESSION['message'] = 'Role deleted successfully';
            header('Location: index.php?modul=role&fitur=list');
            exit();
        } else {
            header('Location: index.php?modul=role&fitur=list');
            exit();
        }
    }

    private function listRoles() {
        $roles = $this->obj_role->getAllRoles();
        include 'views/role_list.php';
    }
}