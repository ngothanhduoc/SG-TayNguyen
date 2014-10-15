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

        <link rel="stylesheet" href="/public/assets/css/reset.css" rel="stylesheet">
        <link rel="stylesheet" href="/public/assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="/public/assets/css/half-slider.css" type="text/css"/>
        <link rel="stylesheet" href="/public/assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="/public/assets/css/jquery.simplyscroll.css" rel="stylesheet">


    </head>
    <body>

        <div class="header">
            <div class="header-main">
                <div class="logo"><img class="animated slideInLeft" src="/public/assets/images/logo.png" /></div>
                <div class="animated slideInDown slogan">Công Ty TNHH SÀI GÒN - TÂY NGUYÊN</div>
            </div>
        </div>
        <!-- Half Page Image Background Carousel Header -->
        <?php echo $slide_home ?>

        <div class="container-fluid">

            <!--left-->
            <div class="col-sm-3">

                <div class="panel panel-default">
                    <a href="/trang-chu.html"><div class="panel-heading menu active">Trang Chủ</div></a>
                    <a href="/gioi-thieu.html"><div class="panel-heading menu">Giới Thiệu</div></a>
                    <a href="/san-pham.html"><div class="panel-heading menu">Sản Phẩm</div></a>
                    <a href="/tin-tuc-su-kien.html"><div class="panel-heading menu">Tin Tức - Sự Kiện</div></a>
                    <a href="/tu-van-hoi-dap.html"><div class="panel-heading menu">Tư Vấn - Hỏi Đáp</div></a>

                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Hổ trợ trực tuyến</div>
                    <div class="panel-body">
                        <div class="yahoo" >
                            <?php foreach ($contact as $key => $value) {
                               echo "<img src='http://opi.yahoo.com/online?u=".$value['nick']."&m=g&t=2'/><br/>" ;
                            }?>
                            
                            
                        </div>

                    </div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Hình ảnh công ty</div>
                    <div class="panel-body scroller-left">
                        <ul id="scroller-left">
                            <?php foreach ($company as $key => $value) {
                                echo '<li><img src="'.$value['image'].'" width="290" height="200" alt="'.$value['name'].'"></li>';
                            }?>
                            
                        </ul>
                    </div>
                </div>

            </div><!--/left-->

            <!--center-->
            <div class="col-sm-6">

                <?php echo $content ?>

            </div><!--/center-->

            <!--right-->
            <div class="col-sm-3">

                <div class="panel panel-default">
                    <div class="panel-heading">Tin tức - sự kiện</div>
                    <div class="panel-body">
                        <ul class="news">
                            <?php foreach ($news as $key => $value) {
                                echo '<a href="/tin-tuc-su-kien/'.$value['id_news'].'-'.utf8_to_ascii($value['name']).'.html"><li>'.$value['name'].'</li></a>';
                            }?>
                            
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Đối tác</div>
                    <div class="panel-body">
                        <div class="panel-body scroller-right">
                            <ul id="scroller-right">
                               <?php foreach ($partner as $key => $value) {
                                echo '<li><img src="'.$value['image'].'" width="290" height="200" alt="'.$value['name'].'"></li>';
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>


            </div><!--/right-->
            <hr>
        </div><!--/container-fluid-->
        <!-- Footer -->
        <footer>
            <div class="footer-main">
                <div class="footer-navi">
                    <ul>
                        <a href="/trang-chu.html"><li>Trang Chủ</li></a>
                        <a href="/gioi-thieu.html"><li >Giới Thiệu</li></a>
                        <a href="/san-pham.html"><li >Sản Phẩm</li></a>
                        <a href="/tin-tuc-su-kien.html"><li >Tin Tức - Sự Kiện</li></a>
                        <a href="/tu-van-hoi-dap.html"><li id="last">Tư Vấn - Hỏi Đáp</li></a>
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
        <script src="/public/assets/js/jquery-1.8.3.min.js"></script>
        <script src="/public/assets/js/bootstrap.min.js"></script>
        <script src="/public/assets/js/jquery.simplyscroll.min.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            });
            $("#scroller-left").simplyScroll({orientation: 'vertical'});
            $("#scroller-right").simplyScroll({orientation: 'vertical'});
        </script>
        <script lang="text/javascript">
            $(function () {
                $(".show-more").click(function () {
                    $page = $(this).attr('id');
                    $.ajax({
                        url: "ajax_product?page=" + $page,
                        type: 'GET',
                        dataType: '',
                        data: {}
                    }).done(function (response) {
                        if (response != 'end') {
                            $(".list-product").append(response);
                            $page = parseInt($page) + 12;
                            $(".show-more").attr('id', $page);
                        } else {
                            $(".show-more").remove();
                        }

                    }).fail(function () {
                        alert('Có lỗi ! Không kết nối đến dữ liệu được.');
                    });
                });
            });
        </script>
    </body>
</html>