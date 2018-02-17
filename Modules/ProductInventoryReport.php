<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php";
include "../class/DataAccess.php";

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();
$DA   = new DataAccess();


$code   = $_GET['cd'];
$name   = $_GET['name'];
$s_stat = $_GET['s_stat'];


$PI->load_records(addslashes($code),addslashes($name),addslashes($s_stat));
$arr = $PI->get_arr();
$x = count($arr); 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Dragon Fireworks Inventory System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../StyleSheet/report.css" rel="stylesheet">
<script language="JavaScript" src="../javascript/PrintPage.js"></script>
</head>

<body>
<form name="frmReport" method="post" action="ProductInventoryReport.php"><br>
  <table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td><div align="center">&nbsp;<span class="report1">PRODUCTS INVENTORY REPORT</span></div></td>
    </tr>
    <tr> 
      <td><div align="center"><span class="report1">DRAGON FIREWORKS INVENTORY 
          SYSTEM</span></div></td>
    </tr>
    <tr> 
      <td> <div align="center"><span class="report1"> 
          <?= $DA->get_current_date();?>
          </span> </div></td>
    </tr>
     <tr>
      <td> <div align="center"><span class="report2"> 
          <?php switch ($s_stat) {
	  										case 'AVA':
												echo "AVALABLE STOCKS";
												break;
											case 'RES':
												echo "RESEREVED/SOLD STOCKS";
												break;
											case 'PND':
												echo "PENDING STOCKS";
												break;
											default;
										}
	  ?>
          </span> </div></td>
    </tr>
  </table>
  <br>
 
  <?php
			 	if ($x>0) {							
			 ?>
  		 
  <table width="70%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="cccccc">
    <tr class="tbl_header"> 
      <td class="result_header" nowrap width="15%">&nbsp;CODE&nbsp;</td>
      <td class="result_header" nowrap width="55%">&nbsp;NAME&nbsp;</td>
      <td class="result_header" nowrap width="15%">&nbsp;PRICE/item </td>
      <td width="5%" nowrap class="result_header">&nbsp;AVAILABLE&nbsp;</td>
      <td width="5%" nowrap class="result_header">&nbsp;RESERVED/SOLD&nbsp;</td>
      <td width="5%" nowrap class="result_header">&nbsp;PENDING&nbsp;</td>
    </tr>
    <?php for($i=0;$x>$i;$i++) {?>
    <tr> 
      <td>&nbsp; 
        <?= $arr[$i]['prod_code']?>
      </td>
      <td nowrap>&nbsp; 
        <?= $arr[$i]['prod_name']?>
        &nbsp; </td>
      <td nowrap><div align="right">&nbsp; 
          <?php  echo number_format($arr[$i]['price'],2,'.',',') ?>
          &nbsp;php&nbsp; </div></td>
      <td><div align="right">&nbsp; 
          <?php if  ($arr[$i]['quantity'] == 0) echo($arr[$i]['quantity']); else echo("<strong>".$arr[$i]['quantity']."</strong>"); ?>
          &nbsp; </div></td>
      <td><div align="right">&nbsp; 
          <?php if  ($arr[$i]['res_qty'] == 0) echo($arr[$i]['res_qty']); else echo("<font color='#0000ff'><strong>".$arr[$i]['res_qty']."</strong></font>"); ?>
          &nbsp;</div></td>
      <td><div align="right">&nbsp; 
          <?php if  ($arr[$i]['order_qty'] == 0) echo($arr[$i]['order_qty']); else echo("<font color='#FF0000'><strong>".$arr[$i]['order_qty']."</strong></font>"); ?>
          &nbsp; </div></td>
    </tr>
    <?php } ?>
    <tr> 
      <td colspan="3">&nbsp;<strong>TOTAL php</strong></td>
      <td nowrap><div align="right"><strong><?php echo number_format($PI->total_ava(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong>&nbsp; </div></td>
      <td nowrap><div align="right"><strong><?php echo number_format($PI->total_res(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong>&nbsp; </div></td>
      <td nowrap><div align="right"><strong><?php echo number_format($PI->total_pnd(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong>&nbsp; </div></td>
  </table>
			  
  <?PHP } else echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									NO RECORD(s) FOUND."; ?>
  <p>&nbsp;</p>
</form>
</body>
</html>
<script language="JavaScript">
	PrintThisPage();
</script>
