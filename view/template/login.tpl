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

</head>

<body>
  <div id="loginbox">            
    <form id="loginform" class="form-vertical" action="index.html">
         <div class="control-group normal_text"> <h3><img src="{DEFAULT_PATH}public/images/logo.png" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    </i></span><input type="text" placeholder="Username" name="username" class="login-in"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                   <input type="password" placeholder="Password" name="password" class="login-in"/>
                </div>
            </div>
        </div>
        <div class="form-actions text-center">
            <span><a type="submit" href="#" class="btn btn-success submit-auth" /> Login</a></span>
        </div>
        <div class="text-center">
            <a href="{DEFAULT_PATH}voting">Sign In as Judge</a>
        </div>
    </form>
</div>
{DEFAULT_SCRIPT}
</body>

</html>