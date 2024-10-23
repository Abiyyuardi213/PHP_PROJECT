<?php
class Role {
    public $role_id;
    public $role_name;
    public $role_description;
    public $role_sallary;
    public $role_status;

    function __construct($role_id, $role_name, $role_description, $role_sallary, $role_status) {
        $this->role_id = $role_id;
        $this->role_name = $role_name;
        $this->role_description = $role_description;
        $this->role_sallary = $role_sallary;
        $this->role_status = $role_status;
    }
}

?>