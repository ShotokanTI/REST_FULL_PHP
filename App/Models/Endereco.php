<?php

namespace App\Models;

use App\Database\Connect;
use App\Helpers\UpdateHelper;

class Endereco
{
    public static function select($data)
    {
        $connPdo = Connect::conectar();
        $sql = 'SELECT id,'.$data['coluna'].' FROM enderecos' . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum endereço encontrado!");
        }
    }
    public static function selectAll($data)
    {
        $connPdo = Connect::conectar();

        $sql = 'SELECT id,'.$data['coluna'].' FROM enderecos';
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum endereço encontrado!");
        }
    }

    public static function update($putData,$id){

        $connPdo = Connect::conectar();
        $sql = UpdateHelper::UpdateEndereco();
        $adress = UpdateHelper::extractModelArray(Models::$adress, $putData);
        $adress['id'] = $id;
        $adress['Usuario_Cpf'] = $putData['Cpf'];
        $updateUser = $connPdo->prepare($sql);
        $updateUser->execute($adress);

        if ($updateUser->rowCount()) {
            return 'Endereço atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar o endereço");
        }
    }

    public static function delete($id)
    {
        $connPdo = Connect::conectar();
        $sql = "DELETE FROM enderecos WHERE id = :id";
        $deleteUser = $connPdo->prepare($sql);
        $deleteUser->bindValue(':id', $id);
        $deleteUser->execute();
        if ($deleteUser->rowCount()) {
            return 'O endereco com ID ' . $id . ' foi excluido com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir o endereco!");
        }
    }
    public static function deleteAll()
    {
        $connPdo = Connect::conectar();
        $sql = "DELETE FROM enderecos";
        $deleteAllUsers = $connPdo->prepare($sql);
        $deleteAllUsers->execute();
        if ($deleteAllUsers->rowCount()) {
            return 'Todos os enderecos foram excluidos com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir enderecos!");
        }
    }
}
