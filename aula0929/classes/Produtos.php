<?php
// incluir os dados de configuracao
include_once './includes/config.php';
    

class Clientes {

    public $ProdutoId;
    public $Nome;
    public $Preco;    
    public $CategoriaID;
    public $ConexaoDB; // atributo do banco de dados/conexao
}  

  function __construct(){
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }


    public function exibirProdutos(){

        $sql = 'SELECT * FROM Produtos';
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
        public function excluirProdutos($ProdutoID){
        
        if($ProdutosID != '' && is_numeric($ProdutoID) ){
            $sql = 'DELETE FROM  produtos WHERE ProdutoID ='.$ProdutoID;
            if( $this->ConexaoDB->query($sql) === TRUE){
                return 'Produto descontinuado com Sucesso!';
            }else{
                return 'Erro ao excluir o ProdutoID ='.$ProdutoID;
            }
        }else{
            return 'ProdutoID invalido';
        }

    }

    public function salvarProduto($ProdutoID = ''){

        if( is_numeric($ProdutoID)){
            // update na tabela
            $sql = 'UPDATE Produto 
                    SET produto = "'.$this->ProdutoID.'", 
                        Preco = '.$this->PrecoID.'
                    WHERE CategoriaID = '.$CategoriaID;
        }else{
            // include na tabela
            $sql = 'INSERT INTO Produto (Nome,preco) 
                    VALUES("'.$this->ProdutoID.'",'.$this->Preco.')';
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

