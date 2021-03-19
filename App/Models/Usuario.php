<?php

namespace App\Models;

use App\Database\Connect;
use App\Helpers\InsertHelper;
use App\Helpers\UpdateHelper;

class Usuario
{
    private static $table = "usuarios";
    public static function select($data)
    {
        $connPdo = Connect::conectar();
        $sql = 'SELECT * FROM ' . $data['tabela'] . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function selectAll($data)
    {
        $connPdo = Connect::conectar();

        $sql = 'SELECT * FROM ' . $data['tabela'];
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function update($putData, $id)
    {
        $connPdo = Connect::conectar();
        $sql = UpdateHelper::UpdateUser();
        $user = UpdateHelper::extractModelArray(Models::$user, $putData);
        $user['id'] = $id;
        $updateUser = $connPdo->prepare($sql);
        $updateUser->execute($user);

        if ($updateUser->rowCount()) {
            return 'Usuário(a) atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar o usuário(a)!");
        }
    }

    public static function insert($postData)
    {
        $connPdo = Connect::conectar();
        //add usuarios
        $sql = InsertHelper::iterateModelUser();
        $user = UpdateHelper::extractModelArray(Models::$user, $postData);
        $userData = $connPdo->prepare($sql)->execute($user);

        //add endereco
        $sql = InsertHelper::iterateEnderecolUser();
        $adress = UpdateHelper::extractModelArray(Models::$adress, $postData);
        $adress['Usuario_Cpf'] = $postData['Cpf'];
        $connPdo->prepare($sql)->execute($adress);

        if ($userData) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
        }
    }

    public static function delete($id)
    {
        $connPdo = Connect::conectar();
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $deleteUser = $connPdo->prepare($sql);
        $deleteUser->bindValue(':id', $id);
        $deleteUser->execute();
        if ($deleteUser->rowCount()) {
            return 'O usuario com ID ' . $id . ' foi excluido com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir usuario!");
        }
    }
    public static function deleteAll()
    {
        $connPdo = Connect::conectar();
        $sql = "DELETE FROM " . self::$table;
        $deleteAllUsers = $connPdo->prepare($sql);
        $deleteAllUsers->execute();
        if ($deleteAllUsers->rowCount()) {
            return 'Todos os usuarios excluidos com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir usuarios!");
        }
    }
}
