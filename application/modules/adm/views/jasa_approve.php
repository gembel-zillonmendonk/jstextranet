<script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php echo form_open(); ?>
 
	 <div class="accordion">
            <h3 href="">KELOMPOK JASA</h3>
            <div>
			<p>	
 
	   <?php echo form_label("Kelompok Jasa") ?>
	   <?php 
	   $kode_kel_jasa = array (
			'id' => 'kode_kel_jasa',
			'name' => 'kode_kel_jasa',
			'readonly' => true,
			'value' => $kode_kel_jasa
			
	   );
	   echo form_input($kode_kel_jasa) ?>
	   <!--
	   <input type="button" id="btnPopup"  value="..." />
	   -->
	   <br/> <br/>
	    <?php echo form_label("Kode Jasa") ?>
	   <?php 
	   $kode_jasa = array (
			'id' => 'kode_jasa',
			'name' => 'kode_jasa',
			'readonly' => true,
			'style' => 'width:50%',
			'value' => $kode_jasa 
	   );
	   
	   echo form_input($kode_jasa) ?>
	   <br/> <br/>
	   <?php 
	   
	   
	   echo form_label("Nama Jasa") ?>
	   <?php 
	
	   $nama_jasa = array (
			'id' => 'nama_jasa',
			'name' => 'nama_jasa', 
			'value' => $nama_jasa,
			'readonly' => true,
			'style' => 'width:50%' 			
			
	   );
	   
	      echo form_input($nama_jasa) ?>
	    
	  
	   
	    	
 
</p>		
</form>	
			</div>
	</div>
   
 <div class="accordion">
 
            <h3 href="">KOMENTAR</h3>
            <div   >
			<fieldset>
			<form id="frmKomentar" action="<?php echo base_url() . "index.php/adm/komentar_kom/update" ?>"  method="POST" >
			<p>                   
               <textarea  style="width:100%" id="commentar" name="commentar" ></textarea>
			</p>
			<input type="hidden" name="kode_alurkerja" id="KODE_ALURKERJA" value="<?php echo $kode_alurkerja ; ?>" />
			<input type="hidden" name="kode_komentar" id="kode_komentar" value="<?php echo $kode_komentar; ?>" />
			<p>
			<label>Respon</label>
                         
			<select id="kode_transisi"  name="kode_transisi"   class="{validate:{required:true,maxlength:255}}" >
				<option value="" >-- </option>
				<?php
				foreach($rs_transisi as $row) {
				?>
					<option value="<?php echo $row->KODE_TRANSISI; ?>" ><?php echo $row->NAMA_TRANSISI; ?></option>
				<?php
				}
				?>
			</select>  
			</p>
			
<input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
			</fieldset>
<br/> 
<input type="button" id="btnSubmit" value="Submit" />
<input type="button" id="btnCancel"  value="Cancel" /> 
<div id="trace" > </div>  
 </div>

 </div> 	

 


<div id="modal_form_kelompok_jasa"></div>

</fieldset> 
 <script>
   
    tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
  	
   function fnSetValue(str) {
		$("#kode_kel_jasa").val(str);
		alert(str);
		 
  }
  
  $(document).ready(function(){
  
	$("#btnPopup").click(function() {
		 
		str= "";
		jQuery('#modal_form_kelompok_jasa')
                    .load($site_url + '/kel_jasa_get' + str)
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
	
	    var validator = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

		$("#btnSubmit").click(function(){
		
		
			 $('#komentar').val(tinyMCE.get('commentar').getContent());
		
			 if(validator.form()) {
				 
			 
				 jQuery("#frmKomentar").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                         
							alert(msg);
						
					$("#trace").html(msg) ;	
						
						
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
		window.location = "<?php echo base_url() ."index.php/adm/pekerjaan_kom"; ?>";  
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
 