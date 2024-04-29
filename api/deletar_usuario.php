<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $ch = curl_init('https://processo-seletivo-backend-9ae3435cd654.herokuapp.com/' . $id);  

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

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
            header('Location: index.php');
            exit;
        }
    }
} else {
    echo "ID não fornecido para a exclusão.";
}
?>
