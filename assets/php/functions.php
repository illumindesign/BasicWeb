<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * functions.php - Global Functions
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

function anti ($data, $method=1)
{
    if ($method==1) $data = preg_replace("/[^ \w]/", "", $data);
    elseif ($method==2) $data = preg_replace("/\W.*(\w+)\W.*$/", "$1", $data);
    elseif ($method==3) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function debug ($passed='')
{
    $pType = gettype($passed);
    echo '<pre>';

        echo "PASSED (".$pType.") = ";
        if ($pType == 'array') print_r($passed);
        elseif ($pType == 'object') var_dump(get_object_vars($passed));
        else echo $passed."\r\n";
        echo "\r\n";

        echo "POST = ";
        print_r($_POST);
        echo "\r\n";

        echo "SESSION = ";
        print_r($_SESSION);
        echo "\r\n";

        echo "SERVER = ";
        print_r($_SERVER);
        echo "\r\n";

    echo '</pre>';
    exit;
}

function is_url ($pages)
{
    $pType = gettype($pages);
    if ($pType == 'array') {
        //print_r($pages, true);
    } elseif ($pType == 'string') {
        //if ()
    }
    return false;
}

function password_encode ($P)
{
    $P = crypt($P, '$5$rounds=5000$vwbus$');
    $P = explode('$', $P);
    return $P[4];
}

function set_error ($emsg)
{
    $_SESSION['error_message'] = $emsg;
}

function show_error ()
{
    if (isset($_SESSION['error_message'])) {
        echo '<div id="error-message"><span style="color:#a55;">Error:</span> ' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    } else echo '<!-- No Error Messages -->';
}

function truncate ($string, $maxlen)
{
    if (strlen($string) > $maxlen):
        $tmpstr = $string;
        $string = $tmpstr{0};
        for ($i = 1; $i <= $maxlen-3; $i++):
            $string .= $tmpstr{$i};
        endfor;
        $string .= "...";
        return $string;
    else:
        return $string;
    endif;
}

function verify_origin ()
{
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
        preg_match("/:\/\/(.*?)\//i", $_SERVER['HTTP_REFERER'], $origin);
        if ($origin[1] != aBase) die('Could not verify origin');
    }
}