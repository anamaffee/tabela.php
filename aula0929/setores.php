<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <table>
            <tr>
                <th>SetorID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
<?php
    include_once './classes/Setores.php';
    $objSetores = new setores();
    $resultado = $objSetores->exibirSetores();

    foreach ($resultado as $key => $value) {
?>
            <tr>
                <td></td>
                <td><?php echo $value['Nome']?></td>
                <td></td>
            </tr>
<?php
    }
?>
        </table>
</body>
</html>