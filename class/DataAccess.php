<?php

class DataAccess
{
    private $resultcount;
    private $arr_query_resultset;
    var $query_resultset;
	private $current_date;

	function get_fieldnum()
	{
		 return mysql_num_fields($this->query_resultset);
	}
	
	function get_fieldname($p_index)
	{
		return mysql_fetch_field($this->query_resultset,$p_index);
	}
	
	function get_resultcount()
    {
      return $this->resultcount;
    }
	
    function get_resultset()
    {
      return $this->query_resultset;
    }
    
    function get_result_arr()
    {
      return $this->arr_query_resultset;
    }
    
    function __construct()
    {
        /*if ($p_connected == 0)
        {
            $conn = new Connection();
            $conn->connect();
        }*/
	}
    
	
    function open_record($p_strsql)
    {
      	$this->query_resultset = mysql_query($p_strsql);
		$this->resultcount = mysql_num_rows($this->query_resultset); 
    }
    
    function fetch_result_to_array()
    {
        $rowctr = 0 ;
		
		if ($this->resultcount > 0)
        {
			$tmparr_idx = '';
            while ($rowresult = $this->fetch_result_array())
            {
			   $this->arr_query_resultset[$rowctr] = $rowresult;
               $rowctr++;
			}
		}
    }

    function fetch_result_array()
    {
      while ($myrow = mysql_fetch_array($this->query_resultset))
      {
        return $myrow;
      }
    }
	
	function execute_query($p_srtsql)
	{
		mysql_query($p_srtsql);
		
		if (mysql_affected_rows() == -1)
			return false;
		else
		{
			//mysql_query("COMMIT");
			return true;
		}
	}
	
	function begin_trans()
	{
		mysql_query("SET AUTOCOMMIT = 0");
	}
	
	function commit_trans()
	{
		mysql_query("COMMIT");
		mysql_query("SET AUTOCOMMIT = 1");
	}
	
	function rollback_trans()
	{
		mysql_query("ROLLBACK");
		mysql_query("SET AUTOCOMMIT = 1");
	}
	function move_first()
	{
		if (mysql_num_rows($this->query_resultset) > 0)
			mysql_data_seek($this->query_resultset,0);
	}
	
	function set_row_position($p_position)
	{
		if ($p_position <= (mysql_num_rows($this->query_resultset) - 1))
			mysql_data_seek($this->query_resultset,$p_position);
		else
			mysql_data_seek($this->query_resultset,mysql_num_rows($this->query_resultset) - 1);
	}
	
	function get_sql_data($pstrsql,$p_ret = '')
	{
		$retval = $p_ret;
		$sqldata_result = mysql_query($pstrsql);
		if (mysql_num_rows($sqldata_result) > 0)
		{
			$sqlrow = mysql_fetch_array($sqldata_result);
			if (!is_null($sqlrow[0]))
				$retval = $sqlrow[0];
		}
		return $retval;
	} 
	
	function get_current_date($p_mysql_format = 0)
	{
		if ($p_mysql_format == 0)
			$result_date = mysql_query("SELECT DATE_FORMAT(NOW(),'%d-%b-%Y') today");
		else if ($p_mysql_format == 1)
			$result_date = mysql_query("SELECT NOW() today");
		else if ($p_mysql_format == 2)
			$result_date = mysql_query("SELECT DATE_FORMAT(NOW(),'%d-%b-%Y %h:%i %p') today");
		else if ($p_mysql_format == 3)
			$result_date = mysql_query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') today");
		
		$myrow = mysql_fetch_array($result_date);
		return $myrow['today'];
	} 
	
	
}

?>
