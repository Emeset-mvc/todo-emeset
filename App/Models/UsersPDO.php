<?php

/**
 * Exemple per a M07.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Model pels usuaris.
 *
**/

namespace App\Models;
/**
 * Imatges
*/
class UsersPDO
{

    /**
     * __construct:  Crear el model tasques
     *
     * Model adaptat per PDO
     *
     * @param \App\Models\Db $sql connexió a la base de dades
     **/
    public function __construct(private $sql, private $options = ['cost' => 12])
    {
    }

    /**
     * get et retorna la imatge amb l'id
     *
     * @param int $id
     * @return array imatge amb ["titol", "url"]
     */
    public function getUser($user)
    {
        $query = 'select id, user, pass from users where user=:user;';
        $stm = $this->sql->prepare($query);
        $result = $stm->execute([':user' => $user]);

        if ($stm->errorCode() !== '00000') {
            $err = $stm->errorInfo();
            $code = $stm->errorCode();
            die("Error.   {$err[0]} - {$err[1]}\n{$err[2]} $query");
        }
        
        return $stm->fetch(\PDO::FETCH_ASSOC);
    }


    public function validateUser($user, $pass)
    {
        
        $login = $this->getUser($user);

        if ($login) {
            $hash = $login["pass"];
            if (password_verify($pass, (string) $hash)) {
                if (password_needs_rehash($hash, PASSWORD_DEFAULT, $this->options)) {
                    $newHash = password_hash($pass, PASSWORD_DEFAULT, $this->options);
                    $query = 'update users set pass=:hash where user=:user;';
                    $stm = $this->sql->prepare($query);
                    $result = $stm->execute([
                        ':user' => $user,
                        ':hash' => $newHash,
                    ]);
                }
            } else {
                $login = false;
            }
        }

        return $login;
    }
}
