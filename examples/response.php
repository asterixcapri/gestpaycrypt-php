<?php

require_once "../GestPayCrypt.inc.php";

if (empty($_GET["a"])) {
	die("Parametro mancante: 'a'\n");
}

if (empty($_GET["b"])) {
	die("Parametro mancante: 'b'\n");
}

$crypt = new GestPayCrypt();

$crypt->SetShopLogin($_GET["a"]);
$crypt->SetEncryptedString($_GET["b"]);

if (!$crypt->Decrypt()) {
	die("Error: ".$crypt->GetErrorCode().": ".$crypt->GetErrorDescription()."\n");
}

switch ($crypt->GetTransactionResult()) {
	case "XX":
		die("Esito transazione sospeso (pagamento tramite bonifico)\n");
		break;

	case "KO":
		die("Esito transazione negativo\n");
		break;

	case "OK":
		die("Esito transazione positivo\n");
		break;

	default:
		die("Esito transazione indefinito\n");
}

?>
