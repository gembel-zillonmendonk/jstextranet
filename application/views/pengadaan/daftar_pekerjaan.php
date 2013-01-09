<div class="accordion">
    <h3 href="<?php echo site_url('/crud/grid/ep_pgd_pekerjaan') ?>?PTVS_STATUS=<?php echo $PTVS_STATUS; ?>">DAFTAR PEKERJAAN <?php echo $this->session->userdata("kode_vendor"); ?></h3>
    <div>
        <fieldset class="ui-widget-content">
        <legend>Pencarian</legend>
			<form id="frmSearch" method="POST" action="" >
			
			<div id="mysearch"></div>
			<p>	
				<label>STATUS</label>
                                        <select id="myfield">
                                            <option Value="-1">PILIH</option>
                                                                <option <?php echo ($this->input->get("PTVS_STATUS") == "1" ? " SELECTED " : "" ) ;?>    Value="1">Undangan Pengadaan</option>
                                                                <option <?php echo ($this->input->get("PTVS_STATUS") == "2,20" ? " SELECTED " : "" ) ;?> Value="2,20">Menunggu Penawaran</option>
                                                                <option <?php echo ($this->input->get("PTVS_STATUS") == "3,21" ? " SELECTED " : "" ) ;?> Value="3,21">Edit / Resubmit Penawaran</option>
                                                                <option <?php echo ($this->input->get("PTVS_STATUS") == "10" ? " SELECTED " : "" ) ;?>  Value="10">Penawaran Negosiasi</option>
                                                                <option <?php echo ($this->input->get("PTVS_STATUS") == "11" ? " SELECTED " : "" ) ;?>  Value="11">Award Announcement</option>
                                         </select>
                              
		
			</p>
                        <p>
                                <label>CARI BERDASARKAN</label>
                            		<select  id="kolom" name="kolom"  > 
                                            <option Value="KODE_TENDER">NOMOR PENGADAAN</option>
                                            <option Value="JUDUL_PEKERJAAN">JUDUL PEKERJAAN</option>
                                        </select>    
                                <input type="text" id="cari" name="cari"  />
                                <button type="button" id="btnSrc"  >Cari</button> 
                        </p>
			</form>
         </fieldset>                   
        
        <div id="list"></div>
    </div>
</div>
<script>


    $(document).ready(function(){
        
    
	$("#btnSrc").click(function() {
	

	
		//alert($("#kolom").val());
		
		
		
		srcval = $("#kolom").val();
		var myfilter = { groupOp: "AND", rules: []};
		
		//var myfield = $("#myfield").val();
		var myfield = "PTVS_STATUS";
		srcval = $("#myfield").val();
                var myfield2 = $("#kolom").val();
		srcval2 = $("#cari").val();
                
                alert($("#myfield").val() );
                switch ($("#myfield").val()) {
                    case '3,21':
                        myfilter = { groupOp: "OR", rules: []};
                        myfilter.rules.push({field:'PTVS_STATUS' ,op:"eq",data: 3},{field: 'PTVS_STATUS' ,op:"eq",data: 21},{field: myfield2 ,op:"cn",data:srcval2});
                        break;
                    case '2,20':
                        myfilter = { groupOp: "OR", rules: []};
                        myfilter.rules.push({field:'PTVS_STATUS' ,op:"eq",data: 2},{field: 'PTVS_STATUS' ,op:"eq",data: 20},{field: myfield2 ,op:"cn",data:srcval2});
                        break;
                    case '-1':
                        myfilter.rules.push( {field: myfield2 ,op:"cn",data:srcval2});
                        break;
                    default:    
                        myfilter.rules.push({field: myfield ,op:"eq",data:srcval},{field: myfield2 ,op:"cn",data:srcval2});
                }
                 
		var grid = $("#grid_ep_pgd_pekerjaan");
			
	 
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
	 
		
		alert(grid);
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
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
    //.css("width", "auto");
        
        
    $('.accordion h3').each(function(){
        var uri = $(this).attr('href');
        if(uri != '' && uri != '#'){
           var ctn =  $(this).next().children("#list");  
            //alert($(ctn).width());
                
            if(ctn.html() == '')
                ctn.load(uri);
        }
    });
    
    });
    
    function fnProsesPekerjaan(str){
      
        
        	 $('#grid_ep_pgd_pekerjaan').jqGrid('setSelection',str); 
		 var selected = $('#grid_ep_pgd_pekerjaan').jqGrid('getGridParam', 'selrow');
		 
                 alert(selected);
                 if (selected) {
                    selected = jQuery('#grid_ep_pgd_pekerjaan').jqGrid('getRowData',selected);
 
		   
		   var keys = <?php echo json_encode(Array ( 0  => "KODE_KOMENTAR" )); ?>;
		   
		 // alert(selected["KODE_KOMENTAR"]);
                    var count = 0;
                
                    var data = {};
                    var str = "KODE_TENDER=" + selected["KODE_TENDER"] ;
                     str += "&KODE_KANTOR=" +  selected["KODE_KANTOR"] ;
                    
                    
                    /*
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    */
		}			
		 
		   window.location = "<?php echo base_url() . "index.php/pengadaan/pekerjaan"; ?>?" + str;
	
        
    }
    
    
</script>

     