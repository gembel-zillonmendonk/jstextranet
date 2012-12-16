<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title>Eproc</title>
	
	<link rel="stylesheet" href="<?php echo base_url('js/jquery.treeview/jquery.treeview.css'); ?>" />
 	
	
	<script src="<?php echo base_url('js/jquery.treeview/lib/jquery.cookie.js') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.js') ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.edit.js') ?>" type="text/javascript"></script>

	
	</head>
	<body>
	
	  
  <div class="accordion">
 <h3 href=" ">Menu Management</h3>
            <div>
 
	<!--
	<button id="add">Add!</button>
	-->
	<?php echo $menu; ?>
	 
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
 
	<script type="text/javascript">
		$(function() {
		 $("#0").treeview();
			$("#browser").treeview();
			$("#add").click(function() {
				var branches = $("<li><span class='folder'>New Sublist</span><ul>" + 
					"<li><span class='file'>Item1</span></li>" + 
					"<li><span class='file'>Item2</span></li></ul></li>").appendTo("#0");
				$("#0").treeview({
					add: branches
				});
				branches = $("<li class='closed'><span class='folder'>New Sublist</span><ul><li><span class='file'>Item1</span></li><li><span class='file'>Item2</span></li></ul></li>").prependTo("#0");
				$("#0").treeview({
					add: branches
				});
			});
			/*
			$("#0").bind("contextmenu", function(event) {
				if ($(event.target).is("li") || $(event.target).parents("li").length) {
					$("#0").treeview({
						remove: $(event.target).parents("li").filter(":first")
					});
					return false;
				}
			});
			 */
		})
		
	</script>
	 
</body></html>