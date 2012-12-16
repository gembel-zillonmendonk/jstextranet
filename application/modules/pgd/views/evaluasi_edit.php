 <div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_evaluasi_model?KODE_EVALUASI=<?php echo $KODE_EVALUASI; ?>">EDIT TEMPLATE EVALUASI PENGADAAN</h3>
             
			 
			<div class="list" ></div>
			 
		
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_evaluasi_model_detail?KODE_EVALUASI=<?php echo $KODE_EVALUASI; ?>">EDIT TEMPLATE EVALUASI PENGADAAN</h3>
         
			<div class="list" ></div>
<h3 href="<?php echo base_url()?>index.php/pgd/gridrf/ep_pgd_evaluasi_model_detail?KODE_EVALUASI=<?php echo $KODE_EVALUASI; ?>">ITEM</h3>
         
			<div class="list" ></div>			 
  </div>			

<script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
	
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
                        var ctn = $(this).next(".list")  ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
	 
		
 
	 

	 });
  
</script>   	 			