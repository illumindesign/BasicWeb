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
    $order = array();
    $data = json_decode($_POST['d']);

    $order['property']  = $data[0];
    $order['frequency'] = $data[1];
    $order['count']     = $data[2];
    $order['date']      = $data[3];
    unset($data);

    $new_order = $pdo_connection->prepare("INSERT INTO  `orders` (
        `id`,
        `user`,
        `property`,
        `frequency`,
        `count`,
        `date_start`,
        `date`
    ) VALUES (
        NULL ,
        :userid,
        :property,
        :frequency,
        :count,
        :startDate,
        UNIX_TIMESTAMP()
    );");

    $new_order->execute(array(
        ':userid'    => $_SESSION[sPre . '_user']['id'],
        ':property'  => $order['property'],
        ':frequency' => $order['frequency'],
        ':count'     => $order['count'],
        ':startDate' => $order['date']
    ));

    $order['i'] = $pdo_connection->lastInsertId();

    echo json_encode($order);
}