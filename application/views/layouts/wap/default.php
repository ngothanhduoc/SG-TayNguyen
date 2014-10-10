<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <title></title>

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <link rel="stylesheet" type="text/css" href="/public/frontend/assets/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/public/frontend/assets/wap/css/style_wap.css" />
        <link rel="stylesheet" type="text/css" href="/public/frontend/assets/wap/css/photoswipe.css" />
        <link rel="stylesheet" type="text/css" href="/public/frontend/assets/wap/css/responsiveslides.css" />
        <link rel="stylesheet" type="text/css" href="/public/frontend/assets/wap/js/demo.css" />
        
        <!--<script src="/public/frontend/assets/js/sliderengine/jquery.js"></script>-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
        <script src="/public/frontend/assets/js/sushi_jquery.js"></script>
        <script src="/public/frontend/assets/wap/js/responsiveslides.min.js"></script>
       

        <!--- slide------------------->
        <!-- Important Owl stylesheet -->


    </head>

    <script type="text/javascript">
            $(function () {
                $(".button-menu").click(function () {
                    $(".main-navi").slideToggle();
                    $id = $(this).attr("id");
                    if ($id == 'fadeout') {
                        $(this).attr("id", "fadein");
                        $(this).addClass("close_menu");
                    } else {
                        $(this).attr("id", "fadeout");
                        $(this).removeClass("close_menu");
                    }
                });
                $(".main-navi li").click(function () {
                    $(".main-navi").slideToggle();
                    $(".button-menu").attr("id", "fadeout").removeClass("close_menu");
                })
            });
    </script>
    <div class="wapper" id="wapper" style="position: relative">
        <div class="container" id="container">
            <div class="main-contant">
                <div class="header">
                    <div class="menu">
                        <div class="logo">
                            <a href="<?php echo base_url() ?>"> <img src="/public/frontend/assets/images/logo_top.png" width="250px" /></a>
                        </div>
                        <div class="navi">
                            <div class="button-menu" id="fadeout"></div>
                            <div class="main-navi">
                                <ul>
                                    <li class="navi-menu active" id="home">Home</li>
                                    <li class="navi-menu" id="about">Gallery</li>
                                    <li class="navi-menu" id="menu">Menu</li>
                                    <li class="navi-menu" id="reservations">Reservations</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="content">
                    <div class="main">

                        <div class="main-ajax">

                        </div>




                    </div>
                </div>

                <div class="footer">

                </div>

            </div>

            <div class="clear-box"></div>

            <div class="footer">
                <div class="main-ft">
                    <div class="header-ft">
                        <?php
                        echo $home['fulltext'];
                        ?>
                    </div>
                    <div class="company-info">
                        <a href="https://www.facebook.com/rasasayangdubai" target="_blank"><img src="/public/frontend/assets/images/facebook-3-512.png" width="50px" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>