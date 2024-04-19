<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{DEFAULT_TITLE}</title>
    <link rel="icon" href="{DEFAULT_PATH}public/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>var default_url = "<?php echo {DEFAULT_PATH}?>"</script>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="{DEFAULT_PATH}public/default/default_js/jquery.min.js"></script>
    <script src="{DEFAULT_PATH}public/default/default_js/bootstrap.min.js"></script>
    <script src="{DEFAULT_PATH}public/default/default_js/loader.js"></script>

    {DEFAULT_STYLE}
<style>
          .auto{
            width:100%;
            float:left;
          }

          .auto img{
            width:100%;
          }

          .sponsor{
            width:100%;
            float:left;
            margin-top:18%;
            text-align: center;
            padding:5pt;
          }


          </style>
</head>


 <body class="nav-md">
   <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{DEFAULT_PATH}voting/dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Eastwoods Tabulation</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{USER_NAME}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{DEFAULT_PATH}voting/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a>
                  </li>
                  <li><a href="{DEFAULT_PATH}voting/proper"><i class="fa fa-thumbs-up"></i> Voting </a>
                  </li>
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="fa fa-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="fa fa-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="fa fa-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{DEFAULT_PATH}authentication/judgeOut">
                <span class="fa fa-power-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{DEFAULT_PATH}public/images/accounts/user.png" alt="">{USER_NAME}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{DEFAULT_PATH}authentication/judgeOut"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          {DEFAULT_BODY}
          <!-- /top tiles -->

          

          <h3 class="bg-primary sponsor">Our Sponsors</h3>
           <div class="auto">
            
            {DEFAULT_SPONSOR}
            

          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered By: CS Department | Developed By: Percian Joseph Borja
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   
{DEFAULT_SCRIPT}

 <script>
    $(document).ready(function(){
      $('.auto').slick({
         slidesToShow: 6,
          slidesToScroll: 6,
          autoplay: true,
          autoplaySpeed: 4000
      });


      $(".slick-next").remove();
      $(".slick-prev").remove();
    });


  </script>
</body>

</html>