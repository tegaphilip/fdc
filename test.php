<?php

require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
$cons = new Constants();
$member = new Member();
$util = new Utilities();
$data = array(
    AFFILIATION_CODE=>$util->getUniqueCode(AFFILIATIONS, AFFILIATION_CODE),
    AFFILIATION_NAME => 'University of Benin'
);

$condition = array(
  MEMBER_ID => '1',
  MEMBER_STATUS => '1'
);

$db->insertIntoTable(AFFILIATIONS, $data);

//$order_by = array(MEMBER_CODE,USERNAME);

//var_dump($data);

//$sals = $db->getWhere(SALUTATIONS,null,$order_by);

var_dump($sals);

?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1">
    <tr>
      <td>Username</td>
      <td><input type="text" name="<?php echo USERNAME; ?>" id="<?php echo USERNAME; ?>" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="<?php echo PASSWORD; ?>" id="<?php echo PASSWORD; ?>" /></td>
    </tr>
    <tr>
      <td>Contact Address</td>
      <td><textarea name="<?php echo CONTACT_ADDRESS; ?>" id="<?php echo CONTACT_ADDRESS; ?>" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
  </table>
</form>