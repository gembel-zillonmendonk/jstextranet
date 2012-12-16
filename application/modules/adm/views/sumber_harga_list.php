  <div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/adm/gridr/ep_kom_sumber_harga">Sumber Harga</h3>
            <div>
			<p>
				<input type="button" id="btnAdd"  value="Tambah Sumber Harga" /> 
				<input type="button" id="btnEdit"  value="Edit Sumber Harga" /> 
				<input type="button" id="btnDelete"  value="Hapus Sumber Harga" /> 
				
			
			</p>
			
			
			 
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
	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
	$("#btnAdd" ).click(function() {
		window.location = "<?php echo base_url() ."index.php/adm/sumber_harga/add"; ?>";  
	});
	
	$("#btnEdit" ).click(function() {
 
	 var selected = $('#grid_ep_kom_sumber_harga').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_sumber_harga').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_SUMBER" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    window.location = "<?php echo base_url() . "index.php/adm/sumber_harga/edit"; ?>?" + str;
		}			
	});

		
	$("#btnDelete" ).click(function() {
 
	 var selected = $('#grid_ep_kom_sumber_harga').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_sumber_harga').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_SUMBER" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
					var del =  selected["KODE_SUMBER"] ;		
					
                    window.location = "<?php echo base_url() . "index.php/adm/sumber_harga/delete"; ?>?" + str;
		}			
	});
	 });
  
</script>   			