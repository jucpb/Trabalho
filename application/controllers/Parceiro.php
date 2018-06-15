<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parceiro extends MY_Controller {
    


    public function __construct()
    {
        parent::__construct();
        $this->load->model('parceiro_model');
    }
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function index_get($id = null)
    {

        if ($id) {
            $parceiro = $this->parceiro_model->getParceiro($id);
        } else {
            $parceiro = $this->parceiro_model->getParceiros();
        }
        

        if ($parceiro) {
            $this->response($parceiro);
        } else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Parceiro não encontrado'
            ];
            $this->response($resposta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        
        $this->form_validation->set_rules('nom_parceiro', 'nom_parceiro', 'required');
        $this->form_validation->set_rules('cnpj', 'cnpj', 'required|exact_length[14]|numeric');
        $this->form_validation->set_rules('email_parceiro', 'email_parceiro', 'required|valid_email');
        $this->form_validation->set_rules('logradouro', 'logradouro', 'required');
        $this->form_validation->set_rules('bairro', 'bairro', 'required');
        $this->form_validation->set_rules('cidade', 'cidade', 'required');
        $this->form_validation->set_rules('tel_parceiro', 'tel_parceiro', 'required|numeric|min_length[10]|max_length[11]');

        $this->form_validation->set_data($this->post(NULL,TRUE));

        if ($this->form_validation->run() == FALSE)
        {                    
                $dados = array(
                    'status'=>FALSE,
                    'erro' => $this->form_validation->error_array()
                );
                $this->response($dados,REST_Controller::HTTP_BAD_REQUEST);
        }


        $dados = [
            'cnpj' => $this->post('cnpj',true),
            'nom_parceiro' => $this->post('nom_parceiro',true),
            'email_parceiro' => $this->post('email_parceiro',true),
            'logradouro' => $this ->post('logradouro',true),
            'bairro' => $this ->post('bairro',true),
            'regional' => $this ->post('regional',true),
            'cidade' => $this ->post('cidade',true),
            'tel_parceiro' => $this ->post('tel_parceiro',true),
        ];
        
        $insert = $this->parceiro_model->cadastrarParceiro($dados);

        if ($insert) {

            $resposta = [
                'status' => true,
                'mensagem' => 'Parceiro cadastrado com sucesso',
                'id' => $insert
            ];
            $this->response($resposta,REST_Controller::HTTP_CREATED);
        }
        else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Erro ao inserir o parceiro'
            ];
            $this->response($resposta, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function index_delete($id = null)
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Parceiro removido com sucesso'
        ];

        $this->response($dados);
    }

    public function index_patch()
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Parceiro atualizado com sucesso'
        ];
        $this->response($dados);
    }



}
