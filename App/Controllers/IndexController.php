<?php 

    namespace App\Controllers;

    //Os recurssos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;
    use stdClass;

    class IndexController extends Action{

        public function __construct(){
            $this->view = new stdClass();
        }

        public function index() {
            //Listar todos os cards existentes
            $registro = Container::getMOdel("Registro");
            $this->view->registros = $registro->getAll();

            $this -> render('index');
        }

        public function registraProblemaSolucao() {
            //Fazer as validações do formulario
            if(!$this->validaForm($_POST)){
                header('Location: /?situacaoForm=erro');
                return;
            }

            $registro = Container::getMOdel("Registro");
            $registro->setTitulo($_POST['title-form']);
            $registro->setLinguagem($_POST['seletor-category']);
            $registro->setDescricao($_POST['description-form']);

            $status = $registro->salvar();

            if($status) {
                header('Location: /?situacaoEnvio=enviado');
            } else {
                header('Location: /?situacaoEnvio=erro');
            }
        }

        public function validaForm($dados) {
            //Remove espaços
            $titulo = trim($dados['title-form'] ?? '');
            $selecao = trim($dados['seletor-category'] ?? '');
            $desc = trim($dados['description-form'] ?? '');

            $categoriasPermitidas = ['Java', 'PHP', 'JavaScript'];

            if(empty($titulo) or mb_strlen($titulo, 'UTF-8') < 3 or mb_strlen($titulo, 'UTF-8') > 255) {
                return false;
            }

            if(empty($selecao) or !in_array($selecao, $categoriasPermitidas)) {
                return false;
            }

            if(empty($desc) or mb_strlen($desc, 'UTF-8') < 10 or mb_strlen($desc, 'UTF-8') > 500) {
                return false;
            }

            return true;
        }
        
    }

?>