<?php
class Auth_model extends CI_Model {

    private $table = "users";

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }
}
