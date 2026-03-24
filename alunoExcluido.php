<?php
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST["matricula"]; // Pra excluir, só precisamos da matrícula
    
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

                // A MÁGICA DA EXCLUSÃO AQUI:
                // Se a matrícula for DIFERENTE da que o usuário digitou, guarda na lista.
                if($pedacos[0] != $matricula) {
                    $listaNova = $listaNova . $alunoAtual;
                } else {
                    // Se for IGUAL, a gente apenas avisa que achou, mas NÃO guarda na listaNova.
                    // Como não guardamos, a linha do aluno some da versão final!
                    $alunoEncontrado = true;
                }
            }
            $i++;
        }

        if ($alunoEncontrado == true) {
            $arqAluno = fopen("alunos.txt", "w") or die("Falha ao abrir o arquivo");
            fwrite($arqAluno, $listaNova);
            fclose($arqAluno);
            $msg = "Aluno excluído com sucesso!";
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
        <h1>Excluir aluno</h1>

        <form action="" method="POST">
            Matrícula do aluno que deseja excluir: <input type="text" name="matricula" required>
            <br><br>
            <input type="submit" value="Excluir Aluno">
        </form>
        
        <p><strong><?php echo $msg; ?></strong></p>

    </body>
</html>