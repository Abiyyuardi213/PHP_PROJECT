<?php
session_start();
require_once 'models/model_role.php';
require_once 'models/model_user.php';

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
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $obj_role = new modelRole();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $role_name = $_POST['role_name'];
                    $role_description = $_POST['role_description'];
                    $role_salary = $_POST['role_salary'];
                    $role_status = $_POST['role_status'];
                    $obj_role->addRole($role_name, $role_description, $role_salary, $role_status);
            
                    $_SESSION['message'] = 'Role added successfully';
            
                    header('Location: index.php?modul=role&fitur=list');
                    exit();
                }
                include 'views/role_add.php';
                break;

            case 'update':
                if (isset($_GET['role_id'])) {
                    $role_id = $_GET['role_id'];
                    $roles = $obj_role->getAllRoles();
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
                        echo "tes";
                        $_SESSION['message'] = 'Role updated successfully';
                        echo $_SESSION;
                        header('Location: index.php?modul=role&fitur=list');
                        exit();
                    }
                
                    include 'views/role_update.php';
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                    exit();
                }
                break;
        
            case 'delete':
                if (isset($_GET['id'])) {
                    $role_id = $_GET['id'];
                    $obj_role->deleteRole($role_id);

                    $_SESSION['message'] = 'Role deleted successfully';
                    header('Location: index.php?modul=role&fitur=list');
                    exit();
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                    exit();
                }
                break;

            case 'list':
            default:
                $roles = $obj_role->getAllRoles();
                include 'views/role_list.php';
                break;
        }
        break;

    case 'user':
    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
    $obj_role = new modelRole();
    $obj_user = new modelUser($obj_role);

    switch ($fitur) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_name = $_POST['user_name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role_id = $_POST['role_id'];

                $obj_user->addUser($user_name, $username, $password, $role_id);
                header('Location: index.php?modul=user&fitur=list');
                exit();
            }
            $roles = $obj_role->getAllRoles();
            include 'views/user_add.php';
            break;

            case 'update':
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];
                    $users = $obj_user->getAllUsers();
                    $current_user = null;
            
                    foreach ($users as $user) {
                        if ($user->user_id == $user_id) {
                            $current_user = $user;
                            break;
                        }
                    }
            
                    echo $_SERVER['REQUEST_METHOD'];
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        echo "tes";
                        $user_id = $_POST['user_id'];
                        $user_name = $_POST['user_name'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $role_id = $_POST['role_id'];
                    
                        $obj_user->updateUser($user_id, $user_name, $username, $password, $role_id);
                        $_SESSION['message'] = "User updated successfully";
                        header('Location: index.php?modul=user&fitur=list');
                        exit();
                    }
                    $roles = $obj_role->getAllRoles();
                    include 'views/user_update.php';
                }
                break;

        case 'delete':
            if (isset($_GET['id'])) {
                $user_id = $_GET['id'];
                $obj_user->deleteUser($user_id);

                $_SESSION['message'] = 'User deleted successfully';
                header('Location: index.php?modul=user&fitur=list');
                exit();
            } else {
                header('Location: index.php?modul=user&fitur=list');
                exit();
            }
            break;

        case 'list':
            $users = $obj_user->getAllUsers();
             include 'views/user_list.php';
             break;
        default:
            header('Location: index.php?modul=dashboard');
            break;
    }
    break;
}
?>