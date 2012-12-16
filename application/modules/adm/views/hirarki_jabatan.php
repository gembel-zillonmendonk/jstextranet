<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title>jQuery treeview</title>
		<link rel="stylesheet" href="<?php echo base_url('js/jquery.treeview/jquery.treeview.css'); ?>" />
 	
	
	<script src="<?php echo base_url('js/jquery.treeview/lib/jquery.cookie.js') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.js') ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('js/jquery.treeview/jquery.treeview.edit.js') ?>" type="text/javascript"></script>

<style>
.clicked {
		font-weight: bold;
}
	
	
</style>

	
	</head>
	<body>
 <div id="modal_form_hirarki_jabatan"></div>	
<input type="text" style="display: none" name="selected_id" id="selected_id" />	
	  
  <div class="accordion">
 <h3 href=" ">Hirarki Jabatan</h3>
            <div>
 
	<button id="btnAdd">Add</button>
	<button id="btnEdit">Edit</button>
	<button id="btnDelete">Delete</button>
	
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
		 	/*
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
		*/	  
		
		$("span").click(function(){
			$('.clicked').removeClass('clicked');
			$(this).addClass('clicked');
			
			$("#selected_id").val($(this).parent("li").attr("id"));
		 
			
		 
		});
		
		$("#btnDelete").click(function(){
			 str= $("#selected_id").val();
			 if (!(str)) return;
			 if (confirm("Anda Yakin AKan Menghapus ?")) { 
				 strurl = $site_url + '/adm/hirarki_jabatan/delete/' + str;
				  $.ajax({
					url: strurl, 
					success:function(msg) {
						alert(msg);
						window.location.reload();
					}
				 });
			 }
				
		});
		
		
		 $("#btnAdd").click(function(){
			str= $("#selected_id").val();
			
			if(str == 0) return;
			if (!(str)) return;
			 
			jQuery('#modal_form_hirarki_jabatan')
                     .load($site_url + '/adm/hirarki_jabatan/add/' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            },
							"SIMPAN" : function() {
								if(validator.form()) {
										jQuery("#frmHirarki").ajaxSubmit({
										//clearForm: false,
										success: function(msg){
											 //reload grid
											 alert(msg);
											 // $("#trace").html(msg);											 
											 jQuery('#modal_form_hirarki_jabatan').dialog("close");
											 window.location.reload();
										},
										error: function(){
											alert('Data gagal disimpan')
										}
									});
								}
							}
                        }
                    });
                    jQuery('#modal_form_hirarki_jabatan').dialog("open");
			
			
			
		 });
		
		 $("#btnEdit").click(function(){
			str= $("#selected_id").val();
			if (!(str)) return;
			jQuery('#modal_form_hirarki_jabatan')
                     .load($site_url + '/adm/hirarki_jabatan/edit/' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            },
							"SIMPAN" : function() {
								if(validator.form()) {
										jQuery("#frmHirarki").ajaxSubmit({
										//clearForm: false,
										success: function(msg){
											 //reload grid
											 	 
											 jQuery('#modal_form_hirarki_jabatan').dialog("close");
											 window.location.reload();
										},
										error: function(){
											alert('Data gagal disimpan')
										}
									});
								}
							}
                        }
                    });
                    jQuery('#modal_form_hirarki_jabatan').dialog("open");
					
		 });
			
					
 
		})
		
	</script>
<div id="trace" ></div>	 
</body></html>