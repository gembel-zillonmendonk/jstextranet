
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php echo form_open(); ?>
 
	 <div class="accordion">
            <h3 href="">KELOMPOK JASA</h3>
            <div>
			<p>	
		<?php echo form_hidden("kode_kel_jasa", $kode_kel_jasa) ?>
		
	   <?php echo form_label("Nama Kelompok Jasa") ?>
	   <?php 
						   $nama_kel_jasa = array (
								   'name'        => 'nama_kel_jasa',
								   'id'          => 'nama_kel_jasa', 
								   'value'		 => $nama_kel_jasa	
							);
	   
	   echo form_input($nama_kel_jasa) ?>
	   
	    	
 
</p>		
			</div>
	</div>			

    <p>
        <input type="button" id="btncancel"  value="Cancel" />
        <input type="submit" value="Submit" />
    </p>
</form>	
</fieldset> 
 <script>
  
  $(document).ready(function(){
  
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/kel_jasa"; ?>";  
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
 