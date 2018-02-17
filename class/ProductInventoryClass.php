<?php
// perry nov-05

class ProductInventoryClass {

	private $code;
	private $name;
	private $price;
	private $qty;
	private $today;
	private $user;
	private $arr;
	private $order_qty;
	private $res;
	private $total_qty;
	private $total_price;
	
	function get_total_qty() {
		return $this->total_qty;
	}
	function get_total_price() {
		return $this->total_price;
	}
	
	function get_res() {
		return $this->res;
	}
	function set_res($val) {
		$this->res = $val;
	}
	
	function get_order_qty() {
		return $this->order_qty;
	}
	function set_order_qty($val) {
		$this->order_qty = $val;
	}
	
	function get_arr() {
		return $this->arr;
	}
	
	function get_code() {
		return $this->code;
	}
	function set_code($val) {
		$this->code = $val;
	}
	
	function get_name() {
		return $this->name;
	}
	function set_name($val) {
		$this->name = $val;
	}
	
	function get_price() {
		return $this->price;
	}
	function set_price($val) {
		$this->price = $val;
	}
	
	function get_qty() {
		return $this->qty;
	}
	function set_qty($val) {
		$this->qty = $val;
	}
	
	function get_today() {
		return $this->today;
	}
	function set_today($val) {
		$this->today = $val;
	}
	
	function get_user() {
		return $this->user;
	}
	function set_user($val) {
		$this->user = $val;
	}
	
	
	function load_records($cd,$name,$stat) {
	
		$where = '';
				
		if ($cd != '') {
			$where =  " WHERE products.prod_code LIKE '$cd%'";
		}		
		if ($name != '') {
			($where != '') ? $where = $where." AND products.prod_name LIKE 'name%'" : $where = $where." WHERE products.prod_name LIKE '$name%'";	
		}
		if ($stat == 'AVA') {
			($where != '') ? $where = $where." AND products.quantity > '0'" : $where = $where." WHERE products.quantity > '0'";	
		}
		if ($stat == 'RES') {
			($where != '') ? $where = $where." AND products.res_qty > '0'" : $where = $where." WHERE products.res_qty > '0'";	
		}
		if ($stat == 'PND') {
			($where != '') ? $where = $where." AND products.order_qty > '0'" : $where = $where." WHERE products.order_qty > '0'";	
		}
			
		$result = mysql_query("SELECT * FROM products".$where); 
		
		
		if (mysql_num_rows($result) > 0) {
			$i = 0;
			while ($rows = mysql_fetch_array($result)) {
				$this->arr[$i] = $rows;
				$i++;				
			}
		}
	}
	
	function chk_code($cd) {
		$result = mysql_query("SELECT prod_name 
		                         FROM products 
								WHERE prod_code = '$cd' 
							 ");
		
		if (mysql_num_rows($result) == 0) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function add_product() {
		$result = mysql_query("INSERT 
								 INTO products
								  SET prod_code = '$this->code' ,
								  	  prod_name = '$this->name' ,
									  price     = '$this->price',
									  quantity  = '$this->qty'  , 
									  order_qty = '0'			,
									  res_qty   = '0'
							  ");
	}
	
	function load_product($cd) {
		$result = mysql_query("SELECT * FROM products WHERE prod_code = '$cd'");
		
		$row = mysql_fetch_array($result);
		
		$this->code      = $row['prod_code'];
		$this->name      = $row['prod_name'];
		$this->price     = $row['price'];
		$this->qty       = $row['quantity'];
		$this->order_qty = $row['order_qty'];
		$this->res       = $row['res_qty'];
		
	}
	
	function edit_product($cd) {
		$result = mysql_query("UPDATE products
								  SET prod_name = '$this->name'     ,
									  price     = '$this->price'    ,
									  order_qty = '$this->order_qty',
									  res_qty   = '$this->res'			  
									  
								WHERE prod_code = '$cd'
							  ");
	}
	
	function delete_product($cd) {
		$result = mysql_query("DELETE FROM  products
								WHERE prod_code = '$cd'
							  ");
	}
	
	function select_pending($cd) {
		$result = mysql_query("SELECT order_qty FROM products WHERE prod_code = '$cd'"); 
		$row = mysql_fetch_array($result);
		return $row['order_qty'];
	}
	
	function select_stock($cd) {
		$result = mysql_query("SELECT quantity FROM products WHERE prod_code = '$cd'"); 
		$row = mysql_fetch_array($result);
		return $row['quantity'];
	}
	
	function select_res($cd) {
		$result = mysql_query("SELECT res_qty FROM products WHERE prod_code = '$cd'"); 
		$row = mysql_fetch_array($result);
		return $row['res_qty'];
	}
	
	function update_stock($cd,$qty) {
		mysql_query("UPDATE products SET quantity = '$qty' WHERE prod_code = '$cd'"); 
	}
	
	function update_pending($cd,$qty) {
		mysql_query("UPDATE products SET order_qty = '$qty' WHERE prod_code = '$cd'"); 
	}
	
	function update_res($cd,$qty) {
		mysql_query("UPDATE products SET res_qty = '$qty' WHERE prod_code = '$cd'"); 
	}
	
	function load_customers($cd,$show) {
		$yr      = date('Y');
		$startDt = $yr."-01-01";
		$endDt   = $yr + 1 ."-01-01";
		
		if ($show != '')
			$where = "  AND (sales.order_dt >= '$startDt' AND sales.order_dt < '$endDt')";
		else 
			$where = '';
		
		$result = mysql_query("SELECT   customer.customer_name,
										sales.qty,
										sales.price,
										DATE_FORMAT(sales.order_dt,'%d-%b-%Y') order_dt 
										
										
								FROM    sales
										left join customer on customer.customer_cd = sales.customer_cd
								WHERE   sales.item_cd = '$cd'".$where."
										
							    ORDER BY sales.order_dt desc");
							
		
		
		if (mysql_num_rows($result) > 0) {
			$i = 0;
			while ($rows = mysql_fetch_array($result)) {
				$this->arr[$i] = $rows;
				$i++;				
			}
		}
	}
	
	function delete_orders($cd) {
		mysql_query("DELETE FROM sales WHERE item_cd = '$cd'");	
	}

	function total_ava($cd,$name,$stat) {
		$where = '';
				
		if ($cd != '') {
			$where =  " WHERE products.prod_code LIKE '$cd%'";
		}		
		if ($name != '') {
			($where != '') ? $where = $where." AND products.prod_name LIKE '%$name%'" : $where = $where." WHERE products.prod_name LIKE '%$name%'";	
		}
		if ($stat == 'AVA') {
			($where != '') ? $where = $where." AND products.quantity > '0'" : $where = $where." WHERE products.quantity > '0'";	
		}
		if ($stat == 'RES') {
			($where != '') ? $where = $where." AND products.res_qty > '0'" : $where = $where." WHERE products.res_qty > '0'";	
		}
		if ($stat == 'PND') {
			($where != '') ? $where = $where." AND products.order_qty > '0'" : $where = $where." WHERE products.order_qty > '0'";	
		}
	
		$result = mysql_query("SELECT sum(price * quantity) as total_ava 
							   FROM products ".$where);
		$row = mysql_fetch_array($result);
		return $row['total_ava'];
	}
	
	function total_res($cd,$name,$stat) {
		$where = '';
				
		if ($cd != '') {
			$where =  " WHERE products.prod_code LIKE '$cd%'";
		}		
		if ($name != '') {
			($where != '') ? $where = $where." AND products.prod_name LIKE '%$name%'" : $where = $where." WHERE products.prod_name LIKE '%$name%'";	
		}
		if ($stat == 'AVA') {
			($where != '') ? $where = $where." AND products.quantity > '0'" : $where = $where." WHERE products.quantity > '0'";	
		}
		if ($stat == 'RES') {
			($where != '') ? $where = $where." AND products.res_qty > '0'" : $where = $where." WHERE products.res_qty > '0'";	
		}
		if ($stat == 'PND') {
			($where != '') ? $where = $where." AND products.order_qty > '0'" : $where = $where." WHERE products.order_qty > '0'";	
		}
		
		$result = mysql_query("SELECT sum(price * res_qty) as total_res 
							   FROM products ".$where);
		$row = mysql_fetch_array($result);
		return $row['total_res'];
	}
	
	function total_pnd($cd,$name,$stat) {
		$where = '';
				
		if ($cd != '') {
			$where =  " WHERE products.prod_code LIKE '$cd%'";
		}		
		if ($name != '') {
			($where != '') ? $where = $where." AND products.prod_name LIKE '%$name%'" : $where = $where." WHERE products.prod_name LIKE '%$name%'";	
		}
		if ($stat == 'AVA') {
			($where != '') ? $where = $where." AND products.quantity > '0'" : $where = $where." WHERE products.quantity > '0'";	
		}
		if ($stat == 'RES') {
			($where != '') ? $where = $where." AND products.res_qty > '0'" : $where = $where." WHERE products.res_qty > '0'";	
		}
		if ($stat == 'PND') {
			($where != '') ? $where = $where." AND products.order_qty > '0'" : $where = $where." WHERE products.order_qty > '0'";	
		}
		
		$result = mysql_query("SELECT sum(price * order_qty) as total_pnd 
							   FROM products ".$where);
		$row = mysql_fetch_array($result);
		return $row['total_pnd'];
	}
	
	function total_price_item($cd) {
		$yr      = date('Y');
		$startDt = $yr."-01-01";
		$endDt   = $yr + 1 ."-01-01";
	
		$result = mysql_query("SELECT sum(price) as total_price,
									  sum(qty) as total_qty
							   FROM   sales 
							   WHERE   sales.item_cd = '$cd' AND
										(sales.order_dt >= '$startDt' AND sales.order_dt < '$endDt')");
		$row = mysql_fetch_array($result);
		$this->total_price = $row['total_price'];
		$this->total_qty   = $row['total_qty'];
	}
	
} //end class
?>