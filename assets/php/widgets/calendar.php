<?php
/** BasicWeb - A procedural framework for basic websites
 * Bobby @ IlluminDesign made this
 *
 * calendar.php - Calendar Widget
 *
 * February 2018
 */
$cellwidth = 20;
$cellheight = 15;
$this_day = date("j", time());
$this_month_numeric = date("n", time());
$this_month = date("F", time());
$this_year = date("Y", time());
$y = $this_year;
?>

<style>
    .dayDisabled {
        color:#aeaeae;
        text-align: center;
    }
    .dayWeekend {
        color:#e99;
        text-align: center;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#a90329+0,8f0222+44,6d0019+100&0.05+0,0.05+100 */
        background: -moz-radial-gradient(center, ellipse cover, rgba(169,3,41,0.05) 0%, rgba(143,2,34,0.05) 44%, rgba(109,0,25,0.05) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover, rgba(169,3,41,0.05) 0%,rgba(143,2,34,0.05) 44%,rgba(109,0,25,0.05) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center, rgba(169,3,41,0.05) 0%,rgba(143,2,34,0.05) 44%,rgba(109,0,25,0.05) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0da90329', endColorstr='#0d6d0019',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }
    .dayAvailable {
        background:#fff;
        color:#000000;
        cursor:pointer;
        /*font-size:0.75em;*/
        text-align: center;
    }
    .dayAvailable:hover {
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+100&0+0,0.1+100 */
        background: -moz-radial-gradient(center, ellipse cover, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover, rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center, rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#1a000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        /*font-size: 1em;*/
    }
    .daySelected {
        /*background: #3d95d3;*/
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#3d95d3+0,84b7e8+100 */
        background: #3d95d3; /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #3d95d3 0%, #84b7e8 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover, #3d95d3 0%,#84b7e8 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center, #3d95d3 0%,#84b7e8 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3d95d3', endColorstr='#84b7e8',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        color: #ffffff;
        font-weight: bold;
        /*font-size:1em;*/
        cursor: pointer;
        text-align: center;
    }
    .dayToday {
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,3d95d3+90,3d95d3+100&1+0,0.05+100 */
        background: -moz-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(61,149,211,0.14) 90%, rgba(61,149,211,0.05) 100%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%,rgba(61,149,211,0.14) 90%,rgba(61,149,211,0.05) 100%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center, rgba(255,255,255,1) 0%,rgba(61,149,211,0.14) 90%,rgba(61,149,211,0.05) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#0d3d95d3',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        color: #3d95d3;
        cursor: pointer;
        font-weight: bold;
        font-size:1em;
        text-align: center;
    }
    .monthTitle {
        color:#3d95d3;
        font-size:0.75em;
        font-weight:bold;
        font-family: Arial, Helvetica, sans-serif;
    }
    .calPage
    {
        position:relative;
        -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        padding: 0;
        margin: 0;
    }
    .calPage:before, .calPage:after
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
    .calPage:after
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

<script>
var selectedDay;

function reset_date ()
{
    if (lDebug == true) console.log('reset_date ()');
    if (selectedDay != null) document.getElementById('day'+selectedDay).setAttribute("class", "dayAvailable");
    selectedDay = null;
}

function show_month (month)
{
    if (lDebug == true) console.log('show_month ('+month+')');

    for (m=<?=$this_month_numeric?>; m<=12; m++) {
        document.getElementById('month'+m).style.display = 'none';
    }
    document.getElementById('month'+month).style.display = '';

}

function set_date (format, month, day, totaldays)
{
    if (lDebug == true) console.log('set_date ('+format+', '+month+', '+day+', '+totaldays+')');
    reset_date();
    document.getElementById('day'+month+day).setAttribute("class", "daySelected");
    selectedDay = ''+month+day+''; // force JS to concat instead of add
    order.setDate(format, month, day);
}
</script>

<?php
for ($m=$this_month_numeric; $m<=12; $m++)
{
    $first_day = date("w", strtotime($m."/1/".$y));
    $total_days = date("t", strtotime($m."/1/".$y));
    $the_month = date("F", strtotime($m."/1/".$y));
    $the_month_numeric = date("n", strtotime($m."/1/".$y));
    $the_year = date("Y", strtotime($m."/1/".$y));

    $the_day = '';
    $week_num = 1;
    $day_num = 1;

    if ($the_month == $this_month) {
        $arrow_left = '&laquo;';
        ?>
<!-- <?=$the_month?> -->
<div id="month<?=$m?>"><?php
    } else {
        $arrow_left = '<a href="javascript: show_month('.($m-1).');">&laquo;</a>';
        ?>
<!-- <?=$the_month?> -->
<div id="month<?=$m?>" style="display:none;"><?php
    }

    if ($m == 12) $arrow_right = '&raquo;';
    else $arrow_right = '<a href="javascript: show_month('.($m+1).');">&raquo;</a>';
    ?>

    <!-- Month -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" width="25"><?=$arrow_left?></td>
            <td align="center">
                <span class="monthTitle"><?=$the_month?> <?=$the_year?></span>
            </td>
            <td align="center" width="25"><?=$arrow_right?></td>
        </tr>
    </table>
    <!-- /Month -->
    <!-- Grid -->
    <div class="calPage clearfix" style="width:100%;height:200px;margin:0;padding:2px;">
        <table width="100%" height="100%" border="1" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" style="font-size:9px;font-family: Arial, Helvetica, sans-serif;">
            <tr bgcolor="#ddd">
                <td align="center">Su</td>
                <td align="center">Mo</td>
                <td align="center">Tu</td>
                <td align="center">We</td>
                <td align="center">Th</td>
                <td align="center">Fr</td>
                <td align="center">Sa</td>
            </tr><?php
        while ($week_num <= 6)
        {
            ?>

            <tr height="16%">
                <?php
            for ( $i = 0; $i <= 6; $i++ )
            {
                if ($week_num == 1)
                {
                    if ($i < $first_day) $the_day = " ";
                    elseif ($i == $first_day) $the_day = 1;
                }
                elseif ($the_day > $total_days) $the_day = " ";

                if ($the_day > 0)
                {
                    /*if ($i == 0)
                    {
                        ?><td class="dayWeekend"><?=$the_day?></td>
                        <?php
                    }
                    else*/if (($the_day == $this_day) && ($the_month == $this_month))
                    {
                ?><td class="dayToday">
                    <script>
                        //selectedDay = '<?=$the_month_numeric.$the_day?>';
                    </script>
                    <?=$the_day?>
                </td>
                <?php
                    }
                    elseif ((($the_day > $this_day) || ($the_month != $this_month))/* && ($i != 0)*/)
                    {
                ?><td class="dayAvailable" id="day<?=$the_month_numeric.$the_day?>" onclick="set_date('<?=$the_month?> <?=$the_day?>, <?=$the_year?>', <?=$the_month_numeric?>, <?=$the_day?>, <?=$total_days?>);"><?=$the_day?></td>
                <?php
                    }
                    else
                    {
                    ?><td class="dayDisabled"><?=$the_day?></td>
                <?php
                    }
                }
                else
                {
                    /*if ($i == 0)
                    {
                        ?><td class="dayWeekend">-</td>
                        <?php
                    }
                    else {
                        */?>
                        <td align="center">-</td>
                        <?php
                    /*}*/
                }
                if ($the_day != " ") $the_day++;
            }
            ?>

            </tr><?php
            $week_num++;
        }
            ?>

        </table>
        <!-- /Grid -->
    </div>
</div>
<!-- /<?=$the_month?> -->

<?php
}