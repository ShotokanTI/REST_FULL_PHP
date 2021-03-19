<?php

namespace App\Models;

use App\Database\Connect;

class Total
{
    public static function sqlParam($coluna)
    {
        $sql = 'SELECT' . " COUNT(DISTINCT(user.id)) as TotalPor" . $coluna . "
        FROM usuarios as user 
        inner join enderecos as end on user.Cpf = end.Usuario_Cpf 
        where end." . "$coluna=" . ":param";
        return $sql;
    }

    public static function totalUsers($coluna, $param)
    {
        $connPdo = Connect::conectar();

        $sql = self::sqlParam($coluna);
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(":param", $param);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

    public static function totalUsersByState($param)
    {
        return self::totalUsers('Estado', $param);
    }

    public static function totalUsersByCity($param)
    {
        return self::totalUsers('Cidade', $param);
    }
}
