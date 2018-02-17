

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
      <table cellspacing="0" width="100%" border="0">
        <tr> 
          <td class="content" width="100%"><span class="text_title">&nbsp;</span></td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="5" width="100%" border="0">
        <tr> 
          <td valign="top" class="content">
		  	<table border="0" cellpadding="2" cellspacing="0" width="100%">
                <tr> 
                  <td class="content"><span class="text_title">About</span><span class="text_title"></span> 
                  </td>
                </tr>
              </table> 
		    <hr>
		  </td>
        </tr>
        <tr> 
            <td class="content" width="100%" valign="top"> Dragon Fireworks Inventory 
              System<br>
              DFIS ver 2.0, Dec - 2005<br>
			  Property of Greg Tiongco<br><br>
              Developer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&#8226;&#8226;&#8226;&#8226;<br>
              Environment:&nbsp;&nbsp;PHP5, Apache 2.0 Server, and MySQL 4.1.8
			  <br><br>
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
