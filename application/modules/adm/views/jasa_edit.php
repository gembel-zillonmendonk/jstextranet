
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
	   echo form_input($kode_kel_jasa) ?><input type="button" id="btnPopup"  value="..." />
	   <br/> <br/>
	    <?php echo form_label("Kode Jasa") ?>
	   <?php 
	   $kode_jasa = array (
			'id' => 'kode_jasa',
			'name' => 'kode_jasa',
			'readonly' => true,
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
			'value' => $nama_jasa
			
	   );
	   
	      echo form_input($nama_jasa) ?>
	    
	  
	   
	    	
 
</p>		
			</div>
	</div>			

    <p>
        <input type="button" id="btncancel"  value="Cancel" />
        <input type="submit" value="Submit" />
    </p>
</form>	

<div id="modal_form_kelompok_jasa"></div>

</fieldset> 
 <script>
  
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
	
	
	
	
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/jasa"; ?>";  
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
 