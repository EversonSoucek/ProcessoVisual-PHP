<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';
    $numero = $_POST['numero'] ?? '';

    $dadosParaEnviar = json_encode([
        'nome' => $nome,
        'cpf' => $cpf,
        'email' => $email,
        'numero' => $numero,
    ]);

    $ch = curl_init('https://processo-seletivo-backend-9ae3435cd654.herokuapp.com/');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dadosParaEnviar);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dadosParaEnviar)
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        header('Location: sucesso.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="estilosAdicionar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <div class="header">
        Adicionar Usuário
    </div>
    <div class="container">
        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required>
            <button type="submit" class="btn btn-editar">Adicionar</button>
        </form>
    </div>
    <script>
    $(document).ready(function(){
      $('#cpf').mask('000.000.000-00');
    });
    </script>
</body>
</html>
