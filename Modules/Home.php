
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Dragon Fireworks Inventory System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../StyleSheet/djarc.css" rel="stylesheet">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body leftmargin=0 topmargin="0" rightmargin=0 marginwidth="0" marginheight="0" onLoad="MM_preloadImages('../Images/CustomerOver.gif','../Images/RenewalOver.gif','../Images/AdminOver.gif','../Images/LedgerOver.gif')">
<!-- HEADER -->
<?php include "Header.php"; ?>
<!-- HEADER -->
<!-- BODY -->
<table cellspacing="0" cellpadding="0" width="100%" border="0" height="80%">
  <tr> 
    <td class="panel" width="179" rowspan="2">
	  <img height="28" src="../Images/PanelTab.gif" width="179" border="0"> 
	  <br>
	  <?php include "Panel.php"; ?>
    </td>
    <td class="split" width="1" rowspan="2"><img height="1" src="Images/Pixel.gif" width="1" border="0"></td>
    <td class="main_page" width="100%"> 
	  <table style="border-collapse: collapse" bordercolor="#111111" height="6" cellspacing="0" cellpadding="0" width="100%" border="0">
        <tr> 
          <td class="headerline" width="100%"><img height=6 src="Images/PanelBox.gif" width=6 border="0"></td>
        </tr>
      </table>
      <?php include "Menu.php"; ?>
      <table cellspacing="0" width="100%" border="0">
        <tr> 
          <td class="content" width="100%">&nbsp;</td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td class="content" width="10%"><a href="ProductInventory.php" onMouseOver="MM_swapImage('imgTransaction','','../Images/LedgerOver.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../Images/LedgerOut.gif" alt="Manage product stocks" name="imgTransaction" width=80 height=80 border="0" id="imgTransaction"></a> 
          </td>
          <td class="content" width="100%"><span class="text_title">Products Inventory</span></td>
        </tr>
        <tr> 
          <td class="content" width="100%" colspan="2"> <HR> </td>
        </tr>
		<tr> 
          <td class="content" width="10%"> <a href="CustomerList.php" onMouseOver="MM_swapImage('imgMaintenance','','../Images/CustomerOver.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../Images/CustomerOut.gif" alt="Add new customer, manage customer order(s)" name="imgMaintenance" width=80 height=80 border="0" id="imgMaintenance"></a> 
          </td>
          <td class="content" width="100%"><span class="text_title">Customer Sales</span></td>
        </tr>
        <tr> 
          <td class="content" width="100%" colspan="2"> <HR> </td>
        </tr>
		<tr> 
          <td class="content" width="10%"> <a href="ProductInventoryReportMain.php" onMouseOver="MM_swapImage('imgReport','','../Images/RenewalOver.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../Images/RenewalOut.gif" alt="Print Product Stocks" name="imgReport" width=80 height=80 border="0" id="imgReport"></a> 
          </td>
          <td class="content" width="100%"><span class="text_title">Products Inventory 
            Report </span> </td>
        </tr>
        <tr> 
          <td class="content" width="100%" colspan="2"> <HR> </td>
        </tr>
		<tr> 
          <td class="content" width="10%"> <a href="CustomerReportMain.php" onMouseOver="MM_swapImage('imgAdmin','','../Images/PledgeOver.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../Images/PledgeOut.gif" alt="Print Customer Sales" name="imgAdmin" width=80 height=80 border="0" id="imgAdmin"></a> 
          </td>
          <td class="content" width="100%"><span class="text_title">Customer Sales Report</span></td>
        </tr>
        <tr> 
          <td class="content" width="100%" colspan="2"> <HR> </td>
        </tr>
      </table>
	</td>
    <td class="split" width="1" rowspan="2"><img height="1" src="../Images/Pixel.gif" width="1" border="0"></td>
  </tr>
</table>
<!-- BODY -->

<!-- FOOTER -->
<?php include "Footer.php"; ?>
<!-- FOOTER -->


</body>
</html>
