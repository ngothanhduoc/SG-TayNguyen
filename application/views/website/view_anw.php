<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Tư Vấn - Hỏi Đáp</h2></div>
        <a href="/tu-van-hoi-dap/dat-cau-hoi.html"><h4>Đặt Câu Hỏi</h4></a><br/>
        <div class="description-introduction">
            <ul>
                <?php foreach ($anwser as $key => $value) {
                    echo '<a href="/tu-van-hoi-dap/'.$value['id_anwser'].'-'.utf8_to_ascii($value['title']).'.html">';
                    echo '<li><img  src="/public/assets/images/news/images/findAnswers.png" width="80px" height="80px"/><span><h4>'.$value['title'].'</h4></span> <span style="font-size: 12px; color: #0591e5">'.$value['create_time'].'</span> </li>';
                    echo "</a>";
                } ?>
                
            </ul>
            
        </div>
    </div>
</div>