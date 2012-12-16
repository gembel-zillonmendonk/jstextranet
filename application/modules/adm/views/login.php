
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>Selamat Datang di e-Procurement</title>
	        <link href="<?php echo base_url('css/format.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/text.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('css/data.css') ?>" rel="stylesheet" type="text/css"/>
 
	 
</head>
<body onload="document.getElementById('txtUserName').focus();" leftmargin="0" topmargin="0"
    marginwidth="0" marginheight="0">
    <form id="form1" runat="server" action="<?php echo base_url()  . "index.php/adm/app/login"; ?>" method="get" >
         <table class="table_main_container" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table_band">
                    <table class="table_band_container" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="txt_logged">
                                &nbsp;</td>
                            <td class="txt_date">
                                <asp:Label runat="server" ID="lblDate"></asp:Label></td>
                            <td class="tools_container">
                                &nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="login_table_header">
                   <div class="login_iproc_logo">&nbsp;</div>
                </td>
            </tr>
            <tr>
                <td class="table_menu_container">
                    <table width="600" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="login_menu_l">
                                &nbsp;</td>
                            <td class="login_menu_c">
                                <div class="login_mid">
                                    &nbsp;</div>
                            </td>
                            <td class="login_menu_r">
                                &nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_content_container">
                    <table align="center" class="login_table_content" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="170" align="center" >
                                <div  style="align:center" >
                                             <table  border="0" align="center"  cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="125" class="txt_label">
                                                        User Name</td>
                                                    <td width="225">
                                                        <input type="text" name="textfield" id="txtUserName" runat="server" style="width: 200px"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        &nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="txt_label">
                                                        Password</td>
                                                    <td>
                                                        <input type="password" name="textfield2" id="txtPassword" style="width: 200px" runat="server"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        &nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="center">
                                                        <input type="submit" name="Submit" value="Login" style="width: 60px" id="btnLogin"
                                                            class="frm_butt" runat="server"></td>
                                                </tr>
                                                 
                                                <tr>
                                                    <td colspan="2" class="txt_note">
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                 
                                            </table>
                                         
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" valign="top">
                                <div class="login_end">
                                    <div class="login_grey_crn_l">
                                        &nbsp;</div>
                                    <div class="login_grey_crn_r">
                                        &nbsp;</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td height="100%" align="center" valign="bottom">
                                <div class="login_iproc_logop">
                                    &nbsp;</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_ornament">
                    <table width="600" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="table_orn_purple">
                                <img src="images/blank.gif" width="10" height="5"></td>
                            <td class="table_orn_green">
                                <img src="images/blank.gif" width="10" height="5"></td>
                            <td class="table_orn_orange">
                                <img src="images/blank.gif" width="10" height="5"></td>
                            <td class="table_orn_blue">
                                <img src="images/blank.gif" width="10" height="5"></td>
                            <td class="table_orn_yl_green">
                                <img src="images/blank.gif" width="10" height="5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="table_footer">
                    © 2009 Copyright <b>PT. ADW</b> - All Right Reserved</td>
            </tr>
            <tr>
                <td class="table_end">
                    <img src="images/blank.gif" width="995" height="1"></td>
            </tr>
        </table>
    </form>
</body>
</html>
