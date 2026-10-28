<?php

include_once './includes/config.php';

class setores {
    public $setorId;
    public $nome;
    public $andar;
    public $cor;
    public $ConexaoDB;


    public function __construct(){
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function exibirSetores(){
        $sql = 'SELECT * FROM cargos';

        $resultado = $this->ConexaoDB->query($sql);

        if ($resultado-> num_rows > 0){
            $registros = array();
            while ($row = $resultado->fetch_assoc()) {
              array_push($registros,$row);
            }
              return $registros;
            }else{
                return 'sem registros';
            }
               
    }
   public function exibirSetor($setorID){

    }
    public function excluirSetor($setorID){

    }
    
    //destrutor da classe
    public function __destruct(){
     //desconectar do banco de dados
        $this->ConexaoDB->close();
    //anular a conexao
        $this->ConexaoDB = null;
    }
}
