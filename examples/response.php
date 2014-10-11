<?php

require_once "../GestPayCrypt.inc.php";

if (empty($_GET["a"])) {
    die("Parametro mancante: 'a'\n");
}

if (empty($_GET["b"])) {
    die("Parametro mancante: 'b'\n");
}

$gestpay = new GestPayCryptHS();
$gestpay->setShopLogin($_GET["a"]);
$gestpay->setEncryptedString($_GET["b"]);

if (!$gestpay->decrypt()) {
    throw new Exception(
        "Error: ".$gestpay->getErrorCode().": ".$gestpay->getErrorDescription()
    );
}

$result = $gestpay->getTransactionResult();

if ($result == "XX") {
    echo "Esito transazione sospeso (pagamento tramite bonifico)\n";
}
elseif ($result == "KO") {
    echo "Esito transazione negativo\n";
}
elseif ($result == "OK") {
    echo "Esito transazione positivo\n";
}
else {
    echo "Esito transazione indefinito\n";
}
