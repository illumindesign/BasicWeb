<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * header.php - Global Layout Header Elements
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

# Conditional <body> Headers =====-----------------------------------------------------------------
if ($uPath[0] == 'something')
{
?>
    <!-- ||| -->
<?php
}

# Global <body> Headers =====----------------------------------------------------------------------
?>

<!-- header -->
<header id="header">

</header>
<!-- /header -->
