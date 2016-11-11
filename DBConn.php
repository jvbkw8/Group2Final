<?php
class DBConn{
	private $conn;
	private $errors = array();
	private $numRows = 0;
	
	function __construct()
	{
		return $this->connectToDatabase();
	}

	function connectToDatabase()
	{
		$dsn = "mysql:dbname=db;host=localhost";
		$user = "root";
		$password = "";
		try{
			$this->conn = new PDO($dsn, $user, $password);
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
			return false;
		}
		return true;
	}

	function close()
	{
		$this->conn = NULL;
	}

	function rowCount()
	{
		return $this->numRows;
	}

	function update($query, $newValues = array(), $whereValues = array())
	{	//echo "update function parameters passed in<br>newValues: ".print_r($newValues, true)."<br>whereValues: ".print_r($whereValues, true)."</pre>";
		$this->numRows = 0;
                $this->errors = array();
		if(!is_array($newValues))
		{
			$newValues = (array)$newValues;
		}
		if(!is_array($whereValues))
		{
			$whereValues = (array)$whereValues;
		}
		$newValues = $this->clean($newValues);
		$whereValues = $this->clean($whereValues);
		try{
			//echo "preparing update<br>";
			if (($stmt = $this->conn->prepare($query)) === false)
			{
				$this->errors[] = "Error preparing update query: ".$query.PHP_EOL."Values: ".print_r($newValues, true).print_r($whereValues, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			$count = 1;
			if (count($newValues)>0)
			{//echo "new values count > 0. <br>";
				foreach($newValues as $key=>&$value)
				{
					//echo "binding value: $value<br>";
					if(($stmt->bindParam($count, $value)) === false)
					{
						$this->errors[] = "Error binding 'new' parameters for update statement: ".$query.PHP_EOL."Values: ".print_r($newValues, true).print_r($whereValues, true);
						$messageArray = $stmt->errorInfo();
						$this->errors[] = $messageArray[2];
						return false;
					}
					$count++;
				}
			}
			if (count($whereValues)>0)
			{//echo "where values count > 0.<br>";
				foreach($whereValues as $key=>&$value)
				{//echo "binding value: $value<br>";
					if(($stmt->bindParam($count, $value)) === false)
					{
						$this->errors[] = "Error binding 'where' parameters for update statement: ".$query.PHP_EOL."Values: ".print_r($newValues, true).print_r($whereValues, true);
						$messageArray = $stmt->errorInfo();
						$this->errors[] = $messageArray[2];
						return false;
					}
					$count++;
				}
			}
			if (($stmt->execute()) === false)
			{
				$this->errors[] = "Error executing update statement: ".$query.PHP_EOL."Values: ".print_r($newValues, true).print_r($whereValues, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			//echo "statement executed<br>";
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
			return false;
		}
		$this->numRows = $stmt->rowCount();
		//echo "update statement should have been successful<br>";
		return true;
	}

	function insert($query, $values = array())
	{
		$this->numRows = 0;
                $this->errors = array();
		if(!is_array($values))
		{
			$values = (array)$values;
		}
		$values = $this->clean($values);
		try{
			if (($stmt = $this->conn->prepare($query)) === false)
			{
				$this->errors[] = "Error preparing insert query: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			if (count($values)>0)
			{
				foreach($values as $key=>&$value)
				{
					if(($stmt->bindParam($key + 1, $value)) === false)
					{
						$this->errors[] = "Error binding parameters for insert statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
						$messageArray = $stmt->errorInfo();
						$this->errors[] = $messageArray[2];
						return false;
					}
				}
			}
			if (($stmt->execute()) === false)
			{
				$this->errors[] = "Error executing insert statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
			return false;
		}
		$this->numRows = $stmt->rowCount();
		return true;
	}


	function select($query, $values = array())
	{
		$this->numRows = 0;
                $this->errors = array();
		if(!is_array($values))
		{
			$values = (array)$values;
		}
		$values = $this->clean($values);
		try{
			if (($stmt = $this->conn->prepare($query)) === false)
			{
				$this->errors[] = "Error preparing select query: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			if(count($values)>0)
			{
				foreach($values as $key=>&$value)
				{
					if(($stmt->bindParam($key + 1, $value)) === false)
					{
						$this->errors[] = "Error binding parameters for select statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
						$messageArray = $stmt->errorInfo();
						$this->errors[] = $messageArray[2];
						return false;
					}
				}
			}
			if (($stmt->execute()) === false)
			{
				$this->errors[] = "Error executing select statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			if (($rows = $stmt->fetchAll(PDO::FETCH_ASSOC)) === false)
			{
				$this->errors[] = "Error fetching rows for query: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
			return false;
		}
		$this->numRows = count($rows);
		return $rows;
	}

	function delete($query, $values = array())
	{
		$this->numRows = 0;
                $this->errors = array();
		if(!is_array($values))
		{
			$values = (array)$values;
		}
		$values = $this->clean($values);
		try{
			if (($stmt = $this->conn->prepare($query)) === false)
			{
				$this->errors[] = "Error preparing delete query: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
			if (count($values)>0)
			{
				foreach($values as $key=>&$value)
				{
					if(($stmt->bindParam($key + 1, $value)) === false)
					{
						$this->errors[] = "Error binding parameters for delete statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
					$messageArray = $stmt->errorInfo();
					$this->errors[] = $messageArray[2];
						return false;
					}
				}
			}
			if (($stmt->execute()) === false)
			{
				$this->errors[] = "Error executing delete statement: ".$query.PHP_EOL."Values: ".print_r($values, true);
				$messageArray = $stmt->errorInfo();
				$this->errors[] = $messageArray[2];
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->errors[] = $e->getMessage();
			return false;
		}
		$this->numRows = $stmt->rowCount();
		return true;
	}

	function getErrors()
	{
		return $this->errors;
	}

	function clean($values = array())
	{//echo "in clean, values passed in: <pre>".print_r($values, true)."</pre><br>";
		$cleanValues = array();
		foreach($values as $key=>$value)
		{
			if (is_array($value))
			{
				$cleanValues[$key] = $this->clean($value);
			}
			else
			{
				$cleanValues[$key] = htmlspecialchars($value);
			}
		}
		return $cleanValues;
	}
}
?>
