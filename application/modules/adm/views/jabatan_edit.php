	<link rel="stylesheet" href="<?php echo base_url('js/jquery.treeview/jquery.treeview.css'); ?>" />
 	
	
	<script src="<?php echo base_url('js/jquery.treeview/lib/jquery.cookie.js') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.js') ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.edit.js') ?>" type="text/javascript"></script>

	
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php echo form_open(); ?>
 
	 <div class="accordion">
            <h3 href="">JABATAN</h3>
            <div>
			<p>	
			<?php echo form_label("Kode Jabatan") ?>
		<?php 
						   $kode_jabatan = array (
								   'name'        => 'kode_jabatan',
								   'id'          => 'kode_jabatan', 
								   'value'		 => $kode_jabatan,
								'readonly' =>true			
							);
	    
	   echo form_input($kode_jabatan) ?>
	     
		<br/><br/>
	   <?php echo form_label("Nama Jabatan") ?>
	   <?php 
						   $nama_jabatan = array (
								   'name'        => 'nama_jabatan',
								   'id'          => 'nama_jabatan', 
								   'value'		 => $nama_jabatan,	
								   'style'       => 'width: 50%',
								   'readonly' =>true
							);
	   
	   echo form_input($nama_jabatan) ?>
	   
	    	
 
</p>		
			</div>
		<h3 href="">MENU</h3>
    		<div>		 
 	<p>
				<input type="button" id="btncancel"  value="Cancel" /> 
				 <input type="button" id="btnSubmit"  value="Submit" /> 
				 
			</p>			
		<?php echo $menu; ?>
			</div>
 		
	</div>			
	
</form>	
</fieldset> 
 <script>
  
  $(document).ready(function(){
  
	$("#btnSubmit").click(function() {
		str = "";
		$("input[type=checkbox]").each(function() {
				if ($(this).attr("checked")) {
					str += $(this).attr("id");
					str += ",";
				}
		});	
		
		str = str.substr(0,str.length -1);
		alert(str);
		kode_jabatan = $("#kode_jabatan").val();
		
		$.ajax({
		   type: "POST",
		   url: " update",
		   data: "kode_jabatan=" + kode_jabatan + "&menu=" + str,
		   success: function(msg){
			 alert( "Data Saved: " + msg );
		   }
		});
	});
	
  
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/jabatan"; ?>";  
	});
  
	$(".chk").click(function() {
 	 idx = $(this).attr("id");
 	 a = $(this).attr("checked");
 
	 
 /*
		if (!a) {
			 alert("xx");
		}
*/		
		 
		b = $(this).attr("parent"); 
	// 	alert(b);
		if (a) {
			// alert($('input[id*="'+b+'"]').attr("id"));
			$('input[id*="'+b+'"]').attr("checked",true) ;
		} 
		 
		 $('input[parent*="'+idx+'"]').each(function(){
			 if (!a) {
				  $(this).attr("checked", false)  ;
			 }
		 });
	 
	 
		
	
		
		 
	});
  
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

 