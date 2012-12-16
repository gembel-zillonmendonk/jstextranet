
        
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
<input type="hidden" name="KODE_TENDER" id="KODE_TENDER" value="<?php echo $kode_tender ; ?>" />
<input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" value="<?php echo $kode_kantor ; ?>" />						
<input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
			</fieldset>
<br/> 
<button type="button" id="btnSubmit"   >Submit</button>
<button type="button" id="btnCancel"    >Cancel</button> 
<div id="trace" ><div>
  </div>
  <script>
     tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
        
    $(document).ready(function(){


        var validatorKomentar = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });


        $("#btnSubmit").click(function(){ 
            alert("btnSubmit");
            
             $('#komentar').val(tinyMCE.get('commentar').getContent());

            
                  $.ajax({
        type: "POST",
        data : "KODE_TENDER=<?php echo $this->input->get("KODE_TENDER"); ?>&KODE_KANTOR=<?php echo $this->input->get("KODE_KANTOR"); ?>",
        url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
        success : function(msg) {
                   
                 
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
        
  

    });
        
 </script>           
 
