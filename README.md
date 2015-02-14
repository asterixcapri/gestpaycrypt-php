[![Latest Stable Version](https://poser.pugx.org/asterixcapri/gestpaycrypt/v/stable.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt) [![Total Downloads](https://poser.pugx.org/asterixcapri/gestpaycrypt/downloads.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt) [![License](https://poser.pugx.org/asterixcapri/gestpaycrypt/license.svg)](https://packagist.org/packages/asterixcapri/gestpaycrypt)

GestPayCrypt-PHP
================

GestPayCrypt-PHP è l'implementazione open source (licenza LGPL) in PHP delle
classi GestPayCrypt e GestPayCryptHS che Bancasella distribuisce in Java per
permettere l'interfacciamento al sistema di pagamento online GestPay.

Questa reimplementazione in PHP mantiene la stessa interfaccia pubblica
di quella originale, permettendo, quindi, di fare a meno di installare
l'ambiente di esecuzione java sul server web, ed evitare di configurare
il supporto java in PHP, cosa non sempre possibile, soprattutto in
situazioni di hosting.

La documentazione ufficiale di Banca Sella per il suo utilizzo è
valida anche per questa reimplementazione:

http://www.gestpay.it/gestpay/specifiche-tecniche/index.jsp


Tipo di architetture supportate dal sistema di pagamento online GestPay
-----------------------------------------------------------------------

Attenzione a non fare confusione: le architetture supportate da Banca
Sella sono 3:

- GestPay con architettura OneTimePassword
- GestPay con architettura compatibile Payment Gateway Banca Sella
- GestPay con architettura Crittografia

La classe GestPayCrypt lavora solo ed esclusivamente con GestPay con
architettura Crittografia. La prima e la seconda architettura continuano
ad utilizzare le one time password (file ric e ris) per retrocompatibilità.


Classe High Security GestPayCryptHS
-----------------------------------

Se si intende utilizzare una connessione sicura HTTPS per le comunicazioni
server to server bisogna instanziare la classe GestPayCryptHS (high security)
in tutto e per tutto uguale nell'interfaccia a GestPayCrypt.
Perchè tale classe possa funzionare correttamente è necessario soddisfare almeno
uno dei seguenti requisiti:

- Versione di PHP > 4.3.0 e supporto estensione OpenSSL
- PHP con supporto CURL
- Binario CURL disponibile alla URL: http://curl.haxx.se/


Links
-----

Banca Sella
http://www.sella.it/

Sistema di pagamento online GestPay e documentazione relativa
http://www.gestpay.it/
