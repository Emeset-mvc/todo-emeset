<?php

/**
 * Exemple per a M07.
 * @author: Dani Prados dprados@cendrassos.net
 *
 * Encapsula la connexió a la base de dades per poder-la compartir entre els models.
 *
**/

namespace App\Models;

/**
 * Connection
*/
class Connection
{
    private $sql;

    /**
     * Constructor de la classe Connection amb PDO
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
        $usuari = $config['user'];
        $clau = $config['pass'];

        try {
            $this->sql = new \PDO($dsn, $usuari, $clau);
        } catch (\PDOException $e) {
            die('Ha fallat la connexió: ' . $e->getMessage() . " $usuari");
        }
    }

    /**
     * getConn :  retorna la connexió a la base de dades
     *
     * @return \PDO retorna la connexió PDO
     */
    public function getConn()
    {
        return $this->sql;
    }
}
