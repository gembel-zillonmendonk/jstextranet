
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php 
$attributes = array( 'id' => 'frmPanitia');
echo form_open("", $attributes);; ?>
 
	 <div class="accordion">
            <h3 href="">PANITIA</h3>
            <div>
			<p>	
	 <?php echo form_label("Nama  Panitia * ") ?>
	 <?php 
	 	$nama_panitia = array(
					 'id' => 'nama_panitia',
					 'name' => 'nama_panitia',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}"
					 );
	 
	 echo form_input($nama_panitia); ?>
	  </p>
	 <p>	
	<?php echo form_label("Kantor") ?> 
		<select name="kode_kantor" >
			<?php foreach($kode_kantor as $row ) {
			?>
			<option value="<?php echo $row["KODE_KANTOR"]; ?>" ><?php echo $row["NAMA_KANTOR"]; ?></option>
			<?php
			}
			?>			
		</select>	
	</p>
		
			</div>
	</div>	
    <p>
        <input type="button" id="btncancel"  value="Cancel" />
        <input type="button" id="btnSubmit" value="Submit" />
    </p>	
</form>	
</fieldset> 	

 <script>
  
  $(document).ready(function(){
  
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/adm/panitia"; ?>";  
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
	
	 var validator = $("#frmPanitia").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
     });
	 
	 
	$("#btnSubmit").click(function(){
			 if(validator.form()) {
				$("#kode_jasa_barang").val($("#kode_jasa").val());
			 
			 
				 jQuery("#frmPanitia").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                       alert(msg);
						
						if(msg) {
							window.location = "<?php echo base_url() ."index.php/adm/panitia"; ?>";  
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
	
  });
  
</script>        
 