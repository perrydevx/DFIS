<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 
include "../class/DataAccess.php";

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();
$DA   = new DataAccess();

$today = $DA->get_current_date();

$PI->load_records('','','');
$arr = $PI->get_arr();
$x = count($arr); 

?>
<script language='javascript'>
	function ValidateSubmit() {
		
		document.frmCustAdd.btnAdd.disabled = true;
				
		if (document.frmCustAdd.txtName.value == "") {
			alert("Enter customer name!");
			document.frmCustAdd.btnAdd.disabled = false;
			return false;			
		}			
		else {
			return true;
		}
					
	}
	
	function ToggleCheck() {
		if (document.frmCustAdd.cboPayType.value == 'CHECK') {
			tblCheck.style.display = "block";
		}
		else {
			tblCheck.style.display = "none";
			document.frmCustAdd.txtBank.value = '';
			document.frmCustAdd.txtCheckNo.value = '';			
			document.frmCustAdd.txtDue.value = '';		
		}

	}
	
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Dragon Fireworks Inventory System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../StyleSheet/djarc.css" rel="stylesheet">
<script language="JavaScript" src="../javascript/calendar.js"></script>
</head>
<body leftmargin=0 rightmargin=0 topmargin="0" marginwidth="0" marginheight="0">
<form name="frmCustAdd" method="post" action="CustomerAction.php" onSubmit="return ValidateSubmit()">
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
              Customer</span></td>
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
                  <td nowrap width="14%">&nbsp;CUSTOMER <font color="#FF0000">*</font></td>
                  <td width="35%"><input type="text" name="txtName" class="txt" size="50" maxlength="100" value=""> 
                  </td>
                  <td  width="9%">ORDER DATE </td>
                  <td  width="42%"><input type="text" name="txtDate" size="15"   class="txt" maxlength="45" value="<?=$today?>" readonly> 
                    <a href="javascript:cmDate.popup();"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> 
                  </td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;PAYMENT TYPE&nbsp;</td>
                  <td><select name="cboPayType" style="WIDTH:100" onChange="ToggleCheck()">
                      <option value = "CASH" >CASH</option>
                      <option value = "CHECK">CHECK</option>
					  <option value = "CTF">CTF</option>
					  <option value = "CONS">CONS</option>
					  <option value = "OTHER">OTHER</option>
                    </select> 
                    &nbsp;DISCOUNT &nbsp;<input type="text" name="txtDis" size="7"   class="txt" maxlength="45" > 
                    <strong><font size="3">%</font></strong></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            
              <table width="100%" border="0" cellspacing="0" cellpadding="2" id="tblCheck" style="display:none">
                <tr> 
                  <td width="14%">&nbsp;BANK/BRANCH</td>
                  <td width="35%"><input type="text" name="txtBank" class="txt" size="50" maxlength="100" value=""></td>
                  <td width="9%">&nbsp;</td>
                  <td width="42%">&nbsp;</td>
                </tr>
                <tr> 
                  <td>&nbsp;CHECK NO</td>
                  <td><input type="text" name="txtCheckNo" class="txt" size="50" maxlength="100" value=""> 
                  </td>
                  <td>DUE DATE
                  </td>
                  <td><input type="text" name="txtDueDate" size="15"   class="txt" maxlength="45" readonly> 
                    <a href="javascript:dueDate.popup();"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> 
                  </td>
                </tr>
              </table>
              <div align="right">
                <input type="hidden" name="hidAdd">
                <input type="submit" name="btnAdd" value="Save" class="btn" style="width: 100" >
                <input type="button" name="btnSearch2" value="Cancel" class="btn" style="width: 100" onClick="javascript:window.location='CustomerList.php'">
              </div>
              <hr>
			   
              <?php
			 	if ($x>0) {
											
			   ?><table width="100%" border="0" cellspacing="2" cellpadding="2">
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
				<div  style="z-index:1; overflow: scroll; width: 100%; height: 300px;"> 
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
             
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td width="6%"><div align="center"> 
                      <input type="checkbox" name="cb<?=$i?>" value="checkbox" onClick="javascript:
																				if (document.frmCustAdd.cb<?=$i;?>.checked) {
																					rw<?=$i;?>.style.background = '#F0F0F0';
																					document.frmCustAdd.cb<?=$i;?>.style.background = '#F0F0F0';
																					
																				}
																				else {
																					rw<?=$i;?>.style.background = '#ffffff';
																					document.frmCustAdd.cb<?=$i;?>.style.background = '#ffffff';
																					document.frmCustAdd.txtQty<?=$i?>.value = '';
																					document.frmCustAdd.txtPrice<?=$i?>.value = '';
																				}">
                    </div></td>
                  <td width="10%">&nbsp; 
                    <?= $arr[$i]['prod_code']?>
                    <input type="hidden" name="hidCode<?=$i;?>" value="<?= $arr[$i]['prod_code']?>"></td>
                  <td width="35%">&nbsp; 
                    <?= $arr[$i]['prod_name']?>
                  </td>
                  <td  nowrap width="7%"><div align="right">&nbsp;<?php   echo number_format($arr[$i]['price'],2,'.',',') ?>&nbsp;php&nbsp; </div></td>
                  <td width="8%"> <div align="right">&nbsp; 
                      <?php if  ($arr[$i]['quantity'] == 0) echo($arr[$i]['quantity']); else echo("<strong>".$arr[$i]['quantity']."</strong>"); ?>
                      &nbsp; </div></td>
                  <td width="10%"> <div align="right"> 
                      <?php if  ($arr[$i]['res_qty'] == 0) echo($arr[$i]['res_qty']); else echo("<font color='#0000ff'><strong>".$arr[$i]['res_qty']."</strong></font>"); ?>
                      &nbsp; </div></td>
                  <td width="9%"> <div align="right"> 
                      <?php if  ($arr[$i]['order_qty'] == 0) echo($arr[$i]['order_qty']); else echo("<font color='#FF0000'><strong>".$arr[$i]['order_qty']."</strong></font>"); ?>
                      &nbsp; </div></td>
                  <td width="9%"><input type="text" name="txtQty<?=$i?>" class="txt" size="8" maxlength="10" value=""  onKeyPress="javascript: if (document.frmCustAdd.txtQty<?=$i?> !='') { 				                                                                                                                       
				  																													 		document.frmCustAdd.cb<?=$i?>.checked = true; 
																																		} 
																																	   if (document.frmCustAdd.cb<?=$i;?>.checked) {
																																	 		rw<?=$i;?>.style.background = '#F0F0F0';
																																	 		document.frmCustAdd.cb<?=$i;?>.style.background = '#F0F0F0';
																																	    }
																																	 	else {
																																			rw<?=$i;?>.style.background = '#ffffff';
																																			document.frmCustAdd.cb<?=$i;?>.style.background = '#ffffff';
																																		}" 
																											<?php if (1) {?>
																												onChange="javascript:  if (document.frmCustAdd.txtQty<?=$i?> !='') { 
																																	   		document.frmCustAdd.txtPrice<?=$i?>.value = <?= $arr[$i]['price']?> * document.frmCustAdd.txtQty<?=$i?>.value;
																																		}" 
																											<?php } ?>							
																																		
																																		></td>
                  <td width="19%"><input type="text" name="txtPrice<?=$i?>" class="txt" size="8" maxlength="10" value="" ></td>
                </tr>
                <?php } ?>
              </table>
                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                  <tr> 
                    <td class="content" width="30%">&nbsp;</td>
                    <td class="content" width="100%" align="right">&nbsp; </td>
                  </tr>
                </table>
              </DIV>
              <input type="hidden" name="hidTotal" value="<?=$x?>">
              <br><?php } ?>
            
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
<script language="JavaScript">
	var cmDate = new calendar(document.frmCustAdd.txtDate);
	cmDate.year_scroll = true;
	cmDate.time_comp = false;
	
	var dueDate = new calendar(document.frmCustAdd.txtDueDate);
	dueDate.year_scroll = true;
	dueDate.time_comp = false;
</script>
</html>
