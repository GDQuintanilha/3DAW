<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $carga = $_POST["carga"];

    if (!file_exists("disciplina.txt")) {
        $arqMateria = fopen("disciplina.txt", "w") or die("Erro ao criar arquivo");
        $cabecalho = "codigo/nome/carga\n";
        fwrite($arqMateria, $cabecalho);
        fclose($arqMateria);
    }

    $arqMateria = fopen("disciplina.txt", "a") or die("Erro ao abrir o arquivo");
    $linha = $codigo . "/" . $nome . "/" . $carga . "\n";
    fwrite($arqMateria, $linha);
    fclose($arqMateria);
    
    $msg = "Matéria cadastrada com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>

    <h3>Cadastro de Matérias</h3>
    
    <?php if($msg) echo "<p>$msg</p>"; ?>

    <form method="POST">
        Código:<br>
        <input type="text" name="codigo" required><br><br>

        Nome:<br>
        <input type="text" name="nome" required><br><br>

        Carga Horária:<br>
        <input type="number" name="carga" required><br><br>

        <input type="submit" value="Salvar">
    </form>

</body>
</html>