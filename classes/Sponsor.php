<?php
session_start();
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Sponsor
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
    
    function addSponsor(){
        //capture data
        $array_fields = array(SPONSOR_NAME,SPONSOR_URL,CONTACT_ADDRESS,POBOX,FAX,TELEPHONE,ACTIVATION_STATUS);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[SPONSOR_NAME]))
            $error.="<br>Please enter a sponsor name";
        
        if(!$this->util->checkIfUniqueBeforeInsert(SPONSORS, SPONSOR_NAME, $posted[SPONSOR_NAME]))
            $error.="<br>Sponsor name already exists";
        
        if(empty($error)){
            //All correct, proceed to insertion
            $data = array(
                SPONSOR_CODE=>$this->util->getUniqueCode(SPONSORS, SPONSOR_CODE),
                SPONSOR_NAME => $posted[SPONSOR_NAME],
                SPONSOR_URL => $posted[SPONSOR_URL],
                ACTIVATION_STATUS=>$posted[ACTIVATION_STATUS],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                POBOX => $posted[POBOX],
                TELEPHONE => $posted[TELEPHONE],
                FAX=>$posted[FAX]
            );
            if($this->db->insertIntoTable(SPONSORS, $data)){
                $s = $this->db->getWhere(SPONSORS,array(SPONSOR_ID=>  mysql_insert_id()));
                $s = $s[0];
                $this->report->logAction("Sponsor ".$posted[SPONSOR_NAME]." was added successfully.");
                return $this->util->displaySuccessMessage("Sponsor was added successfully. 
                    <a href='edit_sponsor.php?id=".$s[SPONSOR_CODE]."'>Proceed to add Logo</a>");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    
     function editSponsor(){
        //capture data
        $array_fields = array(SPONSOR_NAME,SPONSOR_URL,CONTACT_ADDRESS,POBOX,FAX,TELEPHONE,ACTIVATION_STATUS,SPONSOR_ID);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[SPONSOR_NAME]))
            $error.="<br>Please enter a sponsor name";
        
        if(!$this->util->checkIfUniqueBeforeUpdate(SPONSORS, SPONSOR_NAME, $posted[SPONSOR_NAME],SPONSOR_ID, $posted[SPONSOR_ID]))
            $error.="<br>Sponsor name already exists";
        
        if(empty($error)){
            //All correct, proceed to update
            $data = array(
                SPONSOR_NAME => $posted[SPONSOR_NAME],
                SPONSOR_URL => $posted[SPONSOR_URL],
                ACTIVATION_STATUS=>$posted[ACTIVATION_STATUS],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                POBOX => $posted[POBOX],
                TELEPHONE => $posted[TELEPHONE],
                FAX=>$posted[FAX]
            );
            if($this->db->updateTable(SPONSORS, $data,array(SPONSOR_ID=>$posted[SPONSOR_ID]))){
                $this->report->logAction("Sponsor ".$posted[SPONSOR_NAME]." was edited successfully.");
                return $this->util->displaySuccessMessage("Sponsor details was updated.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    function updateLogo(){
        $array_fields = array(SPONSOR_ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('jpg','png','gif','jpeg');
        
        //doUpload($folder, $controlname,$exts)
        $upload = $this->util->doUpload("../images/uploads/sponsors", $_FILES[SPONSOR_LOGO],$allowable);
        
        if(is_array($upload)){
            if($this->db->updateTable(SPONSORS, array(SPONSOR_LOGO => $upload[FILE_NAME]),array(SPONSOR_ID=>$posted[SPONSOR_ID]))){
                $sponsor = $this->util->getDetails(SPONSORS, SPONSOR_ID, $posted[SPONSOR_ID]);
                $this->report->logAction("Sponsor ".$sponsor[SPONSOR_NAME]."'s logo was updated successfully.");
                return $this->util->displaySuccessMessage("Photo has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Photo update was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
        
    }
	
    public function getSponsors(){
        return $this->db->getWhere(SPONSORS,null,null);
    }
	
    public function deleteSponsor($bid){
        $sponsor = $this->util->getDetails(SPONSORS, SPONSOR_ID, $posted[SPONSOR_ID]);
        $this->db->deleteFromTable(SPONSORS, array(SPONSOR_CODE => $bid));
        $this->report->logAction("Sponsor ".$sponsor[SPONSOR_NAME]." was deleted.");
    }
	
	
    
}

?>
