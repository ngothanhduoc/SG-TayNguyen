<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Portal Template</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="/assets/css/reset.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="/assets/css/half-slider.css" type="text/css"/>
        <link rel="stylesheet" href="/assets/css/styles.css" rel="stylesheet">


    </head>
    <body>

        <div class="header">
            <div class="header-main">
                <div class="logo"><img class="animated slideInLeft" src="/assets/images/logo.png" /></div>
                <div class="animated slideInDown slogan">Công Ty TNHH SÀI GÒN - TÂY NGUYÊN</div>
            </div>
        </div>
        <!-- Half Page Image Background Carousel Header -->
        <div id="myCarousel" class="carousel slide">
            <!-- Indicators -->

            <!-- Wrapper for Slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <!-- Set the first background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('/assets/images/wallpaper-1114115.jpg');"></div>
                    <div class="carousel-caption">
                        <h2>Caption 1</h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the second background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('/assets/images/wallpaper-1149323.jpg');"></div>
                    <div class="carousel-caption">
                        <h2>Caption 2</h2>
                    </div>
                </div>
                <div class="item">
                    <!-- Set the third background image using inline CSS below. -->
                    <div class="fill" style="background-image:url('/assets/images/wallpaper-1149592.jpg');"></div>
                    <div class="carousel-caption">
                        <h2>Caption 3</h2>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>

        </div>
        <div class="container-fluid">

            <!--left-->
            <div class="col-sm-3">

                <div class="panel panel-default">
                    <a href="trang-chu.html"><div class="panel-heading menu active">Trang Chủ</div></a>
                    <a href="gioi-thieu.html"><div class="panel-heading menu">Giới Thiệu</div></a>
                    <a href="san-pham.html"><div class="panel-heading menu">Sản Phẩm</div></a>
                    <a href="tin-tuc-su-kien.html"><div class="panel-heading menu">Tin Tức - Sự Kiện</div></a>
                    <a href="tu-van-hoi-dap.html"><div class="panel-heading menu">Tư Vấn - Hỏi Đáp</div></a>

                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Hổ trợ trực tuyến</div>
                    <div class="panel-body">Content here..</div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Hình ảnh công ty</div>
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                        Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
                        dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                        Aliquam in felis sit amet augue.</div>
                </div>
                
            </div><!--/left-->

            <!--center-->
            <div class="col-sm-6">
                
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Lời Giới Thiệu</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
                            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
                            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                            Aliquam in felis sit amet augue.</p>
                        
                    </div>
                </div>
                <hr>      
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Sản Phẩm Tiêu Biểu</h2>
                        <div class="list-product">
                            <?php 
                                for ($i=1; $i <= 10; $i++){
                            ?>
                            <div class="product">
                                
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
            </div><!--/center-->

            <!--right-->
            <div class="col-sm-3">

                <div class="panel panel-default">
                    <div class="panel-heading">Tin tức - sự kiện</div>
                    <div class="panel-body">Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
                        Aliquam in felis sit amet augue.</div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Đối tác</div>
                    <div class="panel-body">Content here..</div>
                </div>
                
                
            </div><!--/right-->
            <hr>
        </div><!--/container-fluid-->
        <!-- Footer -->
        <footer>
            <div class="footer-main">
                <div class="footer-navi">
                    <ul>
                        <a href="trang-chu.html"><li>Trang Chủ</li></a>
                        <a href="gioi-thieu.html"><li >Giới Thiệu</li></a>
                        <a href="san-pham.html"><li >Sản Phẩm</li></a>
                        <a href="tin-tuc-su-kien.html"><li >Tin Tức - Sự Kiện</li></a>
                        <a href="tu-van-hoi-dap.html"><li id="last">Tư Vấn - Hỏi Đáp</li></a>
                    </ul>
                </div>
                <div class="footer-info">
                    <span>Công Ty TNHH SÀI GÒN - TÂY NGUYÊN</span><br/>
                    <span>Địa Chỉ: 204/13 Nguyễn Oanh, P.17, Q.Gò Vấp, TP.HCM</span><br/>
                    <span>Tel: (08) 3895 2279 &nbsp;&nbsp; - &nbsp;&nbsp; Fax: (08) 3895 1515</span><br/>
                    <span>Mã số thuế: 0312 695 798</span><br/>
                </div>
            </div>
        </footer>
        <!-- script references -->
        <script src="/assets/js/jquery-1.8.3.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        </script>
    </body>
</html>