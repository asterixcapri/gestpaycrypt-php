<?
// PAGINA PER LA CONNESSIONE
// ALLA PAGINA DI PAGAMENTO
// (RICHIESTA DI PAGAMENTO)

// N.B: TUTTI I PARAMETRI SONO DA ASSEGNARE COME STRINGHE, ANCHE QUELLI CHE
// DOVREBBERO ESSERE NUMERICI

//INIZIO SCRIPT DI CRITTOGRAFIA

//PARTE DA NON MODIFICARE
require_once "../../GestPayCrypt.inc.php";
$objCrypt = new GestPayCrypt();

//PARTE DA MODIFICARE (VALORIZZAZIONE ATTRIBUTI TRANSAZIONE)

//Inserire al posto delle scritte con parentesi quadre [] I dati
//necessari per effettuare la transazione.
//Le righe contenenti i dati contrassegnati come NON OBBLIGATORI
//devono essere eliminate se non utilizzate

//CAMPI OBBLIGATORI

$myshoplogin = "[SHOP LOGIN]"; // Es. 9000001
$mycurrency = "[CODICE DIVISA]"; //Es. 242 per euro o 18 lira
$myamount = "[IMPORTO SENZA SEPARATORI DI MIGLIAIA CON SEPARATORE PUNTO PER DECIMALI]"; // Es. 1256.28
$myshoptransactionID="[IDENTIFICATIVO TRANSAZIONE]"; //Es. "34az85ord19"

//CAMPI NON OBBLIGATORI
//METTERE UGUALE ALLA STRINGA ANULLA LE VARIABILI NON INIZIALIZZATE
// (NON CANCELLARE LE RIGHE NON INTERESSATE)


$mybuyername= "[NOME E COGNOME ACQUIRENTE]"; //Es. "Mario Bianchi"
$mybuyeremail= "[EMAIL ACQUIRENTE]"; // Es. "Mario.bianchi@isp.it"
$mylanguage= "[CODICE LINGUA DA UTILIZZARE NELLA COMUNICAZIONE]"; //Es. 3 per spagnolo
$mycustominfo= "[PARAMETRI PERSONALIZZATI]"; //Es. "BV_CODCLIENTE=12*P1*BV_SESSIONID=398"

// nella parte seguente, le righe setbuyername e setbuyeremail si possono attivare (togliendo il
// simbolo di commento) solo dopo aver pubblicato la pagina di informazioni aggiuntive

//PARTE DA NON MODIFICARE

$objCrypt->SetShopLogin($myshoplogin);
$objCrypt->SetCurrency($mycurrency);
$objCrypt->SetAmount($myamount);
$objCrypt->SetShopTransactionID($myshoptransactionID);
// $objCrypt->SetBuyerName($mybuyername);
// $objCrypt->SetBuyerEmail($mybuyeremail);
$objCrypt->SetLanguage($mylanguage);
$objCrypt->SetCustomInfo($mycustominfo);

$objCrypt->Encrypt();

$ed=$objCrypt->GetErrorDescription();
if($ed!="")
{
echo "Errore di encoding: " . $objCrypt->GetErrorCode() . " " . $ed . "<br>";
}
else
{
$b = $objCrypt->GetEncryptedString();
$a = $objCrypt->GetShopLogin();
}

//FINE SCRIPT PER CRITTOGRAFIA.

//SE TUTTO OK SI HANNO 2 VARIABILI A E B DA UTILIZZARE PER IL 'PASSAGGIO DEI PARAMETRI A BANCA SELLA

//ESEMPIO CON FORM HTML
?>

Cliccare su OK per inviare i dati a Banca Sella
<form action="https://ecomm.sella.it/gestpay/pagam.asp">
<input name="a" type="hidden" value="<? echo $a; ?>">
<input name="b" type="hidden" value="<? echo $b; ?>">
<input type="submit" value=" OK " name="submit">
</form>
