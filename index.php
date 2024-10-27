<?php
session_start();
require_once 'models/model_role.php';

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard':
        include 'views/kosong.php';
        break;

    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list'; // Set default to 'list'
        $obj_role = new modelRole();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $role_name = $_POST['role_name'];
                    $role_description = $_POST['role_description'];
                    $role_salary = $_POST['role_salary'];
                    $role_status = $_POST['role_status'];
                    $obj_role->addRole($role_name, $role_description, $role_salary, $role_status);
            
                    // Set flash message in session
                    $_SESSION['message'] = 'Role added successfully';
            
                    header('Location: index.php?modul=role&fitur=list'); // Redirect to list after add
                    exit();
                }
                include 'views/role_add.php';
                break;
        
                case 'update':
                    if (isset($_GET['role_id'])) {
                        $role_id = $_GET['role_id'];
                        $roles = $obj_role->getAllRole();
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
                            
                            $obj_role->updateRole($role_id, $role_name, $role_description, $role_salary, $role_status);
                
                            // Set flash message for update success
                            $_SESSION['flash_message'] = 'Role updated successfully';
                            header('Location: index.php?modul=role&fitur=list');
                            exit();
                        }
                
                        include 'views/role_update.php';
                    } else {
                        header('Location: index.php?modul=role&fitur=list');
                        exit();
                    }
                    break;
        
            case 'list':
            default:
                $roles = $obj_role->getAllRole();
                include 'views/role_list.php';
                break;
        }
        break;

    default:
        include 'views/kosong.php';
        break;
}
?>
