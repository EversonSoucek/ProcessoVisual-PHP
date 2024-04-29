<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID é necessário para editar');
}
$id = $_GET['id'];

$ch = curl_init("https://processo-seletivo-backend-9ae3435cd654.herokuapp.com/{$id}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    die("Erro ao realizar a solicitação: " . curl_error($ch));
}
curl_close($ch);
$usuario = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($usuario)) {
    die("Erro ao decodificar a resposta JSON ou usuário não encontrado");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="./adicionar.css">
</head>
<body>
    <div class="header">
        Editar Usuário
    </div>
    <div class="container">
        <form action="processa_edicao.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($usuario['nome']); ?>">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required value="<?php echo htmlspecialchars($usuario['cpf']); ?>">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($usuario['email']); ?>">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required value="<?php echo htmlspecialchars($usuario['numero']); ?>">
            <button type="submit" class="btn btn-editar">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
