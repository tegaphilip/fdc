<?php
    require_once 'classes/Database.php';
    require_once 'classes/Utilities.php';
    require_once 'classes/Constants.php';
    require_once 'classes/Member.php';
    
    $db = new Database();
    new Constants();
    $util = new Utilities();
    
    $names = array(
        "President","Vice president I","Vice president II","Secretary","Assistant Secretary",
        "Financial Secretary","Treasurer","Editor","Public Relations Officer","Social Secretary","Business Manager"
    );
    
    foreach($names as $name){
    
        $data = array(
            OFFICE_CODE=>$util->getUniqueCode(OFFICES, OFFICE_CODE),
            OFFICE_NAME => $name,
            DATE_ADDED=>time()
        );
        $db->insertIntoTable(OFFICES, $data);
    }
    
    
?>	