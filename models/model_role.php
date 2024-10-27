<?php

require_once 'nodes/node_role.php';

class modelRole {
    private $roles = [];
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['roles'])) {
            $this->roles = unserialize($_SESSION['roles']);
            $this->nextId = count($this->roles) + 1;
        } else {
            $this->initializeDefaultRole();
        }
    }

    public function initializeDefaultRole() {
        if (empty($this->roles)) {
            $this->addRole("sofia", "mahasiswa", 450000, 1); // Add default role
        }
    }

    public function addRole($role_name, $role_description, $role_salary, $role_status) {
        $peran = new Role($this->nextId++, $role_name, $role_description, $role_salary, $role_status);
        $this->roles[] = $peran;
        $this->saveToSession();
    }

    public function saveToSession() {
        $_SESSION['roles'] = serialize($this->roles);
    }

    public function getAllRole() {
        return $this->roles;
    }

    public function updateRole($role_id, $role_name, $role_description, $role_salary, $role_status) {
        foreach ($this->roles as $role) {
            if ($role->role_id == $role_id) {
                $role->role_name = $role_name;
                $role->role_description = $role_description;
                $role->role_salary = $role_salary;
                $role->role_status = $role_status;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function deleteRole($role_id) {
        foreach ($this->roles as $key => $role) {
            if ($role->role_id == $role_id) {
                unset($this->roles[$key]);
                $this->roles = array_values($this->roles);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
}
?>
