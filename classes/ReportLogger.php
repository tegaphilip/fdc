<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'Database.php';
require_once 'Constants.php';

class ReportLogger
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        new Constants();
    }
    
    public function  logAction($action){
        $data = array(
            ADMIN_ID => $_SESSION[ADMIN_ID],
            DATE_ADDED => time(),
            ACTION =>$action
        );
        if($_SESSION[ADMIN_ID]!=NULL)
            $this->db->insertIntoTable(AUDIT_LOGS, $data);
    }
}

?>