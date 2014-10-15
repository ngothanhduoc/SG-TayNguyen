<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Tin Tức -Sự Kiện</h2></div>
        <div class="description-introduction">
            <ul>
                <?php foreach ($data_news as $key => $value) {
                    echo '<a href="/tin-tuc-su-kien/'.$value['id_news'].'-'.utf8_to_ascii($value['name']).'.html">';
                    echo '<li><img  src="'.$value['image'].'" width="80px" height="80px"/> <span>'.$value['name'].'</span> <span>'.$value['create_time'].'</span> </li>';
                    echo "</a>";
                } ?>
                
            </ul>
              
            
        </div>
    </div>
</div>