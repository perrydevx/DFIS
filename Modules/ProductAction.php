<?php
include "../class/Connection.php"; 
include "../class/ProductInventoryClass.php"; 

$conn = new Connection();
$conn->connect();

$PI = new ProductInventoryClass();


if (isset($_POST['hidAdd'])) {
	$cd      = $_POST['txtCode'];
	$name    = $_POST['txtName'];
	$price   = $_POST['txtPrice'];
	$qty     = $_POST['txtQty'];
	
		
	$PI->set_code($cd);
	$PI->set_name($name);
	$PI->set_price($price);
	$PI->set_qty($qty);
		
	if ($PI->chk_code($cd)) {
		$PI->add_product();
		echo ("<script language='javascript'>window.location='ProductInventory.php'</script>");
	}
	else {
		$msg = "Code $cd already exists, enter a different code.";
		echo ("<script language='javascript'>window.location='ProductAdd.php?msg=$msg'</script>");
	}	
}

if (isset($_POST['btnCancel'])) {
	$cd = $_POST['txtCode'];
	
	echo ("<script language='javascript'>window.location='ProductEdit.php?cd=$cd&msg='</script>");
}

if (isset($_POST['btnDelete'])) {
	$cd = $_POST['txtCode'];
	$PI->delete_product($cd);
	$PI->delete_orders($cd);
	echo ("<script language='javascript'>window.location='ProductInventory.php'</script>");
}

if (isset($_POST['btnEdit'])) {
	$cd      = $_POST['txtCode'];
	$name    = $_POST['txtName'];
	$price   = $_POST['txtPrice'];
	$hidQty  = $_POST['hidQty'];
	$res     = $_POST['txtRes'];
	$pnd     = $_POST['txtPnd'];
		
	
	$PI->set_name($name);
	$PI->set_price($price);
	$PI->set_res($res);
	$PI->set_order_qty($pnd);
	
	if ($hidQty>0)  {
		$qty     = $_POST['txtQty'];
		if ($hidQty>=$qty) {		
			$PI->set_qty($qty);
			$PI->update_stock($cd,$qty);
		}
		else {
		$msg = "This page is for edit only, go to \"Add Stocks\" page to add additional stocks.";
		echo ("<script language='javascript'>window.location='ProductEdit.php?cd=$cd&msg=$msg'</script>");
		}
	}
		
	$PI->edit_product($cd);	
	echo ("<script language='javascript'>window.location='ProductInventory.php'</script>");
}

if (isset($_POST['hidAddStocks'])) {
	$num     = $_POST['hidTotalAddStocks'];
	
	
	for ($i=0;$num>$i;$i++) {	
						
		if ($_POST['txtAddStocks'.$i]!='') {
			$cd = $_POST['hidCode'.$i];
			
			$ava_stocks = $PI->select_stock($cd);
			$res_stocks = $PI->select_res($cd);  
			$pending    = $PI->select_pending($cd);
								
			$add_stocks = $_POST['txtAddStocks'.$i];
						
			if ($pending>0) {
				$add_qty = $pending - $add_stocks;
						
				if ($add_stocks >= $pending) {
					$ava = $pending - $add_stocks;
					
					$PI->update_pending($cd,0);
					$PI->update_res($cd,($res_stocks + $pending));
					$PI->update_stock($cd,($ava_stocks+($ava*-1)));
				}
				else if ($pending>$add_stocks) {
					$pnd = $pending - $add_stocks;
								
					$PI->update_pending($cd,$pnd);
					$PI->update_res($cd,($res_stocks + $add_stocks));
					$PI->update_stock($cd,0);
				}		
			}
			else {
				$new_stocks = $ava_stocks + $add_stocks;
				$PI->update_stock($cd,$new_stocks);
			}
		}
	}
	
	echo ("<script language='javascript'>window.location='ProductInventory.php'</script>");
} 

/*
$pending = $PI->select_pending($cd);
	
	if ($pending>0) {
		$add_qty = $pending - $qty;		
		if ($add_qty>0) {
			// update pending_orders 
			$PI->update_pending($cd,$add_qty);
			$PI->update_stock($cd,0);
		}
		else {
			$xxx = $add_qty * -1;			
			$PI->update_pending($cd,0);
			$PI->update_stock($cd,$xxx);
		}
		
	}
	else {
		$PI->update_stock($cd,$qty);
	}
*/
?>
