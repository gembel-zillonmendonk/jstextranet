<!-- 
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_perencanaan">DAFTAR PERENCANAAN</h3>
            <div>
			 
			<div id="list" ></div>
			</div>
 </div>	
 -->
<?php $this->load->helper('form'); ?>
<div class="accordion">
<h3 href="">PEMBUATAN PERENCANAAN PENGADAAN</h3>
        <div>
	   <div   >
  <fieldset class="ui-widget-content">
      <form id="frmPerencanaan" method="POST" action="" >
     
	<p>	
            <?php echo form_label("User *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_JABATAN"  value="<?php echo $this->session->userdata("nama_jabatan"); ; ?>" />
	</p>
        <p>	
            <?php echo form_label("Biro/Unit *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_KANTOR" value="<?php echo $this->session->userdata("nama_kantor"); ; ?>" />
	</p>
        <p>	
            <?php echo form_label("Nama Pekerjaan * ") ?>
	    <input type="text" style="width: 50%" name="JUDUL_PEKERJAAN" id="JUDUL_PEKERJAAN"  tyle="width: 50%"  class="{validate:{required:true,maxlength:255}}"   />
	</p>        
        <p>	
            <?php echo form_label("Deskripsi Rencana Pekerjaan * ") ?>
	    <input type="text" style="width: 50%" name="LINGKUP_PEKERJAAN" id="LINGKUP_PEKERJAAN"  tyle="width: 50%"  class="{validate:{required:true,maxlength:255}}"   />
	</p>
        <p>	
            <?php echo form_label("Rencana Kebutuhan * ") ?>
	    <select   id="BULAN_RENCANA_KEBUTUHAN" class="{validate:{required:true}}" >
                <?php
                echo "<option value=''>-- Pilih Bulan--</option>";
                foreach($arr_bulan as $k=>$v){
                    echo "<option value='" . $k ."'>".$v."</option>";
                    
                }
                ?>
            </select>
            <select   id="TAHUN_RENCANA_KEBUTUHAN" class="{validate:{required:true}}"  >
                <?php
                echo "<option value=''>-- Pilih Tahun--</option>";
                foreach($arr_tahun as $k=>$v){ 
                    $sel = ($k == date("Y") ? " SELECTED " : "" );
                    
                    echo "<option value='" . $k ."'  " .$sel. "  >".$v."</option>";
                    
                }
                ?>
            </select>    
	</p>
         <p>	
            <?php echo form_label("Rencana Pelaksanaan * ") ?>
	    <select   id="BULAN_RENCANA_PELAKSANAAN"  class="{validate:{required:true}}"  >
                <?php
                echo "<option value=''>-- Pilih Bulan--</option>";
                foreach($arr_bulan as $k=>$v){
                    echo "<option value='" . $k ."'>".$v."</option>";
                    
                }
                ?>
            </select>
            <select   id="TAHUN_RENCANA_PELAKSANAAN"  class="{validate:{required:true}}" >
                <?php
                echo "<option value=''>-- Pilih Tahun--</option>";
                foreach($arr_tahun as $k=>$v){
                      $sel = ($k == date("Y") ? " SELECTED " : "" );
                    echo "<option value='" . $k ."'  " .$sel. "  >".$v."</option>";
                    
                }
                ?>
            </select>    
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
                
         <p>	
            <?php echo form_label("Swakelola * ") ?>
         <group>
             <input type="radio" id="SWAKELOLA" name="SWAKELOLA" value="0"> Tidak</input>
             <input type="radio" id="SWAKELOLA" name="SWAKELOLA" value="1" >Ya</input>
             
         </group> 
             
        </p>
        <p>
            <button type="button" id="btnSimpan">SIMPAN</button>
            <button type="button" id="btnBatal">BATAL</button>

        </p>
      <input type="hidden" id="RENCANA_KEBUTUHAN" name="RENCANA_KEBUTUHAN" />  
      <input type="hidden" id="RENCANA_PELAKSANAAN" name="RENCANA_PELAKSANAAN" />    
      <input type="hidden" id="KODE_KANTOR" name="KODE_KANTOR" value="<?php echo $this->session->userdata("kode_kantor"); ?>" />
       <input type="hidden" id="KODE_JABATAN" name="KODE_JABATAN" value="<?php echo $this->session->userdata("kode_jabatan"); ?>" />
      
      </form>
      </fieldset>  
        </div>
 <div id="trace">  
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
<button type="button" id="btnSubmit"   >Submit</button>
<button type="button" id="btnCancel"    >Cancel</button> 
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
	  
		
 
 	    
        var validator = $("#frmPerencanaan").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

	$("#btnSimpan").click(function(){
			 if(validator.form()) {
				// $("#kode_jasa_barang").val($("#kode_jasa").val());
                                var x = "";
                                var y_rk = $("#TAHUN_RENCANA_KEBUTUHAN").val();
                                var b_rk = $("#BULAN_RENCANA_KEBUTUHAN").val();
                                v_RENCANA_KEBUTUHAN = x.concat(y_rk,b_rk);
                                var x = "";
                                var y_rk = $("#TAHUN_RENCANA_PELAKSANAAN").val();
                                var b_rk = $("#BULAN_RENCANA_PELAKSANAAN").val();
                                v_RENCANA_PELAKSANAAN = x.concat(y_rk,b_rk);
                                
                                $("#RENCANA_KEBUTUHAN").val(v_RENCANA_KEBUTUHAN);
                                $("#RENCANA_PELAKSANAAN").val(v_RENCANA_PELAKSANAAN);
                                
				jQuery("#frmPerencanaan").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                          //alert(msg);
                          // $("#trace").html(msg);
			  if(msg) { 			
                            window.location = "<?php echo base_url() ."index.php/pgd/perencanaan/anggaran_add"; ?>/" + msg;			
			  } else { 
                           alert('Data gagal disimpan')
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