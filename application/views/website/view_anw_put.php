<div class="row">
    <div class="col-xs-12">
        <div class="title-header"><h2>Đặt Câu Hỏi</h2></div>
        <div class="description-introduction">
            <h4><?php echo @$thank ?></h4>
            <form class="stdform stdform2" id="frm-add-article" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<p>
			<label for="title">Họ Tên <span style="color:#ff0000">(*): </span></label>
			<span class="field">
                            <input type="text" placeholder="" id="title" required="" name="name" class="mediuminput" value="">
			</span>
		</p>
		<p>
			<label for="title">Số Điện Thoại: </label>
			<span class="field">
                            <input type="number" placeholder="" id="title" name="phone" class="mediuminput" value="">
			</span>
		</p>
		<p>
			<label for="title">Email <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                            <input type="email" placeholder="" id="title" required="" name="email" class="mediuminput" value="">
			</span>
		</p>
		<p>
			<label for="title">Chủ Đề <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                            <input type="text" placeholder="" id="title" required="" name="title" class="mediuminput" value="">
			</span>
		</p>
			
                <p>
			<label for="title">Nội Dung <span style="color:#ff0000">(*)</span></label>
			<span class="field">
                            <textarea name="content" style="width: 90%; height: 200px; padding: 10px"></textarea>
			</span>
		</p>
                
		<p class="stdformbutton">
			
			<button class="submit radius2" type="submit">Gửi</button>
		</p>
		
	</form>	
              
            
        </div>
    </div>
</div>