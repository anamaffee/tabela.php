<?php
// incluir os dados de configuracao
include_once './includes/config.php';
    

class Clientes {

    public $ProducaoID;
    public $ProdutoId;
    public $FuncionarioID;
    public $ClienteID;    
    public $DataProducaoID;
    public $DataEntrega;
    public $ConexaoDB; // atributo do banco de dados/conexao
}

function __construct(){
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }


    public function exibirProducao(){

        $sql = 'SELECT * FROM Producao';
        $resultado = $this->ConexaoDB->query($sql);
        if( $resultado->num_rows > 0 ){
            $registros = array();
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
        public function excluirProducao($ProducaoID){
        
        if($ProducaoID != '' && is_numeric($ProducaoID) ){
            $sql = 'DELETE FROM  producao WHERE ProducaoID ='.$ProducaoID;
            if( $this->ConexaoDB->query($sql) === TRUE){
                return 'Producao descontinuada com Sucesso!';
            }else{
                return 'Erro ao excluir a producaoID ='.$FuncionarioID;
            }
        }else{
            return 'ProducaoID invalido';
        }

    }

    public function salvarProducao($ProducaoID = ''){

        if( is_numeric($ProducaoID)){
            // update na tabela
            $sql = 'UPDATE Producao 
                    SET producao = "'.$this->ProducaoID.'", 
                        Produto = '.$this->ProdutoID.'
                    WHERE ProducaoID = '.$ProducaoID;
        }else{
            // include na tabela
            $sql = 'INSERT INTO Producao (ClienteID,DataEntrega) 
                    VALUES("'.$this->ClienteID.'",'.$this->DataEntrega.')';
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

