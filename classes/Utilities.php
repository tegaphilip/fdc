<?php
session_start();
require_once 'Database.php';
require_once 'Constants.php';

class Utilities
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        new Constants();
    }
	
    public function getUniqueCode($table,$field)
    {
        $code = $this->generateCode();
        $query = "SELECT  * FROM $table WHERE $field = '$code'";
        if($this->db->getNumOfRows($query)>0){
            //it means the value already exists in this table
            //call the function again to generate a new code
            return $this->getUniqueCode($table, $field);
        } else{
            return $code;
        }
    }
    
    public function validateUrl($url){
        return true;
    }
    
    public function generateCode()
    {
        $string = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //shuffle this string and get me the first ten characters
        $string = str_shuffle($string);
        $first = substr($string,0,10);
        //get me a random 5-digit number
        $second = rand(9999,100000);
        //join them
        return $first.$second;
    }
    
    //This is used during insertion
    public function checkIfUniqueBeforeInsert($table,$field,$value){
        $query = "SELECT * FROM $table WHERE $field = '$value'";
        //return $this->db->getNumOfRows($query);
        return $this->db->getNumOfRows($query)>0?false:true;
    }
    
    //This is used during updating
    public function checkIfUniqueBeforeUpdate($table,$field,$value,$field2,$value2){
        $query = "SELECT * FROM $table WHERE $field = '$value' AND $field2 != '$value2'";
        return $this->db->getNumOfRows($query)>0?false:true;
    }

    public function generateActivationCode()
    {   
        $string = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        //shuffle this string and get me the first 30 characters
        $string = str_shuffle($string);
        return substr($string, 0,30);
    }
    
    public function getActivationCode($table,$field)
    {
        $code = $this->generateActivationCode();
        $query = "SELECT  * FROM $table WHERE $field = '$code'";
        if($this->db->getNumOfRows($query)>0){
            //it means the value already exists in this table so call the function again to generate a new code
            return $this->getActivationCode($table, $field);
        } else{
            return $code;
        }
    }
    
    public function isEmailValid($email){
        $regexp = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
        return preg_match($regexp, $email)?true:false;
    }
    
    function sendMail($email, $subject, $message)
    {
        $headers  = "From: ".MAILER_DAEMON."\r\n"; 
        $headers .= "Content-type: text/html\r\n"; 

        //options to send to cc+bcc 
        //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]"; 
        //$headers .= "Bcc: [email]email@maaking.cXom[/email]"; 

        // now lets send the email. 
        return mail($email, $subject, $message, $headers); 
    }
    
    public function getPostedData($array_fields){
        $data = array();
        foreach($array_fields as $field)
            $data[$field] = trim($_POST[$field]);
        return $data;
    }
    
    public function getDetails($table,$field,$value){
        $query = "SELECT * FROM $table WHERE $field = '$value'";
        return $this->db->fetchRow($query);
    }
    
    public function displayErrorMessage($message){
        return "<div class='alert alert-block alert-error fade in'>
                      <button data-dismiss='alert' class='close' type='button'>×</button>
                      <h4 class='alert-heading'>Error!</h4><p>$message</p>
                    </div>";
    }
    
    
    public function displayWarningMessage($message){
        return "<div class='alert alert-block alert-warning fade in'>
                      <button data-dismiss='alert' class='close' type='button'>×</button>
                      <h4 class='alert-heading'>Warning!</h4><p>$message</p>
                    </div>";
    }
    
    public function displaySuccessMessage($message){
        return "<div class='alert alert-block alert-success fade in'>
                      <button data-dismiss='alert' class='close' type='button'>×</button>
                      <h4 class='alert-heading'>Success!</h4><p>$message</p>
                    </div>";
    }
    
    public function displayInfoMessage($message){
        return "<div class='alert alert-block alert-info fade in'>
                      <button data-dismiss='alert' class='close' type='button'>×</button>
                      <h4 class='alert-heading'>Information!</h4><p>$message</p>
                    </div>";
    }
    
    public function getMonths(){
        return array(
            "1"=>"January",
            "2"=>"February",
            "3"=>"March",
            "4"=>"April",
            "5"=>"May",
            "6"=>"June",
            "7"=>"July",
            "8"=>"August",
            "9"=>"September",
            "10"=>"October",
            "11"=>"November",
            "12"=>"December"
        );
    }
    
    function getFriendlyDate($timeStamp){
        return date("F j,  Y",$timeStamp);
    }
    
    
    //Code handler for the file Upload
    /*
     * @param ($exts holds an array of accepted extensions)
     */
    function doUpload($folder, $controlname,$exts)
    {
        if(isset($controlname['name']) && $controlname['size']>0)
        {
            $lower = array();
            foreach($exts as $e)
                array_push($lower,strtolower($e));
            
            
            $fileName=$controlname['name'];
            $ext = strtolower(substr($fileName,strrpos($fileName,".")+1));
            if(!in_array($ext,$lower)){
                return "The file format is not supported";
            }
            $tmpName=$controlname['tmp_name'];
            $fileSize=$controlname['size'];
            $fileType=$controlname['type'];	

            $random=rand().substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"),0,10);
            $fileName=$random.$fileName;
            $upload_dir = $folder . '/';

            if (!@move_uploaded_file($tmpName, $upload_dir . $fileName )) 
            {
                return "Failed to upload for an unknown error";
            }

            if(!get_magic_quotes_gpc())
            {
                $fileName=addslashes($fileName);
            }
        }
        else
        {
            return "Invalid file format or file size";
        }

        return array(FILE_NAME=>$fileName);
    }
    
    
    function get24HourTime($my12hr,$meridian){
        $meridian = strtolower($meridian);
        if($my12hr==12 && $meridian=="am")
            return 0;
        elseif($my12hr>=1 && $my12hr<=11 && $meridian=="am")
            return $my12hr;
        elseif($my12hr==12 && $meridian=="pm")
            return 12;
        elseif($my12hr>=1 && $my12hr<=11 && $meridian=="pm")
            return $my12hr+12;
    }
    
}

?>