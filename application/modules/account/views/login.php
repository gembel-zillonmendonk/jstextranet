<form action="<?php echo site_url('/account/login') ?>" method="POST">
    <table width="350" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="125" class="txt_label">User Name</td>
            <td width="225"><input type="text" name="username" id="textfield" style="width:200px"></td>
        </tr>
        <tr>
            <td class="txt_label">Password</td>
            <td><input type="password" name="password" id="textfield2" style="width:200px"></td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="padding-top: 5px; padding-bottom: 5px">
                <input type="submit" name="submit" id="button" style="width:100px" value="Login" class="frm_butt" onClick="location='home.htm'">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="txt_note">
                <p>Lupa password anda?<br>
                    Klik <a class="txt_blue" href="<?php echo site_url('/account/reset_password') ?>">disini</a> untuk me-reset
                    password anda...</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="txt_note">
                <p>Belum Terdaftar?<br>
                    Klik <a class="txt_blue" href="<?php echo site_url('/account/registration') ?>">disini</a> untuk Registrasi</p>
            </td>
        </tr>
    </table>
</form>