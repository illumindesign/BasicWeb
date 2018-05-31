<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * layout.php - Layout Processor
 *
 * February 2018
 */
if (!defined('aI')) { header('Location: /', true, 301); exit; }

require_once(ga_proc.'ux.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <!--base href="<?=aBase?>"-->
    <title><?=aTitle?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=aDescription?>">
    <meta name="keywords" content="<?=aKeywords?>">
    <?php foreach($metaHead as $tag) echo $tag."\r\n    "; ?>

    <!-- CSS -->
    <?php foreach($cssHead as $tag) echo $tag."\r\n    "; ?>

    <!-- Javascript -->
    <?php foreach($jsHead as $tag) echo $tag."\r\n    "; ?>

    <!-- Mobile -->
    <?php foreach($mobileHead as $tag) echo $tag."\r\n    "; ?>

    <!-- Icon -->
    <link rel="icon" href="<?=ga_ico?>favicon.png">

</head>
<body>
<?php
# DECIDE WHICH PAGE TO LOAD =====================
if ($_page[0] == '') $page = 'default';
elseif (file_exists(ga_pages.$_page[0].'.php')) $page = $_page[0];
else $page = '404';

# LOAD THE PAGE =================================
    echo "\r\n";
    require_once(ga_layout.'header.php');
    echo "\r\n";
require_once(ga_pages.$page.'.php');
    echo "\r\n";
    require_once(ga_layout.'footer.php');
    echo "\r\n";
?>

<!-- Display Error Messages -->
<?=show_error()?>

<!-- Footer Scripts -->
<?php foreach($jsFoot as $tag) echo $tag."\r\n"; ?>

<!-- Event Functions -->
<script>

    var lDebug = true;

    <?=($ui['wow'])?'var wow = new WOW();':''?>


    /* https://developer.mozilla.org/en-US/docs/Web/Events/load */
    window.addEventListener("load", function() {
        if (lDebug == true) console.log("window.load");
    });

    /* https://developer.mozilla.org/en-US/docs/Web/Events/DOMContentLoaded */
    window.addEventListener('DOMContentLoaded', function() {
        if (lDebug == true) console.log('DOMContentLoaded');
    });

    /* https://developer.mozilla.org/en-US/docs/Web/Events/beforeunload */
    window.addEventListener("beforeunload", function (e) {
        if (lDebug == true) console.log('window.beforeunload');
        /*var confirmationMessage = "\o/";
        e.returnValue = confirmationMessage;
        return confirmationMessage;*/
    });

    /* https://developer.mozilla.org/en-US/docs/Web/Events/unload */
    window.addEventListener('unload', function(event) {
        if (lDebug == true) console.log('window.unload');
    });

    /* https://developer.mozilla.org/en-US/docs/Web/API/Document/readyState */
    /* https://developer.mozilla.org/en-US/docs/Web/Events/readystatechange */
    document.onreadystatechange = function () {
        var rs = document.readyState;
        if (lDebug == true) console.log('readyState='+rs);
        if (rs == 'interactive') {

            <?=($ui['wow'])?'wow.init();':''?>

        }
    };
</script>

</body>
</html>