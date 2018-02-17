<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();

$code = "";
$name = "";
$s_stat = "";

if (isset($_POST['btnSearch'])) {
	$code = $_POST['txtCode'];
	$name = $_POST['txtName'];
	$s_stat = $_POST['cbostat'];
}

$PI->load_records(addslashes($code),addslashes($name),addslashes($s_stat));
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
<form name="frmBranchList" method="post" action="ProductInventory.php">
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
      
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
		  	<table border="0" cellpadding="2" cellspacing="0" width="100%">
                <tr> 
                  <td class="content"><span class="text_title">Products </span><span class="text_title">Inventory</span> 
                  </td>
                </tr>
              </table> 
		    <hr>
		  </td>
        </tr>
        <tr> 
          <td class="content" width="100%" valign="top">
			
              <table width="100%" border="0" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC">
                <tr> 
                  <td nowrap width="8%">&nbsp;CODE</td>
                  <td width="92%"><input type="text" name="txtCode" class="txt" size="10" maxlength="16" value="<?=$code?>"></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;NAME</td>
                  <td><input type="text" name="txtName" size="45" class="txt" maxlength="100" value="<?=$name?>" ></td>
                </tr>
                <tr> 
                  <td nowrap>&nbsp;STOCKS </td>
                  <td><select name="cbostat" style="width:120">
				  		<option value=""></option>
						<option value="AVA" <?php if ($s_stat=='AVA') echo 'selected';?>>AVALABLE</option>
						<option value="RES" <?php if ($s_stat=='RES') echo 'selected';?>>RESERVED/SOLD</option>
						<option value="PND" <?php if ($s_stat=='PND') echo 'selected';?>>PENDING</option>
                    </select></td>
                </tr>                
              </table><BR>
			  <input type="submit" name="btnSearch" value="Search" class="btn" style="width: 100">
              <hr>
              <div align="right">
                <input type="button" name="btnNew" value="New Product" class="btn" style="width: 100" align="right" onClick="javascript:window.location='ProductAdd.php?msg='">
                <input type="button" name="btnNew2" value="Add Stocks" class="btn" style="width: 100" align="right" onClick="javascript:window.location='AddStocks.php'">
                </div>
				<br>

                
                <?php
			 	if ($x>0) {							
			 ?>
              
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
			  <tr> 
                  <td class="result_header" nowrap width="10%">&nbsp;CODE&nbsp;</td>
                  <td class="result_header" nowrap width="35%">&nbsp;NAME&nbsp;</td>
                  <td class="result_header" nowrap width="15%"><div align="right">&nbsp;PRICE/item&nbsp; 
                    </div></td>
                  <td class="result_header" nowrap width="5%">&nbsp;</td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;AVAILABLE 
                      &nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;RESERVED/SOLD&nbsp;</div></td>
                  <td width="5%" nowrap class="result_header"><div align="right">&nbsp;PENDING&nbsp; 
                    </div></td>
                  <td width="5%" nowrap class="result_header">&nbsp;</td>
                </tr>
			</table>
			 <div  style="z-index:1; overflow: scroll; width: 100%; height: 240;"> 
              <table width="100%" border="0" cellpadding="2" cellspacing="2">
                
                <?php for($i=0;$x>$i;$i++) {?>
                <tr id="rw<?=$i;?>"> 
                  <td nowrap width="10%">&nbsp; 
                    <?= $arr[$i]['prod_code']?>
                  </td>
                  <td nowrap width="39%">&nbsp;<a href="ProductEdit.php?cd=<?= $arr[$i]['prod_code']?>&msg="  onMouseOver="javascript:rw<?=$i;?>.style.background = '#F0F0F0';" onMouseOut="javascript:rw<?=$i;?>.style.background = '#ffffff';"> 
                    <?= $arr[$i]['prod_name']?></a>&nbsp;</td>
                  <td nowrap width="17%"><div align="right">&nbsp; 
                      <?php   echo number_format($arr[$i]['price'],2,'.',',') ?>
                      &nbsp;php&nbsp;</div></td>
                  <td nowrap width="4%">&nbsp;</td>
                  <td width="9%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['quantity'] == 0) echo($arr[$i]['quantity']); else echo("<strong>".$arr[$i]['quantity']."</strong>"); ?>
                      &nbsp; </div></td>
                  <td width="12%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['res_qty'] == 0) echo($arr[$i]['res_qty']); else echo("<font color='#0000ff'><strong>".$arr[$i]['res_qty']."</strong></font>"); ?>
                      &nbsp;</div></td>
                  <td width="7%"><div align="right">&nbsp; 
                      <?php if  ($arr[$i]['order_qty'] == 0) echo($arr[$i]['order_qty']); else echo("<font color='#FF0000'><strong>".$arr[$i]['order_qty']."</strong></font>"); ?>
                      &nbsp; </div></td>
                  <td width="2%">&nbsp;</td>
                </tr>
                <?php } ?>
              </table></div>
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr> 
                  <td height="19">&nbsp;<strong>TOTAL php</strong> <div align="right"><strong> 
                      </strong></div></td>
                  <td width="15%"><div align="right"><strong><?php echo number_format($PI->total_ava(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong></div></td>
                  <td width="11%"> <div align="right"><strong><?php echo number_format($PI->total_res(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong></div></td>
                  <td width="11%"><div align="right"> <strong><?php echo number_format($PI->total_pnd(addslashes($code),addslashes($name),addslashes($s_stat)),2,'.',','); ?></strong> 
                    </div></td>
                  <td width="2%">&nbsp;</td>
                </tr>
              </table>
              <?PHP } else echo "<br><strong>NO RECORD(s) FOUND.</strong>"; ?>
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
