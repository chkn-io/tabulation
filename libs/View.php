<?php

/**
 *
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 *
 *
 * Class View
 * This class set all the links for css and javascript
 * This class also set the content of the site and all the visible part of the website/system
 *
 */
class View {
    protected $_file;
    function Html_Objects($type,$value){
        $controller =  $_SESSION['controller'];
        $css = array();
        $js = array();

        switch($type){
            case 'css':
                for($x=0;$x<count($value);$x++){
                    $css[$x] = '<link href="'.DEFAULT_URL.'public/css/'.$value[$x].'" rel="stylesheet" type="text/css">';
                }
                return implode("\n",$css);
                break;
            case 'js':
                for($x=0;$x<count($value);$x++){
                    $js[$x] = '
				<script type="text/javascript" src="'.DEFAULT_URL.'public/js/'.$value[$x].'"></script>';
                }
                return implode("\n",$js);
                break;
            case 'page':
                return file_get_contents(DEFAULT_URL.'view/page/'.$value);
                break;
        }
    }
}