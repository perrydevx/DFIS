<script language='javascript'>
	function ValidateSubmit() {
		
		document.frmAddProd.btnAdd.disabled = true;
				
		if ((document.frmAddProd.txtCode.value == "") && (document.frmAddProd.txtName.value == "")) {
			alert("Enter product code & name!");
			document.frmAddProd.btnAdd.disabled = false;
			return false;					
		}
		else if (document.frmAddProd.txtCode.value == "") {
			alert("Enter product code!");
			document.frmAddProd.btnAdd.disabled = false;
			return false;			
		}
		else if (document.frmAddProd.txtName.value == "") {
			alert("Enter product name!");
			document.frmAddProd.btnAdd.disabled = false;
			return false;
		}		
		else {
			return true;
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
<form name="frmAddProd" method="post" action="ProductAction.php" onSubmit="return ValidateSubmit();">
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
            <td class="content" width="100%"><span class="text_title">&nbsp;New 
              Product</span></td>
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
             </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
		
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td nowrap width="9%">&nbsp;CODE <font color="#FF0000">*</font></td>
                  <td width="91%"><input type="text" name="txtCode" class="txt" size="10" maxlength="16" value="" ></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;NAME <font color="#FF0000">*</font></td>
                  <td><input type="text" name="txtName" size="50" class="txt" maxlength="100" value=""></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;PRICE/item</td>
                  <td nowrap><input type="text" name="txtPrice" size="10" class="txt" maxlength="10" value="" ></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;QUANTITY</td>
                  <td nowrap><input type="text" name="txtQty" size="10" class="txt" maxlength="10" value="" ></td>
                </tr>
              </table>
              <div align="right"><br>
                <input type="hidden" name="hidAdd">
                <input type="submit" name="btnAdd" value="Save" class="btn" style="width: 100" >
                <input type="button" name="btnCancel" value="Cancel" class="btn" style="width: 100" onClick="javascript:window.location='ProductInventory.php'">
              </div>
              <hr>
              <br>
          
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
