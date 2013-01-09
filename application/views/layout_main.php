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
                
                $('input[type=text],textarea').live('keyup',function() {
                    $(this).val($(this).val().toUpperCase());
                });
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
        <table class="table_main_container" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table_band">
                    <table class="table_band_container" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="txt_logged">Anda Masuk Sebagai : <span class="txt_orange"><?php echo $this->session->userdata("nama_vendor"); ?></span></td>
                            <td class="txt_date">
                                <?php echo date("l, d F Y") ?>
                                <?php 
//                                    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
//                                    /* Output: vrijdag 22 december 1978 */
//                                    echo strftime("%A %e %B %Y"); 
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
                                <ul class="sf-menu">
                                    <li><a href="<?php echo site_url('/home') ?>">HOME</a>

                                    </li>
                                    <li><a href="#">MANAJEMEN PENGADAAN</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('/pengadaan/daftar_pekerjaan') ?>">Daftar Pekerjaan</a></li>
                                            <li><a href="<?php echo site_url('/pengadaan/monitor') ?>">Monitor Pengadaan</a></li>
                                            <li><a href="<?php echo site_url('/crud/form/ep_pgd_sanggahan') ?>">Mengajukan Sanggahan</a></li>
                                            <li><a href="<?php echo site_url('/crud/view_grid/ep_pgd_monitor_sanggahan') ?>">Monitor Sanggahan</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">MANAJEMEN KONTRAK</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('/contract/contract/todo') ?>">Daftar Pekerjaan</a></li>
                                            <li><a href="<?php echo site_url('/contract/contract/monitoring') ?>">Monitor Kontrak</a></li>
                                            <li><a href="<?php echo site_url('/contract/ammend/monitoring') ?>">Monitor Adendum Kontrak</a></li>
                                            
                                            
                                            <li><a href="<?php echo site_url('/contract/ammend/create_draft') ?>">Membuat Permohonan Adendum Kontrak</a></li>
                                            
                                            <li><a href="<?php echo site_url('/contract/po/list_todo') ?>">Update Progress Work Order</a></li>
                                            <li><a href="<?php echo site_url('/contract/milestone/list_todo') ?>">Update Progress Milestone</a></li>
<!--                                            <li><a href="<?php echo site_url('/contract/grid') ?>">Update Progress Termin Pembayaran</a></li>-->
                                            <li><a href="<?php echo site_url('/contract/po/monitoring') ?>">Monitor Progress Work Order</a></li>
                                            <li><a href="<?php echo site_url('/contract/milestone/monitoring') ?>">Monitor Progress Milestone</a></li>
<!--                                            <li><a href="<?php echo site_url('/contract/grid') ?>">Monitor Progress Termin Pembayaran</a></li>-->
                                            <li><a href="<?php echo site_url('/contract/grid/invoice.list_for_invoice') ?>">Membuat Tagihan</a></li>
                                            <li><a href="<?php echo site_url('/contract/invoice/monitoring') ?>">Monitor Tagihan</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">PROFIL VENDOR</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('/vendor/view') ?>">Lihat Profil</a></li>
                                            <li><a href="<?php echo site_url('/vendor/update') ?>">Update Profil</a></li>
                                            <li><a href="<?php echo site_url('/vendor/monitor_update') ?>">Monitor Update Profil</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">PERTOLONGAN</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('/crud/grid') ?>">Fitur Aplikasi</a></li>
                                            <li><a href="<?php echo site_url('/crud/grid') ?>">Registrasi Vendor</a></li>
                                            <li><a href="<?php echo site_url('/crud/grid') ?>">Transaksi Vendor</a></li>
                                        </ul>                                        
                                    </li>
<!--                                    <li><a href="#">MANAJEMEN VENDOR</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('/crud/grid') ?>">Daftar Pekerjaan</a></li>
                                            <li><a href="#">Tools Vendor</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Perbaharui Nomor SMK</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Pengaktifan Vendor</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Daftar Vendor</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Daftar Semua Vendor</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Hasilkan Daftar Penawar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Penetapan Vendor</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Registrasi Baru</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Masukan Informasi Baru</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Kinerja Vendor</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Daftar Kinerja Vendor</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Pengaktifan Suspended Vendor</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Suspend Vendor</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Panduan Vendor</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Pendahuluan</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Fitur Aplikasi</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Panduan Registrasi Vendor</a></li>
                                                    <li><a href="<?php echo site_url('/crud/grid') ?>">Panduan Manajemen Vendor</a></li>
                                                <ul>
                                            </li>
                                        </ul>                                        
                                    </li>-->
                                </ul>
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



                                            <?php echo $content_for_layout ?>

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
</script>
