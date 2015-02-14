<?php

/*
 * GestPayCrypt-PHP
 * Copyright (C) 2001-2015 Alessandro Astarita <aleast@capri.it>
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
    private $testDomainName;
    private $paymentUrl;
    private $port;
    private $separator;
    private $min;
    private $cvv;
    private $country;
    private $vbv;
    private $vbvRisp;
    private $threeDLevel;
    private $scriptEncrypt;
    private $scriptDecrypt;
    private $testEnv;

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
        $this->testDomainName = "testecomm.sella.it";
        $this->paymentUrl = "/pagam/pagam.aspx";
        $this->port = "80";
        $this->scriptEncrypt = "/CryptHTTP/Encrypt.asp";
        $this->scriptDecrypt = "/CryptHTTP/Decrypt.asp";
        $this->separator = "*P1*";
        $this->min = "";
        $this->cvv = "";
        $this->country = "";
        $this->vbv = "";
        $this->vbvRisp = "";
        $this->threeDLevel = "";
        $this->testEnv = false;
    }

    /**
     * @param bool $enable
     * @return GestPayCrypt
     */
    public function setTestEnv($enable)
    {
        $this->testEnv = $enable;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTestEnv()
    {
        return $this->testEnv;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setShopLogin($val)
    {
        $this->shopLogin = $val;

        return $this;
    }

    /**
     * @return string
     */
    public function getShopLogin()
    {
        return $this->shopLogin;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setCurrency($val)
    {
        $this->currency = $val;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setAmount($val)
    {
        $this->amount = $val;

        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setShopTransactionID($val)
    {
        $this->shopTransactionId = urlencode(trim($val));

        return $this;
    }

    /**
     * @return string
     */
    public function getShopTransactionID()
    {
        return urldecode($this->shopTransactionId);
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setCardNumber($val)
    {
        $this->cardNumber = $val;

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setExpMonth($val)
    {
        $this->expMonth = $val;

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setExpYear($val)
    {
        $this->expYear = $val;

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setMin($val)
    {
        $this->min = $val;

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setCvv($val)
    {
        $this->cvv = $val;

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setBuyerName($val)
    {
        $this->buyerName = urlencode(trim($val));

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setBuyerEmail($val)
    {
        $this->buyerEmail = trim($val);

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setLanguage($val)
    {
        $this->language = trim($val);

        return $this;
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setCustomInfo($val)
    {
        $this->customInfo = urlencode(trim($val));

        return $this;
    }

    /**
     * @param array $arrval
     * @return GestPayCrypt|bool
     */
    public function setCustomInfoFromArray(array $arrval)
    {
        if (!is_array($arrval)) {
            return false;
        }
        //check string validity
        foreach ($arrval as $key => $val) {
            if (strlen($val) > 300) {
                $val = substr($val, 0, 300);
            }
            $arrval[$key] = urlencode($val);
        }

        $this->customInfo = http_build_query($arrval, '', $this->separator);

        return $this;
    }

    public function getCustomInfoToArray()
    {
        $allinfo = explode($this->separator, $this->customInfo);
        $customInfoArray = array();
        foreach ($allinfo as $singleInfo) {
            $tagval = explode("=", $singleInfo);
            $customInfoArray[$tagval[0]] = urldecode($tagval[1]);
        }

        return $customInfoArray;
    }

    /**
     * @return string
     */
    public function getCustomInfo()
    {
        return urldecode($this->customInfo);
    }

    /**
     * @param string $val
     *
     * @return GestPayCrypt
     */
    public function setEncryptedString($val)
    {
        $this->encryptedString = $val;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getVbv()
    {
        return $this->vbv;
    }

    /**
     * @return string
     */
    public function getVbvRisp()
    {
        return $this->vbvRisp;
    }

    /**
     * @return string
     */
    public function get3dLevel()
    {
        return $this->threeDLevel;
    }

    /**
     * @return string
     */
    public function getBuyerName()
    {
        return urldecode($this->buyerName);
    }

    /**
     * @return string
     */
    public function getBuyerEmail()
    {
        return $this->buyerEmail;
    }

    /**
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * @return string
     */
    public function getBankTransactionID()
    {
        return $this->bankTransactionId;
    }

    /**
     * @return string
     */
    public function getTransactionResult()
    {
        return $this->transactionResult;
    }

    /**
     * @return string
     */
    public function getAlertCode()
    {
        return $this->alertCode;
    }

    /**
     * @return string
     */
    public function getAlertDescription()
    {
        return $this->alertDescription;
    }

    /**
     * @return string
     */
    public function getEncryptedString()
    {
        return $this->encryptedString;
    }

    /**
     * @param string $type
     *
     * @return GestPayCrypt
     */
    public function setTransport($type)
    {
        $this->transport = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param string $domain_name
     *
     * @return GestPayCrypt
     */
    public function setDomainName($domain_name)
    {
        $this->domainName = $domain_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomainName()
    {
        if ($this->testEnv === true) {
            return $this->testDomainName;
        }

        return $this->domainName;
    }

    /**
     * @param string $port
     *
     * @return GestPayCrypt
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $script
     *
     * @return GestPayCrypt
     */
    public function setScriptEncrypt($script)
    {
        $this->scriptEncrypt = $script;

        return $this;
    }

    /**
     * @param string $script
     *
     * @return GestPayCrypt
     */
    public function setScriptDecrypt($script)
    {
        $this->scriptDecrypt = $script;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentUrl()
    {
        return $this->paymentUrl;
    }

    /**
     * @param $url
     * @return GestPayCrypt
     */
    public function setPaymentUrl($url)
    {
        $this->paymentUrl = $url;

        return $this;
    }

    public function getRedirectUrl()
    {
        return 'https://' . $this->getDomainName() . $this->getPaymentUrl() .
               '?a=' . $this->getShopLogin() .
               '&b=' . $this->getEncryptedString();
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function getScriptType($type)
    {
        if ($type == "crypt") {
            return $this->scriptEncrypt;
        } else {
            return $this->scriptDecrypt;
        }
    }

    /**
     * @return bool
     */
    public function encrypt()
    {
        $this->setError('0', '');

        if (empty($this->shopLogin)) {
            $this->setError('546', 'IDshop not valid');
            return false;
        }

        if (empty($this->currency)) {
            $this->setError('552', 'Currency not valid');
            return false;
        }

        if (empty($this->amount)) {
            $this->setError('553', 'Amount not valid');
            return false;
        }

        if (empty($this->shopTransactionId)) {
            $this->setError('551', 'Shop Transaction ID not valid');
            return false;
        }

        $response = $this->_httpGetResponse("crypt", $this->shopLogin, $this->_getParsedEncryptArguments());

        if ($response == -1) {
            return false;
        }

        $this->encryptedString = $this->_parseResponse("crypt", $response);

        if ($this->encryptedString == -1) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
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
                $args .= $name . "=" . $value . $this->separator;
            }
        }

        $args = substr($args, 0, -strlen($this->separator));

        if (strlen($this->customInfo) > 0) {
            $args .= $this->separator . $this->getCustomInfo();
        }

        $args = str_replace(" ", chr(167), $args);

        return $args;
    }

    /**
     * @return bool
     */
    public function decrypt()
    {
        $this->setError('0', '');

        if (empty($this->shopLogin)) {
            $this->setError('546', 'IDshop not valid');
            return false;
        }

        if (empty($this->encryptedString)) {
            $this->setError('1009', 'String to Decrypt not valid');
            return false;
        }

        $response = $this->_httpGetResponse("decrypt", $this->shopLogin, $this->encryptedString);

        if ($response == -1) {
            false;
        }

        $this->decrypted = $this->_parseResponse("decrypt", $response);

        if ($this->decrypted == -1) {
            return false;
        } elseif (empty($this->decrypted)) {
            $this->setError('9999', 'Empty decrypted string');
            return false;
        }

        $this->decrypted = str_replace(chr(167), " ", $this->decrypted);

        $this->_parseDecryptedData();

        return true;
    }

    /**
     * @param string $type
     * @param string $a
     * @param string $b
     *
     * @return string
     */
    protected function _httpGetResponse($type, $a, $b)
    {
        $errno = "";
        $errstr = "";

        $socket = fsockopen(
            $this->getTransport() . "://" . $this->getDomainName(),
            $this->getPort(),
            $errno,
            $errstr,
            60
        );

        if (!$socket) {
            $this->setError(
                '9999',
                "Impossible to connect to: " .
                $this->getTransport() . "://" . $this->getDomainName() . ':' . $this->getPort()
            );
            return -1;
        }

        $uri = $this->getScriptType($type) . "?a=" . $a . "&b=" . $b;

        fputs($socket, "GET " . $uri . " HTTP/1.0\r\n\r\n");

        while (fgets($socket, 4096) != "\r\n") {
            ;
        }

        $line = fgets($socket, 4096);

        fclose($socket);

        return $line;
    }

    /**
     * @param string $type
     * @param string $response
     *
     * @return string
     */
    private function _parseResponse($type, $response)
    {
        $matches = array();

        if (preg_match("/#" . $type . "string#([\w\W]*)#\/" . $type . "string#/", $response, $matches)) {
            $parsed = trim($matches[1]);
        } elseif (preg_match("/#error#([\w\W]*)#\/error#/", $response, $matches)) {
            $err = explode("-", $matches[1]);

            if (empty($err[0]) && empty($err[1])) {
                $this->setError('9999', 'Unknown error');
            } else {
                $this->setError(trim($err[0]), trim($err[1]));
            }

            return -1;
        } else {
            $this->setError('9999', 'Response from server not valid');

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
            } elseif (preg_match("/^PAY1_AMOUNT/", $tagPAY1)) {
                $this->amount = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_SHOPTRANSACTIONID/", $tagPAY1)) {
                $this->shopTransactionId = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_CHNAME/", $tagPAY1)) {
                $this->buyerName = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_CHEMAIL/", $tagPAY1)) {
                $this->buyerEmail = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_AUTHORIZATIONCODE/", $tagPAY1)) {
                $this->authorizationCode = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_ERRORCODE/", $tagPAY1)) {
                $this->errorCode = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_ERRORDESCRIPTION/", $tagPAY1)) {
                $this->errorDescription = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_BANKTRANSACTIONID/", $tagPAY1)) {
                $this->bankTransactionId = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_ALERTCODE/", $tagPAY1)) {
                $this->alertCode = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_ALERTDESCRIPTION/", $tagPAY1)) {
                $this->alertDescription = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_CARDNUMBER/", $tagPAY1)) {
                $this->cardNumber = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_EXPMONTH/", $tagPAY1)) {
                $this->expMonth = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_EXPYEAR/", $tagPAY1)) {
                $this->expYear = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_COUNTRY/", $tagPAY1)) {
                $this->country = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_VBVRISP/", $tagPAY1)) {
                $this->vbvRisp = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_VBV/", $tagPAY1)) {
                $this->vbv = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_IDLANGUAGE/", $tagPAY1)) {
                $this->language = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_TRANSACTIONRESULT/", $tagPAY1)) {
                $this->transactionResult = $tagPAY1val[1];
            } elseif (preg_match("/^PAY1_3DLEVEL/", $tagPAY1)) {
                $this->threeDLevel = $tagPAY1val[1];
            } else {
                $this->customInfo .= $tagPAY1 . $this->separator;
            }
        }

        $this->customInfo = substr($this->customInfo, 0, -strlen($this->separator));
    }

    /**
     * @param string $errorCode
     * @param string $errorDescription
     * @return GestPayCrypt
     */
    protected function setError($errorCode, $errorDescription)
    {
        $this->errorCode = $errorCode;
        $this->errorDescription = $errorDescription;

        return $this;
    }
}
