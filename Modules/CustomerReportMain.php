<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php"; 

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();

$name 		= "";
$cust_stat 	= "";
$year 		= date('Y');
$c_stat 	= "";
$c_no   	= "";
$p_type     = "";

if (isset($_POST['btnSearch'])) {	
	$name 		= $_POST['txtName'];
	$year 		= $_POST['txtYear'];	
}

$CC->load_records(addslashes($name),addslashes($cust_stat),addslashes($year),addslashes($p_type),addslashes($c_no),addslashes($c_stat));
$arr = $CC->get_arr();
$x = count($arr); 

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Dragon Fireworks Inventory System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../StyleSheet/djarc.css" rel="stylesheet">
</head>
<body leftmargin=0 rightmargin=0 topmargin="0" marginwidth="0" marginheight="0">
<form name="frmCustListR" method="post" action="CustomerReportMain.php">
<!-- HEADER -->
<?php include "Header.php"; ?>
<!-- HEADER -->

<!-- BODY -->
<table cellspacing="0" cellpadding="0" width="100%" border="0" height="80%">
  <tr> 
    <td class="panel" width="179">
	  <img height="28" src="../Images/PanelTab.gif" width="179" border="0"> 
	  <br>
	  <?php include "Panel.php"; ?>
    </td>
    <td class="split" width="1"><img height="1" src="../Images/Pixel.gif" width="1" border="0"></td>
    <td class="main_page" width="100%"> 
	  <table style="border-collapse: collapse" bordercolor="#111111" height="6" cellspacing="0" cellpadding="0" width="100%" border="0">
        <tr> 
          <td class="headerline" width="100%"><img height=6 src="../Images/PanelBox.gif" width=6 border="0"></td>
        </tr>
      </table>
      <?php include "Menu.php"; ?>
      <table cellspacing="0" width="100%" border="0">
        <tr> 
          <td class="content" width="100%"><span class="text_title">&nbsp;</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
		  	<table border="0" cellpadding="2" cellspacing="0" width="100%">
                <tr> 
                  <td width="51%" height="23" class="content"><span class="text_title">Customer Sales 
                    Report</span>&nbsp; </td>
                  <td width="49%" class="content"> <div align="right"> </div></td>
                </tr>
              </table> 
		    <hr>
		  </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td width="11%" nowrap>&nbsp;CUSTOMER</td>
                  <td width="89%"><input type="text" name="txtName" class="txt" size="50" maxlength="100" value="<?=$name?>"></td>
                </tr>
                <tr> 
                  <td height="13" nowrap>&nbsp;YEAR</td>
                  <td><input type="text" name="txtYear" class="txt" size="7" maxlength="4" value="<?=$year?>">
                    &nbsp;</td>
                </tr>
              </table>
              <BR>
              <input type="submit" name="btnSearch" value="Search" class="btn" style="width: 100">
              <hr>
              
             <?php
			 	if ($x>0) {							
			 ?><table width="100%" border="0" cellspacing="2" cellpadding="2">
 <tr> 
                  <td class="result_header" nowrap width="14%">&nbsp;ORDER DATE&nbsp;</td>
                  <td class="result_header" nowrap width="48%">&nbsp;CUSTOMER&nbsp;</td>
                  <td nowrap class="result_header" width="12%"><div align="right">&nbsp;TOTAL 
                      PRICE&nbsp;</div></td>
                  <td nowrap class="result_header" width="26%">&nbsp;</td>
                </tr>
</table>
 <div  style="z-index:1; overflow: scroll; width: 100%; height: 240px;"> 
             
              <table width="100%" height="27" border="0" cellpadding="2" cellspacing="2">
                
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td width="14%"nowrap>&nbsp; 
                    <?= $arr[$i]['customer_date']?>
                    &nbsp; </td>
                    <td width="49%" >&nbsp;<a href="CustomerReport.php?cd=<?= $arr[$i]['customer_cd']?>"  onMouseOver="javascript:rw<?=$i;?>.style.background = '#F0F0F0';" onMouseOut="javascript:rw<?=$i;?>.style.background = '#ffffff';"> 
                      <?= $arr[$i]['customer_name']?>
                      </a>&nbsp;
                      <input type="hidden" name="hiddenField" value = ></td>
                  <td width="12%"  nowrap> <div align="right"> &nbsp; 
                      <?php  echo number_format($CC->total_purcahsed($arr[$i]['customer_cd']),2,'.',',');?>
                      &nbsp;php&nbsp;</div></td>
                  <td width="25%"  nowrap>&nbsp;</td>
                </tr>
                <?php }  ?>
              </table></div>
			  <hr>
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td width="62%" height="22"><div align="right">&nbsp;<strong> 
                      GRAND TOTAL&nbsp;&nbsp;</strong></div></td>
                  <td width="38%"><strong> <?php echo  number_format($CC->grand_total(addslashes($name),addslashes($cust_stat),addslashes($year),addslashes($p_type),addslashes($c_no),addslashes($c_stat)),2,'.',',');?> 
                    &nbsp;php </strong></td>
                </tr>
              </table>
              <?PHP } else echo "<br><strong>NO RECORD(s) FOUND.</strong>"; ?>
			
		  </td>
        </tr>
      </table>
	</td>
    <td class="split" width="1"><img height="1" src="../Images/Pixel.gif" width="1" border="0"></td>
  </tr>
</table>
<!-- BODY -->
<!-- FOOTER -->
<?php include "Footer.php"; ?>
<!-- FOOTER -->
</form>
</body>
</html>
