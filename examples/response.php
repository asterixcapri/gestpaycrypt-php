<?php

require_once "../lib/GestPayCryptWS.php";

$_GET['a'] = 'SHOP ID';
$_GET['b'] = 'ENCRYPTED STRING';

if (empty($_GET["a"])) {
	throw new Exception("Parametro mancante: 'a'");
}

if (empty($_GET["b"])) {
	throw new Exception("Parametro mancante: 'b'");
}

$gestpay = new GestPayCryptWS();
$gestpay->setShopLogin($_GET["a"]);
$gestpay->setEncryptedString($_GET["b"]);

if (!$gestpay->decrypt()) {
	throw new Exception(
	"Error [" . $gestpay->getErrorCode() . "]: " . $gestpay->getErrorDescription()
	);
}

$result = $gestpay->getTransactionResult();

if ($result == "XX") {
	echo "Esito transazione sospeso (pagamento tramite bonifico)\n";
} elseif ($result == "KO") {
	echo "Esito transazione negativo\n";
} elseif ($result == "OK") {
	echo "Esito transazione positivo\n";
} else {
	echo "Esito transazione indefinito\n";
}
