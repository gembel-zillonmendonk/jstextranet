<script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/adm/form/ep_kom_komentar_harga_barang">DAFTAR HARGA JASA YANG PERLU PERSETUJUAN</h3>
            <div>
			 
			
			
			<div id="list" ></div>
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
<div id="trace" > </div>  
 </div>

 </div> 	
 <script>
   
    tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
 
  
  $(document).ready(function(){
 
        var validator = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

        $("#btnSubmit").click(function(){


                 $('#komentar').val(tinyMCE.get('commentar').getContent());

                 if(validator.form()) {


                         jQuery("#frmKomentar").ajaxSubmit({
                            //clearForm: false,
                            success: function(msg){

                                                 alert(msg);

                                                $("#trace").html(msg) ;	


                                //reload grid

                            },
                            error: function(){
                                alert('Data gagal disimpan')
                            }
                        });
                   	}
    });

      	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
				//	alert(uri);
                    if(uri != '' && uri != '#'){
                       // var ctn = $("#list") ;
						var ctn =  $(this).next().children("#list");   

					 			
					   //alert($(ctn).width());
                        //alert(uri);
                        // if(ctn.html() == '')
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