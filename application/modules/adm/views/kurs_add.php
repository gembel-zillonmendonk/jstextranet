
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php echo form_open(); ?>
 
	 <div class="accordion">
            <h3 href="">KURS MATA UANG</h3>
            <div>
			<p>	
	 <?php echo form_label("Mata Uang Dari") ?>
		<select name="mata_uang_dari" >
			<?php foreach($mata_uang as $row ) {
			?>
			<option value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>	
	  <br/>
	  
	  <?php echo form_label("Mata Uang Ke") ?>
		<select name="mata_uang_ke" >
			<?php foreach($mata_uang as $row ) {
			?>
			<option value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>
		<br/>
	   <?php echo form_label("Tgl Kurs") ?>
	   <?php 
	   $tgl_kurs = array(
               'name'        => 'tgl_kurs',
               'id'          => 'tgl_kurs', 
               'class'       => 'datepicker',
             );
			 
	   echo form_input($tgl_kurs) ?>		
	   <br/>
	   <br/>
	   <?php echo form_label("Nilai") ?>
	   <?php 
	   
	   echo form_input("nilai") ?>
	   
	    	
 
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
		window.location = "<?php echo base_url() ."index.php/kurs"; ?>";  
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
 