<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php";

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();

$cd      = $_GET['cd'];
$item    = $_GET['item'];
$dt 	 = $_GET['dt'];

$CC->load_record($cd);

$CC->load_order($cd,$item,$dt);

  
?>
<script language="javascript">
function x() {
		tblEditDel.style.display = "none";
		tblSaveCancel.style.display = "block";	
		
}

function y() {
	//document.frmCEO.txtQty.disabled = false;
	document.frmCEO.txtPrice.disabled = false;


}

var btnClicked = "";
	
function ValidateSubmit() {
	if (btnClicked == "delete") {
		if (confirm("Delete this order?")) {			
			return true;			
		}
		else {
			return false;			
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
<form name="frmCEO" method="post" action="CustomerAction.php" onSubmit="return ValidateSubmit()">
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
            <td class="content" width="100%"><span class="text_title">&nbsp;Edit 
              Order </span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
<hr>
              <input type="button" name="btnSearch222" value="Back to Customer" class="btn" style="width: 120" onClick="javascript:window.location='Customer.php?cd=<?=$cd;?>'">	
            </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td width="9%" nowrap>&nbsp;CUSTOMER</td>
                  <td width="91%"><input type="text" name="txtName3" size="50" class="txt" maxlength="45" value="<?=$CC->get_name();?>" readonly>
                    <input type="hidden" name="hidCode" value="<?=$cd;?>"></td>
                </tr>
                <tr> 
                  <td width="9%" nowrap>&nbsp;ITEM NAME</td>
                  <td><input type="text" name="txtName" size="50" class="txt" maxlength="45" value="<?=$CC->get_item();?>" readonly>
                    <input type="hidden" name="hidItem" value="<?=$item?>"></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;ORDER DATE</td>
                  <td><input type="text" name="txtName2" size="15" class="txt" maxlength="45" value="<?=$CC->get_order_date();?>" readonly>
                    <input type="hidden" name="hidDate" value="<?=$dt?>"> </td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;QUANTITY</td>
                  <td><input type="text" name="txtQty" size="15" class="txt" maxlength="45" value="<?=$CC->get_qty();?>" readonly></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;PRICE</td>
                  <td><input type="text" name="txtPrice" size="15" class="txt" maxlength="45" value="<?=$CC->get_price();?>" disabled></td>
                </tr>
              </table>
              
              <table border="0" cellpadding="2" cellspacing="0" width="100%"  id="tblEditDel">
                <tr> 
                  <td class="content" width="30%"><span class="text_title"> </span></td>
                  <td class="content" width="100%" align="right"><input type="button" name="btnCancel" value="Edit" class="btn" style="width: 100" onClick="x();y();"> 
                    <?php if ($CC->get_cust_stat()!='DEL') {?>
                    <input type="submit" name="btnOrderDelete" value="Delete" class="btn" style="width: 100" onClick="javascript: btnClicked = 'delete'"> 
                    <?php } ?>
                  </td>
                </tr>
              </table>
              <table border="0" cellpadding="2" cellspacing="0" width="100%" style="DISPLAY:NONE" id="tblSaveCancel">
                <tr> 
                  <td class="content" width="30%">&nbsp;</td>
                  <td class="content" width="100%" align="right"><input type="submit" name="btnOrderEdit" value="Save" class="btn" style="width: 100" onClick="javascript: btnClicked = 'save';"> 
                    <input type="submit" name="btnOrderCancel" value="Cancel" class="btn" style="width: 100" onClick="javascript: btnClicked = 'cancel'"> 
                  </td>
                </tr>
              </table>
           <hr><br>
           
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
