<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Affiliation
{
    private $db;
    private $util;
    private $report;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->util = new Utilities();
        new Constants();
        $this->report = new ReportLogger();
    }
    
    public function addNewAffiliation(){
        //capture data
        $array_fields = array(AFFILIATION_NAME,URL,CONTACT_ADDRESS,STATE_ID);
        $posted = $this->util->getPostedData($array_fields);
        //Capture all errors
        $error = "";
        if(empty($posted[AFFILIATION_NAME]))
            $error.="<br>Please enter a valid affiliation name";
        if(empty($posted[CONTACT_ADDRESS]))
            $error.="<br>Please enter a contact address";
        if(empty($posted[STATE_ID]))
            $error.="<br>Please select a state";
        if(!empty($posted[URL]) && !$this->util->validateUrl($posted[URL]))
            $error.="<br>Please enter a valid url";
        
        
        //Check if selecte affiliation name has not been taken already
        if(!$this->util->checkIfUniqueBeforeInsert(AFFILIATIONS,AFFILIATION_NAME,$posted[AFFILIATION_NAME]))
            $error.="<br>This affiliation has already been registered before";
        
        if(empty($error)){
            //All correct, proceed to insertion
            //get unique code
            $aff_code = $this->util->getUniqueCode(AFFILIATIONS, AFFILIATION_CODE);
           
            $data = array(
                AFFILIATION_CODE => $aff_code,
                AFFILIATION_NAME => $posted[AFFILIATION_NAME],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                URL => $posted[URL],
                STATE_ID => $posted[STATE_ID],
                DATE_ADDED => time()
            );
            
            if($this->db->insertIntoTable(AFFILIATIONS, $data)){
                $action = "Affiliation ".$posted[AFFILIATION_NAME]." was added successfully";
                $this->report->logAction($action);
                return $this->util->displaySuccessMessage($action);
            }else{
                return $this->util->displayErrorMessage("Sorry an error occurred!");
            }
        }else{
            return $this->util->displayErrorMessage($error); 
        }
    }
    
    public function updateAffiliationDetails(){
        //capture data
        $array_fields = array(AFFILIATION_NAME,URL,CONTACT_ADDRESS,STATE_ID,AFFILIATION_ID);
        $posted = $this->util->getPostedData($array_fields);
        //Capture all errors
        $error = "";
        if(empty($posted[AFFILIATION_NAME]))
            $error.="<br>Please enter a valid affiliation name";
        if(empty($posted[CONTACT_ADDRESS]))
            $error.="<br>Please enter a contact address";
        if(empty($posted[STATE_ID]))
            $error.="<br>Please select a state";
        if(!empty($posted[URL]) && !$this->util->validateUrl($posted[URL]))
            $error.="<br>Please enter a valid url";
        
        
        //Check if selecte affiliation name has not been taken already
        if(!$this->util->checkIfUniqueBeforeUpdate(AFFILIATIONS,AFFILIATION_NAME,
                $posted[AFFILIATION_NAME],AFFILIATION_ID,$posted[AFFILIATION_ID]))
            $error.="<br>This affiliation has already been registered before";
        
        if(empty($error)){
            //All correct, proceed to insertion
            $data = array(
                AFFILIATION_NAME => $posted[AFFILIATION_NAME],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                URL => $posted[URL],
                STATE_ID => $posted[STATE_ID],
                DATE_UPDATED => time()
            );
            $condition = array(AFFILIATION_ID=>$posted[AFFILIATION_ID]);
            
            if($this->db->updateTable(AFFILIATIONS, $data, $condition)){
                $action = "Affiliation ".$posted[AFFILIATION_NAME]." was updated successfully";
                $this->report->logAction($action);
                return $this->util->displaySuccessMessage($action);
            }else{
                return $this->util->displayErrorMessage("Sorry an error occurred!");
            }
        }else{
            return $this->util->displayErrorMessage($error); 
        }
    }
    
    public function getAffiliationDetailsByID($aff_id){
        return $this->util->getDetails(AFFILIATIONS, AFFILIATION_ID, $aff_id);
    }
    
    public function getAffiliationDetailsByCode($aff_code){
        return $this->util->getDetails(AFFILIATIONS, AFFILIATION_CODE, $aff_code);
    }
    
    public function getAffiliationDetailsByName($aff_name){
        return $this->util->getDetails(AFFILIATIONS, AFFILIATION_NAME, $aff_name);
    }
    
    public function getAffiliations(){
        return $this->db->getWhere(AFFILIATIONS,null,array(AFFILIATION_NAME=>"ASC"));
    }
	
    public function deleteAffiliation($aid){
        $aff = $this->util->getDetails(AFFILIATIONS, AFFILIATION_CODE, $aid);
        $this->db->deleteFromTable(AFFILIATIONS, array(AFFILIATION_CODE => $aid));
        $action = "Affiliation ".$aff[AFFILIATION_NAME]." was deleted";
        $this->report->logAction($action);
    }
    
}

?>
