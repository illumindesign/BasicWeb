<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * rfq.php - AJAX Processor to "Request for Quote"
 *
 * February 2018
 */
require_once('../global.php');

if (isset($_POST['d']))
{
    $rfq = array();
    $data = json_decode($_POST['d']);

    $rfq['address']   = $data[0];
    $rfq['frequency'] = $data[1];
    $rfq['count']     = $data[2];
    $rfq['date']      = $data[3];
    unset($data);

    $new_order = $pdo_connection->prepare("INSERT INTO  `quotes` (
        `id`,
        `user`,
        `address`,
        `frequency`,
        `count`,
        `date_for`,
        `date`
    ) VALUES (
        NULL ,
        :userid,
        :address,
        :frequency,
        :count,
        :date,
        UNIX_TIMESTAMP()
    );");

    $new_order->execute(array(
        ':userid'    => $_SESSION[sPre . '_user']['id'],
        ':address'   => $rfq['address'],
        ':frequency' => $rfq['frequency'],
        ':count'     => $rfq['count'],
        ':date'      => $rfq['date']
    ));

    $rfq['i'] = $pdo_connection->lastInsertId();

    echo json_encode($rfq);
}