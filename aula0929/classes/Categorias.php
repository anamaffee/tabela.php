<?php
include_once './includes/config.php';
 
class Categorias{
    public $CategoriaID;
    public $Nome;
    public $Descricao;
   
    function __construct(){
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
    }
 
    public function exibirCatergorias(){
        $sql = 'SELECT * FROM categorias';
        $resultado = $this->ConexaoDB->query($sql);
 
        if ($resultado->num_rows > 0) {
            $registros = array();
            while ($row = $resultado->fetch_assoc()) {
                array_push($registros,$row);
            }
            return $registros;
        } else {
            return 'Sem registros';
        }
    }
 
    public function exibirCategoria($categoriaID){
        if ($categoriaID != '' && is_numeric($categoriaID)) {
            $sql = 'SELECT * FROM categorias WHERE CategoriaID ='.$categoriaID;
            $resultado = $this->ConexaoDB->query($sql);
 
            if ($resultado->num_rows > 0) {
                $dados = $resultado->fetch_assoc();
                return $dados;
            } else{
                return 'Registro não localizado';
            }
        } else {
            return 'CategoriaID inválido';
        }
    }
 
    public function excluirCategoria($categoriaID){
        if ($categoriaID != '' && is_numeric($categoriaID)) {
            $sql = 'DELETE FROM categorias WHERE CategoriaID ='.$categoriaID;
            $resultado = $this->ConexaoDB->query($sql);
 
            if ($this->ConexaoDB->query($sql) === TRUE) {
                return 'Categoria excluída com sucesso!';
            } else {
                return 'Erro ao excluir o CategoriaID ='.$categoriaID;
            }
        } else {
            return 'CategoriaID inválido';
        }
    }
 
    public function salvarCategoria($categoriaID = ''){
        if (is_numeric($categoriaID)) {
            $sql = 'UPDATE categorias
                    SET Nome = "'.$this->Nome.'",
                        Descricao = "'.$this->Descricao.'"
                    WHERE CategoriaID = '.$categoriaID;
        } else {
            $sql = 'INSERT INTO categorias (Nome,Descricao)
                    VALUES("'.$this->Nome.'","'.$this->Descricao.'")';
        }
        if ($this->ConexaoDB->query($sql) === TRUE){
            return 'Registro de categoria salvo com sucesso!';
        } else {
            return 'Erro ao salvar o registro';
        }
        exit($sql);
    }
 