<?php
/**CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 *
 * Class process_model
 * This class holds the PDO Main function the CRUD
 *
 *
 */
class process_model extends Model{
    protected $keys;
    protected $params = array();
    protected $key_values = array();
 
    /**
     * @return mixed
     * Checks if the database is already settled up and does'nt used the default value for the variables
     */
    public function check_db(){
        $response = $this->db_connect();
        return $response;
    }

    /**
     * @param $sql
     * @return mixed
     * This function collects all the data needed by the user
     * It will automatically generate a SELECT query
     */
    public function get_list($sql,$line){

        try {
            $this->db_connect();
        

        $query = 'SELECT * FROM ';
        $query_all = $query . $sql[0];
            if(count($sql) == 1){$this->db_prepare($query_all);$data = $this->db_execute();}
       
        else if(count($sql) > 1){
            $imploaded=  implode(',',array_keys($sql[1]));
            $keys = explode(',',$imploaded);
            for($x=0;$x<count($keys);$x++){$params[$x] =  $keys[$x].'=:param'.$x;}
            $query .= $sql[0].' WHERE ';
            for($x=0;$x<count($keys);$x++){$query .=$params[$x];if($x != count($keys)-1){$query.=' and ';}}
            $this->db_prepare($query);
            for($x=0;$x<count($keys);$x++){$this->db_bind(':param'.$x,$sql[1][$keys[$x]],PDO::PARAM_STR);}
            $data = $this->db_execute();
        }
        return $data;
        } catch (PDOException $e) {
           $this->builder($e,$sql[0],$line,$type="where clause");
        }
        
    }

    /**
     * @param $sql
     * @return mixed
     * This function collects all the data needed by the user
     * This function also allows the user to set an ORDER and LIMIT to the request data from the database
     * It will automatically generate a SELECT query with ORDER and LIMIT
     */
    public function get_order_list($sql,$line){
        try {
            $query = 'SELECT * FROM ';
            $query .= $sql[0].' ORDER BY ';
            $count = count($sql);
            $field = $sql[1][0];
            $order_type = $sql[1][1];
            switch($count){
                case 2:$query.=$field.' '.$order_type;break;
                case 3:$query.=$field.' '.$order_type. ' LIMIT '.$sql[2][0];break;
            }
            $this->db_connect();
            $this->db_prepare($query);
            $data = $this->db_execute();
            return $data;
        } catch (Exception $e) {
           $this->builder($e,$sql[0],$line,$type="order clause");
        }
    }

    /**
     * @param $sql
     * @return mixed
     * This function collects all the data needed by the user
     * This function also allows the user to select a data using LIKE CONCAT
     * It will automatically generate a SELECT query with LIKE CONCAT
     */
    public function get_list_like($sql,$line){
        try {
            $this->db_connect();
            $query = 'SELECT * FROM ';
            $query .= $sql[0]. ' WHERE ';
            $key = array_keys($sql[1]);
            for($x=0;$x<count($key);$x++){$query.=$key[$x].' LIKE CONCAT ';$query.='("%",:param'.$x.',"%") ';if($x<count($key)-1){$query.='OR ';}}
            $this->db_prepare($query);

            for($x=0;$x<count($key);$x++){$this->db_bind(':param'.$x,$sql[1][$key[$x]]);}
            $data = $this->db_execute();
            return $data;
        } catch (Exception $e) {
            
           $this->builder($e,$sql[0],$line,$type='where clause');
        }
        

    }
    public function get_list_like_and($sql,$line){
        try {
            $this->db_connect();
            $query = 'SELECT * FROM ';
            $query .= $sql[0]. ' WHERE ';
            $key = array_keys($sql[1]);
            for($x=0;$x<count($key);$x++){$query.=$key[$x].' LIKE CONCAT ';$query.='("%",:param'.$x.',"%") ';if($x<count($key)-1){$query.='AND ';}}
            $this->db_prepare($query);
            for($x=0;$x<count($key);$x++){$this->db_bind(':param'.$x,$sql[1][$key[$x]]);}
            $data = $this->db_execute();
            return $data;
        } catch (Exception $e) {
           $this->builder($e,$sql[0],$line,$type="where clause");
        }
        

    }

    /**
     * @param $sql
     * @return mixed
     * This function allows the user to add data to the database easier
     * It will automatically generate a INSERT query and VALUES that is based on the data gathered by $sql
     */
    public function add_query_execute($sql,$line){
        try {
            $this->db_connect();
            $query = 'INSERT INTO ';
            $query .= $sql[0].'(';
            $array_keys = array_keys($sql[1]);
            $k_count = count($array_keys);
            for($x=0;$x<count($array_keys);$x++){$query.=$array_keys[$x];if($x != $k_count-1){$query.=',';}else{$query.=')';}}
            $query .=' VALUES (';
            for($x=0;$x<count($sql[1]);$x++){$query .= ':param'.$x;if($x != count($sql[1])-1){$query .=',';}}
            $query .=')';
            $this->db_prepare($query);
            for($x=0;$x<count($sql[1]);$x++){$params[$x] = $sql[1][$array_keys[$x]];}
            for($x=0;$x<count($sql[1]);$x++){$this->db_bind(':param'.$x,$params[$x]);}
            $this->db_execute();
        } catch (Exception $e) {
           $this->builder($e,$sql[0],$line,$type="field list");
        }
        
    }

    /**
     * @param $sql
     * @return mixed
     * This function allows the user to delete data to the database easier
     * It will automatically generate a DELETE query that is based on the data gathered by $sql
     */
    public function delete_query_execute($sql,$line){
        $this->db_connect();
        $query = 'DELETE FROM ';
        $query .= $sql[0]. ' WHERE ';
        $query.= key($sql[1]);
        $query.='=:param1';
        $this->db_prepare($query);
        $sql_value = $sql[1][key($sql[1])];
        $this->db_bind(':param1',$sql_value,PDO::PARAM_INT);
        $this->db_execute();
    }

    /**
     * @param $sql
     * @return mixed
     * This function allows the user to update data to the database easier
     * It will automatically generate a UPDATE query that is based on the data gathered by $sql
     */
    public function update_query_execute($sql,$line){
        $query = 'UPDATE ';
        $query .= $sql[0].' SET ';
        $array_keys = array_keys($sql[1]);
        $array_count = count($sql[1]);
        for($x=0;$x<count($sql[1]);$x++){if($array_keys[$x]!='id'){$query.=$array_keys[$x].'=:param'.$x;if($x != $array_count-2){$query.=',';}}}
        for($x=0;$x<count($array_keys);$x++){if($array_keys[$x] == 'id'){$query .= ' WHERE id=:param';}}
        $this->db_connect();
        $this->db_prepare($query);
        for($x=0;$x<count($sql[1]);$x++){if($array_keys[$x] != 'id'){$this->db_bind(':param'.$x,$sql[1][$array_keys[$x]]);}}
        for($x=0;$x<count($sql[1]);$x++){if($array_keys[$x] == 'id'){$this->db_bind(':param',$sql[1][$array_keys[$x]]);}}
        $this->db_execute();
    }

    /**
     * @param $sql
     * @return mixed
     * This function allows the user to easily execute a set SQL QUERY
     */
    public function query($sql,$line){
        $this->db_connect();
        $query = $sql[0];
        $this->db_prepare($query);
        $count = substr_count($query,':param');
        for($x=0;$x<$count;$x++){$a = $x+1;$this->db_bind(':param'.$a,$sql[1][$x]);}
        $data = $this->db_execute();
        return $data;
    }

    /**
     * @param $table
     * @return mixed
     * Truncate or remove all the data on a table
     */
    public function truncate($table,$line){
        $this->db_connect();
        $query = 'TRUNCATE TABLE '.$table;
        $this->db_prepare($query);
        $response = $this->db_execute();
        return $response;
    }


    public function errorHand($message,$line){

    $server = explode('/',str_replace('url=', "", $_SERVER['QUERY_STRING']));
    $url = DEFAULT_URL.$server[0];
    if($url == DEFAULT_URL){
        $file = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']).'controller/index.php';
    }else{
        $file = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']).'controller/'.$server[0].'Controller.php';
    }

        $html = '<style>
                    .chkn_handler{
                        width:100%;
                        float:left;
                        background-color:#fff;
                        border:1px solid #ccc;
                    }

                    .chkn_handler_header{
                        padding:10pt;
                        float:left;
                        width:97.5%;
                        text-transform:uppercase;
                    }
                    .chkn_handler_header p{
                        padding:10pt;
                        margin:0;
                    }
                    .chkn_handler_error{
                        background-image:linear-gradient(to bottom, #ff3019 0%,#cf0404 100%);
                        color:white;
                        padding:10pt;
                    }
                    .chkn_handler_warning{
                        background-image:linear-gradient(to bottom, #ffa84c 0%,#ff7b0d 100%);;
                        color:black;
                    }
                    .chkn_handler_content{
                        width:97.5%;
                        padding:10pt;
                    }

                </style>';
        $html .= '<div class="chkn_handler">';
        $html .= '<div class="chkn_handler_error">PDO Exception</div>';
        $html .= '<div class="chkn_handler_content">';
        $html .= '
                <p><b>Message:</b> '.$message.'</p>
                <p><b>File Located:</b> '.$file.'</p>
                <p><b>Line:</b>'.$line.'</p>
        ';      
        $html.='</div>';
        $html .=  '</div>';
        echo $html;
    }

    public function builder($e,$tablename,$line,$type){
        switch ($e->getCode()) {
               case '42S02':
                $message = 'Table <span style="font-style:italic;color:red;">'.$tablename.'</span> doesn\'t exist';
               break;
               case '42000':
                $message = 'Syntax error or access violation. Check the CHKN Documentation for SELECT function.';    
               break;
               case '42S22':
               $cut = str_replace('SQLSTATE[42S22]: Column not found: 1054 Unknown column \'', '', $e->getMessage());
               $cut = str_replace('\' in \''.$type.'\'', '', $cut);
                $message = 'Unknown column <span style="font-style:italic;color:red;">'.$cut.'</span>';    
               break;
               default:
                $message = '';
                $search_query = '';
               break;   
           }
           $this->errorHand($message,$line);
    }
}