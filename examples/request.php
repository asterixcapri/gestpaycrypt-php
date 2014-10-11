<?php

require_once "../GestPayCrypt.inc.php";

$gestpay = new GestPayCryptHS();

$gestpay->setShopLogin("SHOP LOGIN"); // Es. 9000001
$gestpay->setShopTransactionID("TRANSACTION ID"); // Identificativo transazione. Es. "34az85ord19"
$gestpay->setAmount("10"); // Importo. Es.: 1256.50
$gestpay->setCurrency("242"); // Codice valuta. 242 = euro

if (!$gestpay->encrypt()) {
    throw new Exception(
        "Error: ".$gestpay->getErrorCode().": ".$gestpay->getErrorDescription()
    );
}

$url = "https://ecomm.sella.it/gestpay/pagam.asp".
       "?a=".$gestpay->getShopLogin().
       "&b=".$gestpay->getEncryptedString();

header("Location: ".$url);
