<script type="text/javascript" src="/public/admin/assets/js/backend/backend.article.js"></script>


<div class="pageheader notab">
	<h1 class="pagetitle">Danh sách menu</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->
<script type="text/javascript">
	setActiveMenu('article');
        setActiveSubMenu('backend-article-index');
        
        var users = <?php echo json_encode($users)?>;
</script>
