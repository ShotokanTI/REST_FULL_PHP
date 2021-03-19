<?php

namespace App\Services;

use App\Models\Endereco;

class CidadeService
{
    public function get($id = null)
    {
        if ($id) {
            $data = $id;
        } else {
            $data = [
                'coluna' => 'Cidade',
                'id' => $id,
            ];
        }
        if ($data['id']) {
            return Endereco::select($data);
        } else {
            return Endereco::selectAll($data);
        }
    }
}
