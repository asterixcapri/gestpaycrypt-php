<?php

/*
 * GestPayCryptWS
 * Copyright (C) 2001-2015 Gabriele Brosulo <gabriele@brosulo.net>
 *
 * http://github.com/asterixcapri/gestpaycrypt-php
 *
 * GestPayCryptWS is the new implementation of GestPayCrypt using SOAP WebServices
 * It allows to connect to online credit card payment GestPay.
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

class GestPayCryptWS {

    private $context;
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
    private $separator;
    private $min;
    private $cvv;
    private $country;
    private $vbv;
    private $vbvRisp;
    private $threeDLevel;
    private $testEnv;

    public function __construct() {
        $this->shopLogin = "";
        $this->currency = "";
        $this->amount = "";
        $this->shopTransactionId = "";

        $this->testEnv = false;
        $this->domainName = "ecomm.sella.it";
        $this->testDomainName = "testecomm.sella.it";
        $this->paymentUrl = "/pagam/pagam.aspx";
        $this->separator = "*P1*";

        $this->setContext();
    }

    public function setTestEnv($enable) {
        $this->testEnv = $enable;
        return $this;
    }

    public function getTestEnv() {
        return $this->testEnv;
    }

    public function setShopLogin($val) {
        $this->shopLogin = $val;
        return $this;
    }

    public function getShopLogin() {
        return $this->shopLogin;
    }

    public function setCurrency($val) {
        $this->currency = $val;
        return $this;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setAmount($val) {
        $this->amount = $val;
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setShopTransactionID($val) {
        $this->shopTransactionId = urlencode(trim($val));
        return $this;
    }

    public function getShopTransactionID() {
        return urldecode($this->shopTransactionId);
    }

    public function setCardNumber($val) {
        $this->cardNumber = $val;
        return $this;
    }

    public function getCardNumber() {
        return $this->cardNumber;
    }

    public function setExpMonth($val) {
        $this->expMonth = $val;
        return $this;
    }

    public function getExpMonth() {
        return $this->expMonth;
    }

    public function setExpYear($val) {
        $this->expYear = $val;
        return $this;
    }

    public function getExpYear() {
        return $this->expYear;
    }

    public function setMin($val) {
        $this->min = $val;
        return $this;
    }

    public function getMin() {
        return $this->min;
    }

    public function setCvv($val) {
        $this->cvv = $val;
        return $this;
    }

    public function getCvv() {
        return $this->cvv;
    }

    public function setBuyerName($val) {
        $this->buyerName = urlencode(trim($val));
        return $this;
    }

    public function getBuyerName() {
        return urldecode($this->buyerName);
    }

    public function setBuyerEmail($val) {
        $this->buyerEmail = trim($val);
        return $this;
    }

    public function getBuyerEmail() {
        return $this->buyerEmail;
    }

    public function setLanguage($val) {
        $this->language = trim($val);
        return $this;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setCustomInfo($val) {
        $this->customInfo = urlencode(trim($val));
        return $this;
    }

    public function getCustomInfo() {
        return urldecode($this->customInfo);
    }

    /**
     * @param array $arrval
     * @return GestPayCrypt|bool
     */
    public function setCustomInfoFromArray(array $arrval) {
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

    public function getCustomInfoToArray() {
        $allinfo = explode($this->separator, $this->customInfo);
        $customInfoArray = array();
        foreach ($allinfo as $singleInfo) {
            $tagval = explode("=", $singleInfo);
            $customInfoArray[$tagval[0]] = urldecode($tagval[1]);
        }

        return $customInfoArray;
    }

    public function setEncryptedString($val) {
        $this->encryptedString = $val;
        return $this;
    }

    public function getEncryptedString() {
        return $this->encryptedString;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setVbv($vbv) {
        $this->vbv = $vbv;
        return $this;
    }

    public function getVbv() {
        return $this->vbv;
    }

    public function setVbvRisp($vbvRisp) {
        $this->vbvRisp = $vbvRisp;
        return $this;
    }

    public function getVbvRisp() {
        return $this->vbvRisp;
    }

    public function set3dLevel($val) {
        $this->threeDLevel = $val;
        return $this;
    }

    public function get3dLevel() {
        return $this->threeDLevel;
    }

    public function setAuthorizationCode($val) {
        $this->authorizationCode = $val;
        return $this;
    }

    public function getAuthorizationCode() {
        return $this->authorizationCode;
    }

    /**
     * @param string $errorCode
     * @param string $errorDescription
     * @return GestPayCrypt
     */
    protected function setError($errorCode, $errorDescription) {
        $this->errorCode = $errorCode;
        $this->errorDescription = $errorDescription;
        return $this;
    }

    public function getErrorCode() {
        return $this->errorCode;
    }

    public function getErrorDescription() {
        return $this->errorDescription;
    }

    public function setBankTransactionID($val) {
        $this->bankTransactionId = urlencode(trim($val));
        return $this;
    }

    public function getBankTransactionID() {
        return $this->bankTransactionId;
    }

    public function setTransactionResult($val) {
        $this->transactionResult = $val;
        return $this;
    }

    public function getTransactionResult() {
        return $this->transactionResult;
    }

    public function setAlertCode($alertCode) {
        $this->alertCode = $alertCode;
        return $this;
    }

    public function getAlertCode() {
        return $this->alertCode;
    }

    public function setAlertDescription($alertDescription) {
        $this->alertDescription = $alertDescription;
        return true;
    }

    public function getAlertDescription() {
        return $this->alertDescription;
    }

    public function setTransport($type) {
        $this->transport = $type;
        return $this;
    }

    public function getTransport() {
        return $this->transport;
    }

    public function getDomainName() {
        if ($this->testEnv === true) {
            return $this->testDomainName;
        }
        return $this->domainName;
    }

    public function getPaymentUrl() {
        return $this->paymentUrl;
    }

    public function setPaymentUrl($url) {
        $this->paymentUrl = $url;
        return $this;
    }

    public function setSeparator($separator) {
        $this->separator = $separator;
        return $this;
    }

    public function getSeparator() {
        return $this->separator;
    }

    public function setDecrypted($decrypted) {
        $this->decrypted = $decrypted;
        return $this;
    }

    public function getDecrypted() {
        return $this->decrypted;
    }

    /**
     * @param string $ciphers allowed chipers
     * @return \GestPayCrypt
     */
    public function setContext($ciphers = 'DHE-RSA-AES256-SHA:DHE-DSS-AES256-SHA:AES256-SHA:KRB5-DES-CBC3-MD5:KRB5-DES-CBC3-SHA:EDH-RSA-DES-CBC3-SHA:EDH-DSS-DES-CBC3-SHA:DES-CBC3-SHA:DES-CBC3-MD5:DHE-RSA-AES128-SHA:DHE-DSS-AES128-SHA:AES128-SHA:RC2-CBC-MD5:KRB5-RC4-MD5:KRB5-RC4-SHA:RC4-SHA:RC4-MD5:RC4-MD5:KRB5-DES-CBC-MD5:KRB5-DES-CBC-SHA:EDH-RSA-DES-CBC-SHA:EDH-DSS-DES-CBC-SHA:DES-CBC-SHA:DES-CBC-MD5:EXP-KRB5-RC2-CBC-MD5:EXP-KRB5-DES-CBC-MD5:EXP-KRB5-RC2-CBC-SHA:EXP-KRB5-DES-CBC-SHA:EXP-EDH-RSA-DES-CBC-SHA:EXP-EDH-DSS-DES-CBC-SHA:EXP-DES-CBC-SHA:EXP-RC2-CBC-MD5:EXP-RC2-CBC-MD5:EXP-KRB5-RC4-MD5:EXP-KRB5-RC4-SHA:EXP-RC4-MD5:EXP-RC4-MD5') {
        $this->context = stream_context_create(
                        [
                                'ssl' => [
                                        'ciphers' => $ciphers
                                ],
                        ]
        );

        return $this;
    }

    /**
     * @return A stream context resource.
     */
    public function getContext() {
        return $this->context;
    }

    /**
     *
     * @return string
     */
    public function getRedirectUrl() {
        return 'https://' . $this->getDomainName() . $this->getPaymentUrl() .
                        '?a=' . $this->getShopLogin() .
                        '&b=' . $this->getEncryptedString();
    }

    /**
     * Genera la URL del WSDL
     * @return string
     */
    private function getWsdl() {
        return 'https://' . $this->getDomainName() .
                        '/gestpay/gestpayws/WSCryptDecrypt.asmx?WSDL';
    }

    /**
     * Genera l'array dei parametri per l'encrypt
     * @return array
     */
    private function getEncParams() {
        // Parametri obbligatori
        $params = array(
                'shopLogin' => $this->shopLogin,
                'uicCode' => $this->currency,
                'amount' => $this->amount,
                'shopTransactionId' => $this->shopTransactionId,
        );

        $params = array_merge($params, $this->getOptParams());
        return $params;
    }

    /**
     * Genera l'array dei parametri per il decrypt
     * @return array
     */
    private function getDecParams() {
        // Parametri obbligatori
        $params = array(
                'shopLogin' => $this->shopLogin,
                'CryptedString' => $this->encryptedString,
        );

        $params = array_merge($params, $this->getOptParams());
        return $params;
    }

    /**
     * Parametri opzionali
     * @todo Gestire parametri opzionali
     * @return array
     */
    private function getOptParams() {
        $params = array();

        // Parametri opzionali
        if (isset($this->buyerName)) {
            $params['buyerName'] = $this->buyerName;
        }
        if (isset($this->buyerEmail)) {
            $params['buyerEmail'] = $this->buyerEmail;
        }

        return $params;
    }

    /**
     * @return bool
     */
    public function encrypt() {
        $retVal = FALSE;
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

        // Creo il SoapClient
        $client = new SoapClient($this->getWsdl(), array('stream_context' => $this->context));
        // Chiamo la funzione
        $objectresult = $client->__soapCall("Encrypt", array($this->getEncParams()));

        // Leggo l'output
        $res = new SimpleXMLElement($objectresult->EncryptResult->any);

        if ($res !== FALSE) {
            // Parso i contenuti della risposta
            $TransactionType = (string) $res->TransactionType;
            $TransactionResult = (string) $res->TransactionResult;
            $EncryptedString = (string) $res->CryptDecryptString;
            $ErrorCode = (string) $res->ErrorCode;
            $ErrorDescription = (string) $res->ErrorDescription;

            // Gestione degli errori
            $this->setError($ErrorCode, $ErrorDescription);
            $this->setTransactionResult($TransactionResult);

            if ($ErrorCode == 0) {
                // Imposto la stringa criptata
                $this->setEncryptedString($EncryptedString);
                $retVal = TRUE;
            }
        }

        return $retVal;
    }

    /**
     * @return bool
     */
    public function decrypt() {
        $retVal = FALSE;
        $this->setError('0', '');

        if (empty($this->shopLogin)) {
            $this->setError('546', 'IDshop not valid');
            return false;
        }

        if (empty($this->encryptedString)) {
            $this->setError('1009', 'String to Decrypt not valid');
            return false;
        }

        // Creo il SoapClient
        $client = new SoapClient($this->getWsdl(), array('stream_context' => $this->context));
        // Chiamo la funzione
        $objectresult = $client->__soapCall("Decrypt", array($this->getDecParams()));

        // Leggo l'output
        $res = new SimpleXMLElement($objectresult->DecryptResult->any);

        if ($res !== FALSE) {
            // Parso i contenuti della risposta
            $TransactionType = (string) $res->TransactionType;
            $TransactionResult = (string) $res->TransactionResult;
            $ErrorCode = (string) $res->ErrorCode;
            $ErrorDescription = (string) $res->ErrorDescription;

            // Gestione degli errori
            $this->setError($ErrorCode, $ErrorDescription);
            $this->setTransactionResult($TransactionResult);

            if ($ErrorCode == 0) {
                // Decrypted
                $this->setShopTransactionID((string) $res->ShopTransactionID);
                $this->setBankTransactionID((string) $res->BankTransactionID);
                $this->setAuthorizationCode((string) $res->AuthorizationCode);
                $this->setCurrency((int) $res->Currency);
                $this->setAmount((float) $res->Amount);
                $this->setCustomInfo((string) $res->CustomInfo);
                $this->setDecrypted((string) $res->CryptDecryptString);
                $retVal = TRUE;
            }
        }

        return $retVal;
    }

}
