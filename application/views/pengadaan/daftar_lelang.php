<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Selamat Datang di iPROC - Aplikasi e-Procurement Terintegrasi</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url('css/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/custom-theme/jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/ui.jqgrid.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/ui.jqform.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/superfish.css') ?>" rel="stylesheet" media="screen" /> 
        <link href="<?php echo base_url('css/format.css') ?>" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url('css/text.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/data.css') ?>" rel="stylesheet" type="text/css"/>

        <script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.0.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/i18n/grid.locale-en.js') ?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.jqGrid.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.23.custom.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.form.js') ?>"></script>         

        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js') ?>"></script>         
        <script type="text/javascript" src="<?php echo base_url('js/jquery.metadata.js') ?>"></script>         
        <script type="text/javascript">
            $.jgrid.no_legacy_api = true;
            $.jgrid.useJSON = true;
            $.datepicker.setDefaults({
                showOn: 'both',
                buttonImageOnly: true,
                buttonImage: '<?php echo base_url('images/Calendar_scheduleHS.png') ?>',
                buttonText: 'Calendar',
                dateFormat: "yy-mm-dd",
                readOnly: true,
                defaultDate: $('.datepicker').val()
            });
        </script>

        <script type="text/javascript" src="<?php echo base_url('js/hoverIntent.js') ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('js/superfish.js') ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('js/supersubs.js') ?>"></script> 
        <script>  
            $(document).ready(function() { 
                $('ul.sf-menu').supersubs({ 
                    minWidth:    12,   // minimum width of sub-menus in em units 
                    maxWidth:    27,   // maximum width of sub-menus in em units 
                    extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                    // due to slight rounding differences and font-family 
                }).superfish(); 
                /*
                $('input[type=text],textarea').live('keyup',function() {
                    $(this).val($(this).val().toUpperCase());
                });
                */
            }); 

        </script>
        <script type="text/javascript">
            var $base_url = '<?php echo base_url() ?>';
            var $site_url = '<?php echo site_url() ?>';
            var $images_url = $base_url + '/images/';
            var $js_url = $base_url + '/js/';
            var $css_url = $base_url + '/css/';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/stmenu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/swap.js') ?>"></script>
    </head>

    <body onLoad="MM_preloadImages('<?php echo base_url('images/pass_on.png') ?>','<?php echo base_url('images/logout_on.png') ?>','<?php echo base_url('images/delg_on.png') ?>')">
        <div id="modal_form_login" ></div>
        <table class="table_main_container" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table_band">
                    <table class="table_band_container" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="txt_logged"><span class="txt_orange"><?php // echo $this->session->userdata("nama_vendor"); ?></span></td>
                            <td class="txt_date">
                                <?php // echo date("l, d F Y") ?>
                                <?php 
                                    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                                    /* Output: vrijdag 22 december 1978 */
                                    echo strftime("%A %e %B %Y"); 
                                ?>
                            </td>
                            <td class="tools_container">
                                <div class="tools_item"><a href="<?php echo site_url('/account/logout') ?>"><img src="<?php echo base_url('images/logout.png') ?>" alt="Keluar Aplikasi" name="logout" width="20" height="18" border="0" id="logout" onMouseOver="MM_swapImage('logout','','<?php echo base_url('images/logout_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>
                                <div class="tools_item"><a href="<?php echo site_url('/account/change_password') ?>"><img src="<?php echo base_url('images/pass.png') ?>" alt="Rubah Password" name="chg_pass" width="20" height="18" border="0" id="chg_pass" onMouseOver="MM_swapImage('chg_pass','','<?php echo base_url('images/pass_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>
<!--                                <div class="tools_item"><a href="<?php echo site_url('/account/logout') ?>"><img src="<?php echo base_url('images/delg.png') ?>" alt="Pendelegasian User" name="delg" width="20" height="18" border="0" id="delg" onMouseOver="MM_swapImage('delg','','<?php echo base_url('images/delg_on.png') ?>',1)" onMouseOut="MM_swapImgRestore()"></a></div>-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_header">
                    <div class="iproc_logo">&nbsp;</div>
                    <div class="j_logo"><div class="j_logo_l">&nbsp;</div></div>
                </td>
            </tr>
            <tr>
                <td class="table_menu_container">
                    <div class="menu_bg">
                        <div class="menu_l">&nbsp;</div>
                        <div class="menu_r">&nbsp;</div>
                        <div class="menu_c">
                            <div class="mn_item_container">
      
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table_content_container">
                    <table class="table_content" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="brcrumbs_link">Anda berada di sini : <span class="txt_blue">Home</span></td>
                        </tr>
                        <tr>
                            <td class="table_of_contents"  >
                                <table border="0" cellpadding="0" cellspacing="0" style="width: 97%">
                                    <tr>
                                        <td valign="top" style="height: 100%">


                                            <div id="error-box" class="ui-state-error ui-corner-all" style="padding: 0 .7em;margin-bottom: 0.7em;display:none;"> 
                                                <p>
                                                    <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
                                                    <strong>ERROR</strong>
                                                </p>
                                            </div>

                                            <div class="accordion">
                                                    <h3 href="">FILTER</h3>
                                                    <div>
                                                        <fieldset class="ui-widget-content">
                                                        <legend>Pencarian</legend>
                                                                        <form id="frmSearch" method="POST" action="" >

                                                                        <div id="mysearch"></div>

                                                                        <p>
                                                                                <label>CARI BERDASARKAN</label>
                                                                                        <select  id="kolom" name="kolom"  > 
                                                                                            <option <?php echo ($kolom == "KODE_TENDER" ? " SELECTED " : ""); ?>  Value="KODE_TENDER">NOMOR PENGADAAN</option>
                                                                                            <option <?php echo ($kolom == "JUDUL_PEKERJAAN" ? " SELECTED " : ""); ?> Value="JUDUL_PEKERJAAN">JUDUL PEKERJAAN</option>
                                                                                        </select>    
                                                                                <input type="text" id="cari" name="cari" value="<?php echo $cari; ?>" />
                                                                                <button type="button" id="btnSrc"  >Cari</button> 
                                                                        </p>
                                                                        </form>
                                                         </fieldset>                   

                                                        <div id="list"></div>
                                                    </div>

                                             <div class="accordion">
            <h3 href="">PENGUMUMAN PENGADAAN</h3>
            <div>
                <div id="modal_form_viewmonitor" ></div>
                 <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Nomor Pengadaan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 35%; height: 30px" >Nama Pekerjaan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 15%; height: 30px" >Pembukaan Pendaftaran</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 15%; height: 30px" >Penutupan Pendaftaran</th>  
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >&nbsp;</th>  
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >&nbsp;</th>  
          </tr>
          <?php
          $i=1;
          foreach($rslelang as $row) {
          ?>
                     
                     
           <tr>
              <td style="height: 20px" align="center"  ><?php echo $i; ?></td>
              <td   align="center"  ><?php echo $row->KODE_TENDER; ?></td>
              <td  ><?php echo $row->JUDUL_PEKERJAAN; ?></td>
              <td   align="center" ><?php echo $row->TGL_PEMBUKAAN_REG; ?></td>
              <td   align="center" ><?php echo $row->TGL_PENUTUPAN_REG; ?></td>
              <td   align="center" ><button type="button" onclick="fnPendaftaran('<?php echo $row->KODE_TENDER; ?>','<?php echo $row->KODE_KANTOR; ?>')" >DAFTAR</button> </td>
              <td   align="center" ><button type="button" onclick="fnViewMonitor('<?php echo $row->KODE_TENDER; ?>','<?php echo $row->KODE_KANTOR; ?>')" >LIHAT</button> </td>
           </tr>
           <?php
          }
           ?>
            
      </table>
     
            </div>
            
            <h3 href="">DAFTAR HISTORY LELANG</h3>
    <div>
                <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Nomor Pengadaan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 35%; height: 30px" >Nama Pekerjaan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 15%; height: 30px" >Pembukaan Pendaftaran</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 15%; height: 30px" >Penutupan Pendaftaran</th>  
           
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Status</th>  
           
          </tr>
          <?php
          $i=1;
          foreach($rslelanghis as $row) {
          ?>
                     
                     
           <tr>
              <td style="height: 20px" align="center"  ><?php echo $i; ?></td>
              <td   align="center"  ><?php echo $row->KODE_TENDER; ?></td>
              <td  ><?php echo $row->JUDUL_PEKERJAAN; ?></td>
              <td   align="center" ><?php echo $row->TGL_PEMBUKAAN_REG; ?></td>
              <td   align="center" ><?php echo $row->TGL_PENUTUPAN_REG; ?></td>
              <td   align="center" ><?php echo $row->NAMA_AKTIFITAS; ?></td>
     <!--
              <td   align="center" ><button type="button" onclick="fnViewMonitor('<?php echo $row->KODE_TENDER; ?>','<?php echo $row->KODE_KANTOR; ?>')" >LIHAT</button> </td>
     -->
     </tr>
           <?php
           $i++;
           
          }
           ?>
            
      </table>
          
        
    </div>    
                    


                                            
                                            
                                            </div>

                                            
                                        </td>
                                    </tr>	
                                </table>	 

                            </td>
                        </tr>
                        <tr>
                            <td class="table_iproc_logo">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_ornament">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="table_orn_purple"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_green"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_orange"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_blue"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_yl_green"><img src="<?php echo base_url('images/blank.gif') ?>" width="10" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_footer">© 2012 Copyright <b>ADW Consulting</b> - All Right Reserved</td>
            </tr>
            <tr>
                <td class="table_end">>&nbsp;</td>
            </tr>
        </table>
    </body>
</html>
<script>
    $(function() {
        $( "input:submit, input:button").button();
        $( ".datepicker" ).datepicker();
    });
    
    function fnPendaftaran (kode_tender, kode_kantor) {
        
        str = "KODE_TENDER=" + kode_tender;
        str += "&KODE_KANTOR=" + kode_kantor;
        jQuery('#modal_form_login')
                     .load($site_url + '/account/login_lelang?' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:400,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "LOGIN": function() { 
                                 
                                $("#frmLoginLelang").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       if (msg != "0") {
                                           window.location =  "<?php echo base_url(); ?>index.php/pengadaan/pendaftaran?" + msg;
                                       } else {
                                           jQuery('#modal_form_login').dialog("close");
                                       } 
 
                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });
                                
                                
                            },
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_login').dialog("open");
        
    }
    
</script>


 
<script>


    $(document).ready(function(){
        
    
	$("#btnSrc").click(function() {
             
            $("#frmSearch").submit();
            
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
    //.css("width", "auto");
        
        
    $('.accordion h3').each(function(){
            
        var uri = $(this).attr('href');
        if(uri != '' && uri != '#'){
          
           var ctn =  $(this).next().children("#list");  
            //alert($(ctn).width());
                
            if(ctn.html() == '')
                ctn.load(uri);
        }
    });
    
    });
    
    function fnProsesPekerjaan(str){
      
        
        	 $('#grid_ep_pgd_pekerjaan').jqGrid('setSelection',str); 
		 var selected = $('#grid_ep_pgd_pekerjaan').jqGrid('getGridParam', 'selrow');
		 
                 //alert(selected);
                 if (selected) {
                    selected = jQuery('#grid_ep_pgd_pekerjaan').jqGrid('getRowData',selected);
 
		   
		   var keys = <?php echo json_encode(Array ( 0  => "KODE_KOMENTAR" )); ?>;
		   
		 // alert(selected["KODE_KOMENTAR"]);
                    var count = 0;
                
                    var data = {};
                    var str = "KODE_TENDER=" + selected["KODE_TENDER"] ;
                     str += "&KODE_KANTOR=" +  selected["KODE_KANTOR"] ;
                    
                    
                    /*
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    */
		}			
		 
		   window.location = "<?php echo base_url() . "index.php/pengadaan/pekerjaan"; ?>?" + str;
	
        
    }
    
    
        function  fnViewMonitor(KODE_TENDER, KODE_KANTOR) { 
             
		str= "";
		jQuery('#modal_form_viewmonitor')
                     .load($site_url + '/pengadaan_x/view_popup?KODE_TENDER=' + KODE_TENDER + '&KODE_KANTOR=' + KODE_KANTOR  )
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        height: 600,
                        width:1000,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_viewmonitor').dialog("open");
        } 
        
   
    
</script>

     