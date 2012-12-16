<?php $this->load->helper('form'); ?>
<div class="accordion"> 
            <div>
   <fieldset class="ui-widget-content">
      <form   method="POST" action="add_tender" >
        <p>	
            <?php echo form_label("Metode Pengadaan") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_tender;   ?>" />
	</p>
        
        <p>	
            <?php echo form_label("Sistem Sampul") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_sampul;   ?>" />
	</p>
         
         
        <p>	
            <?php echo form_label("Tgl Pembukaan Pendaftaran") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tgl_pembukaan_reg; ?>" />
        </p>
        
         
        <p>	
            <?php echo form_label("Tgl Penutupan Pedaftaran") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tgl_penutupan_reg ; ?>" />
        </p>
        
        <p>	
            <?php echo form_label("Tgl Aanwijzing") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tgl_pre_lelang ; ?>" />
        </p>
        
        <p>	
            <?php echo form_label("Lokasi Aanwijzing") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $lokasi_pre_lelang ; ?>" />
        </p>
        <p>	
            <?php echo form_label("Tgl Pembukaan Penawaran") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tgl_pembukaan_lelang ; ?>" />
        </p>
        
        <p>	
            <?php echo form_label("Lokasi Pengiriman") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $lokasi_kirim ; ?>" />
        </p>
        
        
        
      </form>
   </fieldset>     
          </div>
</div> 
