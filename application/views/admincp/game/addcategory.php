<script type="text/javascript" src="/admin/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/admin/assets/js/backend/backend.game.category.input.js"></script>
<style>
.fileinput .thumbnail > img {
    display: block;
}
.thumbnail > img {
    display: block;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
}
div.uploader {
    cursor: default;
    left: 260px;
    overflow: hidden;
    position: absolute;
    top: -50px;
}
</style>
<div class="pageheader notab">
	<h1 class="pagetitle">Add Category</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<form class="stdform stdform2" id="frm-add-game-category" role="form" action="" method="POST" enctype="multipart/form-data">
				
		<p>
			<label for="title">Title <span style="color:#ff0000">(*)</span></label>
			<span class="field">
				<input type="text" placeholder="" id="title" name="title" class="mediuminput" value="<?php echo @$data['title']?>">
			</span>
		</p>
		
		<p>
			<label for="description">Description</label>
			<span class="field">
				<textarea class="mediuminput" name="description" id="description" placeholder=""><?php echo @$data['description']?></textarea>
			</span>
		</p>
		<p>
			<label for="content" style="float: none">Content</label>
		</p>
		<p>
			<textarea placeholder="" id="content" name="content" class="mediuminput"><?php echo @$data['content']?></textarea>
		</p>
		
		<p>
		
			<label for="image">Image</label>
			<span class="field">
				<br>
				<div class="fileinput-exists" data-provides="fileinput" style="position: relative"><input name="icon" value="<?php echo @$data['image']?>" type="hidden">
										
					<div class="uploader" id="uniform-undefined"><input type="file" name="image" size="19" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div>
					<?php
					if(isset($data['image'])){
                                        ?>
                                            <div class="fileinput" id="view-img" style="display: block;">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 600px; margin: 10px"><img src="/assets/images/upload/<?php echo @$data['image']?>" width="100%"></div>
                                            <a href="#" class="btn btn_orange btn_trash" style="position: absolute; top: -50px; left: 500px" data-dismiss="fileinput"><span>Remove</span></a>
                                            </div>
					<?php
                                        }else{
                                        ?>
                                            <div class="fileinput" id="view-img" style="display: none;">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 600px; margin: 10px"><img src="" width="100%"></div>
                                            <a href="#" class="btn btn_orange btn_trash" style="position: absolute; top: -50px; left: 500px" data-dismiss="fileinput"><span>Remove</span></a>
                                            </div>					
					<?php
                                        }
                                        ?>
					
					
				</div>
			</span>	
				
			
		</p>	
		<p class="stdformbutton">
			<input id="txt_id" type="hidden" value="<?php echo @$data['id_game_category']?>" name="id">
			<button class="submit radius2" type="submit">Add Category</button>&nbsp;&nbsp;<span id="loading" style="position: absolute; display: none"><img src="/admin/assets/images/loaders/loader10.gif"/></span>
		</p>
		
	</form>				
</div><!--contentwrapper-->

<script type="text/javascript">
	setActiveMenu('game');
    setActiveSubMenu('backend-game-addcategory');
	
	
	//view img befor upload
+function ($) { "use strict";

  var isIE = window.navigator.appName == 'Microsoft Internet Explorer'
  
    var Fileupload = function (element, options) {
    this.$element = $(element)
      
    this.$input = this.$element.find(':file')
    if (this.$input.length === 0) return

    this.name = this.$input.attr('name') || options.name

    this.$hidden = this.$element.find('input[type=hidden][name="'+this.name+'"]')
    if (this.$hidden.length === 0) {
      this.$hidden = $('<input type="hidden" />')
      this.$element.prepend(this.$hidden)
    }
    

    this.$preview = this.$element.find('.fileinput-preview')
    var height = this.$preview.css('height')
    
    
    
    if (this.$preview.css('display') != 'inline' && height != '0px' && height != 'none') this.$preview.css('line-height', height)

    this.original = {
      exists: this.$element.hasClass('fileinput-exists'),
      preview: this.$preview.html(),
      hiddenVal: this.$hidden.val()
    }
    
    this.listen()
  }
  
   Fileupload.prototype.listen = function() {
    this.$input.on('change.bs.fileinput', $.proxy(this.change, this))
    $(this.$input[0].form).on('reset.bs.fileinput', $.proxy(this.reset, this))

    this.$element.find('[data-trigger="fileinput"]').on('click.bs.fileinput', $.proxy(this.trigger, this))
    this.$element.find('[data-dismiss="fileinput"]').on('click.bs.fileinput', $.proxy(this.clear, this))
  },

  Fileupload.prototype.change = function(e) {
	$("#view-img").show();
    if (e.target.files === undefined) e.target.files = e.target && e.target.value ? [ {name: e.target.value.replace(/^.+\\/, '')} ] : []
    if (e.target.files.length === 0) return

    this.$hidden.val('')
    this.$hidden.attr('name', '')
    this.$input.attr('name', this.name)

    var file = e.target.files[0]
    
    //console.log(file);
    
    if (this.$preview.length > 0 && (typeof file.type !== "undefined" ? file.type.match('image.*') : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
      var reader = new FileReader()
      var preview = this.$preview
      var element = this.$element

      reader.onload = function(re) {
        var $img = $('<img>').attr('src', re.target.result)
        //console.log(re.target.result);
        
        e.target.files[0].result = re.target.result
        
        element.find('.fileinput-filename').text(file.name)
        
        // if parent has max-height, using `(max-)height: 100%` on child doesn't take padding and border into account
        if (preview.css('max-height') != 'none') $img.css('max-height', parseInt(preview.css('max-height'), 10) - parseInt(preview.css('padding-top'), 10) - parseInt(preview.css('padding-bottom'), 10)  - parseInt(preview.css('border-top'), 10) - parseInt(preview.css('border-bottom'), 10))
        //console.log($img);
        preview.html($img)
        element.addClass('fileinput-exists').removeClass('fileinput-new')

        element.trigger('change.bs.fileinput', e.target.files)
      }

      reader.readAsDataURL(file)
    } else {
      this.$element.find('.fileinput-filename').text(file.name)
      this.$preview.text(file.name)
      
      this.$element.addClass('fileinput-exists').removeClass('fileinput-new')
      
      this.$element.trigger('change.bs.fileinput')
    }
  },
  
  Fileupload.prototype.clear = function(e) {
    if (e) e.preventDefault()
    
    this.$hidden.val('')
    this.$hidden.attr('name', this.name)
    this.$input.attr('name', '')

    //ie8+ doesn't support changing the value of input with type=file so clone instead
    if (isIE) { 
      var inputClone = this.$input.clone(true);
      this.$input.after(inputClone);
      this.$input.remove();
      this.$input = inputClone;
    } else {
      this.$input.val('')
    }

    this.$preview.html('')
    this.$element.find('.fileinput-filename').text('')
    this.$element.addClass('fileinput-new').removeClass('fileinput-exists')
    
    if (e !== false) {
      this.$input.trigger('change')
      this.$element.trigger('clear.bs.fileinput')
    }
	
	$("#view-img").hide();
  },

  // FILEUPLOAD PLUGIN DEFINITION
  // ===========================


  $.fn.fileinput = function (options) {
    return this.each(function () {
      var $this = $(this)
      , data = $this.data('fileinput')
      if (!data) $this.data('fileinput', (data = new Fileupload(this, options)))
      if (typeof options == 'string') data[options]()
    })
  }

 // $.fn.fileinput.Constructor = Fileupload


  // FILEUPLOAD DATA-API
  // ==================
  
  $(document).on('click.fileinput.data-api', '[data-provides="fileinput"]', function (e) {
      
    var $this = $(this)
    
    if ($this.data('fileinput')) return
    $this.fileinput($this.data())
      
    /*
    var $target = $(e.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');
    if ($target.length > 0) {
    
      e.preventDefault()
      $target.trigger('click.bs.fileinput')
    }
    */
    
    
  })

}(window.jQuery)

	
	
</script>