<?php

namespace App\Services;


class EstadoService
{
    public function get($id = null)
    {
        $data = [
            'coluna' => 'Estado',
            'id' => $id
        ];
        $estado = new CidadeService();
        return  $estado->get($data);
    }
}
