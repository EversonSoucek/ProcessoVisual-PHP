<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Inicializa cURL
    $ch = curl_init('http://localhost:3500/' . $id);  // Adapte a URL conforme necessário

    // Configura a solicitação DELETE
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Envia a solicitação e fecha a sessão cURL
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $response = json_decode($response, true);
        if (isset($response['error'])) {
            echo "Erro ao deletar usuário: " . $response['error'];
        } else {
            header('Location: index.php'); // Redireciona de volta para a página principal
            exit;
        }
    }
} else {
    echo "ID não fornecido para a exclusão.";
}
?>
