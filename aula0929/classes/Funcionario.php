<?php
// incluir os dados de configuracao
include_once './includes/config.php';
    
class Funcionarios {

   
    public $FuncionarioID;
    public $Nome;
    public $DataNascimentp;
    public $Email;
    public $ConexaoDB; // atributo do banco de dados/conexao
}

function __construct(){
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }


    public function exibirFuncionarios(){

        $sql = 'SELECT * FROM Clientes';
        $resultado = $this->ConexaoDB->query($sql);
        // faz o teste para saber se o resultado dos dados do banco chegou
        if( $resultado->num_rows > 0 ){
            // cria o array
            $registros = array();
            // laco de repeticao que retornar os dados
            while($row = $resultado->fetch_assoc()) {
                // adicionar os registros dentro do array
                array_push($registros,$row);
            }
            // retorna os registros
            return $registros;
        }else{
            // retorno sem dados
            return 'Sem registros';
        }

    }

        public function excluirFuncionarios($FuncionarioID){
        
        if($FuncionarioID != '' && is_numeric($FuncionarioID) ){
            $sql = 'DELETE FROM  clientes WHERE ClienteID ='.$FuncionarioID;
            if( $this->ConexaoDB->query($sql) === TRUE){
                return 'Funcionario excluido com Sucesso!';
            }else{
                return 'Erro ao excluir o FuncionarioID ='.$FuncionarioID;
            }
        }else{
            return 'FuncionarioID invalido';
        }

    }

    public function salvarFuncionarios($FuncionarioID = ''){

        if( is_numeric($FuncionarioID)){
            // update na tabela
            $sql = 'UPDATE Funcionarios 
                    SET Nome = "'.$this->Nome.'", 
                        Data de nascimento = '.$this->DataNascimento.'
                    WHERE FuncionarioID = '.$FuncionarioID;
        }else{
            // include na tabela
            $sql = 'INSERT INTO Funcionarios (Nome,DataNascimento) 
                    VALUES("'.$this->Nome.'",'.$this->DataNascimento.')';
        }
        // 
        if( $this->ConexaoDB->query($sql) === TRUE ){
            return "Registro salvo com Sucesso!";
        }else{
            return "Erro ao salvar o registro!";
        }
    }

    // destrutor da classe
    public function __destruct(){
        // desconectar do banco de dados
        $this->ConexaoDB->close();
        // anular a conexao
        $this->ConexaoDB = null;
    }

