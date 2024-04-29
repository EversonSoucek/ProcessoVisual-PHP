<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];

    $dadosParaEnviar = json_encode([
        'nome' => $nome,
        'cpf' => $cpf,
        'email' => $email,
        'numero' => $numero,
    ]);

    $ch = curl_init("https://processo-seletivo-backend-9ae3435cd654.herokuapp.com/{$id}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
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
        header('Location: index.php'); 
        exit;
    }
} else {
    header('Location: index.php'); 
    exit;
}
?>
