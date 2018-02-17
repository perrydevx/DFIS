<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();

$cd = $_GET['cd'];

$PI->load_product($cd);

$show = ''; // if NULL show all records for the year

$PI->load_customers($cd,$show);
$arr = $PI->get_arr();
$x = count($arr); 

$PI->total_price_item($cd)
?>
<script language="javascript">
function x() {
		tblEditDel.style.display = "none";
		tblSaveCancel.style.display = "block";
		
		
}

function y() {
	document.frmProdEdit.txtName.disabled = false;
	document.frmProdEdit.txtPrice.disabled = false;
	document.frmProdEdit.txtRes.disabled = false;
	document.frmProdEdit.txtPnd.disabled = false;
	<?php if ($PI->get_qty()>0) {?>
	document.frmProdEdit.txtQty.disabled = false;
	<?php } ?>
}

var btnClicked = "";
	
function ValidateSubmit() {
	if (btnClicked == "delete") {
		if (confirm("Delete this product?")) {			
			return true;			
		}
		else {
			return false;			
		}
	}
	else if (btnClicked == "save") {
			if (document.frmProdEdit.txtName.value == "") {
				alert("Enter name!");
				return false;			
			}		
			else {
				return true;
			}	
		}
}
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Dragon Fireworks Inventory System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../StyleSheet/djarc.css" rel="stylesheet">

</head>
<body leftmargin=0 rightmargin=0 topmargin="0" marginwidth="0" marginheight="0">
<form name="frmProdEdit" method="post" action="ProductAction.php" onSubmit="return ValidateSubmit();">
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
            <td class="content" width="100%"><span class="text_title">&nbsp;Product 
              Details </span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
<hr>
              <?php
						 $br = "";
						 $msg = $_GET['msg'];
						 if ($msg != '') {
						 	$br = "<br><br>";
						 } 
						 echo("<font color='#FF0000'><strong>".$msg."</strong></font>".$br); 
						
						 ?>
              <input type="button" name="btnBack" value="Back to List" class="btn" style="width: 100" onClick="javascript:window.location='ProductInventory.php'">
            </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td nowrap width="10%">&nbsp;CODE</td>
                  <td width="35%"><input type="text" name="txtCode" class="txt" size="10" maxlength="10" value="<?=$cd;?>"  readonly></td>
                  <td width="10%">&nbsp;AVALABLE</td>
                  <td width="45%"><input type="text" name="txtQty" size="10" class="txt" maxlength="10" value="<?=$PI->get_qty();?>" disabled> 
                    <input type="hidden" name="hidQty" value="<?=$PI->get_qty();?>"></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;NAME <font color="#FF0000">*</font></td>
                  <td><input type="text" name="txtName" size="50" class="txt" maxlength="100" value="<?=$PI->get_name();?>" disabled></td>
                  <td nowrap>&nbsp;RESERVED/SOLD</td>
                  <td><input type="text" name="txtRes" size="10" class="txt" maxlength="10" value="<?=$PI->get_res();?>" disabled></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;PRICE/item</td>
                  <td nowrap><input type="text" name="txtPrice" size="10" class="txt" maxlength="10" value="<?=$PI->get_price();?>" disabled></td>
                  <td nowrap>&nbsp;PENDING</td>
                  <td nowrap><input type="text" name="txtPnd" size="10" class="txt" maxlength="10" value="<?=$PI->get_order_qty();?>" disabled></td>
                </tr>
              </table>
              
              <table border="0" cellpadding="2" cellspacing="0" width="100%"  id="tblEditDel">
                <tr> 
                  <td class="content" width="30%"><span class="text_title"> </span></td>
                  <td class="content" width="100%" align="right"><input type="button" name="btnCancel" value="Edit" class="btn" style="width: 100" onClick="x();y();"> 
                    <input type="submit" name="btnDelete" value="Delete" class="btn" style="width: 100" onClick="javascript: btnClicked = 'delete'"> 
                  </td>
                </tr>
              </table>
              <table border="0" cellpadding="2" cellspacing="0" width="100%" style="DISPLAY:NONE" id="tblSaveCancel">
                <tr> 
                  <td class="content" width="30%">&nbsp;</td>
                  <td class="content" width="100%" align="right"><input type="submit" name="btnEdit" value="Save" class="btn" style="width: 100" onClick="javascript: btnClicked = 'save';"> 
                    <input type="submit" name="btnCancel" value="Cancel" class="btn" style="width: 100" onClick="javascript: btnClicked = 'cancel'"> 
                  </td>
                </tr>
              </table>
            
              <hr>
              <?php if ($x>0) {?>
              &nbsp;Order(s) for this item. 
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
             <tr > 
                  <td width="29%" nowrap class="result_header">&nbsp;CUSTOMER&nbsp;</td>
                  <td width="20%" nowrap class="result_header">&nbsp;QUANITY PURCHASED&nbsp;</td>
                  <td width="16%" nowrap class="result_header"><div align="right">&nbsp;PRICE&nbsp;</div></td>
                  <td width="9%" nowrap class="result_header">&nbsp;</td>
                  <td width="26%" nowrap class="result_header">&nbsp;ORDER DATE&nbsp;</td>
                </tr>
              </table>
			   <div  style="z-index:1; overflow: scroll; width: 100%; height: 225;"> 
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                
                <?php for ($i=0;$x>$i;$i++) {?>
                <tr> 
                  <td width="30%">&nbsp; 
                    <?= $arr[$i]['customer_name']?>
                    &nbsp; </td>
                  <td width="19%">&nbsp; 
                    <?= $arr[$i]['qty']?>
                    &nbsp; </td>
                  <td width="16%"><div align="right">&nbsp; 
                      <?php   echo number_format($arr[$i]['price'],2,'.',',') ?>
                      &nbsp;php&nbsp; </div></td>
                  <td width="10%">&nbsp;</td>
                  <td width="25%">&nbsp; 
                    <?= $arr[$i]['order_dt']?>
                    &nbsp; </td>
                </tr>
                <?php } ?>
              </table>
			  </div>
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td width="30%"><strong>&nbsp;TOTAL</strong> </td>
                  <td width="13%"><strong>
                    <?php  echo($PI->get_total_qty()." item(s)");?>
                    </strong> </td>
                  <td width="19%"> <div align="right"> <strong><?php echo number_format($PI->get_total_price(),2,'.',',')." php" ?></strong> 
                    </div></td>
                  <td width="38%">&nbsp;</td>
                </tr>
              </table>
 <?php } else { echo "No order(s) for this Item."; } ?>
			  
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
