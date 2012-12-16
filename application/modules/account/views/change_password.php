<div class="accordion">
    <h3 href="#">UPDATE EMAIL & PASSWORD</h3>
    <div>
        <?php $this->load->helper('form'); ?>
        <?php echo form_open(site_url('/account/change_password'), 'id=form-password class=form-horizontal'); ?>
        <fieldset class="ui-widget-content" style="border:0;">
            <legend>Fields with remark (*) is required.</legend>
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
            <button type="button" id="btnSimpan">SIMPAN</button>
            <button type="button" id="btnBatal">BATAL</button>
        </p>
        <script>
            $(document).ready(function(){
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
                                    
                                    
                // stylish button and input date
                $(function() {
                    $( "input:submit, button").button();
                    $( ".datepicker" ).datepicker();
                    //$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            
                });
        
                var validator = $("#form-password").validate({
                    meta: "validate",
                    submitHandler: function(form) {
                        jQuery(form).ajaxSubmit();
                    }
                });
        
                // attach event to button
                $("#form-password #btnSimpan").click(function() {
                    if(validator.form()) {
                        jQuery("#form-password").ajaxSubmit({
                            clearForm: false,
                            success: function(data){
                                alert('Data berhasil disimpan');
                                document.location = '<?php echo site_url('/welcome'); ?>';
                            },
                            error: function(){
                                alert('Data gagal disimpan')
                            }
                        });
                    }
                });
            
                $("#form-password #btnBatal").click(function() {
                    $("#form-password").resetForm();
                    validator.prepareForm();
                    validator.hideErrors();
                });
            });
        
        </script>
        </form>   

    </div>
</div>