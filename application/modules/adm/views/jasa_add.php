<script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<?php $this->load->helper('form'); ?>

 
	 <div class="accordion">
            <h3 href="">KELOMPOK JASA</h3>
            <div>
			<fieldset class="ui-widget-content">
     
<form id="frmJasa" method="POST" action="add" >
			<p>	
 
	   <label for="kode_kel_jasa">Kelompok Jasa *</label>  
	   <?php 
	   $kode_kel_jasa = array (
			'id' => 'kode_kel_jasa',
			'name' => 'kode_kel_jasa',
			 'class' => " {validate:{required:true,maxlength:50}}",
			'readonly' => true
			
	   );
	   echo form_input($kode_kel_jasa) ?><input type="button" id="btnPopup"  value="..." />
	   <br/> <br/>
	   <?php echo form_label("Nama Jasa * ") ?>
	   <?php 
	   $nama_jasa = array (
			'id' => 'nama_jasa',
			'name' => 'nama_jasa',
			'style' => 'width: 50%',
			 'class' => " {validate:{required:true,maxlength:255}}"
			);
	   echo form_input($nama_jasa) ?>
	    <br/> <br/>
	   <?php 
	   
	   echo form_label("Keterangan") ?>
	   <?php 
	    $keterangan = array (
			'id' => 'keterangan',
			'name' => 'keterangan',
			'style' => 'width: 50%');
	   echo form_input($keterangan) ?>
	   <br/> <br/>
	   <?php echo form_label("Catatan") ?>
	   <?php 
	   $catatan = array (
			'id' => 'catatan',
			'name' => 'catatan',
			'style' => 'width: 50%');
	   
	   
	   echo form_input($catatan) ?>
	   
	    	
 
</p>	
</form>	
</fieldset> 		
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
		  
                        <input type="hidden" id="komentar"  name="komentar" /> 		
                         <input type="hidden" id="kode_transisi"  name="kode_transisi" value="1" /> 
			</form>
			</fieldset>
<br/> 
<input type="button" id="btnSubmit" value="Submit" />
<input type="button" id="btnCancel"  value="Cancel" /> 
  
 </div>

 </div> 
 
<div id="trace" ></div>

<div id="modal_form_kelompok_jasa"></div>


 <script>
  
   	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
	
   function fnSetValue(str) {
		$("#kode_kel_jasa").val(str);
		  
  }
  
  $(document).ready(function(){
  
	$("#btnPopup").click(function() {
		 
		str= "";
		jQuery('#modal_form_kelompok_jasa')
                    .load($site_url + '/adm/kel_jasa_get' + str)
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
                    jQuery('#modal_form_kelompok_jasa').dialog("open");
					
	});
	
	 var validator = $("#frmJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

	$("#btnSubmit").click(function(){
			 if(validator.form()) {
				$("#kode_jasa_barang").val($("#kode_jasa").val());
			 
			 
				 jQuery("#frmJasa").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                        alert(msg); 
						if (msg) {
								$("#trace").html(msg);
								$("#kode_jasa_barang").val(msg);
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
	
	
	
	$("#btnCancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/adm/jasa"; ?>";  
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
 