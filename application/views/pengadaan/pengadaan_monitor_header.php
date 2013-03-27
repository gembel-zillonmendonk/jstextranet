<?php $this->load->helper('form'); ?>
<div class="accordion"> 
            <div>
   <fieldset class="ui-widget-content">
      <form id="frmPermintaan" method="POST"  >
        <p>	
            <?php echo form_label("NOMOR PENGADAAN") ?>
	    <input type="text" style="width: 50%" readonly="true" name="KODE_TENDER"  value="<?php echo $kode_tender; ; ?>" />
	</p>
        <p>	
            <?php echo form_label("KANTOR ") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_KANTOR" value="<?php echo $nama_kantor ; ?>" />
	</p>
    	<p>	
            <?php echo form_label("NAMA PEKERJAAN") ?>
	    <input type="text" style="width: 50%" readonly="true"     id="JUDUL_PEKERJAAN" name="JUDUL_PEKERJAAN" value="<?php echo $judul_pekerjaan; ?>" />
	</p>
        <p>	
            <?php echo form_label("DISKRIPSI PEKERJAAN") ?>
	    <input type="text" style="width: 50%" readonly="true"    id="LINGKUP_PEKERJAAN" name="LINGKUP_PEKERJAAN" value="<?php echo $lingkup_pekerjaan; ?>" /> 
	</p>
    
        <p>	
            <?php echo form_label("JENIS KONTRAK") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tipe_kontrak; ?>" />
        </p>
        <p>	
            <?php echo form_label("MATA UANG") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $mata_uang; ?>" />
        </p>
        <p>	
            <?php echo form_label("PERENCANA PENGADAAAN") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $nama_perencana; ?>" />
        </p>
         
      </form>
   </fieldset>     
          </div>
</div> 
