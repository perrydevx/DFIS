<?php
Class StringManager
{
   function set_null_datetime($p_value)
   {
   		$retval = 'NULL';		
		
		if (isset($p_value))
		{
			if (trim($p_value) != '')
			{
				//$retval = date("Y-m-d H:i:s", strtotime($p_value));
				$retval = $this->parse_date($p_value);
				$retval = "'$retval'";
			}
		}
		return $retval;
   }
   
   function set_null_date($p_value)
   {
   		$retval = 'NULL';		
        if (isset($p_value))
		{
			if (trim($p_value) != '')
			{
				//$retval = $this->format_mysql_date($p_value);
				$retval = $this->parse_date($p_value);
				$retval = "'$retval'";
			}
		}
        return $retval;
   }	
   
   function set_null_numeric($p_value)
   {
   		$retval = 'NULL';
   		if (isset($p_value))
		{
			if (trim($p_value) != '')
				$retval = $p_value;	
		}
		return $retval;				
   }
   
   function sql_prepare(&$p_strval)
   {
        return addslashes($p_strval);
   }
   
   function set_null_string($p_value)
   {
   		$retval = 'NULL';		
        if (isset($p_value))
		{
			if (trim($p_value) != '')
			{
				$p_value = $this->sql_prepare($p_value);
				$retval = "'$p_value'";
			}
		}
        
		return $retval;
   }
   
   
   function set_null_blob($p_value)
   {
   		$retval = 'NULL';		
        if (isset($p_value))
		{
			if (trim($p_value) != '')
			{
				$retval = "'$p_value'";
			}
		}
        
		return $retval;
   }
   
   function set_empty_string($p_value)
   {
   		$retval = '';		
		if (isset($p_value))
		{
			if (trim($p_value) != '' && $p_value != 'NULL')
				$retval = trim($p_value);
		}	
		return $retval;
   }
   
   function format_mysql_date($p_dateval) //format dd-mon-yyyy to yyyy-mm-dd
   {
   		$retval = '';		
		if ($p_dateval != '')		
		{
			/*$timestamp = strtotime($p_dateval); 
			$month = idate('m', $timestamp);
			$retval = date("Y-m-d", mktime(0, 0, 0, $month, substr($p_dateval,0,2) , substr($p_dateval,7,4)));*/
			$retval = $this->parse_date($p_dateval);
		}
		return $retval;
   }
   
   function dateaddmonth($p_dateval,$p_addval) //parameter format dd-mon-yyyy
   {
   		$retval = '';		
		if ($p_dateval != '')		
		{
			$timestamp = strtotime($p_dateval); 
			$month = idate('m', $timestamp);
			$month = $month + $p_addval;
			$retval = date("d-M-Y", mktime(0, 0, 0, $month, substr($p_dateval,0,2) , substr($p_dateval,7,4)));
		}
		return $retval;
   }
   
   function get_date_part($p_part,$p_date)
   {
   		$timestamp = strtotime($p_date); 
		return idate($p_part,$timestamp );
   }
	
	function append_if_not_empty($p_strsource,$p_append = '')
	{
		$retval = '';
		if (trim($p_strsource) != '' && $p_strsource != 'NULL')
			$retval = $p_append . $p_strsource;
		return $retval;	
		
	}
	 
	function is_alpha_numeric($p_val)
	{
		if (trim($p_val) != "" && isset($p_val))
		{
			if (preg_match("/^[A-Za-z][a-zA-Z0-9]+$/", $p_val)) 
				return true;
			else
				return false;
		}
		return true;
	}
	
	function is_currency($p_val)
	{
		if (trim($p_val) != "" && isset($p_val))
		{
			if (preg_match("/^\d+(?:\.\d{0,2})?$/", $p_val)) 
				return true;
			else
				return false;
		}
		return true;
	}
	
	function is_numeric_val($p_val)
	{
		if (trim($p_val) != "" && isset($p_val))
		{
			return is_numeric($p_val);
		}
		return true;
	}
	
	function parse_month($p_month)
	{
		  $arr_month = Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
		  $retval = '';
		  if (trim($p_month) != '')
		  { 	  
			  for ($i = 0 ; $i < 12; $i++)
			  {
					if ($arr_month[$i] == strtoupper($p_month))
						$retval = $i + 1;
			  }
			  $retval = substr("0" . $retval,strlen($retval) -1,2);
		  }
		  return $retval;
	}
	
	function parse_date($p_date)  // dd-mon-yyyy format
	{
		$retval = '';
		if (trim($p_date) != '')
		{
			$time_num = '';
			$arr_date = explode('-',$p_date);
			$day_num = $arr_date[0];
			$month_num = $this->parse_month($arr_date[1]);
			$arr_year_time = explode(' ',$arr_date[2]);
			$year_num = $arr_year_time[0];
				
			if (count($arr_year_time) == 3)
			{
				$time_num = $arr_year_time[1] . ' ' . $arr_year_time[2];
				$time_num = date("H:i:s", strtotime($time_num));
			}
			
			$retval = trim($year_num . '-' . $month_num . '-' . substr("0" .$day_num,strlen($day_num) -1,2 ). ' ' . $time_num);
		}
		return $retval;
	}
	
	function validate_date($p_date,$p_field) 
	{
		$arr_month = Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
		$arr_date = explode('-',$p_date);
		
		if (count($arr_date) != 3) {
			return "Invalid Date format: " . $p_date . " on " . $p_field . ". Format accepted is dd-mmm-yyyy.";
			//return false;
		}
		
		if (!preg_match("/^[a-zA-Z\.\-]*$/", $arr_date[1]))  // check if is_alpha
		{
			return "Invalid Month value: " . $arr_date[1] . " on " . $p_field . ". Allowed values are JAN-DEC.";
		}
		
		for ($i=0; $i<count($arr_month); $i++){
			if (strtoupper(substr($arr_month[$i],0,3)) == strtoupper($arr_date[1])){
				$arr_date[1] = ($i < 9 ? '0' : '') . ($i + 1);
				break;
			}
		}
		
		if (!$arr_date[0]) 
		{
			return "Invalid Date format: " . $p_date . " on " . $p_field . ". No day of month value can be found.";
			//return false;
		}
		
		if (!is_numeric($arr_date[0])) 
		{
			return "Invalid Day of Month value: " . $arr_date[0] . "' on " . $p_field . ". Allowed values are unsigned integers.";
			//return false;
		}
		
		if (!$arr_date[1]) {
			return "Invalid Date format: " . $p_date . " on " . $p_field . ". No month value can be found.";
			//return false;
		}
		
		if (!is_numeric($arr_date[1])) 
		{
			return "Invalid Month value: " . $arr_date[1] . " on " . $p_field . ". Allowed values are JAN-DEC.";
			//return false;
		}
		
		if (!$arr_date[2]) 
		{
			return "Invalid Date format: " . $p_date . " on " . $p_field . ". No year value can be found.";
			//return false;
		}
		
		if (!is_numeric($arr_date[2])) 
		{
			return "Invalid Year value: " . $arr_date[2] . " on " . $p_field . ". Allowed values are unsigned integers.";
			//return false;
		}
	
		if (($arr_date[2] < 1900) || ($arr_date[2] > 2050))
		{
			return "Invalid Year value: " . $arr_date[2] . " on " . $p_field . ". Values should be between 1900 to 2050.";
			//return false;
		}
		
		if ($arr_date[1] < 1 || $arr_date[1] > 12) {
			return "Invalid Month value: " . $arr_date[1] . " on " . $p_field . ". Allowed range is 01-12.";
			//return false;
		}
		
		$da_lastday = new DataAccess();
		$last_day = substr($da_lastday->get_sql_data("SELECT LAST_DAY('" . $arr_date[2] . "-" . $arr_date[1] . "-01')"),8,2);
		
		if ($last_day < $arr_date[0] ) {
			return "Invalid day of Month value: " . $arr_date[0] . " on " . $p_field . ". Allowed range is 01-" . $last_day . ".";
		}
		return '';
	}
	
	function validate_datetime($p_datetime,$p_field)
	{
		$retval = '';
		$arr_datetime = explode(' ',$p_datetime);
		
		if (count($arr_datetime) ==3)
		{
			$retval = $this->validate_date($arr_datetime[0],$p_field);
			if ($retval == '') 
			{
				return $this->validate_time($arr_datetime[1], strtoupper($arr_datetime[2]));
			}
			else
				return $retval;
		
		}
		else
			return "Invalid Date and Time Format.";
			
		return '';
		
	}
	
	function validate_time($p_time,$p_am_pm)
	{
		$arr_time = explode(':',$p_time);
		if (count($arr_time) == 2)
		{	
			if (is_numeric($arr_time[0]))
			{
				if (($arr_time[0] < 1) &&  ($arr_time[0] > 12))
					return "Invalid Hours value: " . $arr_time[0] . ". Allowed range is 01-12.";
			}
			else
				return "Invalid Hours value: " . $arr_time[0] . ". Allowed values are unsigned integers.";
				
			if (is_numeric($arr_time[1]))
			{
				if ($arr_time[1] >= 60)
					return "Invalid Minutes value: " . $arr_time[1] . ". Allowed range is 00-59.";
			}
			else
				return "Invalid Minutes value: " . $arr_time[1] . ". Allowed values are unsigned integers.";
			
			
			if (trim($p_am_pm) != '')
			{
				if (strtoupper($p_am_pm) != "AM" && strtoupper($p_am_pm) != "PM")
					return "Invalid AM/PM value: " . $p_am_pm . ". Allowed values are AM and PM.";
			
			}
			else
				return "Invalid AM/PM value. Allowed values are AM and PM.";
		}
		else
			return "Invalid Time Format value: " . $p_time . " " . $p_am_pm . ".";
		
		return '';
			
	}
}

?>
