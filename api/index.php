<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://processo-seletivo-backend-9ae3435cd654.herokuapp.com/"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
}
curl_close($ch);
if (isset($error_msg)) {
    die("Erro ao realizar a solicitação: $error_msg");
}
$usuarios = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Erro ao decodificar a resposta JSON: " . json_last_error_msg());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visual software</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="header">
        Visual software
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Número</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['numero']); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-editar">Editar</a>
                            <a href="deletar_usuario.php?id=<?php echo $usuario['id']; ?>" class="btn btn-deletar" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Não foi possível carregar os usuários.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="adicionar.php" class="btn btn-editar">Adiciona usuário</a>
    </div>
</body>
</html>
