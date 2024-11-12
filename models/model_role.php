<?php
require_once 'nodes/node_role.php';

class modelRole {
    private $roles = [];

    public function __construct() {
        if (isset($_SESSION['roles'])) {
            $this->roles = unserialize($_SESSION['roles']);
        } else {
            $this->initializeDefaultRole();
        }
    }

    private function getLastID() {
        $maxId = 0;
        foreach ($this->roles as $role) {
            if ($role->role_id > $maxId) {
                $maxId = $role->role_id;
            }
        }
        return $maxId;
    }

    public function initializeDefaultRole() {
        if (empty($this->roles)) {
            $this->addRole("Customer", "Member", 0, 1);
            $this->addRole("Administrator", "Admin", 3500000, 1);
            $this->addRole("Supervisor", "Manager", 6600000, 1);
        }
    }

    public function addRole($role_name, $role_description, $role_salary, $role_status) {
        $newId = $this->getLastID() + 1;
        $peran = new Role($newId, $role_name, $role_description, $role_salary, $role_status);
        $this->roles[] = $peran;
        $this->saveToSession();
    }

    public function saveToSession() {
        $_SESSION['roles'] = serialize($this->roles);
    }

    public function getAllRoles() {
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

    public function getRoleNameById($role_id) {
        foreach ($this->roles as $role) {
            if ($role->role_id == $role_id) {
                return $role->role_name;
            }
        }
        return null;
    }

    public function getRoleIdByName($role_name) {
        foreach ($this->roles as $role) {
            if ($role->role_name === $role_name) {
                return $role->role_id;
            }
        }
        return null; // Role not found
    }
}
?>
