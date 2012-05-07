<?php
// Initialize stuffs.
$day = $month = $year = $sel = $what = $field = $form = ""; 
$counter = 0;
$disablePastDays = false;

// Let's just simplify everything by just extracting any request (both POST or GET methods) to get querystring.
extract($_REQUEST);

if ($day == "") $day = date("j"); 
if ($month == "") $month = date("m"); 
if ($year == "") $year = date("Y"); 

$currentTimeStamp = strtotime("$year-$month-$day"); 
$monthName = date("F", $currentTimeStamp); 
$numDays = date("t", $currentTimeStamp); 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP Calendar</title> 
<link rel="stylesheet" type="text/css" href="calendar.css"> 
<script language="javascript"> 
	function goLastMonth(month,year,form,field,disable) { 
		// If the month is January, decrement the year. 
		if(month == 1) { 
			--year; 
			month = 13; 
		}        
		document.location.href = 'calendar.php?month='+(month-1)+'&year='+year+'&form='+form+'&field='+field+'&disablePastDays='+disable; 
	} 
		
	function goNextMonth(month,year,form,field,disable) { 
		// If the month is December, increment the year. 
		if(month == 12) { 
			++year; 
			month = 0; 
		}    
		document.location.href = 'calendar.php?month='+(month+1)+'&year='+year+'&form='+form+'&field='+field+'&disablePastDays='+disable; 
	} 
		
	function sendToForm(val,field,form) { 
		// Send back the date value to the form caller. 
		eval("opener.document." + form + "." + field + ".value='" + val + "'"); 
		window.close(); 
	} 
</script> 
</head> 
<body style="margin:0px 0px 0px 0px" class="body"> 
<table width='175' border='0' cellspacing='0' cellpadding='0' class="body"> 
    <tr> 
        <td width='25' colspan='1'> 
        <input type='button' class='button' value=' < ' onClick='<?php echo "goLastMonth($month,$year,\"$form\",\"$field\",\"$disablePastDays\")"; ?>'> 
        </td> 
        <td width='125' align="center" colspan='5'> 
        <span class='title'><?php echo $monthName . " " . $year; ?></span><br> 
        </td> 
        <td width='25' colspan='1' align='right'> 
        <input type='button' class='button' value=' > ' onClick='<?php echo "goNextMonth($month,$year,\"$form\",\"$field\",\"$disablePastDays\")"; ?>'> 
        </td> 
    </tr> 
    <tr> 
        <td class='head' align="center" width='25'>S</td> 
        <td class='head' align="center" width='25'>M</td> 
        <td class='head' align="center" width='25'>T</td> 
        <td class='head' align="center" width='25'>W</td> 
        <td class='head' align="center" width='25'>T</td> 
        <td class='head' align="center" width='25'>F</td> 
        <td class='head' align="center" width='25'>S</td> 
    </tr> 
    <tr> 
	<?php 
    for ($i = 1; $i < $numDays+1; $i++, $counter++) { 
        $timeStamp = strtotime("$year-$month-$i");
		$today = strtotime(date('Y-m-d'));
		
        if ($i == 1) { 
            // Workout when the first day of the month is 
            $firstDay = date("w", $timeStamp); 
            
            for ($j = 0; $j < $firstDay; $j++, $counter++) echo "<td> </td>"; 
        } 
            
        if ($counter % 7 == 0) echo "</tr><tr>"; 
        
		if ($disablePastDays && ($timeStamp < $today)) $value = "<font class='disabled'>$i</font>";
		else {
			if (date("w", $timeStamp) == 0) $class = "class='weekend'"; 
			else {
				if ($timeStamp == $today) $class = "class='today'";
				else $class = "class='normal'";
			}
			
			$value = "<a class='buttonbar' href='#' onclick=\"sendToForm('".sprintf("%02d/%02d/%04d", $month, $i, $year)."','$field','$form');\"><font $class>$i</font></a>";
		}
            
        echo "<td class='tr' bgcolor='#ffffff' align='center' width='25'>$value</td>"; 
    } 
    ?> 
    </tr> 
</table> 
</body> 
</html>