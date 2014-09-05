<?php
class Constants 
{
    public function __construct(){
        
        //Member Based Constants
        define('MEMBERS', 'members');
        define('MEMBER_ID', 'member_id');
        define('MEMBER_CODE', 'member_code');
        define('TITLE', 'title');
        define('FIRST_NAME','first_name');
        define('OTHER_NAMES', 'other_names');
        define('LAST_NAME', 'last_name');
        define('USERNAME', 'username');
        define('EMAIL', 'email');
        define('PASSWORD', 'password');
		define('OLD_PASSWORD', 'old_password');
        define('CONFIRM_PASSWORD', 'confirm_password');
        define('DATE_REGISTERED', 'date_registered');
        define('NUM_LOGINS', 'num_logins');
        define('ACTIVATION_CODE', 'activation_code');
        define('ACTIVATION_CODE_USED', 'activation_code_used');
		define('ACTIVATION_LINK_EXPIRY','activation_link_expiry');
        define('MEMBER_STATUS', 'member_status');
        define('PICTURE', 'picture');
        define('GENDER', 'gender');
		define('PASSWORD_RETRIEVAL_CODE','password_retrieval_code');
		define('PASSWORD_RETRIEVAL_CODE_USED','password_retrieval_code_used');


        //Affiliation-based Constant
        define('AFFILIATIONS', 'affiliations');
        define('AFFILIATION_ID', 'affiliation_id');
        define('AFFILIATION_CODE', 'affiliation_code');
        define('AFFILIATION_NAME', 'affiliation_name');

        //State-based constants
        define('STATES', 'states');
        define('STATE_ID', 'state_id');
        define('STATE_CODE', 'state_code');
        define('STATE_NAME', 'state_name');

        //Admin-based constants
        define('ADMINISTRATORS','administrators');
        define('ADMIN_ID', 'admin_id');
        define('ADMIN_CODE', 'admin_code');
        define('ADMIN_STATUS', 'admin_status');
        define('ADMIN_TYPE', 'admin_type');



        //General Constants
        define('DATE_UPDATED', 'date_updated');
        define('START_TIME','start_time');
        define('END_TIME','end_time');
        define('DAY_TITLE','day_title');
        define('DATE_ADDED', 'date_added');
        define('ADDED_BY','added_by');
        define('FAX', 'fax');
        define('TELEPHONE', 'telephone');
        define('PROFESSION','profession');
        define('POBOX', 'pobox');
        define('URL', 'url');
        define('ID', 'id');
        define('CONTACT_ADDRESS', 'contact_address');

        //Audit-log constants
        define('AUDIT_LOGS','audit_logs');
        define('ACTION','action');

        //Sponsor-based constants
        define('SPONSOR_ID','sponsor_id');
        define('SPONSORS','sponsors');
        define('SPONSOR_CODE','sponsor_code');
        define('SPONSOR_NAME','sponsor_name');
        define('SPONSOR_URL','sponsor_url');
        define('SPONSOR_LOGO','sponsor_logo');
        define('ACTIVATION_STATUS','activation_status');

        //Linkage-based constants
        define('LINKAGE_ID','linkage_id');
        define('LINKAGES','linkages');
        define('LINKAGE_CODE','linkage_code');
        define('LINKAGE_NAME','linkage_name');
        define('LINKAGE_URL','linkage_url');
        define('LINKAGE_LOGO','linkage_logo');



        //Country-based constants
        define('COUNTRIES','countries');
        define('COUNTRY_ID','country_id');
        define('COUNTRY_CODE','country_code');
        define('COUNTRY_NAME','country_name');
        define('COUNTRY_FLAG_URL','country_flag_url');

        //Conference -based constants
        define('CONFERENCES','conferences');
        define('CONFERENCE_DETAILS','conference_details');
        define('CONFERENCE_DETAIL_ID','conference_detail_id');
        define('CONFERENCE_ID','conference_id');
        define('CONFERENCE_CODE','conference_code');
        define('CONFERENCE_TITLE','conference_title');
        define('START_DATE','start_date');
        define('TIME','time');
        define('ERROR_TRANSFERER','error_transferer');
        define('TRANSFERER','transferer');
        define('FILE_NAME','file_name');
        define('END_DATE','end_date');
        define('VENUE','venue');
        define('AMOUNT_CHARGED','amount_charged');
        define('LOGO','logo');
        define('CONFERENCE_CHAIRMAN','conference_chairman');
        define('CHAIRMAN_POSITION','chairman_position');
        define('CURRENT','current');
        define('CONFERENCE_ATTENDANCE','conference_attendance');
        define('ATTENDEE_ID','attendee_id');
        define('FULL_NAME','full_name');
        define('IS_MEMBER','is_member');
        define('AMOUNT_PAID','amount_paid');
        define('PAYMENT_CONFIRMED','payment_confirmed');
        define('DATE_PAYMENT_WAS_CONFIRMED','date_payment_was_confirmed');
        define('DATE_PAYMENT_WAS_MADE','date_payment_was_made');
        define('CONFERENCE_REGISTRATION_TYPES','conference_registration_types');
        define('CONFERENCE_REGISTRATION_TYPE_ID','conference_registration_type_id');
        define('CONFERENCE_REGISTRATION_TYPE_NAME','conference_registration_type_name');
        define('CONFERENCE_REGISTRATION_TYPE_code','conference_registration_type_code');

        //Offices
        define('OFFICES','offices');
        define('OFFICE_ID','office_id');
        define('OFFICE_CODE','office_code');
        define('OFFICE_NAME','office_name');
        define('TENURE_PERIOD','tenure_period');
        define('OFFICERS','officers');
        define('OFFICER_ID','officer_id');
        define('DATE_SWORN_IN','date_sworn_in');
        define('DATE_LEFT_OFFICE','date_left_office');
        define('STATUS','status');


        define('START_DAY','start_day');
        define('START_MONTH','start_month');
        define('START_YEAR','start_year');
        define('END_DAY','end_day');
        define('END_MONTH','end_month');
        define('END_YEAR','end_year');


        define('SALUTATIONS','salutations');
        define('SALUTATION','salutation');
        define('SALUTATION_ID','salutation_id');

        define('MAILER_DAEMON','no-reply@FDC.org.ng');


        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        ||CONSTANTS I ADDED
        ||Journals
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        define('JOURNALS','journals');
        define('JOURNALS_ID','id');
        define('JOURNAL_TITLE','journal_title');
        define('JOURNAL_AUTHORS','journal_authors');
        define('JOURNAL_DATE','journal_date');
        define('JOURNAL_ABSTRACT','journal_abstract');
        define('JOURNAL_ISBN','journal_isbn');
        define('JOURNAL_DAY','journal_day');
        define('JOURNAL_MONTH','journal_month');
        define('JOURNAL_YEAR','journal_year');
        define('JOURNAL_COVER','journal_cover');
        define('JOURNAL_DOC','journal_doc');
        define('TIMELOGGED','dateupdate');
        define('ADDEDBY','addedby');

        define('PUBLISHIMG','publishimg');
        define('PUBLISHTYPE','publistype');
        //define('','publistype');

        //Books
        define('BOOKS','books');
        define('BOOKS_ID','id');
        define('BOOK_TITLE','book_title');
        define('BOOK_AUTHORS','book_authors');
        define('BOOK_DATE','book_date');
        define('BOOK_ABSTRACT','book_abstract');
        define('BOOK_ISBN','book_isbn');
        define('PUBLISHER_DETAILS','publisher_details');
        define('BOOK_DAY','book_day');
        define('BOOK_COVER','book_cover');
        define('BOOK_DOC','book_doc');
        define('BOOK_MONTH','book_month');
        define('BOOK_YEAR','book_year');

        define('PUBLIACTION', 'pubaction');
    }
}

?>
