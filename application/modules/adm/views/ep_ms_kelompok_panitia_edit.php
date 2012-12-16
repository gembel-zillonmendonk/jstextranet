
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php 
$attributes = array( 'id' => 'frmanggota');
echo form_open("", $attributes);; ?>
 
	 <div class="accordion">
            <h3 href="">PANITIA</h3>
            <div>
			<p>	
	 <?php echo form_label("Nama  Panitia") ?>
	 <?php 
	 $nama_panitia = array(
					 'id' => 'nama_panitia',
					 'name' => 'nama_panitia',
					 'value' => $val_nama_panitia,
					 'readonly' => true,
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}"
					 );
	 
	 echo form_input($nama_panitia); 
	 ?>
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
	
	
	 <div class="accordion">
            <h3 href="<?php echo base_url()?>index.php/adm/gridr/ep_ms_anggota_panitia?search=true&searchField=KODE_PANITIA&searchString=1&searchOper=bw" >DETAIL ANGGOTA PANITIA</h3>
            <div>
			<p>	
		 
		<?php echo form_label("Jabatan") ?> 
		<select name="kode_jabatan" >
			<?php foreach($kode_jabatan as $row ) {
			?>
			<option value="<?php echo $row["KODE_JABATAN"]; ?>" ><?php echo $row["NAMA_JABATAN"]; ?></option>
			<?php
			}
			?>			
		</select>	
		<br/> 
		<?php echo form_label("Status Pemimpin") ?> 
		<?php echo form_checkbox("status_pemimpin"); ?>	 
		<p>
				<input type="button" id="btnAddAnggota"  value="Tambah Anggota" /> 
				<input type="hidden" id="add_type" name="add_type"  value="" /> 
				<input type="hidden" id="kode_kantor" name="kode_kantor_key"  value="<?php echo $kode_kantor_key; ?>" /> 
				<input type="hidden" id="kode_panitia" name="kode_panitia_key"  value="<?php echo $kode_panitia; ?>" /> 
				 
			</p>
	 	<div id="list" ></div>
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
		window.location = "<?php echo base_url() ."index.php/panitia"; ?>";  
	});
  
	$("#btnAddAnggota").click(function(){
		$("#add_type").val("add_anggota");
		$("#frmanggota").submit();
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
 