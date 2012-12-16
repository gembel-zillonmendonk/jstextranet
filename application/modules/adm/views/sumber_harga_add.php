
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php echo form_open(); ?>
  
	   <br/>
	   <?php echo form_label("Nama Sumber") ?>
	   <?php 
           $nama_sumber = array(
					 'id' => 'nama_sumber',
					 'name' => 'nama_sumber',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:50}}"
					 );
	    
	   echo form_input($nama_sumber);
           ?>
	   
	    	
 
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
		window.location = "<?php echo base_url() ."index.php/adm/sumber_harga"; ?>";  
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
 