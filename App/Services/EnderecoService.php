<?php

namespace App\Services;

use App\Models\Endereco;

class EnderecoService
{
    public function get($id = null)
    {
        $data = [
            'tabela' => 'enderecos',
            'coluna' => null,
            'id' => $id,
        ];
        $i = new UsuarioService();
        return  $i->get($data);
    }

    public function put($id)
    {
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        return Endereco::update($_PUT, $id);
    }

    public function delete($id = null)
    {
        if ($id) {
            return Endereco::delete($id);
        } else {
            return Endereco::deleteAll();
        }
    }
}
