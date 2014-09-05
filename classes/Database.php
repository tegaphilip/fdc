<?php
error_reporting(E_ALL & ~E_NOTICE);
if(!isset($_SESSION)){
    session_start();
}
class Database
{
    private $db;
    private $conn;
	
    function  __construct() 
    {	
        //establishing connection in the constructor
        //error_reporting(E_ERROR);
        $hostname_login = "localhost"; //host
        $database_login = "thinkitr_fdcdb"; //dbname
        $username_login = "root";//db username
        $password_login = ""; //db password
        //$username_login = "thinkitr_fdcuser";//db username
        //$password_login = "bGaQ]Tq%X$&f"; //db password

        $this->conn = mysql_connect($hostname_login, $username_login, $password_login)
                or die(mysql_error());
        $this->db = mysql_select_db($database_login, $this->conn);
    }
    
    public function getConnection(){
        return $this->conn;
    }
	
    public function executeQuery($query)
    {
        mysql_query($query) or die(mysql_error());
        return mysql_affected_rows()>0?true:false;
    }
		
    public function fetchRow($query)
    {
        $res=  mysql_query($query) or die(mysql_error());
        $rs=mysql_fetch_assoc($res);
        return $rs;
    }
    
    public function fetchRows($query)
    {
        $rs = array();
        $res=  mysql_query($query) or die(mysql_error());
        while($row = mysql_fetch_assoc($res))
            array_push($rs,$row);
        return $rs;
    }
    	
    function getNumOfRows($query)
    {
        $res = mysql_query($query) or die(mysql_error());
        return mysql_num_rows($res);
    }

    /*
     *Generic insert for any table
     * @param($table,the table to be inserted into)
     * @param($data, an associative array with the column names 
     * of the table as keys and the values to be inserted as values) 
     */
    public function insertIntoTable($table,$data){
        $query = "INSERT INTO $table (";
        foreach ($data as $key => $value) 
            $query.="$key,";
        //remove last comma
        $query = substr($query, 0,  strlen($query)-1);
        $query.=") VALUES (";
        foreach ($data as $key => $value) 
            $query.="'".mysql_escape_string($value)."',";
        //remove last comma
        $query = substr($query, 0,  strlen($query)-1);
        $query.=")";
        return $this->executeQuery($query)?true:false;
    }
    
    /*
     *Generic update for any table
     * @param($table,the table to be inserted into)
     * @param($data, an associative array with the column names 
     * of the table as keys and the values to be inserted as values)
     * @param($condition, an associative array with the column names of the conditions for update as keys and  
     * the values to be checked before update)--->e.g WHERE member_id = '10'; 
     */
    public function updateTable($table,$data,$condition){
        $query = "UPDATE $table SET ";
        foreach ($data as $key => $value) 
            $query.=" $key = '$value',";
        //remove last comma
        $query = substr($query, 0,  strlen($query)-1);
        $query .= " WHERE ";
        $i=0;
        foreach ($condition as $key => $value){ 
            $query.=" $key = '$value' ";
            $i++;
            if(count($condition)>$i){
                $query.=" AND ";
            }
        }
        return $this->executeQuery($query)?true:false;
    }
    
    /*
     *Delete from any table
     * @param($table,the table to be inserted into)
     * @param($condition, an associative array with the column names of the conditions for update as keys and  
     * the values to be checked before delete)--->e.g WHERE member_id = '10'; 
     */
    public function deleteFromTable($table,$condition){
        $query = "DELETE FROM $table ";
        $query .= " WHERE ";
        $i=0;
        foreach ($condition as $key => $value){ 
            $query.=" $key = '$value' ";
            $i++;
            if(count($condition)>$i){
                $query.=" AND ";
            }
        }
        return $this->executeQuery($query)?true:false;
    }
    
    public function getWhere($table,$condition=null,$order_by=null){
        $query = "SELECT * FROM $table ";
        if(count($condition)>0){
            $query.=" WHERE ";
        }
        $i=0;

        if (!is_null($condition)) {
            foreach ($condition as $key => $value){
                $query.=" $key = '$value' ";
                $i++;
                if(count($condition)>$i){
                    $query.=" AND ";
                }
            }
        }

        if (!is_null(($order_by))) {

            if(count($order_by)>0){
                $query.=" ORDER BY ";
            }
            $i=0;

            foreach ($order_by as $key => $value){
                $query.=" $key $value ";
                $i++;
                if(count($order_by)>$i){
                    $query.=",";
                }
            }
        }
        return $this->fetchRows($query);
    }
    
    public function wildCardSearch($table,$condition=null,$order_by=null){
        $query = "SELECT * FROM $table ";
        if(count($condition)>0){
            $query.=" WHERE ";
        }
        $i=0;
        foreach ($condition as $key => $value){ 
            $query.=" $key LIKE '%$value%' ";
            $i++;
            if(count($condition)>$i){
                $query.=" AND ";
            }
        }
        if(count($order_by)>0){
            $query.=" ORDER BY ";
        }
        $i=0;
        foreach ($order_by as $value){ 
            $query.=" $value ";
            $i++;
            if(count($order_by)>$i){
                $query.=",";
            }
        }
        return $this->fetchRows($query);
    }
}
?>
