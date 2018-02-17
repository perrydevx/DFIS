<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php"; 

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();

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
<link type="text/css" href="../StyleSheet/djarc.css" rel="stylesheet">

</head>
<body leftmargin=0 rightmargin=0 topmargin="0" marginwidth="0" marginheight="0">
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
		  	<table border="0" cellpadding="2" cellspacing="0" width="100%" id="tblEditDel" >
                <tr> 
                  <td height="24" class="content"><span class="text_title">Customer 
                    Sales Report Details</span>&nbsp; </td>
                  <td class="content"><div align="right">
                    <input type="button" name="btnPrint" value="Print" class="btn" style="width: 100" onClick="javascript:  window.open('CustomerReportPrint.php?cd=<?=$cd?>', '', 'menubar=no,width=816,height=700,scrollbars=yes,left=80');">
                  </div></td>
                </tr>
              </table> 
		    <hr>
            <input type="button" name="btnAddOrders22" value="Return to List" class="btn" style="width: 100" onClick="javascript:window.location='CustomerReportMain.php'">	
          </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC" >
                <tr> 
                  <td width="10%" height="24" nowrap>&nbsp;CUSTOMER <input type="hidden" name="hidCode" value="<?=$cd;?>"></td>
                  <td > <input type="text"  readonly name="txtNameR" size="50" class="txt" maxlength="45" value="<?=$CC->get_name();?>"  r> 
                  </td>
                </tr>
                <tr> 
                  <td width="10%" height="26" nowrap>&nbsp;ORDER DATE&nbsp;</td>
                  <td><input type="text" name="txtDate" size="15" class="txt" maxlength="45" value="<?=$CC->get_cust_date();?>"  readonly> 
                  </td>
                </tr>
              </table>
             
              <hr>
              
              <?php
			 	if ($x>0) {							
			 ?>
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr> 
                <td class="result_header" nowrap width="14%">&nbsp;ORDER DATE/item&nbsp;</td>
                <td class="result_header" nowrap width="50%">&nbsp;ITEMS ORDERED&nbsp;</td>
                <td class="result_header" nowrap width="12%"><div align="right">&nbsp;PRICE/item&nbsp;</div></td>
                <td class="result_header" nowrap width="12%">&nbsp;QUANTITY&nbsp;</td>
                <td class="result_header" nowrap width="12%"><div align="right">&nbsp; 
                    PRICE&nbsp;</div></td>
              </tr>
            </table>

			 <div  style="z-index:1; overflow: scroll; width: 100%; height: 250px;"> 
              <table width="100%" border="0" cellpadding="2" cellspacing="2">
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td width="14%" nowrap>&nbsp; 
                    <?= $arr[$i]['order_dt_disp']?>
                  </td>
                  <td width="50%" nowrap>&nbsp; 
                    <?= $arr[$i]['prod_name']?>
                  </td>
                  <td width="12%" nowrap><div align="right">&nbsp; 
                      <?php  echo number_format($arr[$i]['price_t'],2,'.',',')?>
                      &nbsp;php&nbsp;</div></td>
                  <td width="12%" nowrap>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                    <?= $arr[$i]['qty']?>
                  </td>
                  <td width="12%" nowrap><div align="right"> 
                      <?php  echo number_format($arr[$i]['price'],2,'.',',')?>
                      &nbsp;php</div></td>
                </tr>
                <?php }  ?>
              </table>
			  </div>
			  
			  <hr>
			
		      <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr> 
                <td width="93%" nowrap><div align="right"><strong>&nbsp;TOTAL PRICE</strong>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                <td width="7%" nowrap><div align="right"><strong>&nbsp; 
                    <?php  echo number_format($CC->total_purcahsed($cd),2,'.',',');?>
                    &nbsp;php&nbsp;</strong></div></td>
              </tr>
            </table>
              <?PHP } else echo "<br><strong>NO ORDER(S).</strong>"; ?></td>
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

</body>

</html>
