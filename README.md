[![Latest Stable Version](https://poser.pugx.org/asterixcapri/gestpaycrypt/v/stable.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt) [![Total Downloads](https://poser.pugx.org/asterixcapri/gestpaycrypt/downloads.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt) [![License](https://poser.pugx.org/asterixcapri/gestpaycrypt/license.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt)

GestPayCrypt-PHP
================

Questa libreria permette di poter effettuare pagamenti online tramite il
payment gateway GestPay di Banca Sella.

Dal 1 Aprile 2015 è necessario utilizzare la nuova classe GestPayCryptWS
compatibile con le nuove specifiche di Banca Sella:

https://www.gestpay.it/gestpay/sicurezza/poodle.jsp

Le vecchie classi GestPayCrypt e GestPayCryptHS sono deprecate e vanno
sostituite con la nuova GestPayCryptWS.


Installazione
-------------

Puoi installare questa libreria utilizzando `composer`:

```
composer require asterixcapri/gestpaycrypt:~3.0
```

Links
-----

- http://www.gestpay.it/gestpay/specifiche-tecniche/index.jsp
- http://www.sella.it/
- http://www.gestpay.it/
