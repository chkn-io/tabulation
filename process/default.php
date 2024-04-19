<?php
/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Class defaults
 */
class defaults extends process_model{
    function start(){
        $def = '<div>

                </div>
                <div id="homepage">
                    <div class="col-md-12">
                        <div class="col-md-10">
                            <div id="response">';


        $def.='';
        if(SALT == 'ABCDEFGHIJ123456789abcdefghiklmn'){
            $def.='
                <div class="col-md-12" id="salt_error">
                <h3> <i class="fa fa-password"></i> Salt Status: Not yet change</h3>
                <p>To Change it, go to libs/Settings.php</p>
                </div>';
        }else{
            $def.='<div class="col-md-12" id="salt_success">
                <h3>  <i class="fa fa-user"> </i> Salt Status: Changed</h3>
                </div>';
        }

        $database_response = $this->check_db();
        if($database_response[0] == 'Database Connection Error'){
            $def.=
                '<div class="col-md-12" id="database_error">
                <h3><i class="fa fa-database"></i> Database Status: Not Found</h3>
                <p>You can use our default Database on public/data/sample.sql.</p>
                <br>
                <p>To fix this error, go to libs/Settings.php</p>
                </div>';
        }else{
            $def.=
                '<div class="col-md-12" id="database_success">
                <h3> <i class="fa fa-database"></i> Database Status: Ready</h3>
                </div>';
        }

        if(SMS_EMAIL == '' || SMS_PASSWORD == '' || DEVICE_ID == ''){
            $def.='
                <div class="col-md-12" id="sms_error">
                <h3>  <i class="fa fa-envelope"> </i> SMS Gateway Me Status: Not Ready</h3>
                <p>To Change it, go to libs/Settings.php</p>
                </div>';
        }else{
            $def.=
                '<div class="col-md-12" id="sms_success">
                <h3>  <i class="fa fa-envelope"> </i> SMS Gateway Me Status: Ready</h3>
                </div>';
        }

        if(SMTP_HOST == '' || SMTP_PORT == '' || SMTP_SECURE == '' || MAILER_USERNAME == '' || MAILER_PASSWORD == '' || MAILER_NAME == ''){
            $def.='
                <div class="col-md-12" id="mailer_error">
                <h3>  <i class="fa fa-mail-forward"></i> PHPMailer Status: Not Ready</h3>
                <p>To Change it, go to libs/Settings.php</p>
                </div>';
        }else{
            $def.= '
                <div class="col-md-12" id="mailer_success">
                <h3> <i class="fa fa-mail-forward"></i> PHPMailer Status: Ready</h3>
                </div>';
        }

        if(DEFAULT_SITE_KEY == '' || DEFAULT_SECRET_KEY == ''){
            $def.= '
                <div class="col-md-12" id="recaptcha_error">
                <h3><i class="fa fa-check-circle"></i> Recaptcha Status: Not Ready</h3>
                <p>Get your Site Key and Secret Key on <a href="https://www.google.com/recaptcha/admin" target="https://www.google.com/recaptcha/admin">Google Recaptcha</a> </p>
                <br>
                <p>To Change it, go to libs/Settings.php</p>
                </div>';
        }else{
            $def.= '
                <div class="col-md-12" id="recaptcha_success">
                <h3><i class="fa fa-check-circle"></i> Recaptcha Status: Ready</h3>';
        }


        $def.='</div>
        </div>
    </div>
</div>';

        return $def;

    }

}