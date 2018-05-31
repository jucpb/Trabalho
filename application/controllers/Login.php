<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;
class Login extends REST_Controller {

    
    //herdando da biblioteca
    public function __construct() 
    {
        parent::__construct();
    }

    public function index_post(){
        $dados['nome'] = "Teste";
        $dados["id"] = 1;

        $token = $this->_generate_token($dados);
        $this->response(
            [
                'status' => true,
                'token' => $token
            ]
            );

    }


    /**
     * Gera um novo token
     * @param array $data  payload do token
     * @param int $duracao  tempo em segundos para exipiração
     * @return string
     */
    private function _generate_token($data, $duracao = NULL)
    {
        $key = $this->config->item('sesc_api_key');

        $horario = time();

        $token = array(
            "iss" => base_url(),
            "aud" => base_url(),
            "iat" => $horario,
            "nbf" => $horario -1,
            'data' => $data,
        );

        if($duracao) {
            $token["exp"] = $horario + $duracao;
        }
        
        $jwt = JWT::encode($token, $key);
        return $jwt;
    }

}