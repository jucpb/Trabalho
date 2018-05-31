<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {
    


    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente_model');
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
            $cliente = $this->cliente_model->getCliente($id);
        } else {
            $cliente = $this->cliente_model->getClientes();
        }
        

        if ($cliente) {
            $this->response($cliente);
        } else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Cliente não encontrado'
            ];
            $this->response($resposta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        
        $this->form_validation->set_rules('nom_cliente', 'nom_cliente', 'required');
        $this->form_validation->set_rules('cpf', 'cpf', 'required|exact_length[11]|numeric');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
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
            'cpf' => $this->post('cpf',true),
            'nom_cliente' => $this->post('nom_cliente',true),
            'email' => $this->post('email',true),
        ];
        
        $insert = $this->cliente_model->cadastrarCliente($dados);

        if ($insert) {

            $resposta = [
                'status' => true,
                'mensagem' => 'Cliente cadastrado com sucesso',
                'id' => $insert
            ];
            $this->response($resposta,REST_Controller::HTTP_CREATED);
        }
        else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Erro ao inserir o cliente'
            ];
            $this->response($resposta, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function index_delete($id = null)
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Cliente removido com sucesso'
        ];

        $this->response($dados);
    }

    public function index_patch()
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Cliente atualizado com sucesso'
        ];
        $this->response($dados);
    }



}
