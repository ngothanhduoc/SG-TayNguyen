
<script type="text/javascript" src="/admin/assets/js/backend/backend.newsevent.js"></script>


<div class="pageheader notab">
	<h1 class="pagetitle">Danh sách tin tức</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('newsevent');
    setActiveSubMenu('backend-newsevent-index');
	
    var arrGame = <?php echo @json_encode($game)?>;
    var arrCat = <?php echo @json_encode($news_category)?>;
	
</script>