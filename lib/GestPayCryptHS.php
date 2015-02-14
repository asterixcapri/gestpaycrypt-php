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

class GestPayCryptHS extends GestPayCrypt
{
    private $curlBin;

    public function __construct()
    {
        parent::__construct();

        $this->curlBin = "/usr/bin/curl";

        $this->setTransport("ssl");
        $this->setDomainName("ecomm.sella.it");
        $this->setPort("443");
        $this->setScriptEncrypt("/CryptHTTPS/Encrypt.asp");
        $this->setScriptDecrypt("/CryptHTTPS/Decrypt.asp");
    }

    /**
     * @return string
     */
    public function getCurlBin()
    {
        return $this->curlBin;
    }

    /**
     * @param string $curlBin
     *
     * @return GestPayCryptHS
     */
    public function setCurlBin($curlBin)
    {
        $this->curlBin = $curlBin;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function _httpGetResponse($type, $a, $b)
    {
        if (extension_loaded("openssl")) {
            return parent::_httpGetResponse($type, $a, $b);
        } elseif (extension_loaded("curl")) {
            $uri = $this->getScriptType($type) . "?a=" . $a . "&b=" . $b;

            $curl = curl_init("https://" . $this->getDomainName() . $uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $tmp = curl_exec($curl);
            curl_close($curl);

            $lines = explode("\n", $tmp);

            return $lines[0];
        } else {
            $uri = $this->getScriptType($type) . "?a=" . $a . "&b=" . $b;

            $exec_str = $this->getCurlBin() . " -s -m 120 -L " .
                        escapeshellarg("https://" . $this->getDomainName() . $uri);

            exec($exec_str, $ret_arr, $ret_num);

            if ($ret_num != 0) {
                $this->setError('9999', 'Error while executing: ' . $exec_str);
                return -1;
            }

            if (!is_array($ret_arr)) {
                $this->setError('9999', 'Error while executing: ' . $exec_str. ' - $ret_arr is not an array');
                return -1;
            }

            return $ret_arr[0];
        }
    }
}
