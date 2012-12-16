<!-- 
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_tender">PEMBUATAN PERMINTAAN PENGADAAN</h3>
            <div>
			 
			<div id="list" ></div>
			</div>
  </div>
-->
<?php $this->load->helper('form'); ?>
<div id="modal_form_perencanaan"></div>
<div id="modal_form_barangjasa"></div>

<div class="accordion">
<h3 href="">PEMBUATAN PERMINTAAN PENGADAAN</h3>
            <div>
   <fieldset class="ui-widget-content">
      <form id="frmPermintaan" method="POST" action="add_tender" >
        <p>	
            <?php echo form_label("User *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_JABATAN"  value="<?php echo $this->session->userdata("nama_jabatan"); ; ?>" />
	</p>
        <p>	
            <?php echo form_label("Biro/Unit *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_KANTOR" value="<?php echo $this->session->userdata("nama_kantor"); ; ?>" />
	</p>
    	<p>	
            <?php echo form_label("NAMA PEKERJAAN *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="JUDUL_PEKERJAAN" name="JUDUL_PEKERJAAN" value="" /><button type="button" id="btnPerencanaan" >...</button>
	</p>
        <p>	
            <?php echo form_label("DISKRIPSI PEKERJAAN *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"  id="LINGKUP_PEKERJAAN" name="LINGKUP_PEKERJAAN" value="" /> 
	</p>
    
        <p>	
            <?php echo form_label("JENIS KONTRAK *") ?>
            <select name="TIPE_KONTRAK" class="{validate:{required:true}}" >
                <?php
                   echo "<option value='' >-- Pilih Jenis Kontrak --</option>";
                 
                foreach($arr_tipekontrak as $k=>$v) {
                    echo "<option value='" .$k. "' >".$v."</option>";
                   
                }
                 
                ?>
            </select>
        </p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" VALUE="<?php echo $this->session->userdata("kode_kantor") ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER_PERMINTAAN" value="0"    />
        <input type="hidden" name="KODE_JABATAN" id="KODE_JABATAN" VALUE="<?php echo $this->session->userdata("kode_jabatan") ; ?>"  />
        <input type="hidden" name="KODE_PERENCANAAN" id="KODE_PERENCANAAN"  />
        <input type="hidden" name="KODE_KANTOR_PERENCANAAN" id="KODE_KANTOR_PERENCANAAN"  />
        
      </form>
   </fieldset>     
          </div>
<h3 href="">MATA ANGGARAN</h3>
            <div>
                
                <div id="list_perencanaan_anggaran" ></div>      
          </div>
<h3 href="">LAMPIRAN DOKUMEN</h3>
            <div>
          </div>
<h3 href="">ITEM</h3>
            <div>
       <fieldset class="ui-widget-content">
      <form id="frmBarangJasa" method="POST" action="add_item_tender" >            
    	<p>	
            <?php echo form_label("Kode *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KODE_BARANG_JASA" name="KODE_BARANG_JASA" value="" /><button type="button" id="btnBarangJasa" >...</button>
	</p>   
        <p>	
            <?php echo form_label("Sub Barang/Jasa *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KODE_SUB_BARANG_JASA" name="KODE_SUB_BARANG_JASA" value="" />
	</p>   
        <p>	
            <?php echo form_label("Deskripsi *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KETERANGAN" name="KETERANGAN" value="" />
	</p>   
        <p>	
            <?php echo form_label("Jumlah *") ?>
	    <input type="text"   class="{validate:{required:true}}"   id="JUMLAH" name="JUMLAH" value="" />
	</p>   
        <p>	
            <?php echo form_label("Unit") ?>
	    <input type="text"     id="UNIT" name="UNIT" value="" />
	</p>
        <p>	
            <?php echo form_label("Harga *") ?>
	    <input type="text"   class="{validate:{required:true}}"   id="HARGA" name="HARGA" value="" />
	</p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $this->session->userdata("kode_kantor") ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"    />
        
        <button type="button"  id="btnAddBarangJasa" >Tambah</button>
        <button type="button"  id="btnResetBarangJasa" >Kosongkan</button>
        
        
        
      </form>
           </fieldset>     
                
                <div id="list_itemtender"></div>  
          </div>

<div id="trace" ></div> 
</div>
 <div class="accordion">
 
            <h3 href="">KOMENTAR</h3>
            <div   >
			<fieldset>
			<form id="frmKomentar" action="<?php echo base_url() . "index.php/pgd/komentar_tender/update" ?>"  method="POST" >
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
<input type="hidden" id="KODE_TENDER_KOMENTAR"  name="KODE_TENDER" /> 			
			
<input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
			</fieldset>
<br/> 
<button type="button" id="btnSubmit"   >Submit</button>
<button type="button" id="btnCancel"    >Cancel</button> 
<div id="trace" > </div>  
 </div>



<script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
   var kode_tender = 0;     
   var count_item_tender = 0;
        var validatorPermintaan = $("#frmPermintaan").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        var validatorKomentar = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
     
     $("#btnSubmit").click(function(){ 
        $.ajax({
        type: "POST",
        data : "KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>",
        url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
        success : function(msg) {
                 SetCountItemTender(msg);
                  
                 
            	 if(validatorKomentar.form()) {
                    $("#frmKomentar").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                      alert(msg);
                                      $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                   
                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 } 
          
          
        } ,
        error : function() {
            alert("Data Pengadaan Belum Lengkap");
            
        }
        
        
      }); 
        
        
        
     });
     
     
        var validatorBarangJasa = $("#frmBarangJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
        $("#btnAddBarangJasa").click(function() {
            // alert(kode_tender);
            if (kode_tender == 0) {
                //alert("Header Tender Belum Tersimpan");
                            fnHeaderSubmit();
             // alert(kode_tender);
                if (kode_tender > 0) {
             
                strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                           //alert(strurl);
                           fnShowItemTender(strurl); 
                  }         
                return;
                
            } else  {
            
           //  $("#KODE_TENDER").val(kode_tender);
            // alert($("#KODE_TENDER").val());
            
            	 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                      //alert(msg);
                                      $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    if (msg>0) {
                                         strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                                        // alert(strurl);
                                         fnShowItemTender(strurl); 
     
                                        
                                    }
                                    

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
            }     
        });
        
        $("#btnResetBarangJasa").click(function() {
            	$('#frmBarangJasa')[0].reset();
            
        
        });
        
	$("#btnPerencanaan").click(function() {
		 
		str= "";
		jQuery('#modal_form_perencanaan')
                     .load($site_url + '/pgd/perencanaan_get' + str)
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
                    jQuery('#modal_form_perencanaan').dialog("open");
					
	});
        
            
        $("#btnBarangJasa").click(function() {
        
		str= "";
		jQuery('#modal_form_barangjasa')
                     .load($site_url + '/pgd/barang_jasa_get' + str)
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
            jQuery('#modal_form_barangjasa').dialog("open");
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
	 
/*	
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
*/	

 function SetCountItemTender(cnt) {
     
     count_item_tender = cnt;
 }

 function SetKodeTender(str) {
     
     kode_tender = str;
     $("#KODE_TENDER_PERMINTAAN").val(str);
     $("#KODE_TENDER").val(str);
     $("#KODE_TENDER_KOMENTAR").val(str);
      
    // alert($("#KODE_TENDER_KOMENTAR").val());
    // alert(kode_tender);
     
 }		
                 
 function fnHeaderSubmit() {
     if(validatorPermintaan.form()) {
         $("#frmPermintaan").ajaxSubmit({
            //clearForm: false,
            success: function(msg){
                   alert("KODE_TENDER:" + msg);
                $("#trace").html(msg);
                 SetKodeTender(msg);  
                  
                   //  alert($("#KODE_TENDER").val());

                 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                      //alert(msg);
                                      $("#trace").html(msg);
                                  //  alert(msg);
                                    //reload grid
                                    
                                    strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                           //alert(strurl);
                           fnShowItemTender(strurl); 

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
                //reload grid

            },
            error: function(){
                alert('Data gagal disimpan')
            }
        });
         
     }
     
 }
 
	 });
 
 
 function fnShowItemTender(strurl) {
     var uri = strurl + "&r=" + Math.random();
                  //  alert(uri);
                     
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list_itemtender") ;
                        
                    //    alert(ctn);
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.html('');

                            ctn.load(uri);
                    }
                         
     
 }

 
	 

 
 function fnShowMataAnggaran(strurl) {
     var uri = strurl + "&r=" + Math.random();
                 //   alert(uri);
                     
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list_perencanaan_anggaran") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.html('');

                            ctn.load(uri);
                    }
                         
     
 }
 
 
 function fnPerencanaan( arr) {
     
    // alert(arr);
     
     $("#KODE_PERENCANAAN").val(arr[0]);
     $("#KODE_KANTOR_PERENCANAAN").val(arr[1]);
     $("#JUDUL_PEKERJAAN").val(arr[2]);
     $("#LINGKUP_PEKERJAAN").val(arr[3]);
     
     strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran?KODE_PERENCANAAN=" + arr[0] + "&KODE_KANTOR_PERENCANAAN=" + arr[1];
     fnShowMataAnggaran(strurl);
     $('#modal_form_perencanaan').dialog("close");
     
     
 }        
 
 function fnBarangJasa(arr){
     
     $("#KODE_BARANG_JASA").val(arr[0]);
     $("#KODE_SUB_BARANG_JASA").val(arr[1]);
     $("#KETERANGAN").val(arr[2]);
     jQuery('#modal_form_barangjasa').dialog("close");
     
     
     
     
     
 }
 
 
</script>   	 			