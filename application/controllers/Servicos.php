<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Servicos extends MY_Controller {
    


    public function __construct()
    {
        parent::__construct();
        $this->load->model('servicos_model');
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
            $servicos = $this->servicos_model->getServico($id);
        } else {
            $servicos = $this->servicos_model->getServicos();
        }
        

        if ($servicos) {
            $this->response($servicos);
        } else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Servico não encontrado'
            ];
            $this->response($resposta, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {
        
        $this->form_validation->set_rules('desc_servico', 'desc_servico', 'required');
        $this->form_validation->set_rules('valor_servico', 'valor_servico', 'numeric');
        $this->form_validation->set_rules('status_servico', 'status_servico', 'required|in_list[Aberto,Em andamento, Concluido]');

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
            'desc_servico' => $this->post('desc_servico',true),
            'valor_servico' => $this->post('valor_servico',true),
            'status_servico' => $this->post('status_servico',true),
        ];
        
        $insert = $this->servicos_model->cadastrarServico($dados);

        if ($insert) {

            $resposta = [
                'status' => true,
                'mensagem' => 'Serviço cadastrado com sucesso',
                'id' => $insert
            ];
            $this->response($resposta,REST_Controller::HTTP_CREATED);
        }
        else {
            $resposta = [
                'status' => false,
                'mensagem' => 'Erro ao inserir o serviço'
            ];
            $this->response($resposta, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function index_delete($id = null)
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Serviço removido com sucesso'
        ];

        $this->response($dados);
    }


    public function atualizar_post()
    {


        $this->form_validation->set_rules('parceiro', 'parceiro', 'callback_existeParceiro', [
            'existeParceiro' => "Parceiro inválido"
        ] );

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
            'status' => true,
            'mensagem' => 'Serviço atualizado com sucesso'
        ];
        $this->response($dados);
    }

    public function cliente_get($id = null) 
    {
        $servicos = $this->servicos_model->getServicosCliente($id);
        $this->response($servicos);

    }

    public function parceiro_get($id = null) 
    {
        $servicos = $this->servicos_model->getServicosCliente($id);
        $this->response($servicos);

    }

    public function existeParceiro($id) {

        if (is_null($id)){
            return true;
        }

        $this->load->model('parceiro_model');
        $parceiro = $this->parceiro_model->getParceiro($id);
        return $parceiro ? true:false;
    }
}
