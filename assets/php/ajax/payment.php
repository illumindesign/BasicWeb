<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * order.php - AJAX Processor for placing orders
 *
 * February 2018
 */
require_once('../global.php');

if (isset($_POST['d']))
{
    $payment = array();
    $data = json_decode($_POST['d']);

    $payment['order']  = $data[0];
    $payment['amount'] = $data[1];
    unset($data);

    /*
    DO MERCHNT STUFF HERE...
    */

    //IF payment == success THEN
        $new_payment = $pdo_connection->prepare("INSERT INTO `payments` (
            `id`,
            `user`,
            `order`,
            `amount`,
            `date`
        ) VALUES (
            NULL,
            :userid,
            :orderid,
            :amount,
            UNIX_TIMESTAMP()
        );");

        $new_payment->execute(array(
            ':userid'  => $_user['id'],
            ':orderid' => $payment['order'],
            ':amount'  => $payment['amount']
        ));

        $payment['i'] = $pdo_connection->lastInsertId();

        echo json_encode($payment);
    //ELSE
        #echo '0';
    //ENDIF;
}