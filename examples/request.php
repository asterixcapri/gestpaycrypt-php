<?php

require_once "../lib/GestPayCryptWS.php";

$gestpay = new GestPayCryptWS();

$gestpay->setShopLogin("SHOP ID"); // Es. 9000001
$gestpay->setShopTransactionID("SHOP TRANSACTION ID"); // Identificativo transazione. Es. "34az85ord19"
$gestpay->setAmount("0.05"); // Importo. Es.: 1256.50
$gestpay->setCurrency("242"); // Codice valuta. 242 = euro
$gestpay->setTestEnv(TRUE);

if (!$gestpay->encrypt()) {
	throw new Exception(
	"Error: " . $gestpay->getErrorCode() . ": " . $gestpay->getErrorDescription()
	);
}

header("Location: " . $gestpay->getRedirectUrl());
