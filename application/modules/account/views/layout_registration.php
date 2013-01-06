<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>iPROC - Aplikasi e-Procurement Terintegrasi</title>

        <link href="<?php echo base_url('css/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/custom-theme/jquery-ui-1.8.23.custom.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/ui.jqform.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/superfish.css') ?>" rel="stylesheet" media="screen" /> 
        <link href="<?php echo base_url('css/format.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/text.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/data.css') ?>" rel="stylesheet" type="text/css"/>


        <link href="<?php echo base_url('css/grid/css/960.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/ui.jqgrid.css') ?>" rel="stylesheet" type="text/css" />

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
            $.validator.messages.required = "Field tidak boleh kosong!";
            $.validator.setDefaults({
                highlight: function(el, error, valid){ 
                    $(el).closest('.control-group').addClass('error'); 
                },
                success: function(label) {
                    label
                    .text('OK!').addClass('valid')
                    .closest('.control-group').addClass('success');
                }
            });
            
        </script>
    </head>

    <body>
        <table class="table_main_container" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table_band">
                    <table class="table_band_container" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="txt_logged">&nbsp;</td>
                            <td class="txt_date">
                                <?php echo date("l, d F Y") ?>
                                <?php 
                                    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                                    /* Output: vrijdag 22 december 1978 */
                                    echo strftime("%A %e %B %Y"); 
                                ?>
                            </td>
                            <td class="tools_container">&nbsp;</td>
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
                <td class="form_menu_container">
                    <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="form_menu_grey_l">&nbsp;</td>
                            <td class="form_menu_c">
                                <div class="form_mid" style="width: 100%">&nbsp;</div>
                            </td>
                            <td class="form_menu_grey_r">&nbsp;</td>
                        </tr>
                    </table>		
                </td>
            </tr>
            <tr>
                <td class="table_content_container">
                    <table class="table_content" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td class="table_of_contents">


                                <div class="accordion">
                                    <h3 href="#">REGISTRASI ONLINE E-PROCUREMENT</h3>
                                    <div>
                                        <?php $this->load->helper('form'); ?>
                                        <?php echo form_open(site_url('/account/registration'), 'id=form-registration class=form-horizontal'); ?>
<!--                                        <fieldset class="ui-widget-content" style="border:0;width:40%;float:left">-->
                                        <fieldset class="ui-widget-content" style="border:0">
                                            <legend>Fields with remark (*) is required.</legend>
                                            <p>
                                                <?php echo form_label("USERNAME *", "id_kode_login") ?>
                                                <?php echo form_input("EP_VENDOR[KODE_LOGIN]", '', 'id="id_kode_login" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>
                                            <p>
                                                <?php echo form_label("PASSWORD *", "id_passwrd") ?>
                                                <?php echo form_password("EP_VENDOR[PASSWRD]", '', 'id="id_passwrd" class="{validate:{required:true,minlength:6,maxlength:255}}"'); ?>
                                            </p>
                                            <p>
                                                <?php echo form_label("ALAMAT EMAIL *", "id_alamat_email") ?>
                                                <?php echo form_input("EP_VENDOR[ALAMAT_EMAIL]", '', 'id="id_alamat_email" class="{validate:{required:true,email:true,maxlength:255}}"'); ?>
                                            </p>
                                        </fieldset>
<!--                                        <fieldset class="ui-widget-content" style="border:0;width:50%;margin:0 50%;">

                                            <p>
                                                <?php echo form_label("AWALAN *", "id_awalan") ?>
                                                <?php echo form_dropdown("EP_VENDOR[AWALAN]", array('PT'=>'PT', 'CV'=>'CV','LAINNYA'=>'LAINNYA'), '', 'id="id_awalan" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>
                                            <p>
                                                <?php echo form_label("AWALAN LAIN *", "id_awalan_lain") ?>
                                                <?php echo form_input("EP_VENDOR[AWALAN_LAIN]", '', 'id="id_awalan_lain" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>
                                            <p>
                                                <?php echo form_label("NAMA VENDOR *", "id_nama_vendor") ?>
                                                <?php echo form_input("EP_VENDOR[NAMA_VENDOR]", '', 'id="id_nama_vendor" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>
                                            <p>
                                                <?php echo form_label("AKHIRAN *", "id_akhiran") ?>
                                                <?php echo form_dropdown("EP_VENDOR[AKHIRAN]", array('TBK'=>'TBK', 'GMBH'=>'GMBH', 'NV'=>'NV', 'BV'=>'BV', 'BHD'=>'BHD', 'PTE'=>'PTE', 'LTD'=>'LTD', 'LAINNYA'=>'LAINNYA'),'', 'id="id_akhiran" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>

                                            <p>
                                                <?php echo form_label("AKHIRAN LAIN *", "id_akhiran_lain") ?>
                                                <?php echo form_input("EP_VENDOR[AKHIRAN_LAIN]", '', 'id="id_akhiran_lain" class="{validate:{required:true,maxlength:255}}"'); ?>
                                            </p>
                                        </fieldset>-->
                                        <p>
                                            <button type="button" id="btnSimpan">SIMPAN</button>
                                            <button type="button" id="btnBatal">BATAL</button>
                                        </p>
                                        <script>
                                            $(document).ready(function(){
                                                // stylish button and input date
                                                $(function() {
                                                    $( "input:submit, button").button();
                                                    $( ".datepicker" ).datepicker();
                                                    //$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            
                                                });
        
                                                var validator = $("#form-registration").validate({
                                                    meta: "validate",
                                                    submitHandler: function(form) {
                                                        jQuery(form).ajaxSubmit();
                                                    }
                                                });
        
                                                // attach event to button
                                                $("#form-registration #btnSimpan").click(function() {
                                                    if(validator.form()) {
                                                        jQuery("#form-registration").ajaxSubmit({
                                                            clearForm: false,
                                                            success: function(data){
//                                                                alert(data);
                                                                alert('User berhasil dibuat');
                                                                document.location = '<?php echo site_url('/account/login'); ?>';
                                                            },
                                                            error: function(){
                                                                alert('Data gagal disimpan')
                                                            }
                                                        });
                                                    }
                                                });
            
                                                $("#form-registration #btnBatal").click(function() {
                                                    $("#form-registration").resetForm();
                                                    validator.prepareForm();
                                                    validator.hideErrors();
                                                });
                                            });
        
                                        </script>
                                        </form>   

                                    </div>
                                </div>
                                <script>
                                    
                                    $(".accordion").each(function(){
                                        //alert("test");
                
                                        $('h3', $(this)).each(function(){
                                            var uri = $(this).attr('href');
                                            if(uri != '' && uri != '#'){
                                                var ctn = $(this).next();
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
                                    //.css("width", "auto");
                                    
                                </script>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_ornament">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="table_orn_purple"><img src="<?php echo base_url('/images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_green"><img src="<?php echo base_url('/images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_orange"><img src="<?php echo base_url('/images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_blue"><img src="<?php echo base_url('/images/blank.gif') ?>" width="10" height="5"></td>
                            <td class="table_orn_yl_green"><img src="<?php echo base_url('/images/blank.gif') ?>" width="10" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_footer">© 2008 Copyright <b>ADW Consulting</b> - All Right Reserved</td>
            </tr>
            <tr>
                <td class="table_end"><img src="<?php echo base_url('/images/blank.gif') ?>" width="995" height="1"></td>
            </tr>
        </table>
    </body>
</html>
<script>
    $(function() {
        $( "input:submit, input:button").button();
        $( ".datepicker" ).datepicker();
    });
</script>