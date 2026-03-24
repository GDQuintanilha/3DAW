<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST ["matricula"];
    $nome = $_POST ["nome"];
    $email = $_POST["email"];
    

    if(!file_exists("alunos.txt")){
        $arqAluno = fopen("alunos.txt","w") or die("Erro ao criar arquivo");
        $cabecalho = "matricula;nome;email\n";
        fwrite($arqAluno, $cabecalho);
        fclose($arqAluno);
    }

    $arqAluno = fopen("alunos.txt", "a") or die("Falha ao abrir o arquivo");

    $linha = $matricula . ";" . $nome . ";" . $email . "\n";
    fwrite($arqAluno, $linha);

    fclose ($arqAluno);

    $msg = "Aluno cadastrado com sucesso";
}

?>

<html>
    <head>
        <title>Site de cadastro de alunos</title>
    </head>
    <body>
        <h1>Incluir novo aluno</h1>

        <form action="alunos.php" method="POST">
            Matrícula: <input type="text" name="matricula" required>
            <br><br>
            Nome: <input type="text" name="nome" required>
            <br><br>
            Email: <input type="text" name="email" required>
            <br><br>
            <input type="submit" value="Cadastrar Aluno">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>

