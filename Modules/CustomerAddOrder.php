<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 
include "../class/CustomerClass.php"; 


$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();
$CC = new CustomerClass();

$cd = $_GET['cd'];
$CC->load_record($cd);

$PI->load_records('','','');
$arr = $PI->get_arr();
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
<form name="frmAddOrder" method="post" action="CustomerAction.php" >
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
            <td class="content" width="100%"><span class="text_title">&nbsp;Add 
              Order(s)</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
            <td valign="top" class="content"> 
              <hr>
              <div align="right"> </div></td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td nowrap width="9%">&nbsp;NAME</td>
                  <td width="91%"><input type="text" name="txtName" size="45" class="txt" maxlength="45" value="<?=$CC->get_name();?>" readonly>
                    <input type="hidden" name="hidCode" value="<?=$cd;?>"></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;ORDER DATE</td>
                  <td><input type="text" name="txtName2" size="15" class="txt" maxlength="45" value="<?=$CC->get_cust_date();?>" readonly></td>
                </tr>
              </table>
              <div align="right">
                <input type="hidden" name="hidAddOrder">
                <input type="submit" name="btnCancel" value="Save" class="btn" style="width: 100" >
                <input type="button" name="btnSearch2" value="Cancel" class="btn" style="width: 100" onClick="javascript:window.location='Customer.php?cd=<?=$cd?>'">
                <hR>
                <?php
			 	if ($x>0) {
											
			   ?>
              </div>
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td width="3%" nowrap class="result_header">&nbsp;ORDER&nbsp;</td>
                  <td width="3%" nowrap class="result_header">&nbsp;ITEM CODE&nbsp;</td>
                  <td width="30%" nowrap class="result_header">&nbsp;ITEM NAME&nbsp;</td>
                  <td width="10%" nowrap class="result_header"><div align="right">&nbsp;PRICE/item&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;AVAILABLE&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;RESEREVED&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;PENDING&nbsp;</div></td>
                  <td width="10%" nowrap class="result_header">&nbsp;QUANTITY&nbsp;</td>
                  <td width="11%" nowrap class="result_header">&nbsp;PRICE&nbsp;</td>
                </tr>
              </table>
              <div  style="z-index:1; overflow: scroll; width: 100%; height: 310px;"> 
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <?php for($i=0;$x>$i;$i++) {?>
                  <tr id="rw<?=$i;?>"> 
                    <td width="6%"><div align="center"> 
                        <input type="checkbox" name="cb<?=$i?>" value="checkbox" onClick="javascript:
																				if (document.frmAddOrder.cb<?=$i;?>.checked) {
																					rw<?=$i;?>.style.background = '#F0F0F0';
																					document.frmAddOrder.cb<?=$i;?>.style.background = '#F0F0F0';
																					
																				}
																				else {
																					rw<?=$i;?>.style.background = '#ffffff';
																					document.frmAddOrder.cb<?=$i;?>.style.background = '#ffffff';
																					document.frmAddOrder.txtQty<?=$i?>.value = '';
																					document.frmAddOrder.txtPrice<?=$i?>.value = '';
																				}">
                      </div></td>
                    <td width="10%">&nbsp; 
                      <?= $arr[$i]['prod_code']?>
                      <input type="hidden" name="hidCode<?=$i;?>" value="<?= $arr[$i]['prod_code']?>"></td>
                    <td width="35%">&nbsp; 
                      <?= $arr[$i]['prod_name']?>
                    </td>
                    <td   nowrap width="7%"><div align="right">&nbsp;
                        <?php   echo number_format($arr[$i]['price'],2,'.',',') ?>
                        &nbsp;php&nbsp; </div></td>
                    <td width="8%"> <div align="right">&nbsp; 
                        <?php if  ($arr[$i]['quantity'] == 0) echo($arr[$i]['quantity']); else echo("<strong>".$arr[$i]['quantity']."</strong>"); ?>
                        &nbsp; </div></td>
                    <td width="10%"> <div align="right"> 
                        <?php if  ($arr[$i]['res_qty'] == 0) echo($arr[$i]['res_qty']); else echo("<font color='#0000ff'><strong>".$arr[$i]['res_qty']."</strong></font>"); ?>
                        &nbsp; </div></td>
                    <td width="9%"> <div align="right"> 
                        <?php if  ($arr[$i]['order_qty'] == 0) echo($arr[$i]['order_qty']); else echo("<font color='#FF0000'><strong>".$arr[$i]['order_qty']."</strong></font>"); ?>
                        &nbsp; </div></td>
                    <td width="9%"><input type="text" name="txtQty<?=$i?>" class="txt" size="8" maxlength="10" value=""  onKeyPress="javascript: if (document.frmAddOrder.txtQty<?=$i?> !='') { 				                                                                                                                       
				  																													 		document.frmAddOrder.cb<?=$i?>.checked = true; 
																																		} 
																																	   if (document.frmAddOrder.cb<?=$i;?>.checked) {
																																	 		rw<?=$i;?>.style.background = '#F0F0F0';
																																	 		document.frmAddOrder.cb<?=$i;?>.style.background = '#F0F0F0';
																																	    }
																																	 	else {
																																			rw<?=$i;?>.style.background = '#ffffff';
																																			document.frmAddOrder.cb<?=$i;?>.style.background = '#ffffff';
																																		}" 
																											<?php if (1) {?>
																												onChange="javascript:  if (document.frmAddOrder.txtQty<?=$i?> !='') { 
																																	   		document.frmAddOrder.txtPrice<?=$i?>.value = <?= $arr[$i]['price']?> * document.frmAddOrder.txtQty<?=$i?>.value;
																																		}" 
																											<?php } ?>							
																																		
																																		></td>
                    <td width="19%"><input type="text" name="txtPrice<?=$i?>" class="txt" size="8" maxlength="10" value="" ></td>
                  </tr>
                  <?php } ?>
                </table>
              </DIV>
              <input type="hidden" name="hidTotal" value="<?=$x?>"> <br>
              <?php } ?>
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
