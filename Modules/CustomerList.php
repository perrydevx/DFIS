<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php"; 
include "../Class/DataAccess.php";

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();
$DA = new DataAccess();


$name 		= "";
$cust_stat 	= "";
$year 		= date('Y');
$c_stat 	= "";
$c_no   	= "";
$p_type     = "";

if (isset($_POST['btnSearch'])) {	
	$name 		= $_POST['txtName'];
	$year 		= $_POST['txtYear'];
	$cust_stat  = $_POST['cboStat'];
	$c_stat 	= $_POST['cboCheckStat'];
	$c_no   	= $_POST['txtCheckNo'];
	$p_type     = $_POST['cboPayType'];
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
<form name="frmCustList" method="post" action="CustomerList.php">
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
            <td class="content" width="100%"><span class="text_title">&nbsp;Customer 
              List</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
            <td valign="top" class="content"> 
              <hr>
		  </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td width="11%" nowrap>&nbsp;CUSTOMER</td>
                  <td width="35%"><input type="text" name="txtName" class="txt" size="50" maxlength="100" value="<?=$name?>"></td>
                  <td width="4%">&nbsp;YEAR</td>
                  <td width="50%"><input type="text" name="txtYear" class="txt" size="7" maxlength="4" value="<?=$year?>"></td>
                </tr>
                <tr> 
                  <td height="13" nowrap>&nbsp;PAYMENT TYPE</td>
                  <td><select name="cboPayType" style="WIDTH:100">
				   <option value = "" ></option>
                      <option <?php if ($p_type=='CASH') echo 'selected';?> value = "CASH" >CASH</option>
                      <option <?php if ($p_type=='CHECK') echo 'selected';?> value = "CHECK">CHECK</option>
					  <option <?php if ($p_type=='CTF') echo 'selected';?> value = "CTF">CTF</option>
					  <option <?php if ($p_type=='CONS') echo 'selected';?> value = "CONS">CONS</option>
					  <option <?php if ($p_type=='OTHER') echo 'selected';?> value = "OTHER">OTHER</option>
                    
                    </select> </td>
                  <td>&nbsp;ORDER STATUS</td>
                  <td><select name="cboStat" style="WIDTH:120">
                      <option value=''></option>
                      <option value='FD' <?php if ($cust_stat=='FD') echo 'selected';?> >FOR 
                      DELIVERY</option>
					  <option value='PAR' <?php if ($cust_stat=='PAR') echo 'selected';?>>PARTIAL</option>
                      <option value='DEL' <?php if ($cust_stat=='DEL') echo 'selected';?>>DELIVERED</option>
                    </select></td>
                </tr>
                <tr> 
                  <td height="13" nowrap>&nbsp;CHECK NO</td>
                  <td><input type="text" name="txtCheckNo" class="txt" size="50" maxlength="100" value="<?=$c_no?>"></td>
                  <td nowrap>&nbsp;CHECK STATUS&nbsp;</td>
                  <td><select name="cboCheckStat" style="WIDTH:120">
				   <option value = "" ></option>
                      <option <?php if ($c_stat=='CLEARED') echo 'selected';?> value = "CLEARED" >CLEARED</option>
                      <option <?php if ($c_stat=='PENDING') echo 'selected';?> value = "PENDING" >PENDING</option>
                      <option <?php if ($c_stat=='BOUNCED') echo 'selected';?> value = "BOUNCED">BOUNCED</option>
                    </select></td>
                </tr>
                
              </table><BR>
              <input type="submit" name="btnSearch" value="Search" class="btn" style="width: 100">
            <hr>
              <div align="right">
                <input type="button" name="btnNew" value="New Customer" class="btn" style="width: 100" align="right" onClick="javascript:window.location='CustomerAdd.php'">
                <br>
                <br>
                <?php
			 	if ($x>0) {							
			 ?>
              </div>
              <table width="100%" height="47" border="0" cellpadding="2" cellspacing="2">
                <tr> 
                  <td class="result_header" nowrap width="5%">&nbsp;ORDER 
                    DATE&nbsp;</td>
                  <td class="result_header" nowrap width="35%">&nbsp;CUSTOMER&nbsp;</td>
                  <td nowrap class="result_header" width="5%"><div align="right">&nbsp;TOTAL PRICE&nbsp;</div></td>
                  <td nowrap class="result_header" width="5%">&nbsp;PAYMENT&nbsp;</td>
                  <td nowrap class="result_header" width="35%">&nbsp;BANK BRANCH / 
                    CHECK NO&nbsp;</td>
                  <td width="5%" nowrap class="result_header">&nbsp;DUE DATE&nbsp;</td>
                  <td width="5%" nowrap class="result_header">&nbsp;CHECK STATUS&nbsp;</td>
                  <td width="5%" nowrap class="result_header">&nbsp;ORDER STATUS&nbsp;</td>
                </tr>
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td height="20%" nowrap>&nbsp; 
                    <?= $arr[$i]['customer_date']?>&nbsp;
                  </td>
                  <td  nowrap><a href="Customer.php?cd=<?= $arr[$i]['customer_cd']?>"  onMouseOver="javascript:rw<?=$i;?>.style.background = '#F0F0F0';" onMouseOut="javascript:rw<?=$i;?>.style.background = '#ffffff';"> 
                    <?= $arr[$i]['customer_name']?>
                    </a></td>
                  <td  nowrap> <div align="right"> 
                      &nbsp;<?php  echo number_format($CC->total_purcahsed($arr[$i]['customer_cd']),2,'.',',');?>
                      &nbsp;php&nbsp;</div></td>
                  <td >&nbsp;
                    <?= $arr[$i]['pay_type']?>&nbsp;
                  </td>
                  <td  nowrap>
                    <?php  if ($arr[$i]['bank_branch']!='' && $arr[$i]['check_no']!='' )  {
						   			echo($arr[$i]['bank_branch']."<BR>chk no. ".$arr[$i]['check_no']);
							}
							else if ($arr[$i]['bank_branch']=='' && $arr[$i]['check_no']!='' ) {
									echo("chk no. ".$arr[$i]['check_no']);
							}
							else if ($arr[$i]['bank_branch']!='' && $arr[$i]['check_no']=='' ) {
									echo($arr[$i]['bank_branch']);
							}
								
					?>&nbsp;
                  </td>
                  <td nowrap>&nbsp;
                    <?php if ($arr[$i]['due_date_x'] <= $DA->get_current_date(3) && ($arr[$i]['check_stat'] == 'PENDING' || $arr[$i]['check_stat'] == 'BOUNCED')) echo "<font color='#FF0000'>".$arr[$i]['due_date']."</font>"; else echo $arr[$i]['due_date']; ?>&nbsp;
                  </td>
                  <td>&nbsp;
                    <?php if ($arr[$i]['check_stat']=='BOUNCED') echo "<font color='#FF0000'>".$arr[$i]['check_stat']."</font>"; else echo $arr[$i]['check_stat'];?>&nbsp;
                  </td>
                  <td >&nbsp; 
                    <?php  if  ($arr[$i]['cust_stat']=='DEL') echo "DELIVERED"; else if ($arr[$i]['cust_stat']=='FD') echo "FOR DELIVERY"; else if ($arr[$i]['cust_stat']=='PAR') echo "PARTIAL"?>&nbsp; 
                  </td>
                </tr>
                <?php }  ?>
              </table>
			  <hr>
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td height="22">&nbsp;<strong> GRAND TOTAL&nbsp;&nbsp;
                      <?php echo  number_format($CC->grand_total(addslashes($name),addslashes($cust_stat),addslashes($year),addslashes($p_type),addslashes($c_no),addslashes($c_stat)),2,'.',',');?> 
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
