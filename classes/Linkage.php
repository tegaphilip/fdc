<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Linkage
{
    private $db;
    private $util;
    private $report;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->util = new Utilities();
        $this->report = new ReportLogger();
        new Constants();
    }
    
    function addLinkage(){
        //capture data
        $array_fields = array(LINKAGE_NAME,LINKAGE_URL,CONTACT_ADDRESS,POBOX,FAX,TELEPHONE,ACTIVATION_STATUS);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[LINKAGE_NAME]))
            $error.="<br>Please enter a sponsor name";
        
        if(!$this->util->checkIfUniqueBeforeInsert(LINKAGES, LINKAGE_NAME, $posted[LINKAGE_NAME]))
            $error.="<br>Linkage already exists";
        
        if(empty($error)){
            //All correct, proceed to insertion
            $data = array(
                LINKAGE_CODE=>$this->util->getUniqueCode(LINKAGES, LINKAGE_CODE),
                LINKAGE_NAME => $posted[LINKAGE_NAME],
                LINKAGE_URL => $posted[LINKAGE_URL],
                ACTIVATION_STATUS=>$posted[ACTIVATION_STATUS],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                POBOX => $posted[POBOX],
                TELEPHONE => $posted[TELEPHONE],
                FAX=>$posted[FAX],
                DATE_ADDED=>time(),
                ADDED_BY => $_SESSION[ADMIN_ID]
            );
            if($this->db->insertIntoTable(LINKAGES, $data)){
                $s = $this->db->getWhere(LINKAGES,array(LINKAGE_ID=>  mysql_insert_id()));
                $s = $s[0];
                $this->report->logAction("Linkage ".$posted[LINKAGE_NAME]." was added successfully");
                return $this->util->displaySuccessMessage("Linkage was added successfully. 
                    <a href='edit_linkage.php?id=".$s[LINKAGE_CODE]."'>Proceed to add Logo</a>");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    
     function editLinkage(){
        //capture data
        $array_fields = array(LINKAGE_NAME,LINKAGE_URL,CONTACT_ADDRESS,POBOX,FAX,TELEPHONE,ACTIVATION_STATUS,LINKAGE_ID);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[LINKAGE_NAME]))
            $error.="<br>Please enter a linkage name";
        
        if(!$this->util->checkIfUniqueBeforeUpdate(LINKAGES,LINKAGE_NAME, 
                $posted[LINKAGE_NAME],LINKAGE_ID, $posted[LINKAGE_ID]))
            $error.="<br>Linkage name already exists";
        
        if(empty($error)){
            //All correct, proceed to update
            $data = array(
                LINKAGE_NAME => $posted[LINKAGE_NAME],
                LINKAGE_URL => $posted[LINKAGE_URL],
                ACTIVATION_STATUS=>$posted[ACTIVATION_STATUS],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                POBOX => $posted[POBOX],
                TELEPHONE => $posted[TELEPHONE],
                FAX=>$posted[FAX],
                DATE_UPDATED=>time()
            );
            if($this->db->updateTable(LINKAGES, $data,array(LINKAGE_ID=>$posted[LINKAGE_ID]))){
                $this->report->logAction("Linkage ".$posted[LINKAGE_NAME]." was edited successfully");
                return $this->util->displaySuccessMessage("Linkage details was updated.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    function updateLogo(){
        $array_fields = array(LINKAGE_ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('jpg','png','gif','jpeg');
       
        $upload = $this->util->doUpload("../images/uploads/linkages", $_FILES[LINKAGE_LOGO],$allowable);
        
        if(is_array($upload)){
            if($this->db->updateTable(LINKAGES, 
                    array(LINKAGE_LOGO => $upload[FILE_NAME]),array(LINKAGE_ID=>$posted[LINKAGE_ID]))){
                $linkage = $this->util->getDetails(LINKAGES, LINKAGE_ID, $posted[LINKAGE_ID]);
                $this->report->logAction("Linkage ".$linkage[LINKAGE_NAME]."'s logo was updated");
                return $this->util->displaySuccessMessage("Photo has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Photo update was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
        
    }
	
    public function getLinkages(){
        return $this->db->getWhere(LINKAGES,null,null);
    }
	
    public function deleteLinkage($lid){
        $linkage = $this->util->getDetails(LINKAGES, LINKAGE_CODE, $lid);
        $this->db->deleteFromTable(LINKAGES, array(LINKAGE_CODE => $lid));
        $this->report->logAction("Linkage ".$linkage[LINKAGE_NAME]." was deleted");
    }
    
}

?>
