<?php

include "../Class/Connection.php"; 
include "../Class/CustomerClass.php"; 
include "../Class/ProductInventoryClass.php"; 
include "../Class/DataAccess.php";
include "../Class/StringManager.php";

$conn = new Connection();
$conn->connect();

$CC = new CustomerClass();
$PI = new ProductInventoryClass();
$DA = new DataAccess();
$SM = new StringManager(); 

$today = $DA->get_current_date(1);


if (isset($_POST['hidAdd'])) {
	$cd      = $CC->get_max_cd();
	$name    = $_POST['txtName'];
	$date    = $_POST['txtDate']; // updated nov 24. 
	$num     = $_POST['hidTotal'];	
	$new_cd  = $cd + 1;
	
	/******** updated nov 24**************/
	$discount = $_POST['txtDis'];
	$pay_type = $_POST['cboPayType'];
	$bank     = "";
	$check_no = "";
	$due_date = "";
	$check_stat = "";
	
	if ($pay_type == 'CHECK') {
		$bank     = $_POST['txtBank'];
		$check_no = $_POST['txtCheckNo'];
		$due_date = $_POST['txtDueDate'];
		$check_stat = "PENDING";
	}	
	
	$CC->set_pay_type($pay_type);
	$CC->set_bank($bank);
	$CC->set_check_no($check_no);
	$CC->set_due_date($SM->set_null_date($due_date));
	$CC->set_discount($discount);
	$CC->set_check_stat($check_stat);
	/*************************************/
	
	$CC->set_cd($new_cd);
	$CC->set_name($name);
	$CC->set_cust_date($SM->set_null_date($date));
	
	$CC->add_customer();
		
	for ($i=0;$num>$i;$i++) {
		
		if (isset($_POST['cb'.$i])) {
			
			$item_cd    = $_POST['hidCode'.$i];
			$item_qty   = $_POST['txtQty'.$i];
			$item_price = $_POST['txtPrice'.$i];		
			
			$CC->set_item($item_cd);
			$CC->set_price($item_price);
			$CC->set_qty($item_qty);
			$CC->set_order_date($today);
			
			$CC->add_sales();
			
			$stock   = $PI->select_stock($item_cd);
			$res     = $PI->select_res($item_cd);
			$pending = $PI->select_pending($item_cd);					
						
			if ($stock>0) {
								
				if ($stock>=$item_qty) {					
					
					$PI->update_stock($item_cd,($stock-$item_qty));
					$PI->update_res($item_cd,($res+$item_qty));
					$PI->update_pending($item_cd,0);
				}
				else if ($stock<$item_qty) {
					$add_pnd = $stock - $item_qty;
				
					$PI->update_stock($item_cd,0);
					$PI->update_res($item_cd,($res+$stock));
					$PI->update_pending($item_cd,$pending+($add_pnd*-1));
				}
			}
			else {
				$PI->update_pending($item_cd,($item_qty+$pending));
			}
					
		}
	}
	
	echo ("<script language='javascript'>window.location='Customer.php?cd=$new_cd'</script>");
		
}

if (isset($_POST['hidAddOrder'])) {
	$cd      = $_POST['hidCode'];	
	$num     = $_POST['hidTotal'];	
	
	$CC->set_cust_date($today);
	$CC->set_cd($cd);
	
	for ($i=0;$num>$i;$i++) {
		if (isset($_POST['cb'.$i])) {
			$item_cd    = $_POST['hidCode'.$i];
			$item_qty   = $_POST['txtQty'.$i];
			$item_price = $_POST['txtPrice'.$i];		
			
			$CC->set_item($item_cd);
			$CC->set_price($item_price);
			$CC->set_qty($item_qty);
			$CC->set_order_date($today);
			
			$CC->add_sales();
			
			$stock   = $PI->select_stock($item_cd);
			$res     = $PI->select_res($item_cd);
			$pending = $PI->select_pending($item_cd);					
			
			
			if ($stock>0) {
								
				if ($stock>=$item_qty) {					
					
					$PI->update_stock($item_cd,($stock-$item_qty));
					$PI->update_res($item_cd,($res+$item_qty));
					$PI->update_pending($item_cd,0);
				}
				else if ($stock<$item_qty) {
					$add_pnd = $stock - $item_qty;
				
					$PI->update_stock($item_cd,0);
					$PI->update_res($item_cd,($res+$stock));
					$PI->update_pending($item_cd,$pending+($add_pnd*-1));
				}
			}
			else {
				$PI->update_pending($item_cd,($item_qty+$pending));
			}
			
				
		}
	}
	
	echo ("<script language='javascript'>window.location='Customer.php?cd=$cd'</script>");
		
}

if (isset($_POST['btnCustomerEdit'])) {
	$cd   = $_POST['hidCode'];
	$name = $_POST['txtName'];
	$stat = $_POST['cboStat'];
	$date = $_POST['txtDate'];
	
	/*****************added nov 24***********************/
	$discount = $_POST['txtDiscount'];
	$pay_type = $_POST['cboPayType'];
	$bank       = "";
	$check_no   = "";
	$due_date   = "";
	$check_stat = "";
	
	if ($pay_type == 'CHECK') {
		$bank       = $_POST['txtBank'];
		$check_no   = $_POST['txtCheckNo'];
		$due_date   = $_POST['txtDue'];
		$check_stat = $_POST['cboCheckStat'];
	}
	
	$CC->set_pay_type($pay_type);
	$CC->set_bank($bank);
	$CC->set_check_no($check_no);
	$CC->set_due_date($SM->set_null_date($due_date));
	$CC->set_discount($discount);
	$CC->set_check_stat($check_stat);
	
	$CC->set_cust_date($SM->set_null_date($date));
	/****************************************************/
	
	$CC->set_name($name);
	$CC->set_cust_stat($stat);
	$CC->edit_customer($cd);
	
	echo ("<script language='javascript'>window.location='Customer.php?cd=$cd'</script>");
}

if (isset($_POST['btnCustomerCancel'])) {
	$cd = $_POST['hidCode'];
	echo ("<script language='javascript'>window.location='Customer.php?cd=$cd'</script>");
}

if (isset($_POST['btnCustomerDelete'])) {
	$cd = $_POST['hidCode'];
	
	$CC->load_orders($cd);
	$arr = $CC->get_arr();
	$x = count($arr);
	
	for($i=0;$x>$i;$i++) {
		$item_cd  = $arr[$i]['item_cd'];
		$item_qty = $arr[$i]['qty'];
		$dt 	  = $arr[$i]['order_dt'];
		
		$ava = $PI->select_stock($item_cd);
		$res = $PI->select_res($item_cd);  
		$pnd = $PI->select_pending($item_cd);
		
		if ($pnd>0) {			
			if ($pnd>=$item_qty) {
				$bbb = $pnd-$item_qty;
				$PI->update_pending($item_cd,$bbb);
			}
			else if ($pnd<$item_qty) {
				$xxx = $item_qty - $pnd;			
				if ($res>0) {
					if ($res>=$xxx) {
						$kkk = $res - $xxx;
						$ttt = $ava + $xxx;
						$PI->update_stock($item_cd,$ttt);
						$PI->update_res($item_cd,$kkk);
					}
					else if ($res<$xxx) {
						$yyy = $xxx - $res;
						$PI->update_stock($item_cd,$yyy);
						$PI->update_res($item_cd,0);
					}
				}
				$PI->update_pending($item_cd,0);
			}
		}	
		else if ($ava>=0) {
			if ($res>0) {
				if ($res>=$item_qty) {
					$uuu = $res - $item_qty;
					$qqq = $ava + $item_qty;
					$PI->update_stock($item_cd,$qqq);
					$PI->update_res($item_cd,$uuu);
					$PI->update_pending($item_cd,0);
				}
				else if ($res<$item_qty) {
					$zzz = $item_qty -  $res;
					$ooo = $ava + $zzz;
					$PI->update_stock($item_cd,$ooo);
					$PI->update_res($item_cd,0);
					$PI->update_pending($item_cd,0);
				}
			}		
		}
		$CC->delete_order($cd,$item_cd,$dt);
	}
	$CC->delete_customer($cd);
	echo ("<script language='javascript'>window.location='CustomerList.php'</script>");
}

if (isset($_POST['btnOrderCancel'])) {
	$cd   = $_POST['hidCode'];
	$item = $_POST['hidItem'];
	$dt   = $_POST['hidDate'];
	
	echo ("<script language='javascript'>window.location='CustomerEditOrder.php?cd=$cd&item=$item&dt=$dt'</script>");
}

if (isset($_POST['btnOrderDelete'])) {
	$cd         = $_POST['hidCode']; //customer code
	$item_cd    = $_POST['hidItem']; // item code
	$dt         = $_POST['hidDate']; 
	$item_qty   = $_POST['txtQty'];  // quantitiy of item canceled
	
	$ava = $PI->select_stock($item_cd);
	$res = $PI->select_res($item_cd);  
	$pnd = $PI->select_pending($item_cd);
	
	if ($pnd>0) {
		//echo "($pnd>0)<br><br>";
		if ($pnd>=$item_qty) {			
			//$PI->update_pending($item_cd,($pnd-$item_qty));
			$bbb = $pnd-$item_qty;
			
			//echo "($pnd>=$item_qty)<br><br>";
			
			//echo "stock = ".$ava."<br>";
			//echo "res = ".$res."<br>";
			//echo "pending = ".$bbb ."<br>";
			$PI->update_pending($item_cd,$bbb);
			
			
		}
		else if ($pnd<$item_qty) {
			$xxx = $item_qty - $pnd;			
			
			//echo "($pnd<$item_qty)<br><br>";			
			
			if ($res>0) {
				if ($res>=$xxx) {
					$kkk = $res - $xxx;
					$ttt = $ava + $xxx;
					
					//echo "stock=".$ttt."<br>";
					//echo "res=".$kkk."<br>";
					
					$PI->update_stock($item_cd,$ttt);
					$PI->update_res($item_cd,$kkk);
			}
				else if ($res<$xxx) {
					$yyy = $xxx - $res;
					
					//echo "stock=".$yyy."<br>";
					//echo "res="."0"."<br>";
					
					$PI->update_stock($item_cd,$yyy);
					$PI->update_res($item_cd,0);
				
					
				}
			}
			//echo "pending="."0"."<br>";
			$PI->update_pending($item_cd,0);
		}
	}	
	else if ($ava>=0) {
		//echo "($ava>=0)<br>";
		if ($res>0) {
			if ($res>=$item_qty) {
				$uuu = $res - $item_qty;
				$qqq = $ava + $item_qty;
								
				//echo("($res>=$item_qty)<br><br>");
				
				//echo "stocks = ".$qqq."<br>";
				//echo "res = ".$uuu."<br>";
				//echo "pending = "."0"."<br>";
				
				$PI->update_stock($item_cd,$qqq);
				$PI->update_res($item_cd,$uuu);
				$PI->update_pending($item_cd,0);
			}
			else if ($res<$item_qty) {
				$zzz = $item_qty -  $res;
				$ooo = $ava + $zzz;
				
				//echo("($res<$item_qty)<br><br>");
				
				//echo "stocks = ".$ooo."<br>";
				//echo "res = "."0"."<br>";
				//echo "pending = "."0"."<br>";
				
				$PI->update_stock($item_cd,$ooo);
				$PI->update_res($item_cd,0);
				$PI->update_pending($item_cd,0);
			}
		}		
	}
			
	$CC->delete_order($cd,$item_cd,$dt);
	echo ("<script language='javascript'>window.location='Customer.php?cd=$cd'</script>");
}

if (isset($_POST['btnOrderEdit'])) {
	$cd    = $_POST['hidCode'];
	$item  = $_POST['hidItem'];
	$dt    = $_POST['hidDate'];
	//$qty   = $_POST['txtQty'];
	$price = $_POST['txtPrice'];
	
	$CC->set_price($price);
	//$CC->set_qty($qty);
	
	$CC->edit_order($cd,$item,$dt);
	
	echo ("<script language='javascript'>window.location='Customer.php?cd=$cd'</script>");
}





?>