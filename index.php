<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP Calendar</title>
</head>

<body>
<form name="frmMain" method="post">
  Date:
  <input type="text" name="txtDate" value="<?php echo date('m/d/Y'); ?>" size="15" maxlength="10"> 
  Disable Past Days: 
  <input type="checkbox" name="chkDisable" />
  <input type="button" name="cmdCal" value="Launch Calendar" onClick='javascript:var disabled=""; if(document.frmMain.chkDisable.checked) {disabled="true"}; window.open("calendar.php?form=frmMain&field=txtDate&disablePastDays="+disabled,"","top=50,left=400,width=175,height=140,menubar=no,toolbar=no,scrollbars=no,resizable=no,status=no"); return false;'>
</form>
</body>
</html>