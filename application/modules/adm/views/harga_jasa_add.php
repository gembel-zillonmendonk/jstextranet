<script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 

 <div id="modal_form_jasax"></div>
<?php $this->load->helper('form'); ?>
  <div class="accordion">
 
            <h3 id="h3_harga_hasa"  href="<?php echo site_url('/crud/form/ep_kom_harga_jasa') ?>">HARGA JASA</h3>
            <div   >
  <fieldset class="ui-widget-content">
   <form id="frmHargaJasa" method="POST" action="" >
    <legend>Fields with remark (*) is required.</legend>
 
			<p>	
			 <?php echo form_label("Kode Jasa") ?>
	   <?php 
	   $kode_jasa = array (
			'id' => 'kode_jasa',
			'name' => 'kode_jasa',
			'readonly' => true
			
	   );
	   
	   echo form_input($kode_jasa) ?>&nbsp;<button type="button" id="btnPopup"    >...</button>
	   </p>
	   <p> 
	  <label for="nama_jasa" class="control-label">Nama Jasa *</label>
	   <?php 
		$nama_jasa = array(
					 'id' => 'nama_jasa',
					 'name' => 'nama_jasa',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}"
					 );
	   
	   echo form_input($nama_jasa) ?>
	   </p>
	   <p> 
	   <?php echo form_label("Kode Kantor") ?>
	   <select name="kode_kantor" >
			<?php foreach($arr_kantor as $row ) {
			$sel = ($row["KODE_KANTOR"] == $this->session->userdata("kode_kantor") ? " SELECTED " : ""); 
			
			?>
			<option value="<?php echo $row["KODE_KANTOR"]; ?>"  <?php echo $sel; ?> ><?php echo $row["NAMA_KANTOR"]; ?></option>
			<?php
			}
			?>			
		</select>
		
	   </p> 
		<p> 
	   <?php echo form_label("Sumber") ?>
	   <select name="kode_sumber" >
			<?php foreach($arr_sumber as $row ) {
			$sel = ($row["KODE_SUMBER"] == $this->session->userdata("kode_sumber") ? " SELECTED " : ""); 
			
			?>
			<option value="<?php echo $row["KODE_SUMBER"]; ?>"  <?php echo $sel; ?> ><?php echo $row["NAMA_SUMBER"]; ?></option>
			<?php
			}
			?>			
		</select>
		
	   </p> 
 
	   <p>
		<?php echo form_label("Mata Uang") ?>

	 	<select name="mata_uang" type="dropdown" >
			<?php foreach($mata_uang as $row ) {
			?>
			<option value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>	
	  	</p>
		
			
		<p> 
                <label for="harga"   >Harga Satuan</label>                 
                    <input type="number" name="harga" value="0" id="harga"   maxlength="22" style=""    />                
        </p>		
	   <p> 
                <label     >Vendor</label>                 
                  <?php 
				echo form_input("nama_vendor") ?>
  
        </p>		
	   <p> 
                <label     >Catatan</label>                 
                  <?php 
					$catatan = array(
					 'id' => 'catatan',
					 'name' => 'catatan',
					  'style' => 'width: 50%',
					 'class' => " {validate:{maxlength:4000}}"
					 );		

		echo form_input($catatan) ?>
  
        </p>		
		<p> 
                <label     >Lampiran</label>                 
                  <?php 
				echo form_upload()
				?>
        </p>
		 
	  </form>
</fieldset>
	  	
			</div>
			</div>
  </div>
 <div class="accordion">
 
            <h3 href="">KOMENTAR</h3>
            <div   >
			<fieldset>
			<form id="frmKomentar" action="<?php echo base_url() . "index.php/adm/komentar_kom/add" ?>"  method="POST" >
			<p>                   
               <textarea style="width:100%" id="commentar" name="comment" ></textarea>
			</p>
                         <input type="hidden" name="kode_alurkerja" id="KODE_ALURKERJA" value="<?php echo $kode_alurkerja ; ?>" />
			<input type="hidden" name="kode_komentar" id="kode_komentar" value="0" />
		 
			<input type="hidden" name="kode_jasa_barang" id="kode_jasa_barang" />
			<input type="hidden" name="kode_harga" id="kode_harga" /> 
                         <input type="hidden" id="komentar"  name="komentar" /> 		
                         <input type="hidden" id="kode_transisi"  name="kode_transisi" value="4" /> 
			</form>
			</fieldset>
<br/> 
<button type="button" id="btnSubmit"  >Submit</button>
<button type="button" id="btnCancel"  >Cancel</button>
  
 </div>
<div id="trace" ></div>
 </div> 

 <script>
 

 	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
	
	
	
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
	
	$("#btnPopup").click(function() {
		 
		str= "";
		jQuery('#modal_form_jasax')
                     .load($site_url + '/adm/jasa_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
                    jQuery('#modal_form_jasax').dialog("open");
					
	});
	
	
	
	  $(function() {
            $( "input:submit, button").button();
            $( ".datepicker" ).datepicker();
            //$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        
        });

	    
        var validator = $("#frmHargaJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

	$("#btnSubmit").click(function(){
			 if(validator.form()) {
				$("#kode_jasa_barang").val($("#kode_jasa").val());
			 
			 
				 jQuery("#frmHargaJasa").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                         
						if (msg) {
								$("#kode_harga").val(msg);
                                                               
                                                                 $('#komentar').val(tinyMCE.get('commentar').getContent());
								
                                                                
                                                                
								jQuery("#frmKomentar").ajaxSubmit({
                    //clearForm: false,
								success: function(msgx){
									alert(msgx);
									 $("#trace").html(msgx);
								
                                                                        alert('Data berhasil disimpan');
                         
								},
								error: function(){
									alert('Data Komentar gagal disimpan')
								}
								});		

						}						
                        
						
						
						
						
						
                        //reload grid
                        
                    },
                    error: function(){
                        alert('Data gagal disimpan')
                    }
                });

//				 $("#frmHargaJasa").submit();
			}
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
	
	$("#btnSrc").click(function() {
	
/*
	
		//alert($("#kolom").val());
	 
		var myfilter = { groupOp: "AND", rules: []};
		myfilter.rules.push({field:"KODE_KEL_JASA",op:"eq",data:"J01"});
		
		var grid = $("#grid_ep_kom_jasa");
			
		
		alert(grid);
		
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
		alert(grid);
*/		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	
	$(".accordion" ).each(function(){
                 
                
                $('#h3_harga_hasa', $(this)).each(function(){
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
	$("#btnCancel" ).click(function() {
		window.location = "<?php echo base_url() ."index.php/adm/harga_jasa"; ?>";  
	});
 	 
	

	

	 });


 
   function fnSetValue(strId, strName) {
		$("#kode_jasa").val(strId);
		$("#nama_jasa").val(strName);
		
		 
  }
  
  
   
	 
</script>   			