<?php

/*
 * GestPayCrypt-PHP
 * Copyright (C) 2001-2011 Alessandro Astarita <aleast@capri.it>
 *
 * http://github.com/asterixcapri/gestpaycrypt-php
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

class GestPayCrypt
{
    private $shopLogin;
    private $currency;
    private $amount;
    private $shopTransactionId;
    private $cardNumber;
    private $expMonth;
    private $expYear;
    private $buyerName;
    private $buyerEmail;
    private $language;
    private $customInfo;
    private $authorizationCode;
    private $errorCode;
    private $errorDescription;
    private $bankTransactionId;
    private $alertCode;
    private $alertDescription;
    private $encryptedString;
    private $decrypted;
    private $transactionResult;
    private $transport;
    private $domainName;
    private $port;
    private $scriptEncrypt;
    private $scriptDecrypt;
    private $separator;
    private $min;
    private $cvv;
    private $country;
    private $vbvrisp;
    private $vbv;

    public function __construct()
    {
        $this->shopLogin = "";
        $this->currency = "";
        $this->amount = "";
        $this->shopTransactionId = "";
        $this->cardNumber = "";
        $this->expMonth = "";
        $this->expYear = "";
        $this->buyerName = "";
        $this->buyerEmail = "";
        $this->language = "";
        $this->customInfo = "";
        $this->authorizationCode = "";
        $this->errorCode = "0";
        $this->errorDescription = "";
        $this->bankTransactionId = "";
        $this->alertCode = "";
        $this->alertDescription = "";
        $this->encryptedString = "";
        $this->decrypted = "";
        $this->transport = "tcp";
        $this->domainName = "ecomm.sella.it";
        $this->port = "80";
        $this->scriptEncrypt = "/CryptHTTP/Encrypt.asp";
        $this->scriptDecrypt = "/CryptHTTP/Decrypt.asp";
        $this->separator = "*P1*";
        $this->min = "";
        $this->cvv = "";
        $this->country = "";
        $this->vbvrisp = "";
        $this->vbv = "";
    }

    public function setShopLogin($val)
    {
        $this->shopLogin = $val;

        return $this;
    }

    public function getShopLogin()
    {
        return $this->shopLogin;
    }

    public function setCurrency($val)
    {
        $this->currency = $val;

        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setAmount($val)
    {
        $this->amount = $val;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setShopTransactionID($val)
    {
        $this->shopTransactionId = urlencode(trim($val));

        return $this;
    }

    public function getShopTransactionID()
    {
        return urldecode($this->shopTransactionId);
    }

    public function setCardNumber($val)
    {
        $this->cardNumber = $val;

        return $this;
    }

    public function setExpMonth($val)
    {
        $this->expMonth = $val;

        return $this;
    }

    public function setExpYear($val)
    {
        $this->expYear = $val;

        return $this;
    }

    public function setMin($val)
    {
        $this->min = $val;

        return $this;
    }

    public function setCvv($val)
    {
        $this->cvv = $val;

        return $this;
    }

    public function setBuyerName($val)
    {
        $this->buyerName = urlencode(trim($val));

        return $this;
    }

    public function setBuyerEmail($val)
    {
        $this->buyerEmail = trim($val);

        return $this;
    }

    public function setLanguage($val)
    {
        $this->language = trim($val);

        return $this;
    }

    public function setCustomInfo($val)
    {
        $this->customInfo = urlencode(trim($val));

        return $this;
    }

    public function getCustomInfo()
    {
        return urldecode($this->customInfo);
    }

    public function setEncryptedString($val)
    {
        $this->encryptedString = $val;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getVbv()
    {
        return $this->vbv;
    }

    public function getVbvRisp()
    {
        return $this->vbvrisp;
    }

    public function getBuyerName()
    {
        return urldecode($this->buyerName);
    }

    public function getBuyerEmail()
    {
        return $this->buyerEmail;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    public function getBankTransactionID()
    {
        return $this->bankTransactionId;
    }

    public function getTransactionResult()
    {
        return $this->transactionResult;
    }

    public function getAlertCode()
    {
        return $this->alertCode;
    }

    public function getAlertDescription()
    {
        return $this->alertDescription;
    }

    public function getEncryptedString()
    {
        return $this->encryptedString;
    }

    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport()
    {
        return $this->transport;
    }

    public function setDomainName($domain_name)
    {
        $this->domainName = $domain_name;

        return $this;
    }

    public function getDomainName()
    {
        return $this->domainName;
    }

    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setScriptEncrypt($script)
    {
        $this->scriptEncrypt = $script;

        return $this;
    }

    public function setScriptDecrypt($script)
    {
        $this->scriptDecrypt = $script;

        return $this;
    }

    public function getScriptType($type)
    {
        if ($type == "crypt") {
            return $this->scriptEncrypt;
        }
        else {
            return $this->scriptDecrypt;
        }
    }

    public function encrypt()
    {
        $this->errorCode = "0";
        $this->errorDescription = "";

        if (empty($this->shopLogin)) {
            $this->errorCode = "546";
            $this->errorDescription = "ShopLogin not valid";

            return false;
        }

        if (empty($this->currency)) {
            $this->errorCode = "552";
            $this->errorDescription = "Currency not valid";

            return false;
        }

        if (empty($this->amount)) {
            $this->errorCode = "553";
            $this->errorDescription = "Amount not valid";

            return false;
        }

        if (empty($this->shopTransactionId)) {
            $this->errorCode = "551";
            $this->errorDescription = "Shop Transaction ID not valid";

            return false;
        }

        $response = $this->_httpGetResponse($this->shopLogin, $this->_getParsedEncryptArguments());

        if ($response == -1) {
            false;
        }

        $this->encryptedString = $this->_parseResponse("crypt", $response);

        if ($this->encryptedString == -1) {
            return false;
        }

        return true;
    }

    private function _getParsedEncryptArguments()
    {
        $args = "";

        $vars = array(
            "PAY1_CVV" => $this->cvv,
            "PAY1_MIN" => $this->min,
            "PAY1_UICCODE" => $this->currency,
            "PAY1_AMOUNT" => $this->amount,
            "PAY1_SHOPTRANSACTIONID" => $this->shopTransactionId,
            "PAY1_CARDNUMBER" => $this->cardNumber,
            "PAY1_EXPMONTH" => $this->expMonth,
            "PAY1_EXPYEAR" => $this->expYear,
            "PAY1_CHNAME" => $this->buyerName,
            "PAY1_CHEMAIL" => $this->buyerEmail,
            "PAY1_IDLANGUAGE" => $this->language
        );

        foreach ($vars as $name => $value) {
            if (!empty($value)) {
                $args .= $name."=".$value.$this->separator;
            }
        }

        $args = substr($args, 0, - strlen($this->separator));
        $args .= $this->customInfo;
        $args = str_replace(" ", "�", $args);

        return $args;
    }

    public function decrypt()
    {
        $this->errorCode = "0";
        $this->errorDescription = "";

        if (empty($this->shopLogin)) {
            $this->errorCode = "546";
            $this->errorDescription = "ShopLogin not valid";

            return false;
        }

        if (empty($this->encryptedString)) {
            $this->errorCode = "1009";
            $this->errorDescription = "String to Decrypt not valid";

            return false;
        }

        $response = $this->_httpGetResponse($this->shopLogin, $this->encryptedString);

        if ($response == -1) {
            false;
        }

        $this->decrypted = $this->_parseResponse("decrypt", $response);

        if ($this->decrypted == -1) {
            return false;
        }
        elseif (empty($this->decrypted)) {
            $this->errorCode = "9999";
            $this->errorDescription = "Empty decrypted string";

            return false;
        }

        $this->decrypted = str_replace("�", " ", $this->decrypted);

        $this->_parseDecryptedData();

        return true;
    }

    protected function _httpGetResponse($type, $a, $b)
    {
        $errno = "";
        $errstr = "";

        $socket = fsockopen(
            $this->getTransport()."://".$this->getDomainName(),
            $this->getPort(),
            $errno,
            $errstr,
            60
        );

        if (!$socket) {
            $this->errorCode = "9999";
            $this->errorDescription = "Impossible to connect to host: ".$host;

            return -1;
        }

        $uri = $this->getScriptType($type)."?a=".$a."&b=".$b;

        fputs($socket, "GET ".$uri." HTTP/1.0\r\n\r\n");

        while (fgets($socket, 4096) != "\r\n") {
            ;
        }

        $line = fgets($socket, 4096);

        fclose($socket);

        return $line;
    }

    private function _parseResponse($type, $response)
    {
        $parsed = "";
        $matches = array();

        if (preg_match("/#".$type."string#([\w\W]*)#\/".$type."string#/", $response, $matches)) {
            $parsed = trim($matches[1]);
        }
        elseif (preg_match("/#error#([\w\W]*)#\/error#/", $response, $matches)) {
            $err = explode("-", $matches[1]);

            if (empty($err[0]) && empty($err[1])) {
                $this->errorCode = "9999";
                $this->errorDescription = "Unknown error";
            }
            else {
                $this->errorCode = trim($err[0]);
                $this->errorDescription = trim($err[1]);
            }

            return -1;
        }
        else {
            $this->errorCode = "9999";
            $this->errorDescription = "Response from server not valid";

            return -1;
        }

        return $parsed;
    }

    private function _parseDecryptedData()
    {
        $keyval = explode($this->separator, $this->decrypted);

        foreach ($keyval as $tagPAY1) {
            $tagPAY1val = explode("=", $tagPAY1);

            if (preg_match("/^PAY1_UICCODE/", $tagPAY1)) {
                $this->currency = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_AMOUNT/", $tagPAY1)) {
                $this->amount = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_SHOPTRANSACTIONID/", $tagPAY1)) {
                $this->shopTransactionId = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_CHNAME/", $tagPAY1)) {
                $this->buyerName = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_CHEMAIL/", $tagPAY1)) {
                $this->buyerEmail = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_AUTHORIZATIONCODE/", $tagPAY1)) {
                $this->authorizationCode = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_ERRORCODE/", $tagPAY1)) {
                $this->errorCode = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_ERRORDESCRIPTION/", $tagPAY1)) {
                $this->errorDescription = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_BANKTRANSACTIONID/", $tagPAY1)) {
                $this->bankTransactionId = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_ALERTCODE/", $tagPAY1)) {
                $this->alertCode = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_ALERTDESCRIPTION/", $tagPAY1)) {
                $this->alertDescription = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_CARDNUMBER/", $tagPAY1)) {
                $this->cardNumber = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_EXPMONTH/", $tagPAY1)) {
                $this->expMonth = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_EXPYEAR/", $tagPAY1)) {
                $this->expYear = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_COUNTRY/", $tagPAY1)) {
                $this->expYear = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_VBVRISP/", $tagPAY1)) {
                $this->expYear = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_VBV/", $tagPAY1)) {
                $this->expYear = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_IDLANGUAGE/", $tagPAY1)) {
                $this->language = $tagPAY1val[1];
            }
            elseif (preg_match("/^PAY1_TRANSACTIONRESULT/", $tagPAY1)) {
                $this->transactionResult = $tagPAY1val[1];
            }
            else {
                $this->customInfo .= $tagPAY1.$this->separator;
            }
        }

        $this->customInfo = substr($this->customInfo, 0, - strlen($this->separator));
    }
}
