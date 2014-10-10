<script type="text/javascript" src="/admin/assets/js/backend/backend.game.category.js"></script>
<div class="pageheader notab">
	<h1 class="pagetitle">Category game</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-category');
	
    var users = <?php echo json_encode($users)?>;
	
</script>
