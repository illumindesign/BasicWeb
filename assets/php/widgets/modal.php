<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * modal.php - Modal Widget
 *
 * February 2018
 */
?>
<script>
    var
    scrollControl = document.createElement('style'),
    cover = document.createElement('div'),
    modal = document.createElement('div');

    // Append cover and modal
    scrollControl.setAttribute("id", "scrollControl");
    cover.setAttribute("id", "cover");
    modal.setAttribute("id", "modal");
    cover.appendChild(modal);
    document.body.appendChild(cover);
    document.head.appendChild(scrollControl);

    function disableScrolling () {
        scrollControl.appendChild(document.createTextNode('html,body {overflow:hidden !important;}'));
        document.getElementById('scrollUp').style.display = 'none';
    }

    function enableScrolling () {
        scrollControl.removeChild(scrollControl.firstChild);
        document.getElementById('scrollUp').style.display = null;
    }

    function openModal ()
    {
        var scrollY;
        if (!document.documentElement.scrollTop) scrollY = document.body.scrollTop;
        else scrollY = document.documentElement.scrollTop;
        scrollY = Math.round(scrollY);

        cover.removeAttribute("style");
        cover.style.display = 'inline-block';
        cover.style.position = 'absolute';
        cover.style.top = scrollY+'px';
        cover.setAttribute("class", "wow fadeIn animated");
        <?php
        if ($ui['wow']) {
            echo '
            modal.setAttribute("class", "modal wow bounceIn clearfix");
            ';
        }
        ?>
        setTimeout(function () {
            disableScrolling();
            modal.style.display = 'inline-block';
        }, 250);
    }

    function closeModal ()
    {

        <?php
        if ($ui['wow']) {
            echo '
            modal.setAttribute("style", "display: inline-block");
            modal.setAttribute("class", "modal wow bounceOut clearfix");
            cover.setAttribute("class", "wow fadeOut animated");
            ';
        } else {
            echo '
            modal.removeAttribute("style");
            modal.innerHTML = "";
            ';
        }
        ?>

        setTimeout (function () {

            <?php
            if ($ui['wow']) {
                echo '
                modal.removeAttribute("style");
                modal.innerHTML = "";
                setTimeout(function () {
                    cover.removeAttribute("style");
                    cover.removeAttribute("class");
                }, 500);
                ';
            } else {
                echo '
                cover.removeAttribute("style");
                ';
            }
            ?>

            enableScrolling();

        }, 500);
    }
</script>
<style>
    #cover {
        background: rgba(0,0,0,0.5);
        display: none;
        position: absolute;
        top: 0; left: 0;
        height:200%;
        width: 100%;
        padding-top:10%;
        text-align: center;
        z-index: 2147483647;
    }
    #modal {
        background: #eaeaea;
        border-radius:15px;
        display: none;
        margin:auto;
        width: 600px;
        min-height: 250px;
        padding:25px;
    }
    @media only screen and (max-width: 767px) {
        #modal {
            background: #eaeaea;
            border-radius:15px;
            display: none;
            margin:auto;
            width: 95%;
            min-height: 250px;
            padding:25px;
        }
    }
    @media only screen and (max-height: 420px) {
        #cover {
            background: rgba(0,0,0,0.5);
            display: none;
            position: absolute;
            top: 0; left: 0;
            height:200%;
            width: 100%;
            padding-top:3%;
            text-align: center;
            z-index: 2147483647;
        }
        #modal {
            background: #eaeaea;
            border-radius:15px;
            display: none;
            margin:auto;
            width: 95%;
            min-height: 150px;
            padding:25px;
        }
    }
    .modal
    {
        position:relative;
        background: #eaeaea;
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
    .modal:before, .modal:after
    {
        content:"";
        position:absolute;
        z-index:-1;
        -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
        -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
        box-shadow:0 0 20px rgba(0,0,0,0.8);
        top:50%;
        bottom:0;
        left:10px;
        right:10px;
        -moz-border-radius:100px / 10px;
        border-radius:100px / 10px;
    }
    .modal:after
    {
        right:10px;
        left:auto;
        -webkit-transform:skew(8deg) rotate(3deg);
        -moz-transform:skew(8deg) rotate(3deg);
        -ms-transform:skew(8deg) rotate(3deg);
        -o-transform:skew(8deg) rotate(3deg);
        transform:skew(8deg) rotate(3deg);
    }
</style>