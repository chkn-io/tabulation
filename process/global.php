<?php
/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Settings Page
 *
 * Class global_helper
 * This class calls all the other helper and libraries requested by the user
 * It includes process_model,Mailer,sms_helper,encrypt_helper,upload_helper,download_helper,pdf_helper,excel_helper
 */
class global_helper {
	private $model;
    private $encrypt;
    private $upload;
    private $download;
    private $default;
    private $line;
	function __construct(){
		$this->model = new process_model;
        $this->encrypt = new encrypt_helper;
        $this->upload = new upload_helper;
        $this->download = new download_helper;
        $this->default = new defaults;
	}

    public function check_db(){
        $response = $this->model->check_db();
        return $response;
    }
    public function query($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
        $response = $this->model->query($sql,$this->line);
        return $response;
    }
	public function select($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->get_list($sql,$this->line);
		return $response;
	}

    public function order_list($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->get_order_list($sql,$this->line);
		return $response;
	}

    public function select_like($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->get_list_like($sql,$this->line);
		return $response;
	}

    public function select_like_and($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
        $response = $this->model->get_list_like_and($sql,$this->line);
        return $response;
    }

    public function add($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->add_query_execute($sql,$this->line);
		return $response;
	}

    public function delete($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->delete_query_execute($sql,$this->line);
		return $response;
	}
    public function update($sql){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
		$response = $this->model->update_query_execute($sql,$this->line);
		return $response;
	}

    public function truncate($table){
        $bt = debug_backtrace();
        $this->line = $bt[0]['line'];
        $response = $this->model->truncate($table,$this->line);
        return $response;
    }

    public function upload($file_location,$image,$image_name){
        $this->upload->upload($file_location,$image,$image_name);
	}

    public function encrypt($value = ''){
        $response = $this->encrypt->encrypt($value);
        return $response;
    }

    public function decrypt($value = ''){
        $response = $this->encrypt->decrypt($value);
        return $response;
    }


    public function download($filename,$file_location){
        $this->download->download($filename,$file_location);
    }


    public function defaults(){
        return $this->default->start();
    }
}