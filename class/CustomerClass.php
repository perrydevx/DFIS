<?php 
// perry nov-05

class CustomerClass {

	private $cd;
	private $name;
	private $cust_date;
	private $arr;
	private $qty;
	private $item;
	private $price;
	private $order_date;
	private $cust_stat;
	
	private $discount;
	private $bank;
	private $check_no;
	private $check_stat;
	private $pay_type;
	private $due_date;
	
	function get_discount() {
		return $this->discount;
	}
	function set_discount($val) {
		$this->discount = $val;
	}
	
	function get_bank() {
		return $this->bank;
	}
	function set_bank($val) {
		$this->bank = $val;
	}
	
	function get_check_no() {
		return $this->check_no;
	}
	function set_check_no($val) {
		$this->check_no = $val;
	}
	
	function get_check_stat() {
		return $this->check_stat;
	}
	function set_check_stat($val) {
		$this->check_stat = $val;
	}
	
	function get_pay_type() {
		return $this->pay_type;
	}
	function set_pay_type($val) {
		$this->pay_type = $val;
	}
	
	function get_due_date() {
		return $this->due_date;
	}
	function set_due_date($val) {
		$this->due_date = $val;
	}
	

	
	
	//===========================================
	function get_cust_stat() {
		return $this->cust_stat;
	}
	function set_cust_stat($val) {
		$this->cust_stat = $val;
	}
	
	function get_price() {
		return $this->price;
	}
	function set_price($val) {
		$this->price = $val;
	}
	
	function get_order_date() {
		return $this->order_date;
	}
	function set_order_date($val) {
		$this->order_date =  $val;
	}
	
	function get_arr() {
		return $this->arr;
	}
	
	function get_cd() {
		return $this->cd;
	}
	function set_cd($val) {
		$this->cd = $val;
	}
	
	function get_name() {
		return $this->name;
	}
	function set_name($val) {
		$this->name = $val;
	}
	
	function get_cust_date() {
		return $this->cust_date;
	}
	function set_cust_date($val) {
		$this->cust_date = $val;
	}
	
	function get_qty() {
		return $this->qty;
	}
	function set_qty($val) {
		$this->qty = $val;
	}
	
	function get_item() {
		return $this->item;
	}
	function set_item($val) {
		$this->item = $val;
	}
	
	function load_records($name,$st,$yr,$p_type,$chk_no,$chk_stat) {
	
	
		$where = '';
				
		if ($name != '') {
			$where = " WHERE customer.customer_name LIKE '%$name%'";	
		}
		if ($st !='') {
			($where != '') ? $where = $where." AND customer.cust_stat = '$st'" : $where = $where." WHERE customer.cust_stat = '$st'";

		}
		if ($p_type !='') {
			($where != '') ? $where = $where." AND customer.pay_type = '$p_type'" : $where = $where." WHERE customer.pay_type = '$p_type'";

		}
		if ($chk_no !='') {
			($where != '') ? $where = $where." AND customer.check_no = '$chk_no'" : $where = $where." WHERE customer.check_no = '$chk_no'";

		}
		if ($chk_stat !='') {
			($where != '') ? $where = $where." AND customer.check_stat = '$chk_stat'" : $where = $where." WHERE customer.check_stat = '$chk_stat'";

		}
		if ($yr !='') {
			$startDt = $yr."-01-01";
			$endDt   = $yr + 1 ."-01-01";
			
			($where != '') ? $where = $where." AND (customer.customer_date >= '$startDt' AND customer.customer_date < '$endDt') " : $where = $where." WHERE (customer.customer_date >= '$startDt' AND customer.customer_date < '$endDt')";
		}
			
		$result = mysql_query("SELECT customer.customer_name,
								      customer.customer_cd,
									  customer.cust_stat,
									  DATE_FORMAT(customer.customer_date,'%d-%b-%Y') customer_date,
									  customer.pay_type,
									  customer.check_no,
									  customer.bank_branch,
									  customer.due_date as due_date_x,
									  DATE_FORMAT(customer.due_date,'%d-%b-%Y') due_date,
									  customer.discount,
									  customer.check_stat
								 FROM customer".$where." ORDER BY customer.customer_date DESC"); 
								 
						
																	
		
		if (mysql_num_rows($result) > 0) {
			$i = 0;
			while ($rows = mysql_fetch_array($result)) {
				$this->arr[$i] = $rows;
				$i++;				
			}
		}
	}
	
	function grand_total($name,$st,$yr,$p_type,$chk_no,$chk_stat) {
		$where = '';
				
		if ($name != '') {
			$where = " WHERE customer.customer_name LIKE '$name%'";	
		}
		if ($st !='') {
			($where != '') ? $where = $where." AND customer.cust_stat = '$st'" : $where = $where." WHERE customer.cust_stat = '$st'";

		}
		if ($p_type !='') {
			($where != '') ? $where = $where." AND customer.pay_type = '$p_type'" : $where = $where." WHERE customer.pay_type = '$p_type'";

		}
		if ($chk_no !='') {
			($where != '') ? $where = $where." AND customer.check_no = '$chk_no'" : $where = $where." WHERE customer.check_no = '$chk_no'";

		}
		if ($chk_stat !='') {
			($where != '') ? $where = $where." AND customer.check_stat = '$chk_stat'" : $where = $where." WHERE customer.check_stat = '$chk_stat'";

		}
		if ($yr!='') {
			$startDt = $yr."-01-01";
			$endDt   = $yr + 1 ."-01-01";
			
			($where != '') ? $where = $where." AND (customer.customer_date >= '$startDt' AND customer.customer_date < '$endDt') " : $where = $where." WHERE (customer.customer_date >= '$startDt' AND customer.customer_date < '$endDt')";
		}
	
		$result = mysql_query("SELECT sum(price) as total_price 
								 FROM sales LEFT JOIN customer on customer.customer_cd = sales.customer_cd
							".$where);
		
		$row = mysql_fetch_array($result);
		return $row['total_price']; 
	}
	
	function load_record($cd) {
		$result = mysql_query("SELECT customer_name,  
									  cust_stat,
									  DATE_FORMAT(customer.customer_date,'%d-%b-%Y') customer_date,
									  customer.pay_type,
									  customer.check_no,
									  customer.bank_branch,
									  DATE_FORMAT(customer.due_date,'%d-%b-%Y') due_date,
									  customer.discount,
									  customer.check_stat
									   
							     FROM customer WHERE customer_cd = '$cd'");
				
		$rows = mysql_fetch_array($result);
		
		$this->name      = $rows['customer_name'];
		$this->cust_date = $rows['customer_date'];
		$this->cust_stat = $rows['cust_stat'];
		
		$this->bank      = $rows['bank_branch'];
		$this->due_date  = $rows['due_date'];
		$this->discount  = $rows['discount'];
		$this->check_stat= $rows['check_stat'];
		$this->pay_type  = $rows['pay_type'];
		$this->check_no  = $rows['check_no'];
	}
	
	function load_orders($cd) {
		$result = mysql_query("SELECT sales.customer_cd	,
									  sales.item_cd		,
									  sales.qty			,
									  sales.price		,
									  sales.order_dt	,									  
									  DATE_FORMAT(sales.order_dt,'%d-%b-%Y') order_dt_disp,
									  
									  products.prod_name,
									  products.price as price_t
									  									  
								 FROM sales LEFT JOIN products ON sales.item_cd = products.prod_code
								WHERE customer_cd = '$cd'
								order by sales.order_dt DESC
								"); 
		
		if (mysql_num_rows($result) > 0) {
			$i = 0;
			while ($rows = mysql_fetch_array($result)) {
				$this->arr[$i] = $rows;
				$i++;				
			}
		}
	}
	
	function load_order($cd,$item,$dt) {
		$result = mysql_query("SELECT sales.customer_cd	,
									  sales.item_cd		,
									  sales.qty			,
									  sales.price		,
									  DATE_FORMAT(sales.order_dt,'%d-%b-%Y') order_dt, 
									  
									  products.prod_name,
									  
									  customer.customer_name
									  									  
								 FROM sales 
									  LEFT JOIN products ON sales.item_cd = products.prod_code
									  LEFT JOIN customer ON sales.customer_cd = customer.customer_cd
								
								WHERE sales.customer_cd = '$cd'   AND
									  sales.item_cd     = '$item' AND
									  sales.order_dt    = '$dt'							
							  ");
		$row = mysql_fetch_array($result);
		$this->qty  = $row['qty'];
		$this->item = $row['prod_name'];
		$this->name = $row['customer_name'];
		$this->order_date = $row['order_dt'];
		$this->price = $row['price'];
	}


	function get_max_cd() {
		$result = mysql_query("SELECT max(customer_cd) as cd FROM customer");
		$row = mysql_fetch_array($result);
		return $row['cd'];
	}
	
	
	function select_qty($item_cd) {
		$result = mysql_query("SELECT quantity
								 FROM products
								WHERE prod_code = '$item_cd'");
		$row = mysql_fetch_array($result);
		return $row['quantity'];
	}
	
	function update_qty($item_cd,$qty) {
		$result = mysql_query("UPDATE products
								  SET quantity  = '$qty'
								WHERE prod_code = '$item_cd'");
	}
	
	function add_customer() {
		$result = mysql_query("INSERT
								 INTO customer
								  SET customer_name = '$this->name'			,
								      customer_cd   = '$this->cd'			,
									  customer_date	= $this->cust_date   	,
									  cust_stat     = 'FD'					,
									  pay_type      = '$this->pay_type'		,
									  bank_branch   = '$this->bank'			,
									  check_no		= '$this->check_no'		,
									  due_date      = $this->due_date		,
									  check_stat    = '$this->check_stat'	,
									  discount		= '$this->discount'
							  ");
	}
	
	function add_sales() {
		$result = mysql_query("INSERT 
								 INTO sales
								  SET customer_cd = '$this->cd'	,
								  	  item_cd     = '$this->item'	,
									  qty 		  = '$this->qty'	,
									  price 	  = '$this->price'	,
									  order_dt 	  = '$this->order_date'	
							");
							
	}
	
	function total_purcahsed($cd) {
		$result = mysql_query("SELECT sum(price) as total
								FROM `sales`where customer_cd = '$cd'");
								
		$row = mysql_fetch_array($result);
		return $row['total'];
	}
	
	
	
	function edit_order($cd,$item,$dt) {
		mysql_query("  UPDATE sales
						SET   price	= '$this->price'		 
						
						WHERE sales.customer_cd = '$cd'   AND
							  sales.item_cd     = '$item' AND
							  sales.order_dt    = '$dt'							
					");
	}
	
	function delete_order($cd,$item,$dt) {
		mysql_query("DELETE FROM sales 
						WHERE sales.customer_cd = '$cd'   AND
							  sales.item_cd     = '$item' AND
							  sales.order_dt    = '$dt'");
	}
	
	function edit_customer($cd) {
		mysql_query("UPDATE customer 
					    SET customer_name = '$this->name' 		,
							customer_date	= $this->cust_date   	,
							cust_stat     = '$this->cust_stat'	,	
							pay_type      = '$this->pay_type'	,
						    bank_branch   = '$this->bank'		,
							check_no      = '$this->check_no'	,
							due_date      = $this->due_date		,
							check_stat    = '$this->check_stat'	,
							discount   	  = '$this->discount'
							
					  WHERE customer_cd   = '$cd'");
	}
	
	function delete_customer($cd) {
		mysql_query("DELETE FROM customer WHERE customer_cd = '$cd'");
	}
}
?>
