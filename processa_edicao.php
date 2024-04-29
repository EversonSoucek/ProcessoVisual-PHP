<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];

    // Dados para enviar
    $dadosParaEnviar = json_encode([
        'nome' => $nome,
        'cpf' => $cpf,
        'email' => $email,
        'numero' => $numero,
    ]);

    // Inicializa cURL
    $ch = curl_init("http://localhost:3500/{$id}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dadosParaEnviar);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dadosParaEnviar)
    ]);

    // Envia a solicitação
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        header('Location: index.php'); // Redireciona de volta para a página principal após sucesso
        exit;
    }
} else {
    header('Location: index.php'); // Redireciona de volta se não for um POST
    exit;
}
?>
