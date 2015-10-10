<?php
require_once 'SystemComponent.php';
require_once 'db_settings.php';
class DbConnector extends SystemComponent {

    var $theQuery;
    var $link;
    var $formaction;
	var $con = false;               // Checks to see if the connection is active
    var $result = array();          // Results that are returned from the query
    var $query;                    
	var $where;
    var $order;
	var $lastQuery;
	var $db;

//*** Function: DbConnector, Purpose: Connect to the database ***
   public function DbConnector() {

// Load settings from parent class
        $settings = SystemComponent::getSettings();

// Get the main settings from the array we just loaded
        $db_host             = $settings['dbhost'];
        $db_name             = $settings['dbname'];
        $db_user             = $settings['dbusername'];
        $db_pass             = $settings['dbpassword'];
        $this->formaction    =$settings['formaction'];
        $this->db=$db_name;
		
  if(!$this->con)
        {
// Connect to the database
       $myconn= $this->link = mysql_connect($db_host, $db_user, $db_pass) or die('Database error');
	    if($myconn)
            {
//select databse			
       $seldb=  mysql_select_db($db_name) or die('Database error');
        register_shutdown_function(array(&$this, 'close'));
		 if($seldb)
                {
                    $this->con = true;
                    return true;
                }
				else
				{
					return false;
				}
			}
       else
            {
                return false;
            }
        }
		else
			{
				return true;
			}
			
		}
		
		
		
    /*
    * Changes the new database, sets all current results
    * to null
    */
    public function setDatabase($name)
    {
        if($this->con)
        {
            if(@mysql_close())
            {
                $this->con = false;
                $this->results = null;
                $this->db_name = $name;
                $this->DbConnector();
            }
        }

    }
	
	 /*
    * Checks to see if the table exists when performing
    * queries
    */
    private function tableExists($table)
    {
        $tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db.' LIKE "'.$table.'"');
        if($tablesInDb)
        {
            if(mysql_num_rows($tablesInDb)==1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }


//*** Function: query, Purpose: Execute a database query ***
    function query($query) {

        $this->theQuery = $query;
        return mysql_query($query, $this->link);
    }

//*** Function: fetchArray, Purpose: Get array of query results ***
    function fetchArray($result) {

        return mysql_fetch_array($result);
    }

    function countRows($result)
    {
        return mysql_num_rows($result);
    }
	
	
	
	 /*
    * Selects information from the database.
    * Required: table (the name of the table)
    * Optional: rows (the columns requested, separated by commas)
    *           where (column = value as a string)
    *           order (column DIRECTION as a string)
    */
   		# selects the data from the table
	public function select($query, $where, $order) {
		
		$this->query = $query;
		$this->where = ($where == NULL) ? NULL : $where;
		$this->order = ($order == NULL) ? NULL : $order;
		
		$fullQuery = $this->query . $this->where . $this->order;
	    $this->lastQuery = $fullQuery;
		if ($fullQuery) { return true; }
		return false;
		
	}
	
	
	#function CountRows : purpose: total Result	 
		
	public function countResult(){
		$query=mysql_query($this->lastQuery); 
		
		$record = mysql_num_rows($query);
		
		return $record;
		  }
	
	
	#function getData : purpose: For getting Data From Database	 
		
	public function fetchData(){
	
		$query=mysql_query($this->lastQuery); 
		$result = array();
		while ($record = mysql_fetch_array($query)) {
			 $result[] = $record;
		}
		return $result;
		  }
    /*
    * Insert values into the table
    * Required: table (the name of the table)
    *           values (the values to be inserted)
    * Optional: rows (if values don't match the number of rows)
    */
    public function insert($table,$values,$rows = null)
    {
        if($this->tableExists($table))
        {
			
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';

            $ins = @mysql_query($insert);
			$last_id = mysql_insert_id();

            if($ins)
            {
                return $last_id;
            }
            else
            {
                return false;
            }
        }
    }

    /*
    * Deletes table or records where condition is true
    * Required: table (the name of the table)
    * Optional: where (condition [column =  value])
    */
    public function delete($table,$where = null)
    {
        if($this->tableExists($table))
        {
            if($where == null)
            {
                $delete = 'DELETE '.$table;
            }
            else
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where;
            }
            $del = @mysql_query($delete);

            if($del)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */
    public function update($table,$rows,$where)
    {
        if($this->tableExists($table))
        {
            // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
            for($i = 0; $i < count($where); $i++)
            {
		
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode('',$where);

            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            $query = @mysql_query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
    * Returns the result set
    */
    public function getResult()
    {
        return $this->result;
    }

//*** Function: close, Purpose: Close the connection ***
    function close() {

        mysql_close($this->link);
    }

}

?>
