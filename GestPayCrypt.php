<?php

/*
 * GestPayCrypt e GestPayCryptHS 2.0.1
 * Copyright (C) 2001-2004 Alessandro Astarita <aleast@capri.it>
 *
 * http://gestpaycryptphp.sourceforge.net/
 *
 * GestPayCrypt-PHP is an implementation in PHP of GestPayCrypt e
 * GestPayCryptHS italian bank Banca Sella java classes. It allows to
 * connect to online credit card payment GestPay.
 *
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * version 2.1 as published by the Free Software Foundation.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details at 
 * http://www.gnu.org/copyleft/lgpl.html
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 */

// Path curl 
define("GESTPAYCRYPT_CURL_BIN", "/usr/bin/curl");

class GestPayCrypt
{
	// Public
	var $ShopLogin;         // Shop Login che identifica l'esercente
	var $Currency;          // Codice che identifica la divisa in cui e' denominato l'importo
	var $Amount;            // Importo della transazione
	var $ShopTransactionID; // Identificativo attribuito alla transazione dall'esercente
	var $CardNumber;        // Numero carta di credito
	var $ExpMonth;          // Mese di scadenza carta di credito
	var $ExpYear;           // Anno di scadenza carta di credito
	var $BuyerName;         // Nome e cognome dell'acquirente
	var $BuyerEmail;        // Indirizzo email dell'acquirente
	var $Language;          // Lingua selezionata
	var $CustomInfo;        // Info aggiuntive
	var $AuthorizationCode; // Codice di autorizzazione della transazione;
	var $ErrorCode; 	// Codice di errore
	var $ErrorDescription; 	// Descrizione errore
	var $BankTransactionID; // Identificativo attribuito alla transazione da GestPay
	var $AlertCode;         // Codice alert
	var $AlertDescription;  // Descrizione alert
	var $EncryptedString;   // Stringa cifrata
	var $ToBeEncript;       // Stringa da cifrare
	var $Decrypted;
	var $TransactionResult; // Esito transazione
	var $ProtocolAuthServer;
	var $DomainName;
	var $separator;
	var $errDescription;
	var $errNumber;
	var $Version;
	var $Min;
	var $CVV;
	var $country;
	var $vbvrisp;
	var $vbv;

	function GestPayCrypt()
	{
		$this->ShopLogin = "";
		$this->Currency = "";
		$this->Amount = "";
		$this->ShopTransactionID = "";
		$this->CardNumber = "";
		$this->ExpMonth = "";
		$this->ExpYear = "";
		$this->BuyerName = "";
		$this->BuyerEmail = "";
		$this->Language = "";
		$this->CustomInfo = "";
		$this->AuthorizationCode = "";
		$this->ErrorCode = "0";
		$this->ErrorDescription = "";
		$this->BankTransactionID = "";
		$this->AlertCode = "";
		$this->AlertDescription = "";
		$this->EncryptedString = "";
		$this->ToBeEncrypt = "";
		$this->Decrypted = "";
		$this->ProtocolAuthServer = "http";
		$this->DomainName = "ecomm.sella.it";
		$this->ScriptEnCrypt = "/CryptHTTP/Encrypt.asp";
		$this->ScriptDecrypt = "/CryptHTTP/Decrypt.asp";
		$this->separator = "*P1*";
		$this->errDescription = "";
		$this->errNumber = "0";
		$this->Version = "2.0";
		$this->Min = "";
		$this->CVV = "";
		$this->country = "";
		$this->vbvrisp = "";
		$this->vbv = "";

		$this->debug = false;
	}

	// Public

	// Metodi di valorizzazione attributi
	function SetShopLogin($val)
	{
		$this->ShopLogin = $val;
	}

	function SetCurrency($val)
	{
		$this->Currency = $val;
	}

	function SetAmount($val)
	{
		$this->Amount = $val;
	}

	function SetShopTransactionID($val)
	{
		$this->ShopTransactionID = urlencode(trim($val));
	}

	function SetCardNumber($val)
	{
		$this->CardNumber = $val;
	}

	function SetExpMonth($val)
	{
		$this->ExpMonth = $val;
	}

	function SetExpYear($val)
	{
		$this->ExpYear = $val;
	}

	function SetMIN($val)
	{
		$this->Min = $val;
	}

	function SetCVV($val)
	{
		$this->CVV = $val;
	}

	function SetBuyerName($val)
	{
		$this->BuyerName = urlencode(trim($val));
	}

	function SetBuyerEmail($val)
	{
		$this->BuyerEmail = trim($val);
	}

	function SetLanguage($val)
	{
		$this->Language = trim($val);
	}

	function SetCustomInfo($val)
	{
		$this->CustomInfo = urlencode(trim($val));
	}

	function SetEncryptedString($val)
	{
		$this->EncryptedString = $val;
	}

	// Metodi di lettura attributi
	function GetShopLogin()
	{
		return $this->ShopLogin;
	}

	function GetCurrency()
	{
		return $this->Currency;
	}

	function GetAmount()
	{
		return $this->Amount;
	}

	function GetCountry()
	{
		return $this->country;
	}

	function GetVBV()
	{
		return $this->vbv;
	}

	function GetVBVrisp()
	{
		return $this->vbvrisp;
	}	
	
	function GetShopTransactionID()
	{
		return urldecode($this->ShopTransactionID);
	}

	function GetBuyerName()
	{
		return urldecode($this->BuyerName);
	}

	function GetBuyerEmail()
	{
		return $this->BuyerEmail;
	}

	function GetCustomInfo()
	{
		return urldecode($this->CustomInfo);
	}

	function GetAuthorizationCode()
	{
		return $this->AuthorizationCode;
	}

	function GetErrorCode()
	{
		return $this->ErrorCode;
	}

	function GetErrorDescription()
	{
		return $this->ErrorDescription;
	}

	function GetBankTransactionID()
	{
		return $this->BankTransactionID;
	}

	function GetTransactionResult()
	{
		return $this->TransactionResult;
	}

	function GetAlertCode()
	{
		return $this->AlertCode;
	}

	function GetAlertDescription()
	{
		return $this->AlertDescription;
	}

	function GetEncryptedString()
	{
		return $this->EncryptedString;
	}

	function Encrypt()
	{
		$err = "";
		$this->ErrorCode = "0";
		$this->ErrorDescription = "";
		$this->ToBeEncrypt = "";

		if (empty($this->ShopLogin)) {
			$this->ErrorCode = "546";
			$this->ErrorDescription = "IDshop not valid";
			return false;
		}

		if (empty($this->Currency)) {
			$this->ErrorCode = "552";
			$this->ErrorDescription = "Currency not valid";
			return false;
		}

		if (empty($this->Amount)) {
			$this->ErrorCode = "553";
			$this->ErrorDescription = "Amount not valid";
			return false;
		}

		if (empty($this->ShopTransactionID)) {
			$this->ErrorCode = "551";
			$this->ErrorDescription = "Shop Transaction ID not valid";
			return false;
		}

		$this->ToEncrypt($this->CVV, "PAY1_CVV");
		$this->ToEncrypt($this->Min, "PAY1_MIN");
		$this->ToEncrypt($this->Currency, "PAY1_UICCODE");
		$this->ToEncrypt($this->Amount, "PAY1_AMOUNT");
		$this->ToEncrypt($this->ShopTransactionID, "PAY1_SHOPTRANSACTIONID");
		$this->ToEncrypt($this->CardNumber, "PAY1_CARDNUMBER");
		$this->ToEncrypt($this->ExpMonth, "PAY1_EXPMONTH");
		$this->ToEncrypt($this->ExpYear, "PAY1_EXPYEAR");
		$this->ToEncrypt($this->BuyerName, "PAY1_CHNAME");
		$this->ToEncrypt($this->BuyerEmail, "PAY1_CHEMAIL");
		$this->ToEncrypt($this->Language, "PAY1_IDLANGUAGE");
		$this->ToEncrypt($this->CustomInfo, "");

		$this->ToBeEncrypt = str_replace(" ", "§", $this->ToBeEncrypt);

		$uri = $this->ScriptEnCrypt."?a=".$this->ShopLogin.
		       "&b=".substr($this->ToBeEncrypt, strlen($this->separator));

		if ($this->debug) {
			//$this->HostName = "localhost";
			//$uri = "/~asterix/GestPayCrypt/Encrypt.asp.txt";
			echo "URL richiesta: ".$this->ProtocolAuthServer."://".$this->DomainName.$uri."\n";
		}

		$this->EncryptedString = $this->HttpGetResponse($this->DomainName, $uri, true);

		if ($this->EncryptedString == -1) {
			return false;
		}

		if ($this->debug) {
			echo "Stringa criptata: ".$this->EncryptedString."\n";
		}

		return true;
	}

	function Decrypt()
	{
		$err = "";
		$this->ErrorCode = "0";
		$this->ErrorDescription = "";
		
		if (empty($this->ShopLogin)) {
			$this->ErrorCode = "546";
			$this->ErrorDescription = "IDshop not valid";
			return false;
		}

		if (empty($this->EncryptedString)) {
			$this->ErrorCode = "1009";
			$this->ErrorDescription = "String to Decrypt not valid";
			return false;
		}

		$uri = $this->ScriptDecrypt."?a=".$this->ShopLogin.
		       "&b=".$this->EncryptedString;

		if ($this->debug) {
			//$this->HostName = "localhost";
			//$uri = "/~asterix/GestPayCrypt/Decrypt.asp.txt";
			echo "URL richiesta: ".$this->ProtocolAuthServer."://".$this->DomainName.$uri."\n";
		}

		$this->Decrypted = $this->HttpGetResponse($this->DomainName, $uri, false);

		if ($this->Decrypted == -1) {
			return false;
		}
		elseif (empty($this->Decrypted)) {
			$this->ErrorCode = "9999";
			$this->ErrorDescription = "Empty decrypted string";
			return false;
		}

		$this->Decrypted = str_replace("§", " ", $this->Decrypted);

		if ($this->debug) {
			echo "Stringa decriptata: ".$this->Decrypted."\n";
		}

		$this->Parsing();

		return true;
	}

	// Private
	function ToEncrypt($value, $tagvalue)
	{
		$equal = $tagvalue ? "=" : "";

		if (!empty($value)) {
			$this->ToBeEncrypt .= $this->separator.$tagvalue.$equal.$value;
		}
	}

	function HttpGetResponse($host, $uri, $crypt)
	{
		$response = "";
		$req = $crypt ? "crypt" : "decrypt";

		$line = $this->HttpGetLine($host, $uri);

		if ($line == -1) {
			return -1;
		}

		if ($this->debug) {
			echo $line;
		}

		if (preg_match("/#".$req."string#([\w\W]*)#\/".$req."string#/", $line, $reg)) {
			$response = trim($reg[1]);
		}
		elseif (preg_match("/#error#([\w\W]*)#\/error#/", $line, $reg)) {
			$err = explode("-", $reg[1]);

			if (empty($err[0]) && empty($err[1])) {
				$this->ErrorCode = "9999";
				$this->ErrorDescription = "Unknown error";
			}
			else {
				$this->ErrorCode = trim($err[0]);
				$this->ErrorDescription = trim($err[1]);
			}

			return -1;
		}
		else {
			$this->ErrorCode = "9999";
			$this->ErrorDescription = "Response from server not valid";
			return -1;
		}

		return $response;
	}

	function HttpGetLine($host, $uri, $port = 80)
	{
		$in = fsockopen($host, $port, $errno, $errstr, 60);
		if (!$in) {
			$this->ErrorCode = "9999";
			$this->ErrorDescription = "Impossible to connect to host: ".$host;
			
			return -1;
		}
		else {
			fputs($in, "GET ".$uri." HTTP/1.0\r\n\r\n");
		}

		$line = "";

		// Salta gli header
		while (fgets($in, 4096) != "\r\n")
			;

		// Legge solo la prima riga
		$line = fgets($in, 4096);

		fclose($in);

		return $line;
	}

	function Parsing()
	{
		$keyval = explode($this->separator, $this->Decrypted);
		
		foreach ($keyval as $tagPAY1) {
			$tagPAY1val = explode("=", $tagPAY1);

			if (ereg("^PAY1_UICCODE", $tagPAY1)) {
				$this->Currency = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_AMOUNT", $tagPAY1)) {
				$this->Amount = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_SHOPTRANSACTIONID", $tagPAY1)) {
				$this->ShopTransactionID = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_CHNAME", $tagPAY1)) {
				$this->BuyerName = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_CHEMAIL", $tagPAY1)) {
				$this->BuyerEmail = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_AUTHORIZATIONCODE", $tagPAY1)) {
				$this->AuthorizationCode = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_ERRORCODE", $tagPAY1)) {
				$this->ErrorCode = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_ERRORDESCRIPTION", $tagPAY1)) {
				$this->ErrorDescription = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_BANKTRANSACTIONID", $tagPAY1)) {
				$this->BankTransactionID = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_ALERTCODE", $tagPAY1)) {
				$this->AlertCode = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_ALERTDESCRIPTION", $tagPAY1)) {
				$this->AlertDescription = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_CARDNUMBER", $tagPAY1)) {
				$this->CardNumber = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_EXPMONTH", $tagPAY1)) {
				$this->ExpMonth = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_EXPYEAR", $tagPAY1)) {
				$this->ExpYear = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_COUNTRY", $tagPAY1)) {
				$this->ExpYear = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_VBVRISP", $tagPAY1)) {
				$this->ExpYear = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_VBV", $tagPAY1)) {
				$this->ExpYear = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_IDLANGUAGE", $tagPAY1)) {
				$this->Language = $tagPAY1val[1];
			}
			elseif (ereg("^PAY1_TRANSACTIONRESULT", $tagPAY1)) {
				$this->TransactionResult = $tagPAY1val[1];
			}
			else {
				$this->CustomInfo .= $tagPAY1.$this->separator;
			}
		}

		$this->CustomInfo = substr($this->CustomInfo, 0, - strlen($this->separator));
	}
}

class GestPayCryptHS extends GestPayCrypt
{
	// Costruttore
	function GestPayCryptHS()
	{
		$this->ShopLogin = "";
		$this->Currency = "";
		$this->Amount = "";
		$this->ShopTransactionID = "";
		$this->CardNumber = "";
		$this->ExpMonth = "";
		$this->ExpYear = "";
		$this->BuyerName = "";
		$this->BuyerEmail = "";
		$this->Language = "";
		$this->CustomInfo = "";
		$this->AuthorizationCode = "";
		$this->ErrorCode = "0";
		$this->ErrorDescription = "";
		$this->BankTransactionID = "";
		$this->AlertCode = "";
		$this->AlertDescription = "";
		$this->EncryptedString = "";
		$this->ToBeEncrypt = "";
		$this->Decrypted = "";
		$this->ProtocolAuthServer = "https";
		$this->DomainName = "ecomm.sella.it";
		$this->ScriptEnCrypt = "/CryptHTTPS/Encrypt.asp";
		$this->ScriptDecrypt = "/CryptHTTPS/Decrypt.asp";
		$this->separator = "*P1*";
		$this->errNumber = "0";
		$this->Min = "";
		$this->CVV = "";
		$this->country = "";
		$this->vbvrisp = "";
		$this->vbv = "";
		
		$this->debug = false;
	}

	function HttpGetLine($host, $uri, $port = 443)
	{
		if (function_exists("version_compare")
			&& version_compare(phpversion(), "4.3.0", ">=")
			&& extension_loaded("openssl")) {

			if ($this->debug) {
				echo "HttpGetLine(): php ssl\n";
			}

			return parent::HttpGetLine("ssl://".$host, $uri, 443);
		}
		elseif (extension_loaded("curl")) {
			if ($this->debug) {
				echo "HttpGetLine(): curl ext\n";
			}

			$curl = curl_init("https://".$host.$uri);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$tmp = curl_exec($curl);
			curl_close($curl);

			$lines = explode("\n", $tmp);

			return $lines[0];
		}
		else {
			if ($this->debug) {
				echo "HttpGetLine(): curl bin\n";
			}

			$exec_str = GESTPAYCRYPT_CURL_BIN.
			            " -s -m 120 -L ".
			            escapeshellarg($this->ProtocolAuthServer."://".$this->DomainName.$uri);

			exec($exec_str, $ret_arr, $ret_num);

			if ($ret_num != 0) {
				$this->ErrorCode = "9999";
				$this->ErrorDescription = "Error while executing: ".$exec_str;
				return -1;
			}

			if (!is_array($ret_arr)) {
				$this->ErrorCode = "9999";
				$this->ErrorDescription = "Error while executing: ".$exec_str." - ".
				                          "\$ret_arr is not an array";

				return -1;
			}

			return $ret_arr[0];
		}
	}
}

?>
