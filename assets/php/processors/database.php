<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * database.php - Database Connection Processor
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

if ($db['module'] == 'pdo')
{
    // DATABASE CONNECTION ========================================================================
    $pdo_dsn = "{$db['driver']}:host={$db['host']};dbname={$db['database']};charset={$db['charset']}";
    $pdo_opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Oh boy, here I go connecting again... ======================================================
    try{
        $pdo_connection = new PDO($pdo_dsn, $db['username'], $db['password'], $pdo_opt);
    } catch (PDOException $E) {
        die('<h1 style="text-align:center;">Cannot connect to database! Please check configuration.</h1>'.$E->getMessage());
    }
}