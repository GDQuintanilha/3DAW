<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST ["matricula"];
    $nome = $_POST ["nome"];
    $email = $_POST["email"];
    $alunoAlterado = "";
    $alunoEncontrado = false;
    $listaNova = "";

    if(file_exists("alunos.txt")){
        $alunos = file("alunos.txt");
        $quantidadeAlunos = count($alunos);
        $i = 0;

        while($i < $quantidadeAlunos){
            $alunoAtual = $alunos[$i];

            if($alunoAtual != ""){
                $pedacos = explode(";", $alunoAtual);

                if($pedacos[0] == $matricula) {
                    $alunoNovo = $matricula . ";" . $nome . ";" . $email . "\n";
                    $listaNova = $listaNova . $alunoNovo;
                    $alunoEncontrado = true;
                } else {
                    $listaNova = $listaNova . $alunoAtual;
                }
            }
            $i++;
        }

        if ($alunoEncontrado == true) {
            $arqAluno = fopen("alunos.txt", "w") or die("Falha ao abrir o arquivo");
            fwrite($arqAluno, $listaNova);
            fclose($arqAluno);
            $msg = "Aluno alterado com sucesso!";
        } else {
            $msg = "Erro: Matrícula não encontrada.";
        }
    } else {
        $msg = "Arquivo não encontrado.";
    }
}
?>

<html>
    <head>
        <title>Site de cadastro de alunos</title>
    </head>
    <body>
        <h1>Alterar aluno</h1>

        <form action="alunos.php" method="POST">
            Matrícula atual do aluno: <input type="text" name="matricula" required>
            <br><br>
            Novo Nome: <input type="text" name="nome" required>
            <br><br>
            Novo Email: <input type="email" name="email" required>
            <br><br>
            <input type="submit" value="Alterar Aluno">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>