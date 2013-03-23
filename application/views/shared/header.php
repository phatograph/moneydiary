<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


        <?php
        //echo link_tag('css/style.css');
        //echo link_tag('css/grid.css');
        ?>

        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <!--
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
        -->
        <script type="text/javascript" src="<?php echo base_url(); ?>script/shared/jquery/jQuery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>script/shared/jquery/jquery.mobile-1.0a1.min.js"></script>

        <title>Money Diary</title>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-15209814-3']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body>