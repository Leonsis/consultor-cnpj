<?php
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['erro' => true, 'mensagem' => 'Método inválido']);
    exit;
}

$valorDigitado = isset($_POST['cnpjCpf']) ? preg_replace('/\D/', '', $_POST['cnpjCpf']) : '';
$tamanho       = strlen($valorDigitado);

function validarCPF($cpf)
{
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }

    }
    return true;
}

if ($tamanho === 11) {

    if (validarCPF($valorDigitado)) {
        echo json_encode([
            'erro'     => false,
            'tipo'     => 'CPF',
            'mensagem' => 'CPF informado é válido!',
        ]);
    } else {
        echo json_encode([
            'erro'     => true,
            'mensagem' => 'CPF informado é inválido',

        ]);
    }
    exit;

} elseif ($tamanho === 14) {
    
// 1. Validação local básica (Evita disparar API com lixo)
    if (strlen($valorDigitado) !== 14) {
        echo json_encode(['erro' => true, 'mensagem' => 'CNPJ deve conter 14 dígitos']);
        exit;
    }

    //$url = "https://brasilapi.com.br/api/cnpj/v1/$valorDigitado";

    $url = "https://minhareceita.org/$valorDigitado";
   // var_dump($url);

    $maxTentativas         = 3;
    $tentativaAtual        = 0;
    $esperaEntreTentativas = 1; // Espera de tantativas em segundos

    while ($tentativaAtual < $maxTentativas) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Apenas local

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            echo $response; // Sucesso!
            exit;
        } elseif ($httpCode === 429) {
            // Se bater no limite, espera e tenta de novo
            $tentativaAtual++;
            sleep($esperaEntreTentativas * $tentativaAtual); // Espera aumenta a cada erro
            continue;
        } elseif ($httpCode === 404) {
            echo json_encode(['erro' => true, 'mensagem' => 'CNPJ não encontrado']);
            exit;
        } elseif ($httpCode === 400) {
            echo 'Sintaxe ou dados incorretos, verifique e tente novamente';
            break; // Outros erros (500, 400) param o loop
        } else {
            echo 'CNPJ não encontrado.';
            break;
        }
    }

// Se sair do loop sem retornar 200
    echo json_encode([
        'erro'      => true,
        'mensagem'  => 'Limite de requisições excedido. Tente novamente em instantes.',
        'tipo_erro' => $httpCode,
    ]);


} else {
    echo json_encode([
        'erro'  => true,
        'mensagem' => 'Digite um CPF ou um CNPJ, por favor!'
    ]);
}
