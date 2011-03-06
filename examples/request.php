<?php

require_once "../GestPayCrypt.inc.php";

$crypt = new GestPayCrypt();

// impostare i seguenti parametri
$crypt->SetShopLogin("SHOP LOGIN"); // Es. 9000001
$crypt->SetShopTransactionID("TRANSACTION ID"); // Identificativo transazione. Es. "34az85ord19"
$crypt->SetAmount("10"); // Importo. Es.: 1256.50
$crypt->SetCurrency("242"); // Codice valuta. 242 = euro

if (!$crypt->Encrypt()) {
	die("Errore: ".$crypt->GetErrorCode().": ".$crypt->GetErrorDescription()."\n");
}

$url = "https://ecomm.sella.it/gestpay/pagam.asp".
       "?a=".$crypt->GetShopLogin().
       "&b=".$crypt->GetEncryptedString();

header("Location: ".$url);

?>
