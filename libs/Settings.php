<?php
/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Settings Page
 *
 *
 *
 * This will automatically set the Default url for the site
 * If your running the app on localhost, kindly change the ROOT_FOLDER definition below
 * If your running on a true host, the system will automatically get the DEFAULT URL for the site
 */

    define('SERVER',$_SERVER['HTTP_HOST']);

    define('TEMPLATE_PATH','view/template/');
    define('PAGE_PATH','view/page/');
    define('ROOT_FOLDER','tabulation');


/**
 *
 */
    if(SERVER == 'localhost'){
        define ('DEFAULT_URL','http://'.SERVER.'/'.ROOT_FOLDER.'/');
    }else{
        define ('DEFAULT_URL','http://'.SERVER.'/'.ROOT_FOLDER.'/');
    }

    

/**
 * Page Maintenance
 *
 * Define the Class you want to close temporarily for maintenance
 * Segregate Class names using (,)
 */
    define('MAINTENANCE',"");

/**
 * This is the database configuration for CHKN Framework PHP
 * Define your set host, database name, charset, username and password
 */
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','tabulation');
    define('DB_CHARSET','utf8');
    define('DB_USER','root');
    define('DB_PASSWORD','');
    

/**
 * This is the settings for PHPMailer
 * This framework uses Gmail for SMTP Host on default
 * Just set the Username, Password and the Default Mailer Name
 */
	define('SMTP_HOST','');
	define('SMTP_PORT','');
	define('SMTP_SECURE','');
	define('MAILER_USERNAME','');
	define('MAILER_PASSWORD','');
	define('MAILER_NAME','');
	define('MAILER_ALT_BODY','');

/**
 * This is the settings for SMS Gateway Me
 * Create an account on http://smsgateway.me/ to have an access to this feature
 * Download the SMS Gateway Me App on Google Playstore and sign-in your created account
 * Change the value of the define variable below
 * The device ID will be given after you successfully Signed In by the Application
 */
    define('SMS_EMAIL','');
    define('SMS_PASSWORD','');
    define('DEVICE_ID','');

/**
 * This is the credentials need to use the Google Re-captcha
 * Get codes on https://www.google.com/recaptcha/admin
 */
    define('DEFAULT_SITE_KEY','');
	define('DEFAULT_SECRET_KEY','');

/**
 * This setting is for SALT Encryption
 * Those codes below will be use for encryption
 * Salt only needs 16,24 and 32 characters only
 */
    define('SALT','ABCDEFGHIJ123456789abcdefghiklmn');

/**
 * This is for the default size of an image and file.
 * Files and Images that is larger than the set default size will not be uploaded to the system
 *
 *
 * This is for Image
 */
    define('DEFAULT_IMAGE_SIZE','88000000000');
/**
 * This is for File
 */
    define('DEFAULT_FILE_SIZE','800000000000');


/**
 * This is the setting for the PHPExcel
 * The define variables below will be use as an information of the Excel
 * file that the system will generate
 */
    define('EXCEL_AUTHOR','CHKN DEV');
    define('EXCEL_MODIFIED','CHKN DEV');
    define('EXCEL_TITLE','CHNK DEV EXCEL PROJECT');
    define('EXCEL_SUBJECT','CHKN DEV EXCEl GENERATION SAMPLE');
    define('EXCEL_DESCRIPTION','CHKN DEV GENERATED EXCEL FILE USING PHPEXCEL');
    define('EXCEL_KEYWORDS','CHKN DEV MS EXCEL 2010');
    define('EXCEL_CATEGORY','CHKN DEV PROCESS RESULT');



