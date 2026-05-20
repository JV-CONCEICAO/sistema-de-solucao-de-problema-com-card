<?php 
    namespace App;

    use PDO;
    use PDOException;

    class Connection {

        public static function getDB() {

            try {
                $dsn = 'mysql:host=127.0.0.1;dbname=dev_vault;charset=utf8';
                $usuario = 'root';
                $senha = '';
                $conexao = new PDO($dsn, $usuario, $senha);

                return $conexao;

            } catch (PDOException $erro) {
                die("Erro: " . $erro->getMessage());
            }

        }
    }
?>