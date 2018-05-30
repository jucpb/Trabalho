<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente_model extends CI_Model {

    function getCliente($id) {

        $this->db->select();
        $this->db->from('cliente');
        $this->db->where('cod_cliente', $id, true);
        $query = $this->db->get();
        return $query->row();
    }

    function getClientes(){
        $this->db->select();
        $this->db->from('cliente');
        $query = $this->db->get();
        return $query->result();
    }

    function cadastrarCliente($dados) {

        if($this->db->insert('cliente',$dados)){
            return $this->db->insert_id();
        }
        return false;
    }
}
