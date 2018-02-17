<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php"; 
include "../class/DataAccess.php";

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();
$DA   = new DataAccess();

$cd = $_GET['cd'];

$CC->load_record($cd);


$CC->load_orders($cd);
$arr = $CC->get_arr();
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
  
  <table width="70%" border="0" align="center" cellpadding="0" cellspacing="2" bordercolor="cccccc">
    <tr > 
      <td nowrap class="result_header"><strong><font color="#333333" size="2">&nbsp;Dragon Fireworks 
        Order List</font></strong></td>
    </tr>
    <tr > 
      <td nowrap class="result_header"><strong><font color="#333333">&nbsp;Customer 
        Name:</font> <font size="2"> &nbsp;&nbsp;
        <?=$CC->get_name();?>
        </font></strong></td>
    </tr>
    <tr> 
      <td><strong><font size="2">&nbsp;</font><font color="#333333">Order Date:</font><font size="2"> 
        &nbsp;&nbsp;
        <?=$CC->get_cust_date();?>
        </font></strong></td>
    </tr>
  </table>
		<br>	  
  <?php
		if ($x>0) {							
?>
  <table width="70%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="cccccc">
    <tr class="TBL_HEADER"> 
      <td  nowrap width="70%">&nbsp;ITEMS ORDERED&nbsp;</td>
      <td  nowrap width="10%"><div align="right">&nbsp;PRICE/item&nbsp;</div></td>
      <td  nowrap width="10%">&nbsp;QUANTITY&nbsp;</td>
      <td  nowrap width="10%"><div align="right">&nbsp;TOTAL&nbsp;</div></td>
    </tr>
    <?php for($i=0;$x>$i;$i++) {?>
    <tr id="rw<?=$i;?>"> 
      <td nowrap>&nbsp; 
        <?= $arr[$i]['prod_name']?>
      </td>
      <td nowrap><div align="right">&nbsp; 
          <?php  echo number_format($arr[$i]['price_t'],2,'.',',')?>
          &nbsp;php&nbsp;</div></td>
      <td width="10%">&nbsp; 
        <?= $arr[$i]['qty']?>&nbsp;
      </td>
      <td nowrap><div align="right"> 
          <?php  echo number_format($arr[$i]['price'],2,'.',',')?>
          &nbsp;php</div></td>
    </tr>
    <?php }  ?>
    <tr id="rw<?=$i;?>"> 
      <td height="12" colspan="3" nowrap><div align="right"><strong><font size="2">&nbsp; GRAND TOTAL</font>&nbsp;&nbsp;</strong></div></td>
      <td nowrap><strong> 
        <div align="right"> <font size="2">&nbsp;
          <?php  echo number_format($CC->total_purcahsed($cd),2,'.',',');?>
          &nbsp;php&nbsp;</font></div>
        </strong></td>
    </tr>
  </table>
  <BR>
    
  <table width="70%" border="0" align="center" cellpadding="2" cellspacing="0" bordercolor="cccccc">
    <tr> 
      <td>CONTACT: GREG TIONGCO</td>
    </tr>
    <tr> 
      <td>TEL (02) 485-7878 &nbsp; | &nbsp; MOBILE: 0917-387-4984 &nbsp; | &nbsp; 
        FAX: (02) 564-2881</td>
    </tr>
  </table>
  <?PHP } else echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									NO ORDER(s)."; ?>
 
</form>
</body>
</html>
<script language="JavaScript">
	PrintThisPage();
</script>
