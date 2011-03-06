<?
// PAGINA PER LA GESTIONE DELLA RISPOSTA DI PAGAMENTO

// INIZIO SCRIPT PER DECRITTOGRAFIA
// DA NON MODIFICARE


// VENGONO LETTI I PARAMETRI IN INPUT E VIENE DECRIPTATO IL
// PARAMETRO B

$parametro_a = trim($a);
$parametro_b = trim($b);

require_once "../../GestPayCrypt.inc.php";
$objdeCrypt = new GestPayCrypt();

$objdeCrypt->SetShopLogin($parametro_a);
$objdeCrypt->SetEncryptedString($parametro_b);
$objdeCrypt->Decrypt();

// DI SEGUITO SI HANNO UNA SERIE DI VARIABILI VALORIZZATE CON I
// DATI RICEVUTI DA GESTPAY DA UTILIZZARE PER L'INTEGRAZIONE CON
// IL PROPRIO SISTEMA


$myshoplogin=trim($objdeCrypt->GetShopLogin());
$mycurrency=$objdeCrypt->GetCurrency();
$myamount=$objdeCrypt->GetAmount();
$myshoptransactionID=trim($objdeCrypt->GetShopTransactionID());
$mybuyername=trim($objdeCrypt->GetBuyerName());
$mybuyeremail=trim($objdeCrypt->GetBuyerEmail());
$mytransactionresult=trim($objdeCrypt->GetTransactionResult());
$myauthorizationcode=trim($objdeCrypt->GetAuthorizationCode());
$myerrorcode=trim($objdeCrypt->GetErrorCode());
$myerrordescription=trim($objdeCrypt->GetErrorDescription());
$myerrorbanktransactionid=trim($objdeCrypt->GetBankTransactionID());
$myalertcode=trim($objdeCrypt->GetAlertCode());
$myalertdescription=trim($objdeCrypt->GetAlertDescription());
$mycustominfo=trim($objdeCrypt->GetCustomInfo());

// FINE SCRIPT DI DECRITTOGRAFIA

echo $myshoplogin . "<br>\n";
echo $myamount . " " . $mycurrency . "<br>\n";
echo $mytransactionresult . "<br>\n";

?>