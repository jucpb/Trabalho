<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class servicos_model extends CI_Model {

    function getServico($id) {

        $this->db->select();
        $this->db->from('servicos');
        $this->db->where('cod_servico', $id, true);
        $query = $this->db->get();
        return $query->row();
    }

    function getServicos(){
        $this->db->select();
        $this->db->from('servicos');
        $query = $this->db->get();
        return $query->result();
    }

    function cadastrarServico($dados) {

        if($this->db->insert('servicos',$dados)){
            return $this->db->insert_id();
        }
        return false;
    }
}
