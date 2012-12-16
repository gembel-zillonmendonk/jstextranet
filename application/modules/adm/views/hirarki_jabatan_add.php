<?php $this->load->helper('form'); ?>
  <div class="accordion">
 
            <h3 id="" >DETAIL OTORISASI </h3>
            <div   >
  <fieldset class="ui-widget-content">
   <form id="frmHirarki" method="POST" action="hirarki_jabatan/add/<?php echo $kode_jabatan_induk; ?>" >
    <legend>Fields with remark (*) is required.</legend>
	<input type="hidden" name="kode_jabatan_induk" value="<?php echo  $kode_jabatan_induk; ?>" />  
	<?php 
	echo "<p>";
	echo form_label("Jabatan Atasan");
	$jabatan_induk = array(
						'id' => 'nama_jabatan_induk',
						'value' => $nama_jabatan_induk,  
						'readonly' => true, 
						'width' => '100%', 
						 'class' => ' {validate:{required:true,maxlength:255}}'
						);
	echo "&nbsp;" . form_input($jabatan_induk);
	echo "</p>"; 

	?>
	<p>	
	<?php echo form_label("Jabatan") ?>
	   <select name="kode_jabatan"  >
			<?php foreach($arr_jabatan as $row ) {
		 	$sel = ($row["KODE_JABATAN"] == $kode_jabatan ? " SELECTED " : " ");
			?>
			<option value="<?php echo $row["KODE_JABATAN"];  ?>"   <?php echo $sel; ?>   ><?php echo $row["NAMA_JABATAN"]; ?></option>
			<?php
			}
			?>			
	</select>
	</p>
	<p>
	<?php echo form_label("Nilai Maks Otorisasi") ?>
	<input type="number" name="nilai_maks_otorisasi" value="0" id="nilai_maks_otorisasi"   maxlength="22" style=""    />      
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
	<input type="hidden" name="kode_otorisasi" value="<?php echo $kode_otorisasi; ?>" /> 
	</form>
  </fieldset>	
  </div>
 </div>
 
<script>
  
 
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
	
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
	 
        var validator = $("#frmHirarki").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

 
		
  
</script>   