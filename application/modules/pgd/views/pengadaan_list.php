 <div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/gridr/ep_pgd_tender">MONITOR PENGADAAN</h3>
            <div>
			<!--
			<p>
			<div id="mysearch"></div>
				<input type="text" id="kolom" name="kolom"  value="" /> 
				<input type="button" id="btnSrc"  value="Cari" /> 
			</p>
			-->  
			<fieldset class="ui-widget-content">
			<legend>Pencarian</legend>
			<form id="frmSearch" method="POST" action="" >
			
			<div id="mysearch"></div>
			<p>	
				<label>
					<select id="myfield" >
						<option value="KODE_TENDER" >Nomor Pengadaan</option>
						<option value="NAMA_PEMOHON" >PIC USER</option>
						<option value="NAMA_PERENCANA" >NAMA PENATA</option> 
						<option value="STATUS" >STATUS</option> 
						<option value="JUDUL_PEKERJAAN" >NAMA PEKERJAAN</option> 
						
					</select>
				</label>
				<input type="text" id="kolom" name="kolom"  value="" /> 
				<input type="button" id="btnSrc"  value="Cari" /> 
			</p>
			</form>
			</fieldset>	
			<br/>
			<div id="list" ></div>
			</div>
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
	
	$("#btnSrc").click(function() {
	

	
		//alert($("#kolom").val());
		
		
		
		srcval = $("#kolom").val();
		var myfilter = { groupOp: "AND", rules: []};
		var myfield = $("#myfield").val();
		
		myfilter.rules.push({field: myfield ,op:"cn",data:srcval});
		
		var grid = $("#grid_ep_pgd_tender");
			
	 
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
	 
		 alert(grid);
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	
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
		window.location = "<?php echo base_url() ."index.php/kel_jasa/add"; ?>";  
	});
	 
	 

	 });
  
</script>   			