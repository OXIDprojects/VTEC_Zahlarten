<?php

/**
 *
 * Version:    1.0
 * Author:     Pasquale Pari | Vendingtechnik
 * Author URL: http://www.vendingtechnik.com
 * Originallösungsansatz aus der Oxid Community (http://forum.oxid-esales.com/showthread.php?t=528&page=3)
 * License:    GNU GPL 3.0
 *             !! it is forbidden to resell this Software !!
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';


$aModule = array (
    'id'           => 'vtec_zahlarten',
    'title'        => 'VTEC erweiterte Zahlarten',                                       
    'description'  => 'Die Zahlarten k&ouml;nnen mittels dem Bonit&auml;tsindex genauer zugeordnet werden. Neu wird ein Feld in den Zahlungsarten bis Bonit&auml;tsindex hinzugef&uuml;gt. So k&ouml;nnen Zahlungsarten individuell zugeordnet werden. Wer zBsp. die Bonit&auml;t Rechnung 30 Tage hat hat in der Auswahl nicht noch alle anderen tiefern Zahlm&ouml;glichkeiten in der Auswahl.',
    'thumbnail'    => 'zahlart.jpg',
    'version'      => '1.0',
    'author'       => 'Pasquale Pari',
    'url'          => 'http://www.vendingtechnik.com <br \> http://www.getraenkekiste.ch',
    'email'        => 'pasquale.pari@vendingtechnik.com',
    'extend'       => array (
        'oxpaymentlist'     => 'vtec/zahlartenplus/vtec_paymentlist',
        ),
    
    'blocks' => array(
        array('template'     => 'payment_main.tpl',
              'block'        => 'admin_payment_main_form',         
              'file'         => '/views/blocks/vtec_boni.tpl'
              ),
        
        ),
);
