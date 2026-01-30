<?php
    ini_set('display_errors', 0);
    error_reporting(0);

    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode([
            'erro' => true,
            'mensagem' => 'Método inválido'
        ]);
        exit;
    }

    $cnpj = isset($_POST['cnpjCpf']) ? $_POST['cnpjCpf'] : '';
    $cnpj = preg_replace('/\D/', '', $cnpj);

    if (empty($cnpj)) {
        echo json_encode([
            'erro' => true,
            'mensagem' => 'CNPJ não informado'
        ]);
        exit;
    }

    // 🔹 NÃO retorna nada aqui!
    // 🔹 Só continua o processamento

    $url = "https://brasilapi.com.br/api/cnpj/v1/$cnpj";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    // Somente para ambiente local
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        echo json_encode([
            'erro' => true,
            'mensagem' => curl_error($ch)
        ]);
        exit;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        echo json_encode([
            'erro' => true,
            'mensagem' => 'CNPJ não encontrado'
        ]);
        exit;
    }

    // ✅ SUCESSO FINAL — UM ÚNICO JSON
    echo $response;
    exit;
