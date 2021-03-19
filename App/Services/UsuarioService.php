<?php

namespace App\Services;

use App\Database\Connect;
use App\Models\Usuario;

class UsuarioService
{
    public function get($id = null)
    {
        if ($id) {
            if (gettype($id) != 'string') {
                $data = $id;
            } else {
                $data = [
                    'tabela' => 'usuarios',
                    'id' => $id,
                ];
            }
        } else {
            $data = [
                'tabela' => 'usuarios',
                'coluna' => 'Cidades',
                'id' => $id,
            ];
        }
        if ($data['id']) {
            return Usuario::select($data);
        } else {
            return Usuario::selectAll($data);
        }
    }

    public function post()
    {
        $data = $_POST;
        return Usuario::insert($data);
    }

    public function put($id = null)
    {
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        return Usuario::update($_PUT, $id);
    }

    public function delete($id = null)
    {
        if ($id) {
            return Usuario::delete($id);
        } else {
            return Usuario::deleteAll();
        }
    }
}
