<?php
include "../class/Connection.php"; 
include "../class/CustomerClass.php"; 

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();

$cd = $_GET['cd'];

$CC->load_record($cd);

($CC->get_pay_type()=="CHECK")? $style = "border" : $style = "none";

$CC->load_orders($cd);
$arr = $CC->get_arr();
$x = count($arr); 

 
?>

<script language="javascript">
function x() {
		tblEditDel.style.display = "none";
		tblSaveCancel.style.display = "block";
		
		tblEditDel2.style.display = "none";
		tblSaveCancel2.style.display = "block";
		
		tblOrder.style.display = "block";
		tblDue.style.display = "block";
		
		document.frmcustomer.cboStat.disabled = false;
		//document.frmcustomer.txtDate.disabled = false;
		document.frmcustomer.cboPayType.disabled = false;
		document.frmcustomer.txtBank.disabled = false;
		document.frmcustomer.txtCheckNo.disabled = false;
		document.frmcustomer.txtDiscount.disabled = false;
		//document.frmcustomer.txtDue.disabled = false;
		document.frmcustomer.cboCheckStat.disabled = false;
}

var btnClicked = "";
	
function ValidateSubmit() {
	if (btnClicked == "delete") {
		if (confirm("Delete this customer? this will delete all of his/her order(s).")) {			
			return true;			
		}
		else {
			return false;			
		}
	}
	if (btnClicked == "save") {
		if (document.frmcustomer.txtName.value == "") {
			alert("Enter customer name!");			
			return false;			
		}			
		else {
			return true;
		}
	}	
}

function ToggleCheck() {
		if (document.frmcustomer.cboPayType.value == 'CHECK') {
			tblCheck.style.display = "block";
		}
		else {
			tblCheck.style.display = "none";		
			document.frmcustomer.txtBank.value = '';
			document.frmcustomer.txtCheckNo.value = '';			
			document.frmcustomer.txtDue.value = '';
			document.frmcustomer.cboCheckStat.value = '';
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
<form name="frmcustomer" method="post" action="CustomerAction.php" onSubmit="return ValidateSubmit();">
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
            <td class="content" width="100%"><span class="text_title">&nbsp;Customer 
              Order Details</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
<hr>
              <input type="button" name="btnAddOrders2" value="Return to List" class="btn" style="width: 100" onClick="javascript:window.location='CustomerList.php?cd=<?=$cd?>'">	
            </td>
        </tr>
        <tr> 
            <td class="content" width="100%" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td width="10%">&nbsp;CUSTOMER 
                    <input type="hidden" name="hidCode" value="<?=$cd;?>"></td>
                  <td width="35%">
				  
				  <table width="49%" border="0" cellspacing="0" cellpadding="0" id="tblEditDel2">
                      <tr> 
                        <td><input type="text"  readonly name="txtNameR" size="50" class="txt" maxlength="45" value="<?=$CC->get_name();?>" > 
                         </td>
                      </tr>
                    </table>
					
					 <table width="67%" border="0" cellspacing="0" cellpadding="0" style="DISPLAY:NONE" id="tblSaveCancel2">
                            <tr> 
                              <td><input type="text" name="txtName" size="50" class="txt" maxlength="45" value="<?=$CC->get_name();?>" ></td>
                            </tr>
                          </table>
					
					
					</td>
                  <td width="10%" nowrap>ORDER DATE&nbsp;&nbsp;&nbsp;</td>
                  <td> <table width="53%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="37%"><input type="text" name="txtDate" size="15" class="txt" maxlength="45" value="<?=$CC->get_cust_date();?>"  readonly></td>
                        <td width="63%"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblOrder"  style="display:none">
                            <tr> 
                              <td>&nbsp;<a href="javascript:cmDate.popup();"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;PAYMENT TYPE</td>
                  <td><select name="cboPayType" style="WIDTH:120" onChange="ToggleCheck()" disabled>
                      <option <?php if ($CC->get_pay_type()=='CASH') echo 'selected';?> value = "CASH" >CASH</option>
                      <option <?php if ($CC->get_pay_type()=='CHECK') echo 'selected';?> value = "CHECK">CHECK</option>
					  <option <?php if ($CC->get_pay_type()=='CTF') echo 'selected';?> value = "CTF">CTF</option>
					  <option <?php if ($CC->get_pay_type()=='CONS') echo 'selected';?> value = "CONS">CONS</option>
					  <option <?php if ($CC->get_pay_type()=='OTHER') echo 'selected';?> value = "OTHER">OTHER</option>
                    </select> &nbsp;DISCOUNT&nbsp; 
                    <input type="text" name="txtDiscount" size="7"   class="txt" maxlength="45" value="<?=$CC->get_discount()?>"  disabled> 
                    <strong><font size="3">%</font></strong> </td>
                  <td>ORDER STATUS </td>
                  <td><select name="cboStat" style="WIDTH:120" disabled>
                      <option value="FD"  <?php if ($CC->get_cust_stat()=='FD') echo 'selected';?>>FOR DELIVERY</option>
					  <option value="PAR" <?php if ($CC->get_cust_stat()=='PAR') echo 'selected';?>>PARTIAL</option>
                      <option value="DEL" <?php if ($CC->get_cust_stat()=='DEL') echo 'selected';?>>DELIVERED</option>
                    </select></td>
                </tr>
              </table>
              <table width="100%" height="50"  border="0" cellpadding="2" cellspacing="0" id="tblCheck" style="display:<?=$style?>">
                <tr> 
                  <td width="10%" height="26">&nbsp;BANK/BRANCH&nbsp;</td>
                  <td width="35%"><input type="text" name="txtBank" class="txt" size="50" maxlength="150" value="<?=$CC->get_bank()?>" disabled> 
                  </td>
                  <td nowrap width="10%">CHECK STATUS&nbsp;</td>
                  <td width="45%"><select name="cboCheckStat" style="WIDTH:120" disabled>
                      <option value = "" ></option>
                      <option <?php if ($CC->get_check_stat()=='CLEARED') echo 'selected';?> value = "CLEARED" >CLEARED</option>
                      <option  <?php if ($CC->get_check_stat()=='PENDING') echo 'selected';?> value = "PENDING" >PENDING</option>
                      <option  <?php if ($CC->get_check_stat()=='BOUNCED') echo 'selected';?> value = "BOUNCED">BOUNCED</option>
                    </select></td>
                </tr>
                <tr> 
                  <td height="24"  >&nbsp;CHECK NO</td>
                  <td ><input type="text" name="txtCheckNo" class="txt" size="50" maxlength="100" value="<?=$CC->get_check_no()?>" disabled> 
                  </td>
                  <td >DUE DATE&nbsp; </td>
                  <td><table width="53%" height="5" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="37%"><input type="text" name="txtDue" size="15"   class="txt" maxlength="45"  readonly value="<?=$CC->get_due_date()?>"></td>
                        <td width="63%"> <table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblDue" style="display:none">
                            <tr> 
                              <td>&nbsp;<a href="javascript:dueDate.popup();"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a> 
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
             
              <table border="0" cellpadding="2" cellspacing="0" width="100%" id="tblEditDel" >
                <tr> 
                  <td width="30%" height="24" class="content">&nbsp;</td>
                  <td class="content" width="100%" align="right">&nbsp; <input type="button" name="btnCancel" value="Edit" class="btn" style="width: 100"  onClick="x();"> 
                    <?php if ($CC->get_cust_stat()=='FD') {?>
                    <input type="submit" name="btnCustomerDelete" value="Delete" class="btn" style="width: 100" onClick="javascript: btnClicked = 'delete'"> 
                    <?php } ?>
                  </td>
                </tr>
              </table>
              <table border="0" cellpadding="2" cellspacing="0" width="100%" style="DISPLAY:NONE" id="tblSaveCancel">
                <tr> 
                  <td class="content" width="30%">&nbsp;</td>
                  <td class="content" width="100%" align="right"><input type="submit" name="btnCustomerEdit" value="Save" class="btn" style="width: 100" onClick="javascript: btnClicked = 'save'"> 
                    <input type="submit" name="btnCustomerCancel" value="Cancel" class="btn" style="width: 100"  onClick="javascript: btnClicked = 'cancel'"> 
                  </td>
                </tr>
              </table>
           <hr>
              <?php if ($CC->get_cust_stat()!='DEL') {?>
              <input type="button" name="btnAddOrders" value="Add Order" class="btn" style="width: 100" onClick="javascript:window.location='CustomerAddOrder.php?cd=<?=$cd?>'"> 
              <?php } ?><br><br>


              <?php
			 	if ($x>0) {							
			 ?>
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
                  <td class="result_header" nowrap width="10%">&nbsp;ORDER DATE/item&nbsp;</td>
                  <td class="result_header" nowrap width="30%">&nbsp;ITEMS ORDERED&nbsp;</td>
                  <td class="result_header" nowrap width="10%">&nbsp;QUANTITY&nbsp;</td>
                  <td width="10%" nowrap class="result_header"><div align="right">&nbsp;PRICE&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header">&nbsp;</td>
  </tr>
</table>

			 <div  style="z-index:1; overflow: scroll; width: 100%; height: 250px;"> 
              <table width="100%" border="0" cellpadding="2" cellspacing="2">
               
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td width="11%" nowrap>&nbsp; 
                    <?= $arr[$i]['order_dt_disp']?>
                  </td>
                  <td width="34%">&nbsp;<a href="CustomerEditOrder.php?cd=<?=$cd?>&item=<?= $arr[$i]['item_cd']?>&dt=<?= $arr[$i]['order_dt']?>"  onMouseOver="javascript:rw<?=$i;?>.style.background = '#F0F0F0';" onMouseOut="javascript:rw<?=$i;?>.style.background = '#ffffff';"> 
                    <?= $arr[$i]['prod_name']?>
                    </a> </td>
                  <td width="12%">&nbsp;&nbsp;&nbsp;
                    <?= $arr[$i]['qty']?>
                  </td>
                  <td width="11%"><div align="right"> 
                      <?php  echo number_format($arr[$i]['price'],2,'.',',')?>
                      &nbsp;php</div></td>
                  <td width="5%">&nbsp;</td>
                </tr>
                <?php }  ?>
              </table>
			  </div>
			  
			  <hr>
			
		      <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td width="77%"><div align="right"><strong>&nbsp;TOTAL PRICE</strong>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                  <td width="15%"><div align="right"><strong>&nbsp; 
                      <?php  echo number_format($CC->total_purcahsed($cd),2,'.',',');?>&nbsp;
                      php </strong></div></td>
                  <td width="8%">&nbsp;</td>
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
</form>
</body>
<script language="JavaScript">
	var cmDate = new calendar(document.frmcustomer.txtDate);
	cmDate.year_scroll = true;
	cmDate.time_comp = false;
	
	var dueDate = new calendar(document.frmcustomer.txtDue);
	dueDate.year_scroll = true;
	dueDate.time_comp = false;
</script>
</html>
