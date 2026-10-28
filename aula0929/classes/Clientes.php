<?php
// incluir os dados de configuracao
include_once './includes/config.php';
    

class Clientes {

   
    public $ClienteID;
    public $Nome;
    public $Telefone;
    public $Email;
    public $ConexaoDB; // atributo do banco de dados/conexao
}

   
    function __construct(){
        // atribuindo ao atributo a conexao com o banco de dado
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

   // metodos da entidade/classe
    public function exibirClientes(){

        $sql = 'SELECT * FROM cargos';
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

    public function excluirCliente($ClienteID){
        
        if($ClienteID != '' && is_numeric($ClienteID) ){
            $sql = 'DELETE FROM  clientes WHERE ClienteID ='.$ClienteID;
            if( $this->ConexaoDB->query($sql) === TRUE){
                return 'Cliente excluido com Sucesso!';
            }else{
                return 'Erro ao excluir o ClienteID ='.$ClienteID;
            }
        }else{
            return 'ClienteID invalido';
        }

    }

    public function salvarCliente($ClienteID = ''){

        if( is_numeric($ClienteID)){
            // update na tabela
            $sql = 'UPDATE clientes 
                    SET Nome = "'.$this->Nome.'", 
                        Telefone = '.$this->Telefone.'
                    WHERE ClienteID = '.$ClienteID;
        }else{
            // include na tabela
            $sql = 'INSERT INTO Clientes (Nome,Telefone) 
                    VALUES("'.$this->Nome.'",'.$this->Email.')';
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
