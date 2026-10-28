<?php
// incluir os dados de configuracao
include_once './includes/config.php';
    
// construcao da classe cargos
class Cargos{

    // os atributos - no minimo os nomes dos campos da tabela
    public $CargoID;
    public $Nome;
    public $TetoSalarial;
    public $ConexaoDB; // atributo do banco de dados/conexao


    // construtor - inicializa a classe
    function __construct(){
        // atribuindo ao atributo a conexao com o banco de dado
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    // metodos da entidade/classe
    public function exibirCargos(){

        // monta a SQL que ira consultar no banco
        $sql = 'SELECT * FROM cargos';
        
        // executa no banco de dados a query sql e coloca o resultado na var
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
    public function exibirCargo($cargoID){
        //verificacao do cargo informado
        if( $cargoID != '' && is_numeric($cargoID) ){

            // monta o sql e consulta
            $sql = 'SELECT * FROM cargos WHERE CargoID = '.$cargoID;
            $resultado = $this->ConexaoDB->query($sql);
            
            // verifica se houve retorno de registros
            if( $resultado->num_rows > 0 ){

                // converte os dados para array
                $dados = $resultado->fetch_assoc();
                
                // retorna os dados
                return $dados;
            }else{
                return 'Registro nao localizado';
            }
        }else{
            return 'CargoID invalido';
        }
    }

    public function excluirCargo($cargoID){
        
        if($cargoID != '' && is_numeric($cargoID) ){
            // monta o SQL
            $sql = 'DELETE FROM cargos WHERE CargoID ='.$cargoID;
            // verificando se a execucao ocorreu SE e VERDADEIRO
            if( $this->ConexaoDB->query($sql) === TRUE){
                return 'Cargo excluido com Sucesso!';
            }else{
                return 'Erro ao excluir o CargoID ='.$cargoID;
            }
        }else{
            return 'CargoID invalido';
        }

    }
                        // condicao se cargoID se nao for enviado fica vazio
    public function salvarCargo($cargoID = ''){

        if( is_numeric($cargoID)){
            // update na tabela
            $sql = 'UPDATE cargos 
                    SET Nome = "'.$this->Nome.'", 
                        TetoSalarial = '.$this->TetoSalarial.'
                    WHERE CargoID = '.$cargoID;
        }else{
            // include na tabela
            $sql = 'INSERT INTO cargos (Nome,TetoSalarial) 
                    VALUES("'.$this->Nome.'",'.$this->TetoSalarial.')';
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
}