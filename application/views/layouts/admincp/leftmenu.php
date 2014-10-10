<?php
	
	$menus = $_SESSION['user_menu'];
	
	if (!empty($menus)) {
		$menu = array();
		foreach ($menus as $m) {
			$menu[$m['group_name']][] = $m;
		}

	}
        
       
		
?>

<ul id="main-menu">
	<?php
	if(empty($menu) === FALSE){
	foreach($menu as $key => $val){
	?>
		<li page="<?php echo @$val[0]['alias']?>"><a href="#<?php echo @$val[0]['alias']?>" class="elements"><?php echo $key?></a>
		<span class="arrow"></span>
		<ul id="<?php echo @$val[0]['alias']?>">
			<?php
			foreach($val as $v){
			?>
			<li sub-page="<?php echo $v['als']?>">
				<a href="<?php echo $v['url']?>"><?php echo $v['name_display']?></a>
			</li>
			<?php
			}
			?>
		</ul>
		
		</li>
	
	<?php
	}
	}
	?>
</ul>

<a class="togglemenu"></a>
<br /><br />