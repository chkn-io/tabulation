var cssId = 'myCss';
var jsID = 'myJs';
if (!document.getElementById(cssId))
{

    var raw_url = default_url;
    var u_url = raw_url.replace('<?php echo ','');
    var url = u_url.replace('?>','');
    var host = window.location.hostname;
    var head  = document.getElementsByTagName('head')[0];
    var file_css = new Array("bootstrap.css","bootstrap-datepicker.css","bootstrap-datepicker.min.css","bootstrap-datepicker.standalone.css","bootstrap-datepicker.standalone.min.css","bootstrap-datepicker3.css","bootstrap-datepicker3.min.css","bootstrap-datepicker3.standalone.css","bootstrap-datepicker3.standalone.min.css","chkn-dialog.css","font-awesome.min.css");
    for(var x=0;x<file_css.length;x++){
        var link  = document.createElement('link');
        link.id   = cssId;
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = url+'public/default/default_css/'+file_css[x];
        link.media = 'all';
        head.appendChild(link);
    }
}

if(!document.getElementById(jsID)){
    var head = document.getElementsByTagName('head')[0];
    var file_js = new Array("jquery-ui.js","bootstrap-datepicker.js","bootstrap-datepicker.min.js","jquery.chkn-dialog.js");
    for(var x=0;x<file_js.length;x++){
        var script  = document.createElement('script');
        script.id   = cssId;
        script.src = url+'public/default/default_js/'+file_js[x];
        script.media = 'all';
        head.appendChild(script);
    }
}
