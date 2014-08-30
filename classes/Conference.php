<?php
session_start();
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Conference
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
    
    function createConference(){
        //capture data
        $array_fields = array(CONFERENCE_TITLE,AMOUNT_CHARGED,START_DAY,START_MONTH,START_YEAR,
            END_DAY,END_MONTH,END_YEAR,VENUE,CONFERENCE_CHAIRMAN,CHAIRMAN_POSITION,TIME);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[CONFERENCE_TITLE]))
            $error.="<br>Please enter a conference title";
        if(empty($posted[AMOUNT_CHARGED]) || !is_numeric($posted[AMOUNT_CHARGED]))
            $error.="<br>Please enter a valid amount charged";
        if(empty($posted[START_DAY]) || empty($posted[START_MONTH]) || empty($posted[START_YEAR]))
            $error.="<br>Please select a start date";
        if(empty($posted[END_DAY]) || empty($posted[END_MONTH]) || empty($posted[END_YEAR]))
            $error.="<br>Please select a end date";
        if(empty($posted[VENUE]))
            $error.="<br>Please enter a venue";
        if(empty($posted[TIME]))
            $error.="<br>Please enter a time";
        if(empty($posted[CHAIRMAN_POSITION]) || empty($posted[CONFERENCE_CHAIRMAN]))
            $error.="<br>Please enter the chairman's name and position";
        
        if(empty($error)){
            //All correct, proceed to insertion
            //get unique code
            $conference_code = $this->util->getUniqueCode(CONFERENCES, CONFERENCE_CODE);
            $start_date = mktime(0, 0, 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
            $end_date = mktime(0, 0, 0, $posted[END_MONTH], $posted[END_DAY], $posted[END_YEAR]);
            
            if($start_date<time()){
                return $this->util->displayErrorMessage("The start date has already elapsed");
            }
            if($start_date>$end_date){
                return $this->util->displayErrorMessage("The start date cannot be after the end date");
            }
            
            
            $data = array(
                CONFERENCE_CODE => $conference_code,
                CONFERENCE_TITLE => $posted[CONFERENCE_TITLE],
                START_DATE => $start_date,
                END_DATE => $end_date,
                TIME=>$posted[TIME],
                CONFERENCE_CHAIRMAN => $posted[CONFERENCE_CHAIRMAN],
                CHAIRMAN_POSITION =>$posted[CHAIRMAN_POSITION],
                VENUE => $posted[VENUE],
                AMOUNT_CHARGED => $posted[AMOUNT_CHARGED],
                DATE_ADDED =>time(),
                ADDED_BY => $_SESSION[ADMIN_ID]
            );
            //if(false){
            if($this->db->insertIntoTable(CONFERENCES, $data)){
                $this->report->logAction("Conference ".$posted[CONFERENCE_TITLE]."
                    was created successfully.");
                return $this->util->displaySuccessMessage("Conference ".$posted[CONFERENCE_TITLE]."
                    was created successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
        
    }
    
    function updateConference(){
        //capture data
        $array_fields = array(CONFERENCE_ID,CONFERENCE_TITLE,AMOUNT_CHARGED,START_DAY,START_MONTH,START_YEAR,
            END_DAY,END_MONTH,END_YEAR,VENUE,CONFERENCE_CHAIRMAN,CHAIRMAN_POSITION,TIME);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[CONFERENCE_TITLE]))
            $error.="<br>Please enter a conference title";
        if(empty($posted[AMOUNT_CHARGED]) || !is_numeric($posted[AMOUNT_CHARGED]))
            $error.="<br>Please enter a valid amount charged";
        if(empty($posted[START_DAY]) || empty($posted[START_MONTH]) || empty($posted[START_YEAR]))
            $error.="<br>Please select a start date";
        if(empty($posted[END_DAY]) || empty($posted[END_MONTH]) || empty($posted[END_YEAR]))
            $error.="<br>Please select a end date";
        if(empty($posted[VENUE]))
            $error.="<br>Please enter a venue";
        if(empty($posted[TIME]))
            $error.="<br>Please enter a time";
        if(empty($posted[CHAIRMAN_POSITION]) || empty($posted[CONFERENCE_CHAIRMAN]))
            $error.="<br>Please enter the chairman's name and position";
        
        if(empty($error)){
            //All correct, proceed to update
            $start_date = mktime(0, 0, 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
            $end_date = mktime(0, 0, 0, $posted[END_MONTH], $posted[END_DAY], $posted[END_YEAR]);
            
            if($start_date<time()){
                return $this->util->displayErrorMessage("The start date has already elapsed");
            }
            if($start_date>$end_date){
                return $this->util->displayErrorMessage("The start date cannot be after the end date");
            }
            
            $data = array(
                CONFERENCE_TITLE => $posted[CONFERENCE_TITLE],
                START_DATE => $start_date,
                END_DATE => $end_date,
                TIME=>$posted[TIME],
                CONFERENCE_CHAIRMAN => $posted[CONFERENCE_CHAIRMAN],
                CHAIRMAN_POSITION =>$posted[CHAIRMAN_POSITION],
                VENUE => $posted[VENUE],
                AMOUNT_CHARGED => $posted[AMOUNT_CHARGED],
                DATE_UPDATED =>time()
            );
            if($this->db->updateTable(CONFERENCES, $data,array(CONFERENCE_ID=>$posted[CONFERENCE_ID]))){
                $this->report->logAction("Conference ".$posted[CONFERENCE_TITLE]."
                    was updated successfully.");
                return $this->util->displaySuccessMessage("Conference ".$posted[CONFERENCE_TITLE]."
                    was updated successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    function updateConferencePhoto(){
        //capture data
        $array_fields = array(CONFERENCE_ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('jpg','png','gif','jpeg');
        $upload = $this->util->doUpload("../images/uploads/confs", $_FILES[LOGO],$allowable);
        if(is_array($upload)){
            if($this->db->updateTable(CONFERENCES, array(LOGO=>$upload[FILE_NAME]),array(CONFERENCE_ID=>$posted[CONFERENCE_ID]))){
                $this->report->logAction("Conference photo was updated");
                return $this->util->displaySuccessMessage("Photo has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Photo update was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
    }
    
    public function getConference($conf_code){
        $conf = $this->db->getWhere(CONFERENCES,array(CONFERENCE_CODE=>$conf_code));
        return $conf[0];
    }
    
    public function getActivity($conf_detail_id){
        $conf = $this->db->getWhere(CONFERENCE_DETAILS,array(CONFERENCE_DETAIL_ID=>$conf_detail_id));
        return $conf[0];
    }
    
    public function getConferences(){
        return $this->db->getWhere(CONFERENCES,null,array(START_DATE=>"ASC"));
    }
    
    public function setCurrent($conf_code){
        //Make all zero
        $this->db->updateTable(CONFERENCES, array(CURRENT=>0), array(1=>1));
        //Set current 1
        $this->db->updateTable(CONFERENCES, array(CURRENT=>1), array(CONFERENCE_CODE=>$conf_code));
    }
    
    public function delete($conf_code){
        $conf = $this->getConference($conf_code);
        $this->db->deleteFromTable(CONFERENCES, array(CONFERENCE_CODE=>$conf_code));
        $this->db->deleteFromTable(CONFERENCE_DETAILS, array(CONFERENCE_ID=>$conf[CONFERENCE_ID]));
        $this->report->logAction("Conference ".$conf[CONFERENCE_TITLE]." and its details were deleted");
    }
    
    public function deleteDetailsOfConference($confdetails_id){
        $this->db->deleteFromTable(CONFERENCE_DETAILS, array(CONFERENCE_DETAIL_ID=>$confdetails_id));
    }
    
    public function deleteParticipant($attendee_id){
        $attendee = $this->util->getDetails(CONFERENCE_ATTENDANCE, ATTENDEE_ID, $attendee_id);
        $this->db->deleteFromTable(CONFERENCE_ATTENDANCE, array(ATTENDEE_ID=>$attendee_id));
        $this->report->logAction("Attendee ".$attendee[FULL_NAME]." was deleted");
    }
    
    public function getActivities($conf_id){
        return $this->db->getWhere(CONFERENCE_DETAILS, array(CONFERENCE_ID=>$conf_id),array(START_TIME=>"ASC"));
    }
    
    public function addActivity(){
        //capture data
        $array_fields = array(DAY_TITLE,CONFERENCE_ID,"sh","sm","sme","eh","em","eme",START_DAY, START_MONTH,START_YEAR);
        $posted = $this->util->getPostedData($array_fields);
        
        //return $this->util->get24HourTime($posted["sh"], $posted["sme"]);
        if($posted["sh"]!="" && $posted["sm"]!="" && $posted["sme"]!=""){
            $shr = $this->util->get24HourTime($posted["sh"], $posted["sme"]);
            $start_date = mktime($shr, $posted["sm"], 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
        }
        if($posted["eh"]!="" && $posted["em"]!="" && $posted["eme"]!=""){
            $ehr = $this->util->get24HourTime($posted["eh"], $posted["eme"]);
            $end_date = mktime($ehr, $posted["em"], 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
        }
        
        //return $start_date."-".$end_date;
        
        //Capture all errors
        $error = "";
        if(empty($posted[DAY_TITLE]))
            $error.="<br>Please enter a program title";
        if(empty($posted[START_DAY]) || empty($posted[START_MONTH]) || empty($posted[START_YEAR]))
            $error.="<br>Please select a date";
        if(empty($error)){
           
            $data = array(
                START_TIME=>$start_date,
                END_TIME=>$end_date,
                DAY_TITLE => $posted[DAY_TITLE],
                CONFERENCE_ID=>$posted[CONFERENCE_ID]
            );
            //if(false){
            if($this->db->insertIntoTable(CONFERENCE_DETAILS, $data)){
                $this->report->logAction("Activity ".$posted[DAY_TITLE]." was added succesfully");
                return $this->util->displaySuccessMessage("Activity added successfully");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    public function editActivity(){
        //capture data
        $array_fields = array(DAY_TITLE,CONFERENCE_DETAIL_ID,"sh","sm","sme","eh","em","eme",START_DAY, START_MONTH,START_YEAR);
        $posted = $this->util->getPostedData($array_fields);
        
        //return $this->util->get24HourTime($posted["sh"], $posted["sme"]);
        if($posted["sh"]!="" && $posted["sm"]!="" && $posted["sme"]!=""){
            $shr = $this->util->get24HourTime($posted["sh"], $posted["sme"]);
            $start_date = mktime($shr, $posted["sm"], 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
        }
        if($posted["eh"]!="" && $posted["em"]!="" && $posted["eme"]!=""){
            $ehr = $this->util->get24HourTime($posted["eh"], $posted["eme"]);
            $end_date = mktime($ehr, $posted["em"], 0, $posted[START_MONTH], $posted[START_DAY], $posted[START_YEAR]);
        }
        
        //return $start_date."-".$end_date;
        
        //Capture all errors
        $error = "";
        if(empty($posted[DAY_TITLE]))
            $error.="<br>Please enter a program title";
        if(empty($posted[START_DAY]) || empty($posted[START_MONTH]) || empty($posted[START_YEAR]))
            $error.="<br>Please select a date";
        if(empty($error)){
           
            $data = array(
                START_TIME=>$start_date,
                END_TIME=>$end_date,
                DAY_TITLE => $posted[DAY_TITLE],
            );
            //if(false){
            if($this->db->updateTable(CONFERENCE_DETAILS, $data,array(CONFERENCE_DETAIL_ID=>$posted[CONFERENCE_DETAIL_ID]))){
                $this->report->logAction("Activity ".$posted[DAY_TITLE]." was edited succesfully");
                return $this->util->displaySuccessMessage("Activity updated successfully");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    public function addParticipant(){
        //capture data
        $array_fields = array(CONFERENCE_ID,FULL_NAME,EMAIL,IS_MEMBER,CONFERENCE_REGISTRATION_TYPE_ID,AFFILIATION_ID,
            TELEPHONE,PAYMENT_CONFIRMED,DATE_PAYMENT_WAS_MADE,AMOUNT_PAID);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[FULL_NAME]))
            $error.="<br>Please enter a name";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check amount paid
        if(!empty($posted[AMOUNT_PAID]) && !is_numeric($posted[AMOUNT_PAID]))
            $error.="<br>Please enter a valid amount paid or leave the field blank";
        
        if(!empty($posted[DATE_PAYMENT_WAS_MADE])){
            $exp = explode("-",$posted[DATE_PAYMENT_WAS_MADE]);
            if(count($exp)!=3){
                $error.="<br>Please enter a valid date for the date payment was made or 
                    leave blank if payment has not been made";
            }else {
                $i=0;
                foreach($exp as $e){
                    $exp[$i] = trim($e);
                    $i++;
                }
                if($exp[0]<1 || $exp[0]>31 || $exp[1]<1 || $exp[1]>12 || strlen($exp[2])!=4){
                $error.="<br>Please enter a valid date for the date payment was made or 
                    leave blank if payment has not been made";
                }
            }
        }
        
        if($posted[PAYMENT_CONFIRMED]==1){
            $dateOfConfirm = time();
        }
        
        
        if(empty($error)){
            $dateOfPay = mktime(0,0,0,$exp[1],$exp[0],$exp[2]);
            $data = array(
                CONFERENCE_ID=>$posted[CONFERENCE_ID],
                PAYMENT_CONFIRMED=>$posted[PAYMENT_CONFIRMED],
                DATE_PAYMENT_WAS_MADE=>$dateOfPay,
                DATE_PAYMENT_WAS_CONFIRMED=>$dateOfConfirm,
                FULL_NAME=>$posted[FULL_NAME],
                AMOUNT_PAID=>$posted[AMOUNT_PAID],
                EMAIL=>$posted[EMAIL],
                IS_MEMBER=>$posted[IS_MEMBER],
                AFFILIATION_ID=>$posted[AFFILIATION_ID],
                TELEPHONE => $posted[TELEPHONE],
                CONFERENCE_REGISTRATION_TYPE_ID=>$posted[CONFERENCE_REGISTRATION_TYPE_ID],
                DATE_REGISTERED=>time()
            );
            if($this->db->insertIntoTable(CONFERENCE_ATTENDANCE, $data)){
                $message = "Dear ".$posted[FULL_NAME].",You have been succesfully registered for a conference
                    by the site administrator.";
                $subject = "NOTICE OF REGISTRATION FOR CONFERENCE";
                $this->util->sendMail($posted[EMAIL], $subject, $message);
                $this->report->logAction("Participant ".$posted[FULL_NAME]." was registered for conference");
                if($posted[PAYMENT_CONFIRMED]==1){
                    $this->report->logAction("Participant ".$posted[FULL_NAME]." payment was confirmed");
                }
                return $this->util->displaySuccessMessage("Registration successful");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    public function updateParticipant(){
        //capture data
        $array_fields = array(ATTENDEE_ID,CONFERENCE_ID,FULL_NAME,EMAIL,IS_MEMBER,CONFERENCE_REGISTRATION_TYPE_ID,AFFILIATION_ID,
            TELEPHONE,PAYMENT_CONFIRMED,DATE_PAYMENT_WAS_MADE,AMOUNT_PAID);
        $posted = $this->util->getPostedData($array_fields);
        //return $posted;
        //Get attendee
        $participant = $this->util->getDetails(CONFERENCE_ATTENDANCE, ATTENDEE_ID, $posted[ATTENDEE_ID]);
        //Capture all errors
        $error = "";
        if(empty($posted[FULL_NAME]))
            $error.="<br>Please enter a name";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check amount paid
        if(!empty($posted[AMOUNT_PAID]) && !is_numeric($posted[AMOUNT_PAID]))
            $error.="<br>Please enter a valid amount paid or leave the field blank";
        
        if(!empty($posted[DATE_PAYMENT_WAS_MADE])){
            $exp = explode("-",$posted[DATE_PAYMENT_WAS_MADE]);
            if(count($exp)!=3){
                $error.="<br>Please enter a valid date for the date payment was made or 
                    leave blank if payment has not been made";
            }else {
                $i=0;
                foreach($exp as $e){
                    $exp[$i] = trim($e);
                    $i++;
                }
                if($exp[0]<1 || $exp[0]>31 || $exp[1]<1 || $exp[1]>12 || strlen($exp[2])!=4){
                $error.="<br>Please enter a valid date for the date payment was made or 
                    leave blank if payment has not been made";
                }
            }
        }
        
        if(!empty($posted[DATE_PAYMENT_WAS_MADE])){
            $dateOfPay = mktime(0,0,0,$exp[1],$exp[0],$exp[2]);
        }
        
        if(empty($error)){
            $data = array(
                CONFERENCE_ID=>$posted[CONFERENCE_ID],
                PAYMENT_CONFIRMED=>$posted[PAYMENT_CONFIRMED],
                DATE_PAYMENT_WAS_MADE=>$dateOfPay,
                DATE_PAYMENT_WAS_CONFIRMED=>$dateOfConfirm,
                FULL_NAME=>$posted[FULL_NAME],
                AMOUNT_PAID=>$posted[AMOUNT_PAID],
                EMAIL=>$posted[EMAIL],
                IS_MEMBER=>$posted[IS_MEMBER],
                AFFILIATION_ID=>$posted[AFFILIATION_ID],
                TELEPHONE => $posted[TELEPHONE],
                CONFERENCE_REGISTRATION_TYPE_ID=>$posted[CONFERENCE_REGISTRATION_TYPE_ID],
                DATE_REGISTERED=>time()
            );
            if($posted[PAYMENT_CONFIRMED]==1 && $participant[PAYMENT_CONFIRMED]==0){
                $data[DATE_PAYMENT_WAS_CONFIRMED] = time();
            }
            //return $dateOfConfirm;
            //return $posted[ATTENDEE_ID];
            if($this->db->updateTable(CONFERENCE_ATTENDANCE, $data,array(ATTENDEE_ID=>$posted[ATTENDEE_ID]))){
                if($posted[PAYMENT_CONFIRMED]==1 && $participant[PAYMENT_CONFIRMED]==0){
                    //Mail user to notify him that his or payment has been confirmed
                    $data[DATE_PAYMENT_WAS_CONFIRMED] = $dateOfConfirm;
                    $this->util->sendMail($posted[EMAIL], "PAYMENT CONFIRMATION FOR CONFERENCE",
                            "This is to notify you that your payment for the upcoming FDC
                                conference has been confirmed");
                }
                $this->report->logAction("Participant ".$posted[FULL_NAME]." registration details were updated");
                if($posted[PAYMENT_CONFIRMED]==1 && $participant[PAYMENT_CONFIRMED]==0){
                    $this->report->logAction("Participant ".$posted[FULL_NAME]." payment was confirmed");
                }
                return $this->util->displaySuccessMessage("Registration details updated");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    public function registerForConference(){
        //capture data
        $array_fields = array(CONFERENCE_ID,FULL_NAME,EMAIL,IS_MEMBER,CONFERENCE_REGISTRATION_TYPE_ID,AFFILIATION_ID,
            TELEPHONE);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[FULL_NAME]))
            $error.="<br>Please enter a name";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
       
        if(empty($error)){
            $data = array(
                CONFERENCE_ID=>$posted[CONFERENCE_ID],
                FULL_NAME=>$posted[FULL_NAME],
                EMAIL=>$posted[EMAIL],
                IS_MEMBER=>$posted[IS_MEMBER],
                AFFILIATION_ID=>$posted[AFFILIATION_ID],
                TELEPHONE => $posted[TELEPHONE],
                CONFERENCE_REGISTRATION_TYPE_ID=>$posted[CONFERENCE_REGISTRATION_TYPE_ID],
                DATE_REGISTERED=>time()
            );
            if($this->db->insertIntoTable(CONFERENCE_ATTENDANCE, $data)){
                $message = $this->composeMessage($posted[FULL_NAME], $posted[CONFERENCE_ID]);
                $subject = "NOTICE OF REGISTRATION FOR CONFERENCE";
                $this->util->sendMail($posted[EMAIL], $subject, $message);
                
                return $this->util->displaySuccessMessage("You have succesfully registered for this conference.
                    <br>Please endeavour to pay the conference fee as soon as possible.
                    <br>Instructions have been sent to your email");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    public function composeMessage($name,$conf_id){
        $con = $this->db->getWhere(CONFERENCES, array(CONFERENCE_ID=>$conf_id));
        $con = $con[0];
        $message = "Dear $name, <br> You have successfully 
                registered for the upcoming FDC conference titled ".$con[CONFERENCE_TITLE]
                ."<br> After payment , please ensure you send your bank details for payment verification";
        return $message;
   }
   
   public function getConferenceRegistrationTypeName($type_id){
       $details = $this->db->getWhere(CONFERENCE_REGISTRATION_TYPES, array(CONFERENCE_REGISTRATION_TYPE_ID=>$type_id));
       return $details[0][CONFERENCE_REGISTRATION_TYPE_NAME];
   }
   
   public function getMostRecentConference(){
       $query = "SELECT * FROM conferences WHERE start_date <= ALL (SELECT start_date FROM conferences)";
       return $this->db->fetchRow($query);
   }
}

?>
