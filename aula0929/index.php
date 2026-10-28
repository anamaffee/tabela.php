<?php
include_once './classes/Cargos.php';
include_once './classes/setores.php';

$objsetores = new setores();
$return = $objsetores->exibirSetores();

echo '<pre>';
print_r($return);

$objCargos = new Cargos();
$return = $objCargos->exibirCargos();


echo '<pre>';
print_r($return);