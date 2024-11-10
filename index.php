<?php
session_start();
require_once 'models/model_role.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
require_once 'models/model_transaksi.php';

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard':
        include 'views/dashboard.php';
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
            
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $obj_barang = new modelBarang();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $barang_name = $_POST['barang_name'];
                    $barang_stock = $_POST['barang_stock'];
                    $barang_harga = $_POST['barang_harga'];
                    $barang_supplier = $_POST['barang_supplier'];
                    $barang_status = $_POST['barang_status'];
                    $obj_barang->addBarang($barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status);

                    $_SESSION['message'] = 'Inventory added successfully';

                    header('Location: index.php?modul=barang&fitur=list');
                    exit();
                }
                include 'views/barang_add.php';
                break;

            case 'update':
                if (isset($_GET['barang_id'])) {
                    $barang_id = $_GET['barang_id'];
                    $barangs = $obj_barang->getAllBarangs();
                    $current_barang = null;

                    foreach ($barangs as $barang) {
                        if ($barang->barang_id == $barang_id) {
                            $current_barang = $barang;
                            break;
                        }
                    }

                    if ($current_barang === null) {
                        header('Location: index.php?modul=barang&fitur=list');
                        exit();
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $barang_name = $_POST['barang_name'];
                        $barang_stock = $_POST['barang_stock'];
                        $barang_harga = $_POST['barang_harga'];
                        $barang_supplier = $_POST['barang_supplier'];
                        $barang_status = $_POST['barang_status'];

                        $obj_barang->updateBarang($barang_id, $barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status);
                        echo "tes";
                        $_SESSION['message'] = 'Inventory updated successfully';
                        echo $_SESSION;
                        header('Location: index.php?modul=barang&fitur=list');
                        exit();
                    }
                    include 'views/barang_update.php';
                } else {
                    header('Location: index.php?modul=barang&fitur=list');
                    exit();
                }
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $barang_id = $_GET['id'];
                    $obj_barang->deleteBarang($barang_id);

                    $_SESSION['message'] = 'Inventory deleted successfully';
                    header('Location: index.php?modul=barang&fitur=list');
                    exit();
                } else {
                    header('Location: index.php?modul=barang&fitur=list');
                    exit();
                }
                break;

            default:
                $barangs = $obj_barang->getAllBarangs();
                include 'views/barang_list.php';
                break;
        }
        break;

    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $userModel = new modelUser();
        $barangModel = new modelBarang();
        $obj_transaksi = new modelTransaction();
    
        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Mengambil data dari form
                    $user_id = $_POST['user_id'];
                    $transaction_date = date('Y-m-d H:i:s');
                    $transaction_status = 'completed'; // Atur status transaksi (bisa disesuaikan)
                    $barang_ids = $_POST['barang_id']; // Array ID barang
                    $barang_quantities = $_POST['barang_quantity']; // Array kuantitas barang
                
                    // Array untuk detail barang dalam transaksi
                    $detailBarang = [];
                    foreach ($barang_ids as $index => $barang_id) {
                        $quantity = $barang_quantities[$index];
                    
                        $barang = $barangModel->getBarangById($barang_id);
                        if ($barang) {
                            $barang_name = $barang->barang_name;  // Corrected
                            $barang_harga = $barang->barang_harga;  // Corrected
                            $detailBarang[] = [
                                'Id_Barang' => $barang_id,
                                'Jumlah_Barang' => $quantity,
                                'Harga_Barang' => $barang_harga
                            ];
                        }
                    }
                
                    // Menambahkan transaksi
                    $obj_transaksi->addTransaksi($user_id, $transaction_date, $transaction_status, $detailBarang);
                
                    // Menyimpan pesan sukses di session
                    $_SESSION['message'] = "Transaksi berhasil ditambahkan!";
                    header('Location: index.php?modul=transaksi&fitur=list');
                    exit();
                }
                // Mengambil data pengguna dan barang untuk ditampilkan di form
                $users = $userModel->getAllUsers();
                $barangs = $barangModel->getAllBarangs();
                include 'views/transaksi_add.php';
                break;

            case 'view':
                if (isset($_GET['transaksi_id'])) {
                    $transaksi_id = $_GET['transaksi_id'];
                    $transaksi = $obj_transaksi->getTransactionById($transaksi_id);
                    include 'views/transaksi_view.php';
                } else {
                    $_SESSION['message'] = "Transaksi tidak ditemukan.";
                    header('Location: index.php?modul=transaksi&fitur=list');
                    exit();
                }
                break;
    
            case 'list':
                $transactions = $obj_transaksi->getAllTransaction();
                include 'views/transaksi_list.php';
                break;
    
        case 'update':
            // Logic for updating a transaction
            break;
    
        case 'delete':
            // Logic for deleting a transaction
            break;
    
        default:
            header('Location: index.php?modul=transaksi&fitur=list');
            exit();
        }
        break;

    default:
        header('Location: index.php?modul=dashboard');
        break;
}

