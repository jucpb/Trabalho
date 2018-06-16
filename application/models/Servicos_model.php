<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicos_model extends CI_Model {

    function getServico($id) {

        $this->db->select('c.nom_cliente as nome,
                           c.email as emailCliente,
                           s.*,p.*');
        $this->db->from('servicos s');
        $this->db->join('cliente c', 's.cliente_fk = c.cod_cliente');
        $this->db->join('parceiro p', 's.parceiro_fk = p.cod_parceiro', 'left');
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

    function getServicosCliente($id)
    {
        $this->db->select();
        $this->db->from('servicos');
        $this->db->where('cliente_fk',$id, true);
        $query = $this->db->get();
        return $query->result();
    } 

}
