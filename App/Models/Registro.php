<?php
    namespace App\Models;

    use MF\Model\Model;

    class Registro extends Model{
        private $id;
        private $titulo;
        private $linguagem;
        private $descricao;

        public function getId() {
            return $this->id;
        }

        public function getTitulo() {
            $primeiraLetra = mb_substr($this->titulo, 0, 1, 'UTF-8');
            $restoDaFrase = mb_substr($this->titulo, 1, null, 'UTF-8');

            $resultado = mb_strtoupper($primeiraLetra, 'UTF-8') . $restoDaFrase;
            return $resultado;
        }

        public function getLinguagem() {
            return $this->linguagem;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function setLinguagem($linguagem) {
            $this->linguagem = $linguagem;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function salvar() {
            $query = "INSERT INTO registros(titulo, linguagem, descricao) values(:titulo, :linguagem, :descricao)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':titulo', $this->getTitulo());
            $stmt->bindValue(':linguagem', $this->getLinguagem());
            $stmt->bindValue(':descricao', $this->getDescricao());

            return $stmt->execute();
        }

        public function getAll() {
            $query = "SELECT id, titulo, linguagem, descricao FROM registros ORDER BY id DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>