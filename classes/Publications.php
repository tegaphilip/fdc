<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'Database.php';
require_once 'Utilities.php';
require_once 'Constants.php';
require_once 'ReportLogger.php';

class Publication
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
    
    function createJournal(){
        //capture data
        $array_fields = array(JOURNAL_TITLE,JOURNAL_ABSTRACT,JOURNAL_AUTHORS,JOURNAL_DATE
            ,JOURNAL_DAY,JOURNAL_ISBN,PUBLISHER_DETAILS,JOURNAL_MONTH,JOURNAL_YEAR,TIMELOGGED);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[JOURNAL_TITLE]))
            $error.="<br>Please enter a journal title";
        if(empty($posted[JOURNAL_DAY]) || empty($posted[JOURNAL_MONTH]) || empty($posted[JOURNAL_YEAR]))
            $error.="<br>Please select date of publication";
			
        $publish_date = mktime(0, 0, 0, $posted[JOURNAL_MONTH], $posted[JOURNAL_DAY], $posted[JOURNAL_YEAR]);

        if($publish_date > time()){
                return $this->util->displayErrorMessage("The publish date cannot be beyond today");
        }
       
        if(empty($posted[JOURNAL_AUTHORS]))
            $error.="<br>Please enter the author(s)";
			
//        if(empty($posted[JOURNAL_ISBN]))
//            $error.="<br>Please enter the ISBN";
        
        if(empty($error)){
            //All correct, proceed to insertion
            $data = array(
                JOURNAL_TITLE => $posted[JOURNAL_TITLE],
                JOURNAL_YEAR=>$posted[JOURNAL_YEAR],
                JOURNAL_ABSTRACT => $posted[JOURNAL_ABSTRACT],
                JOURNAL_AUTHORS => $posted[JOURNAL_AUTHORS],
                PUBLISHER_DETAILS => $posted[PUBLISHER_DETAILS],
                JOURNAL_DATE => $publish_date,
                JOURNAL_ISBN => $posted[JOURNAL_ISBN],
                TIMELOGGED =>time(),
                ADDEDBY => $_SESSION[ADMIN_ID]
            );
            //if(false){
            if($this->db->insertIntoTable(JOURNALS, $data)){
                $this->report->logAction("Journal '".$posted[JOURNAL_TITLE]."' was added successfully.");
                return $this->util->displaySuccessMessage("Journal '".$posted[JOURNAL_TITLE]."'
                    was added successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
        
    }
    
    function updateJournal(){
      //capture data
        $array_fields = array(JOURNAL_TITLE,JOURNALS_ID,JOURNAL_ABSTRACT,JOURNAL_AUTHORS,JOURNAL_DATE
            ,JOURNAL_DAY,JOURNAL_ISBN,PUBLISHER_DETAILS,JOURNAL_MONTH,JOURNAL_YEAR,TIMELOGGED);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[JOURNAL_TITLE]))
            $error.="<br>Please enter a journal title";
        if(empty($posted[JOURNAL_DAY]) || empty($posted[JOURNAL_MONTH]) || empty($posted[JOURNAL_YEAR]))
            $error.="<br>Please select date of publication";
       
        if(empty($posted[JOURNAL_AUTHORS]))
            $error.="<br>Please enter the author(s)";
//        if(empty($posted[JOURNAL_ISBN]))
//            $error.="<br>Please enter the ISBN";
        
        if(empty($error)){
            //All correct, proceed to insertion
           
            $publish_date = mktime(0, 0, 0, $posted[JOURNAL_MONTH], $posted[JOURNAL_DAY], $posted[JOURNAL_YEAR]);
            
            if($publish_date > time()){
                return $this->util->displayErrorMessage("The publish date cannot be beyond today");
            }
           
            $data = array(
                JOURNAL_TITLE => $posted[JOURNAL_TITLE],
                JOURNAL_YEAR=>$posted[JOURNAL_YEAR],
                JOURNAL_ABSTRACT => $posted[JOURNAL_ABSTRACT],
                JOURNAL_AUTHORS => $posted[JOURNAL_AUTHORS],
                 PUBLISHER_DETAILS => $posted[PUBLISHER_DETAILS],
                JOURNAL_DATE => $publish_date,
                JOURNAL_ISBN => $posted[JOURNAL_ISBN],
                TIMELOGGED =>time(),
                ADDEDBY => $_SESSION[ADMIN_ID]
            );
            
            if($this->db->updateTable(JOURNALS, $data,array(JOURNALS_ID=>$posted[JOURNALS_ID]))){
                $this->report->logAction("Journal '".$posted[JOURNAL_TITLE]."' was edited successfully.");
                return $this->util->displaySuccessMessage("Journal '".$posted[JOURNAL_TITLE]."'
                    was updated successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
function createBook(){
        //capture data
        $array_fields = array(BOOK_TITLE,BOOK_ABSTRACT,BOOK_AUTHORS,BOOK_DATE
            ,BOOK_DAY,BOOK_ISBN,PUBLISHER_DETAILS,BOOK_MONTH,BOOK_YEAR,TIMELOGGED);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[BOOK_TITLE]))
            $error.="<br>Please enter a BOOK title";
        if(empty($posted[BOOK_DAY]) || empty($posted[BOOK_MONTH]) || empty($posted[BOOK_YEAR]))
            $error.="<br>Please select date of publication";
       
        if(empty($posted[BOOK_AUTHORS]))
            $error.="<br>Please enter the author(s)";
//        if(empty($posted[BOOK_ISBN]))
//            $error.="<br>Please enter the ISBN";
        
        if(empty($error)){
            //All correct, proceed to insertion
           
            $publish_date = mktime(0, 0, 0, $posted[BOOK_MONTH], $posted[BOOK_DAY], $posted[BOOK_YEAR]);
            
            if($publish_date > time()){
                return $this->util->displayErrorMessage("The publish date cannot be beyond today");
            }
           //
           // ,BOOK_DAY,,BOOK_MONTH,BOOK_YEAR,TIMELOGGED
            $data = array(
                BOOK_TITLE => $posted[BOOK_TITLE],
                BOOK_YEAR => $posted[BOOK_YEAR],
                BOOK_ABSTRACT => $posted[BOOK_ABSTRACT],
                BOOK_AUTHORS => $posted[BOOK_AUTHORS],
                 PUBLISHER_DETAILS => $posted[PUBLISHER_DETAILS],
                BOOK_DATE => $publish_date,
                BOOK_ISBN => $posted[BOOK_ISBN],
                TIMELOGGED =>time(),
                ADDEDBY => $_SESSION[ADMIN_ID]
            );
            //if(false){
            if($this->db->insertIntoTable(BOOKS, $data)){
                $this->report->logAction("Book '".$posted[BOOK_TITLE]."' was added successfully.");
                return $this->util->displaySuccessMessage("Book '".$posted[BOOK_TITLE]."'
                    was added successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
        
    }
    
    function updateBOOK(){
      //capture data
        $array_fields = array(BOOK_TITLE,BOOKS_ID,BOOK_ABSTRACT,BOOK_AUTHORS,BOOK_DATE
            ,BOOK_DAY,BOOK_ISBN,PUBLISHER_DETAILS,BOOK_MONTH,BOOK_YEAR,TIMELOGGED);
        $posted = $this->util->getPostedData($array_fields);
        
        //Capture all errors
        $error = "";
        if(empty($posted[BOOK_TITLE]))
            $error.="<br>Please enter a BOOK title";
        if(empty($posted[BOOK_DAY]) || empty($posted[BOOK_MONTH]) || empty($posted[BOOK_YEAR]))
            $error.="<br>Please select date of publication";
       
        if(empty($posted[BOOK_AUTHORS]))
            $error.="<br>Please enter the author(s)";
        if(empty($posted[BOOK_ISBN]))
            $error.="<br>Please enter the ISBN";
        
        if(empty($error)){
            //All correct, proceed to insertion
           
            $publish_date = mktime(0, 0, 0, $posted[BOOK_MONTH], $posted[BOOK_DAY], $posted[BOOK_YEAR]);
            
            if($publish_date > time()){
                return $this->util->displayErrorMessage("The publish date cannot be beyond today");
            }
           //
           // ,BOOK_DAY,,BOOK_MONTH,BOOK_YEAR,TIMELOGGED
            $data = array(
                BOOK_TITLE => $posted[BOOK_TITLE],
                BOOK_YEAR => $posted[BOOK_YEAR],
                BOOK_ABSTRACT => $posted[BOOK_ABSTRACT],
                BOOK_AUTHORS => $posted[BOOK_AUTHORS],
                 PUBLISHER_DETAILS => $posted[PUBLISHER_DETAILS],
                BOOK_DATE => $publish_date,
                BOOK_ISBN => $posted[BOOK_ISBN],
                TIMELOGGED =>time(),
                ADDEDBY => $_SESSION[ADMIN_ID]
            );
            
            if($this->db->updateTable(BOOKS, $data,array(BOOKS_ID => $posted[BOOKS_ID]))){
                $this->report->logAction("Book '".$posted[BOOK_TITLE]."' was edited successfully.");
                return $this->util->displaySuccessMessage("BOOK '".$posted[BOOK_TITLE]."'
                    was updated successfully.");
            }else{
                return $this->util->displayErrorMessage("Sorry, an error occurred");
            }
        }else{
            return $this->util->displayErrorMessage("<strong>The following errors occurred:</strong>$error");
        }
    }
    
    function uploadBookCover(){
        $array_fields = array(ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('pdf');
        
        //doUpload($folder, $controlname,$exts)
        $upload = $this->util->doUpload("../uploadedfiles/books", $_FILES[BOOK_COVER],$allowable);
        
        if(is_array($upload)){
            //updateTable($table,$data,$condition)
            if($this->db->updateTable(BOOKS, array(BOOK_COVER => $upload[FILE_NAME]),array(ID=>$posted[ID]))){
                $book = $this->util->getDetails(BOOKS, ID, $posted[ID]);
                $this->report->logAction("Book ".$book[BOOK_TITLE]."'s cover was updated .");
                return $this->util->displaySuccessMessage("Photo has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Photo update was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
    }
    
    function uploadBookDoc(){
        $array_fields = array(ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('pdf');
        
        //doUpload($folder, $controlname,$exts)
        $upload = $this->util->doUpload("../uploadedfiles/books", $_FILES[BOOK_DOC],$allowable);
        
        if(is_array($upload)){
            //updateTable($table,$data,$condition)
            if($this->db->updateTable(BOOKS, array(BOOK_DOC => $upload[FILE_NAME]),array(ID=>$posted[ID]))){
                $book = $this->util->getDetails(BOOKS, ID, $posted[ID]);
                $this->report->logAction("Book ".$book[BOOK_TITLE]."'s document was updated .");
                return $this->util->displaySuccessMessage("Document has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Document upload was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
    }
    
    function uploadJournalDoc(){
        $array_fields = array(ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('pdf');
        
        //doUpload($folder, $controlname,$exts)
        $upload = $this->util->doUpload("../uploadedfiles/journals", $_FILES[JOURNAL_DOC],$allowable);
        
        if(is_array($upload)){
            //updateTable($table,$data,$condition)
            if($this->db->updateTable(JOURNALS, array(JOURNAL_DOC => $upload[FILE_NAME]),array(ID=>$posted[ID]))){
                $book = $this->util->getDetails(JOURNALS, ID, $posted[ID]);
                $this->report->logAction("Journal ".$book[JOURNAL_TITLE]."'s document was updated .");
                return $this->util->displaySuccessMessage("Document has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Document upload was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
    }
    
    function uploadJournalCover(){
        $array_fields = array(ID);
        $posted = $this->util->getPostedData($array_fields);
        $allowable = array('pdf');
        
        //doUpload($folder, $controlname,$exts)
        $upload = $this->util->doUpload("../uploadedfiles/journals", $_FILES[JOURNAL_COVER],$allowable);
        
        if(is_array($upload)){
            if($this->db->updateTable(JOURNALS, array(JOURNAL_COVER => $upload[FILE_NAME]),array(ID=>$posted[ID]))){
                $book = $this->util->getDetails(JOURNALS, ID, $posted[ID]);
                $this->report->logAction("Journal ".$book[JOURNAL_TITLE]."'s cover was updated .");
                return $this->util->displaySuccessMessage("Photo has been updated");
            }
            else{
                return $this->util->displayErrorMessage("Photo update was not successful");
            }
        }else{
            return $this->util->displayErrorMessage($upload);
        }
    }
	
    public function getJournals(){
        return $this->db->getWhere(JOURNALS,null,null);
    }
    
    public function deleteJournal($jid){
        //$table,$condition
        $book = $this->util->getDetails(JOURNALS, ID, $posted[ID]);
        $this->db->deleteFromTable(JOURNALS, array(JOURNALS_ID => $jid));
        $this->report->logAction("Journal ".$book[JOURNAL_TITLE]."' was deleted .");
    }
    
    public function getBooks(){
        return $this->db->getWhere(BOOKS,null,null);
    }
	
    public function deleteBook($bid){
        //$table,$condition
        $book = $this->util->getDetails(BOOKS, ID, $posted[ID]);
        $this->db->deleteFromTable(BOOKS, array(BOOKS_ID => $bid));
        $this->report->logAction("Book ".$book[BOOK_TITLE]."' was deleted .");
    }
	
	
    
}

?>
