<?php
/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Settings Page
 * Class encrypt_helper
 */
class encrypt_helper {
    public $key;
    public $cipher;
    public $ivlen;
    public $iv;

    function __construct(){
        $this->key = SALT;
        $this->cipher = "AES-256-CBC";
        $this->ivlen = openssl_cipher_iv_length($this->cipher);
        $this->iv = openssl_random_pseudo_bytes($this->ivlen);
    }

    function encrypt($value){
        // $output = false;
        // // hash

        // $key = hash('sha256', $this->key);
        // $iv = substr(hash('sha256', $this->iv), 0, 16);
        // $output = openssl_encrypt($value, $this->cipher, $key, 0, $iv);
        // $output = base64_encode($output);
        // echo $output;
        // // return $output;
        return md5($value);
    }

    // function decrypt($ciphertext){
    //     $key = hash('sha256', $this->key);
    //     $iv = substr(hash('sha256', $this->iv), 0, 16);
    //     $output = openssl_decrypt(base64_decode($ciphertext), $this->cipher, $key, 0, $iv);
    //     echo $output;
    // }
}