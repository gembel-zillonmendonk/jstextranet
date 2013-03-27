<div class="accordion">
    <h3 href="#">RESET PASSWORD</h3>
    <div>
        <?php $this->load->helper('form'); ?>
        <?php echo form_open(site_url('/account/reset_password'), 'id=form-password class=form-horizontal'); ?>
        <fieldset class="ui-widget-content" style="border:0;">
            <legend>Fields with remark (*) is required.</legend>
            <p>
                <?php echo form_label("KODE LOGIN *", "id_kode_login") ?>
                <?php echo form_input("EP_VENDOR[KODE_LOGIN]", '', 'id="id_kode_login" class="{validate:{required:true,maxlength:255}}"'); ?>
            </p>
            <p>
                <?php echo form_label("ALAMAT EMAIL *", "id_alamat_email") ?>
                <?php echo form_input("EP_VENDOR[ALAMAT_EMAIL]", '', 'id="id_alamat_email" class="{validate:{required:true,email:true,maxlength:255}}"'); ?>
            </p>
            <p>
                <?php echo form_label("PASSWORD *", "id_passwrd") ?>
                <?php echo form_password("EP_VENDOR[PASSWRD]", '', 'id="id_passwrd" class="{validate:{required:true,minlength:6,maxlength:255}}"'); ?>
            </p>
        </fieldset>
        <p>
            <!--<button type="button" id="btnSimpan">SIMPAN</button>-->
			<input type="submit" name="submit" value="SIMPAN" />
            <button type="button" id="btnBatal">BATAL</button>
        </p>
        
        </form>   

    </div>
</div>