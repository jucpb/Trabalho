<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parceiro_model extends CI_Model {

    function getParceiro($id) {

        $this->db->select();
        $this->db->from('parceiro');
        $this->db->where('cod_parceiro', $id, true);
        $query = $this->db->get();
        return $query->row();
    }


    function getParceiros(){
        $this->db->select();
        $this->db->from('parceiro');
        $query = $this->db->get();
        return $query->result();
    }

    function cadastrarParceiro($dados) {

        if($this->db->insert('parceiro',$dados)){
            return $this->db->insert_id();
        }
        return false;
    }
}
