<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();

$code = "";
$name = "";

if (isset($_POST['btnSearch'])) {
	$code = $_POST['txtCode'];
	$name = $_POST['txtName'];
}

$PI->load_records($code,$name,"");
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
<form name="frmAddStocks" method="post" action="ProductAction.php">
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
    <td class="split" width="1"><img height="1" src="Images/Pixel.gif" width="1" border="0"></td>
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
              Stocks</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
            <td valign="top" class="content"> 
              <hr>
              <div align="right">
                <input type="hidden" name="hidAddStocks">
                <input type="submit" name="btnAdd" value="Save" class="btn" style="width: 100" >
                <input type="button" name="btnCancel" value="Cancel" class="btn" style="width: 100" onClick="javascript:window.location='ProductInventory.php'">
              </div></td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			<?php if (0) {?>
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td nowrap width="9%">&nbsp;CODE</td>
                  <td width="91%"><input type="text" name="txtCode" class="txt" size="45" maxlength="10" value="<?=$code?>"></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;NAME</td>
                  <td><input type="text" name="txtName" size="45" class="txt" maxlength="45" value="<?=$name?>" ></td>
                </tr>
				
                <tr> 
                  <td colspan="2" nowrap><input type="submit" name="btnSearch" value="Search" class="btn" style="width: 100"> 
                  </td>
                </tr>
				
              </table> <br><?php } ?>
             
             <?php
			 	if ($x>0) {							
			 ?>
             <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr> 
                  <td width="4%" height="18" nowrap class="result_header">&nbsp;</td>
                  <td width="9%" nowrap class="result_header">&nbsp;CODE&nbsp;</td>
                  <td nowrap class="result_header" width="30%" >&nbsp;NAME&nbsp;&nbsp;</td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;AVAILABLE 
                      &nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;RESEREVED&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;PENDING&nbsp;</div></td>
                  <td width="15%" nowrap class="result_header">&nbsp;ADD STOCKS&nbsp;</td>
                </tr>
</table>
<div  style="z-index:1; overflow: scroll; width: 100%; height: 380px;"> 
              <table width="100%" height="28" border="0" cellpadding="2" cellspacing="2">
                
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td width="4%" height="24"><div align="center"> 
                      <input type="checkbox" name="cb<?=$i?>" value="checkbox" onClick="javascript:
																				if (document.frmAddStocks.cb<?=$i;?>.checked) {
																					rw<?=$i;?>.style.background = '#F0F0F0';
																					document.frmAddStocks.cb<?=$i;?>.style.background = '#F0F0F0';
																					
																				}
																				else {
																					rw<?=$i;?>.style.background = '#ffffff';
																					document.frmAddStocks.cb<?=$i;?>.style.background = '#ffffff';
																					document.frmAddStocks.txtAddStocks<?=$i?>.value = '';
																					
																				}">
                    </div></td>
                  <td width="12%" height="24">&nbsp; 
                    <?= $arr[$i]['prod_code']?>
                    <input type="hidden" name="hidCode<?=$i?>" value="<?= $arr[$i]['prod_code']?>"> 
                  </td>
                  <td width="41%">&nbsp; 
                    <?= $arr[$i]['prod_name']?>
                  </td>
                  <td width="8%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['quantity'] == 0) echo($arr[$i]['quantity']); else echo("<strong>".$arr[$i]['quantity']."</strong>"); ?>
                      &nbsp; </div></td>
                  <td width="9%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['res_qty'] == 0) echo($arr[$i]['res_qty']); else echo("<font color='#0000ff'><strong>".$arr[$i]['res_qty']."</strong></font>"); ?>
                      &nbsp; </div></td>
                  <td width="7%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['order_qty'] == 0) echo($arr[$i]['order_qty']); else echo("<font color='#FF0000'><strong>".$arr[$i]['order_qty']."</strong></font>"); ?>
                      &nbsp; </div></td>
                  <td width="19%"><input type="text" name="txtAddStocks<?=$i;?>" class="txt" size="10" maxlength="10" value="" onKeyPress="javascript: if (document.frmAddStocks.txtAddStocks<?=$i?> !='') { 
																																				document.frmAddStocks.cb<?=$i?>.checked = true; 
																																			} 
																																			if (document.frmAddStocks.cb<?=$i;?>.checked) {
																																				rw<?=$i;?>.style.background = '#F0F0F0';
																																				document.frmAddStocks.cb<?=$i;?>.style.background = '#F0F0F0';
																																			}
																																			else {
																																				rw<?=$i;?>.style.background = '#ffffff';
																																				document.frmAddStocks.cb<?=$i;?>.style.background = '#ffffff';
																																			}"></td>
                </tr>
                <?php } ?>
              </table>
              </div>
              <input type="hidden" name="hidTotalAddStocks" value="<?=$x?>">
			  <?PHP } else { echo("<br>No record/s found.");}?>
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
