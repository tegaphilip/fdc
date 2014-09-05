<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Administrator
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
    
    public function addNewAdmin(){
        //capture data
        $array_fields = array(FULL_NAME,USERNAME,PASSWORD,EMAIL,CONFIRM_PASSWORD);
        $posted = $this->util->getPostedData($array_fields);
        //Capture all errors
        $error = "";
        if(empty($posted[FULL_NAME]))
            $error.="<br>Please enter a full name";
        if(empty($posted[USERNAME]))
            $error.="<br>Please enter a username";
        if(empty($posted[PASSWORD]) || empty($posted[CONFIRM_PASSWORD]) || $posted[PASSWORD]!=$posted[CONFIRM_PASSWORD])
            $error.="<br>Please enter both passwords and ensure that they match";
       
         //Check if selected username is unique
        if(!$this->util->checkIfUniqueBeforeInsert(ADMINISTRATORS, USERNAME, $posted[USERNAME]))
            $error.="<br>Username has already been used. Please select another";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check if selected email is unique
        if(!$this->util->checkIfUniqueBeforeInsert(ADMINISTRATORS, EMAIL, $posted[EMAIL]))
            $error.="<br>Email has already been used. Please select another";
        
        
        if(empty($error)){
            //All correct, proceed to insertion
            //get unique code
            $add_code = $this->util->getUniqueCode(ADMINISTRATORS, ADMIN_CODE);
           
            $data = array(
                ADMIN_CODE => $add_code,
                FULL_NAME => $posted[FULL_NAME],
                USERNAME=>$posted[USERNAME],
                PASSWORD => sha1(PASSWORD),
                EMAIL=>$posted[EMAIL],
                ADMIN_STATUS=>1,
                DATE_REGISTERED => time()
            );
            
            if($this->db->insertIntoTable(ADMINISTRATORS, $data)){
                $action = "Administrator ".$posted[FULL_NAME]." was added successfully";
                $this->report->logAction($action);
                return $this->util->displaySuccessMessage($action);
            }else{
                return $this->util->displayErrorMessage("Sorry an error occurred!");
            }
        }else{
            return $this->util->displayErrorMessage($error); 
        }
    }
    
    
    public function editAdmin(){
        //capture data
        $array_fields = array(FULL_NAME,USERNAME,PASSWORD,EMAIL,ADMIN_ID);
        $posted = $this->util->getPostedData($array_fields);
        //Capture all errors
        $error = "";
        if(empty($posted[FULL_NAME]))
            $error.="<br>Please enter a full name";
        if(empty($posted[USERNAME]))
            $error.="<br>Please enter a username";
       
         //Check if selected username is unique
        if(!$this->util->checkIfUniqueBeforeUpdate(ADMINISTRATORS, USERNAME, $posted[USERNAME],ADMIN_ID,$posted[ADMIN_ID]))
            $error.="<br>Username has already been used. Please select another";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check if selected email is unique
        if(!$this->util->checkIfUniqueBeforeUpdate(ADMINISTRATORS, EMAIL, $posted[EMAIL],ADMIN_ID,$posted[ADMIN_ID]))
            $error.="<br>Email has already been used. Please select another";
        
        
        if(empty($error)){
            //All correct, proceed to insertion
            //get unique code
           
            $data = array(
                FULL_NAME => $posted[FULL_NAME],
                USERNAME=>$posted[USERNAME],
                EMAIL=>$posted[EMAIL],
            );
            
            $act = "";
            if(!empty($posted[PASSWORD])){
                $data[PASSWORD] = sha1($posted[PASSWORD]);
                $act.="Password was changed";
            }
            
            if($this->db->updateTable(ADMINISTRATORS, $data,array(ADMIN_ID=>$posted[ADMIN_ID]))){
                $action = "Administrator ".$posted[FULL_NAME]."'s details were updated.$act";
                $this->report->logAction($action);
                return $this->util->displaySuccessMessage($action);
            }else{
                return $this->util->displayErrorMessage("Sorry an error occurred!");
            }
        }else{
            return $this->util->displayErrorMessage($error); 
        }
    }
    
    public function deleteAdmin($mid){
        $this->db->deleteFromTable(ADMINISTRATORS, array(ADMIN_CODE => $mid));
        $action = "Administrator ".$posted[FULL_NAME]."'s account was deleted";
        $this->report->logAction($action);
    }
    
    public function toggleAdminStatus($mid){
        $admin = $this->util->getDetails(ADMINISTRATORS, ADMIN_CODE, $mid);
        $data = array(ADMIN_STATUS=> 1-$admin[ADMIN_STATUS]);
        $this->db->updateTable(ADMINISTRATORS, $data, array(ADMIN_ID=>$admin[ADMIN_ID]));
        $admin = $this->util->getDetails(ADMINISTRATORS, ADMIN_CODE, $mid);
        $act = $admin[ADMIN_STATUS]=="0"?"de-activated":"activated";
        $action = "Administrator ".$posted[FULL_NAME]."'s account was $act";
        $this->report->logAction($action);
    }
    
    public function getAdministrators(){
        return $this->db->getWhere(ADMINISTRATORS,null,array(FULL_NAME=>"ASC"));
    }
    
    function login(){
        //capture data
        $array_fields = array(USERNAME,PASSWORD);
        $posted = $this->util->getPostedData($array_fields);
        
        $admin = $this->db->getWhere(ADMINISTRATORS,array(USERNAME=>$posted[USERNAME],PASSWORD=>sha1($posted[PASSWORD])));
        if(count($admin)==0){
            return $this->util->displayErrorMessage("Invalid username or password");
        }else{
            //method getwhere retruns an array of arrays
            $admin = $admin[0];
            if($admin[ADMIN_STATUS]==0){
                return $this->util->displayWarningMessage("Your account has been suspended.<br>
                    Please consult the administrator");
            }else{
                //All is well Set sessions
                $_SESSION[ADMIN_ID] = $admin[ADMIN_ID];
                $_SESSION[ADMIN_TYPE] = $admin[ADMIN_TYPE];
                //redirect to home page
                header("location:adhome.php");
            }
        }
    }
    
    public function validateLogin(){
        if(!isset($_SESSION[ADMIN_ID]) || $_SESSION[ADMIN_ID]==NULL){
            $_SESSION['transferer'] = $this->util->displayWarningMessage("You are not logged in");
            header("location:index.php");
        }
    }
    
    public function logout(){
        unset($_SESSION[ADMIN_ID]);
        unset($_SESSION[ADMIN_CODE]);
        $_SESSION['transferer'] = "You have successfully signed out";
        header("location:index.php");
    }
	
	public function retrievePassword(){
		$array_fields = array(EMAIL);
        $posted = $this->util->getPostedData($array_fields);
        
		//return $posted;
        $user = $this->db->getWhere(MEMBERS,array(EMAIL=>$posted[EMAIL]));
		//return $user;
		if(count($user)==0){
			return "<div class='alert-error'>Sorry, but that email address doesn't exist</div>";
		}else{
			$user = $user[0];
			$code = $this->util->generateActivationCode();
			$data = array(PASSWORD_RETRIEVAL_CODE=>$code,PASSWORD_RETRIEVAL_CODE_USED=>0);
			$condition = array(EMAIL=>$user[EMAIL]);
			$this->db->updateTable(MEMBERS,$data,$condition);
			
			//Mail the user with a password retrival link
			$message = "Dear ".$user[FIRST_NAME]." ".$user[LAST_NAME].",<br>You have requested a password reset. Please click <a href='http://www.FDC.org.ng/password_reset.php?em=".$user[EMAIL]."&code=".$code."'>here</a> to reset your password.<br> If you did not make this request, please ignore this mail. <br>Thanks";
			
			if($this->util->sendMail($user[EMAIL],"PASSWORD RESET REQUEST",$message)){
				return "<div class='alert-success'>A password reset link has been sent to your email.</div>";
			}else{
				return "<div class='alert-error'>Sorry, an error occurred. Please try again</div>";
			}
		}
	}
	
	public function sendNewActivationLink(){
		$array_fields = array(EMAIL);
        $posted = $this->util->getPostedData($array_fields);
        
		//return $posted;
        $user = $this->db->getWhere(MEMBERS,array(EMAIL=>$posted[EMAIL]));
		//return $user;
		if(count($user)==0){
			return "<div class='alert-error'>Sorry, but that email address doesn't exist</div>";
		}else{
			$user = $user[0];
			if($user[MEMBER_STATUS]==1){
				return "<div class='alert-success'>Hello, your account has already been confirmed</div>";
			}else{
				$code = $this->util->generateActivationCode();
				$data = array(ACTIVATION_CODE=>$code,ACTIVATION_CODE_USED=>0,ACTIVATION_LINK_EXPIRY=>time()+(3*24*3600));
				$condition = array(EMAIL=>$user[EMAIL]);
				$this->db->updateTable(MEMBERS,$data,$condition);
				
				//Mail the user with a new link to confirm account
				$message = "Dear ".$user[FIRST_NAME]." ".$user[LAST_NAME].",<br>You have requested a new account confirmation link. Please click <a href='http://www.FDC.org.ng/password_reset.php?em=".$user[EMAIL]."&code=".$code."'>here</a> to confirm your account.<br>Thanks";
				
				if($this->util->sendMail($user[EMAIL],"ACCOUNT CONFIRMATION LINK",$message)){
					return "<div class='alert-success'>An account confirmation link has been sent to your email.<br>Please check your email and confirm within 2 days. Thanks</div>";
				}else{
					return "<div class='alert-error'>Sorry, an error occurred. Please try again</div>";
				}
			}
		}
	}
	
	public function resetPassword(){
		$array_fields = array(PASSWORD,CONFIRM_PASSWORD,MEMBER_ID);
        $posted = $this->util->getPostedData($array_fields);
    
		if(($posted[PASSWORD]!=$posted[CONFIRM_PASSWORD]) || strlen($posted[PASSWORD])<6){
			return "<div class='alert-error'>Both passwords must match and must be at least 6 characters long</div>";
		}else{
			$data = array(PASSWORD=>sha1($posted[PASSWORD]),PASSWORD_RETRIEVAL_CODE_USED=>1);
			$condition = array(MEMBER_ID=>$posted[MEMBER_ID]);
			if($this->db->updateTable(MEMBERS,$data,$condition)){
				return "<div class='alert-success'>Your password has been reset</div>";
			}else{
				return "<div class='alert-error'>Sorry, an error occurred</div>";
			}
		}
	}
	
	public function changePassword(){
		$array_fields = array(OLD_PASSWORD,PASSWORD,CONFIRM_PASSWORD);
        $posted = $this->util->getPostedData($array_fields);
    	
		if(empty($posted[PASSWORD]) || empty($posted[CONFIRM_PASSWORD]) || empty($posted[OLD_PASSWORD])){
			return "<div class='alert-error'>Please fill in all fields</div>";
		}
		elseif(($posted[PASSWORD]!=$posted[CONFIRM_PASSWORD]) || strlen($posted[PASSWORD])<6){
			return "<div class='alert-error'>Both passwords must match and must be at least 6 characters long</div>";
		}else{
			$user = $this->db->getWhere(MEMBERS,array(MEMBER_ID=>$_SESSION[MEMBER_ID],PASSWORD=>sha1($posted[OLD_PASSWORD])));
			if(count($user)==0){
				return "<div class='alert-error'>Your old password is invalid</div>";
			}else{
				$data = array(PASSWORD=>sha1($posted[PASSWORD]));	
				$condition = array(MEMBER_ID=>$_SESSION[MEMBER_ID]);
				if($this->db->updateTable(MEMBERS,$data,$condition)){
					return "<div class='alert-success'>Your password has been successfully updated</div>";
				}else{
					return "<div class='alert-error'>Sorry, an error occurred</div>";
				}
			}
		}	
	}
    
    function addNewMember(){
        //capture data
        $array_fields = array(TITLE,FIRST_NAME,LAST_NAME,OTHER_NAMES,USERNAME,PASSWORD,CONFIRM_PASSWORD,
            CONTACT_ADDRESS,AFFILIATION_ID,FAX,TELEPHONE,POBOX,EMAIL,PROFESSION,GENDER,STATE_ID,COUNTRY_ID);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[TITLE]))
            $error.="<br>Title wasn't selected";
        if(empty($posted[FIRST_NAME]))
            $error.="<br>Please enter a first name";
        if(empty($posted[LAST_NAME]))
            $error.="<br>Please enter a last name";
        if(empty($posted[USERNAME]))
            $error.="<br>Please enter a username";
        if(empty($posted[PASSWORD]) || empty($posted[CONFIRM_PASSWORD]) || $posted[PASSWORD]!=$posted[CONFIRM_PASSWORD])
            $error.="<br>Please enter both passwords and ensure that they match";
        
        
        //Check if selected username is unique
        if(!$this->util->checkIfUniqueBeforeInsert(MEMBERS, USERNAME, $posted[USERNAME]))
            $error.="<br>Username has already been used. Please select another";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check if selected email is unique
        if(!$this->util->checkIfUniqueBeforeInsert(MEMBERS, EMAIL, $posted[EMAIL]))
            $error.="<br>Email has already been used. Please select another";
        
        if(empty($error)){
            //All correct, proceed to insertion
            //get unique code
            $member_code = $this->util->getUniqueCode(MEMBERS, MEMBER_CODE);
            //get activation code
            $act_code = $this->util->getActivationCode(MEMBERS, ACTIVATION_CODE);
            $data = array(
                MEMBER_CODE => $member_code,
                TITLE => $posted[TITLE],
                FIRST_NAME => $posted[FIRST_NAME],
                OTHER_NAMES => $posted[OTHER_NAMES],
                LAST_NAME => $posted[LAST_NAME],
                USERNAME => $posted[USERNAME],
                GENDER => $posted[GENDER],
                EMAIL => $posted[EMAIL],
                PASSWORD => sha1($posted[PASSWORD]),
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                DATE_REGISTERED => time(),
				ACTIVATION_LINK_EXPIRY => time()+(3*24*3600),
                NUM_LOGINS => '0',
                PROFESSION => $posted[PROFESSION],
                ACTIVATION_CODE => $act_code,
                MEMBER_STATUS => '0',
                AFFILIATION_ID => $posted[AFFILIATION_ID],
                FAX=>$posted[FAX],
                TELEPHONE => $posted[TELEPHONE],
                POBOX => $posted[POBOX],
                COUNTRY_ID => $posted[COUNTRY_ID],
                STATE_ID => $posted[STATE_ID]
            );
            //if(false){
            if($this->db->insertIntoTable(MEMBERS, $data)){
                //mail the user with an activation link
                $message = $this->composeMessage($posted[FIRST_NAME], $posted[LAST_NAME], $act_code, $posted[EMAIL]);
                $subject = "NOTICE OF REGISTRATION";
                $this->util->sendMail($posted[EMAIL], $subject, $message);
                
                return "<div class='alert-success'>Your account has been created successfully. 
                    <br>Check your email and activate your account within two days!</div>";
            }else{
                return "<div class='alert-error'>Sorry, an error occurred!</div>";
            }
                
        }else{
            return "<div class='alert-error'><strong>The following errors occurred:</strong>$error</div>";
        }
    }
    
    public function updateMemberDetails(){
        //capture data
        $array_fields = array(MEMBER_ID,TITLE,FIRST_NAME,LAST_NAME,OTHER_NAMES,USERNAME,CONTACT_ADDRESS,AFFILIATION_ID,
            FAX,TELEPHONE,POBOX,EMAIL,PROFESSION,GENDER,COUNTRY_ID,STATE_ID);
        $posted = $this->util->getPostedData($array_fields);
        
        //return $posted;
        
        //Capture all errors
        $error = "";
        if(empty($posted[TITLE]))
            $error.="<br>Title wasn't selected";
        if(empty($posted[FIRST_NAME]))
            $error.="<br>Please enter a first name";
        if(empty($posted[LAST_NAME]))
            $error.="<br>Please enter a last name";
        if(empty($posted[USERNAME]))
            $error.="<br>Please enter a username";
       
        //Check if selected username is unique
        if(!$this->util->checkIfUniqueBeforeUpdate(MEMBERS, USERNAME, $posted[USERNAME],MEMBER_ID,$posted[MEMBER_ID]))
            $error.="<br>Username has already been used. Please select another";
        //Check if email is valid
        if(!$this->util->isEmailValid($posted[EMAIL]) || empty($posted[EMAIL]))
            $error.="<br>Please enter a valid email";
        //Check if selected email is unique
        if(!$this->util->checkIfUniqueBeforeUpdate(MEMBERS, EMAIL, $posted[EMAIL],MEMBER_ID,$posted[MEMBER_ID]))
            $error.="<br>Email has already been used. Please select another";
        
        if(empty($error)){
            $details = $this->util->getDetails(MEMBERS, MEMBER_ID, $posted[MEMBER_ID]);
            $data = array(
                TITLE => $posted[TITLE],
                FIRST_NAME => $posted[FIRST_NAME],
                OTHER_NAMES => $posted[OTHER_NAMES],
                LAST_NAME => $posted[LAST_NAME],
                USERNAME => $posted[USERNAME],
                PROFESSION =>$posted[PROFESSION],
                CONTACT_ADDRESS => $posted[CONTACT_ADDRESS],
                NUM_LOGINS => $details[NUM_LOGINS]+1,
                AFFILIATION_ID => $posted[AFFILIATION_ID],
                FAX=>$posted[FAX],
                TELEPHONE => $posted[TELEPHONE],
                POBOX => $posted[POBOX],
                EMAIL => $posted[EMAIL],
                COUNTRY_ID => $posted[COUNTRY_ID],
                STATE_ID => $posted[STATE_ID],
                DATE_UPDATED => time()
            );
            $condition = array(MEMBER_ID=>$posted[MEMBER_ID]);
            
            if($this->db->updateTable(MEMBERS, $data, $condition)){
                return "<div class='alert-success'>Your account details were updated successfully</div>";
            }else{
                return "<div class='alert-error'>Sorry, an error occurred!</div>";
            }
        }else{
            return "<div class='alert-error'>$error</div>";
        }
    }
    
    
    public function composeMessage($fn,$ln,$act_code,$em){
        return  "Dear <strong>$fn $ln<strong>,
                <br><br>You have succesfully registered on the official website of the Philosophy of Education Association of Nigeria.
                <br>Please Click the link below to confirm your registration
                <br><a href='http://www.FDC.org.ng/confirm.php?em=$em&code=$act_code'>Click here</a>
                <br>Thank you";
    }
    
    public function validateAccount($code,$email){
        $query = "SELECT * FROM ".MEMBERS." WHERE ".EMAIL."='$email' AND ".ACTIVATION_CODE."='$code'";
        //return $query;
        if($this->db->getNumOfRows($query)>0){
            //check if that code has been used before
            $result = $this->db->fetchRow($query);
            if($result[MEMBER_STATUS]=='1'){
                return "<div class='alert-error'>Your account has already been activated previously</div>";
            }
            elseif($result[ACTIVATION_CODE_USED]=='1'){
                return "<div class='alert-error'>Sorry, this activation link has been used before</div>";
            }else{
				if(time() > $result[ACTIVATION_LINK_EXPIRY]){
					//Link has stayed more than two days
					return "<div class='alert-error'>Sorry, your activation came later than two days after registration.
                        <br>Please request for a new activation link
                        <br><a href='http://www.FDC.org.ng/newlink.php'>Click here to make a new request</a></div>";
				}else{
					//Update the users account
					$data = array(
						ACTIVATION_CODE_USED => '1',
						MEMBER_STATUS =>1
					);
					$condition = array(MEMBER_ID=>$result[MEMBER_ID]);
					if($this->db->updateTable(MEMBERS, $data, $condition)){
						return "<div class='alert-success'>Your account has been activated successfully!</div>";
					}else{
						return "<div class='alert-error'>Sorry, an error occurred while trying to activate your account.
							<br>Please request for a new activation link
							<br><a href='http://www.FDC.org.ng/newlink.php'>Click here to make a new request</a></div>";
					}
            	}
			}
			
        }else{
            return "<div class='alert-error'>Sorry, this activation link is invalid
                <br>Please request for a new activation link
                        <br><a href='http://www.FDC.org.ng/newlink.php'>Click here to make a new request</a></div>";
        }
    }
    
    public function getMemberDetailsByID($member_id){
        return $this->util->getDetails(MEMBERS, MEMBER_ID, $member_id);
    }
    
    public function getMemberDetailsByMemberCode($member_code){
        return $this->util->getDetails(MEMBERS, MEMBER_CODE, $member_code);
    }
    
    public function getMemberDetailsByEmail($member_email){
        return $this->util->getDetails(MEMBERS, EMAIL, $member_email);
    }
    
    public function getMemberDetailsByUsername($member_username){
        return $this->util->getDetails(MEMBERS, USERNAME, $member_username);
    }
    
    
}

?>
