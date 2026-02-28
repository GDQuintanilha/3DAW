<!DOCTYPE html>
<html>
    <head>
        <title>Calculadora</title>
    </head>
    <body>
        <h1>Bem-vindo a sua calculadora!</h1>

        <form method="POST" action="calculadora.php"> 
            <input type="number" name="n1" placeholder="Digite o primeiro numero" required>
            <input type="number" name="n2" placeholder="Digite o segundo numero" required>

            <p>Escolha qual operação você quer fazer:</p>
            <button type="submit" name="operacao" value="soma">Soma</button>
            <button type="submit" name="operacao" value="subtracao">Subtração</button>
            <button type="submit" name="operacao" value="multiplicacao">Multiplicação</button>
            <button type="submit" name="operacao" value="divisao">Divisão</button>
        </form>

        <hr>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
            $n1 = $_POST['n1'];
            $n2 = $_POST['n2'];
            $operacao = $_POST['operacao'];
            $resultado = 0;

            if($operacao == 'soma'){
                $resultado = $n1 + $n2;
            } else if($operacao == 'subtracao'){
                $resultado = $n1 - $n2;
            } else if($operacao == 'multiplicacao'){
                $resultado = $n1 * $n2;
            } else if($operacao == 'divisao'){
                // Um bônus aqui: impedindo o erro de divisão por zero!
                if ($n2 == 0) {
                    $resultado = "Erro! Impossível dividir por zero.";
                } else {
                    $resultado = $n1 / $n2;
                }
            }
                echo "<h2> O resultado da sua conta é: " . $resultado ."</h2>";
            }
        ?>
    </body>
</html>