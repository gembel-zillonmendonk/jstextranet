<?php
define("IN_PHP", true);

require_once("tree/common.php");

$rootName = "Root";
$treeElements = $treeManager->getElementList(null, "manageStructure.php");

?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/tree/jquery/plugins/simpleTree/style.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/tree/style.css') ?>" />
<script type="text/javascript" src="<?php echo base_url('js/tree/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/tree/jquery/plugins/jquery.cookie.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/jquery.simple.tree.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/tree/langManager.js') ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('js/tree/treeOperations.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/tree/init.js') ?>"></script>
  
  <div class="accordion">
 <h3 href=" ">Hirarki Jabatan</h3>
            <div>
		 
			<div class="contextMenu" id="myMenu1">	
		<li class="addFolder">
			<img src=""<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/folder_add.png') ?>" /> </li>
		<li class="addDoc"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/page_add.png') ?>" /> </li>	
		<li class="edit"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/folder_edit.png') ?>" /> </li>
		<li class="delete"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/folder_delete.png') ?>" /> </li>
		<li class="expandAll"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/expand.png') ?>"/> </li>
		<li class="collapseAll"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/collapse.png') ?>"/> </li>	
</div>
<div class="contextMenu" id="myMenu2">
		<li class="edit"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/page_edit.png') ?>" /> </li>
		<li class="delete"><img src="<?php echo base_url('js/tree/jquery/plugins/simpleTree/images/page_delete.png') ?>" /> </li>
</div>

<div id="wrap">
	<div id="annualWizard">	
			<ul class="simpleTree" id='pdfTree'>		
					<li class="root" id='<?php echo $treeManager->getRootId();  ?>'><span><?php echo $rootName; ?></span>
						<ul><?php echo $treeElements; ?></ul>				
					</li>
			</ul>						
	</div>	
 
</div> 
<div id='processing'></div>
			 
			<div id="list" ></div>
			</div>
  </div>			
 <script>
  
  $(document).ready(function(){
  
    $(".accordion")
    .addClass("ui-accordion ui-widget ui-helper-reset")
    //.css("width", "auto")
    .find('h3')
    .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
    .css("padding", ".5em .5em .5em .7em")
    //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
    .next()
    .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
    .css('overflow','visible')
 
	 });
  
</script>   			