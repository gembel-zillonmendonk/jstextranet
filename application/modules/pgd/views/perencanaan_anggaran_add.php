<!-- 
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_perencanaan">DAFTAR PERENCANAAN</h3>
            <div>
			 
			<div id="list" ></div>
			</div>
 </div>	
 -->
 <div id="modal_form_anggaran"></div>
<?php $this->load->helper('form'); ?>
<div class="accordion">
<h3 href="">PEMBUATAN PERENCANAAN PENGADAAN</h3>
        <div>
	   <div   >
  <fieldset class="ui-widget-content">
      <form id="frmPerencanaan" method="POST" action="" >
     
	<p>	
            <?php echo form_label("User *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_JABATAN"  value="<?php echo $PERENCANA; ?>" />
	</p>
        <p>	
            <?php echo form_label("Biro/Unit *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_KANTOR" value="<?php echo $NAMA_KANTOR; ?>" />
	</p>
        <p>	
            <?php echo form_label("Nama Pekerjaan * ") ?>
	    <input type="text" style="width: 50%" readonly="true" name="JUDUL_PEKERJAAN" id="JUDUL_PEKERJAAN"  style="width: 50%"  class="{validate:{required:true,maxlength:255}}"  value="<?php echo $JUDUL_PEKERJAAN; ?>"  />
	</p>        
        <p>	
            <?php echo form_label("Deskripsi Rencana Pekerjaan * ") ?>
	    <input type="text" style="width: 50%" readonly="true" name="LINGKUP_PEKERJAAN" id="LINGKUP_PEKERJAAN"  tyle="width: 50%"  class="{validate:{required:true,maxlength:255}}"  value="<?php echo $LINGKUP_PEKERJAAN; ?>" />
	</p>
        <p>	
            <?php echo form_label("Rencana Kebutuhan * ") ?>
	    <select readonly="true"  id="BULAN_RENCANA_KEBUTUHAN" class="{validate:{required:true}}" >
                <?php
                echo "<option value=''>-- Pilih Bulan--</option>";
                foreach($arr_bulan as $k=>$v){
                    echo "<option value='" . $k ."'>".$v."</option>";
                    
                }
                ?>
            </select>
            <select readonly="true"  id="TAHUN_RENCANA_KEBUTUHAN" class="{validate:{required:true}}"  >
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
	    <select readonly="true"   id="BULAN_RENCANA_PELAKSANAAN"  class="{validate:{required:true}}"  >
                <?php
                echo "<option value=''>-- Pilih Bulan--</option>";
                foreach($arr_bulan as $k=>$v){
                    echo "<option value='" . $k ."'>".$v."</option>";
                    
                }
                ?>
            </select>
            <select readonly="true"  id="TAHUN_RENCANA_PELAKSANAAN"  class="{validate:{required:true}}" >
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

	 	<select readonly="true" name="mata_uang" type="dropdown" >
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
             <input readonly="true" type="radio" id="SWAKELOLA" name="SWAKELOLA" value="0"> Tidak</input>
             <input readonly="true" type="radio" id="SWAKELOLA" name="SWAKELOLA" value="1" >Ya</input>
             
         </group> 
             
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
  <h3 href="<?php echo base_url()?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran">MATA ANGGARAN</h3>          
    <div>        
     
      <button type="button" id="btnAddMataAnggaran">TAMBAH MATA ANGGARAN</button>   
      <button type="button" id="btnDeleteMataAnggaran">HAPUS MATA ANGGARAN</button> 
      <div id="list_perencanaan_anggaran" ></div>   
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



	$("#btnAddMataAnggaran").click(function() {
		 
		str= "";
		jQuery('#modal_form_anggaran')
                     .load($site_url + '/pgd/anggaran_get' + str)
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
                    jQuery('#modal_form_anggaran').dialog("open");
					
	});
        
	
	$("#btnDeleteMataAnggaran").click(function() {
         
		 var selected = $('#grid_ep_pgd_perencanaan_anggaran').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_pgd_perencanaan_anggaran').jqGrid('getRowData',selected);
 
		   
		   var keys = <?php echo json_encode(Array ( 0  => "KODE_PERENCANAAN" 
                           , 1=> "KODE_KANTOR"
                           , 2=> "TAHUN"
                           , 3=> "KODE_KANTOR_ANGGARAN"
                           , 4=> "KELOMPOK_MA"
                           , 5=> "KODE_MA")); ?>;
		   
		 // alert(selected["KODE_KOMENTAR"]);
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    }); 
		} 
                
                if (confirm("Anda Yakin AKan Menghapus Anggaran")) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo  base_url(); ?>index.php/pgd/perencanaan/anggaran_delete",
                        data: str,
                        success: function(msgx){
                                alert('Data berhasil dihapus');


                    var grid = $("#grid_ep_pgd_perencanaan_anggaran");
                     grid.trigger("reloadGrid",[{page:1}]);






                        },
                        error: function(){
                                alert('Data Komentar gagal disimpan')
                        }
                      });
                  }  
		 		
	});
	
        
        
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        //var ctn = $("#list") ;
                        
                        alert(uri);
                        
                        var ctn =  $(this).next().children("#list");   

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
                            window.location = "<?php echo base_url() ."index.php/adm/perencanaan_anggaran_add"; ?>/" + msg;			
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
         
  
 function fnShowMataAnggaran(strurl) {
     var uri = strurl + "&r=" + Math.random();
                      
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list_perencanaan_anggaran") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.html('');

                            ctn.load(uri);
                    }
                         
     
 }
         
  
 function fnAddAnggaran($arr) {
     str  = "KODE_PERENCANAAN=<?php echo $KODE_PERENCANAAN; ?>";
     str += "&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>";
     str += "&TAHUN=" + $arr[0];
     str += "&KODE_KANTOR_ANGGARAN=" + $arr[1];
     str += "&KELOMPOK_MA=" + $arr[2];
     str += "&KODE_MA=" + $arr[3];
     str += "&AKUN=" + $arr[4];
     str += "&NAMA_AKUN=" + $arr[5];
     str += "&PAGU_ANGGARAN=" +   $arr[6];
     str += "&SISA_ANGGARAN=" + $arr[7];
     
    $.ajax({
        type: "POST",
        url: "anggaran_add",
        data: str,
        success: function(msgx){
                
                alert(msgx);
                alert('Data berhasil disimpan');
                jQuery('#modal_form_anggaran').dialog("close");
                    
                    
                    
                        strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran?"+ msgx;
                        fnShowMataAnggaran(strurl);

                    

        },
        error: function(){
                alert('Data Komentar gagal disimpan')
        }
      });
     
    
 
 } 
  
</script>   	 			