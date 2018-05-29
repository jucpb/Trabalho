<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {
    

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function index_get($id = null)
    {
        $dados = [
            'id' => $id,
            'nome' => "vamos recuperar do banco de dados",
            'x' => 'x',
            'y' => 'y'
        ];

        $this->response($dados);
    }

    public function index_post()
    {
        $dados = [
            'status' => true,
            'mensagem' => 'Cliente adicionado com sucesso'
        ];

        $this->response($dados);
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
