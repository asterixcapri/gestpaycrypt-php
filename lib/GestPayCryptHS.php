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

class GestPayCryptHS extends GestPayCrypt
{
    private $curl_bin;

	public function __construct()
	{
        parent::__construct();

        $this->curl_bin = "/usr/bin/curl";

        $this->SetTransport("ssl");
        $this->SetDomainName("ecomm.sella.it");
        $this->SetPort("443");
        $this->SetScriptEnCrypt("/CryptHTTPS/Encrypt.asp");
        $this->SetScriptDeCrypt("/CryptHTTPS/Decrypt.asp");
	}

	protected function _http_get_response($type, $a, $b)
	{
		if (extension_loaded("openssl")) {
			return parent::_http_get_response($type, $a, $b);
		}
		elseif (extension_loaded("curl")) {
            $uri = $this->GetScriptType($type)."?a=".$a."&b=".$b;

			$curl = curl_init("https://".$this->GetDomainName().$uri);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$tmp = curl_exec($curl);
			curl_close($curl);

			$lines = explode("\n", $tmp);

			return $lines[0];
		}
		else {
            $uri = $this->GetScriptType($type)."?a=".$a."&b=".$b;

			$exec_str = $this->curl_bin." -s -m 120 -L ".
			            escapeshellarg("https://".$this->GetDomainName().$uri);

			exec($exec_str, $ret_arr, $ret_num);

			if ($ret_num != 0) {
				$this->ErrorCode = "9999";
				$this->ErrorDescription = "Error while executing: ".$exec_str;

				return -1;
			}

			if (!is_array($ret_arr)) {
				$this->ErrorCode = "9999";
				$this->ErrorDescription = "Error while executing: ".$exec_str." - "."\$ret_arr is not an array";

				return -1;
			}

			return $ret_arr[0];
		}
	}
}

?>