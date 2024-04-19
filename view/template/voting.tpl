<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{DEFAULT_TITLE}</title>
    <link rel="icon" href="{DEFAULT_PATH}public/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>var default_url = "<?php echo {DEFAULT_PATH}?>"</script>


    <script src="{DEFAULT_PATH}public/default/default_js/jquery.min.js"></script>
    <script src="{DEFAULT_PATH}public/default/default_js/bootstrap.min.js"></script>
    <script src="{DEFAULT_PATH}public/default/default_js/loader.js"></script>

    {DEFAULT_STYLE}

    <style>
        
    </style>
</head>

<body style="background-image:url(public/images/background.jpg);background-position:center;background-size:cover;background-position:fixed;background-repeat:no-repeat;">
  <div id="loginbox" style="background-color:rgba(265,265,265,0.5);padding:10pt;">            
    <div id="loginform" class="form-vertical" action="index.html" style="background-color:rgba(0,0,0,.8);padding:10pt 10pt 30pt 10pt;">
         <div class="control-group normal_text" style="background-color:transparent"> <h3><img src="{DEFAULT_PATH}public/images/logo.png" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <input type="text" placeholder="Enter Judge Code" name="judge-code" class="login-in"/>
                </div>
            </div>
        </div>
      
        <div class="form-actions text-center">
            <span><button type="button" href="#" class="btn btn-success submit-auth" /> Login</button></span>
        </div>
        <div class="text-center">
            <a href="{DEFAULT_PATH}authentication">Sign In as Administrator</a>
        </div>
    </div>
</div>
{DEFAULT_SCRIPT}
</body>

</html>