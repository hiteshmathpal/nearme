<?php
class DB_Con
{

var $dbh="";
var $count=0;
var $exception="";
var $dbUser="root";
var $dbPass="";
var $dbHost="localhost";
var $dbName="nearme";



function dbConnect()
{
$return=false;
try 
{
$this->dbh = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName."", $this->dbUser, $this->dbPass);	
$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$return=true;
}
catch(PDOException $e) 
{
$this->exception= $e->getMessage(); 
$return =false;
}
return $return;
}

static function checkDB($user,$password,$dbname,$host)
{
$instance = new self();
$instance->dbUser=$user;
$instance->dbPass=$password;
$instance->dbHost=$host;
$instance->dbName=$dbname;

if($instance->dbConnect())
return true;
else
return false;
}

function setData($data,$table)
{
$affected_rows;
// Set The SQL Query for PDO
$cols="";
$fields="";
$qpmArray=array();
$i=0;
foreach($data as $key=>$val)
{
if($i==sizeof($data)-1)
$seprator="";
else
$seprator=",";

$fields.=":".$key.$seprator;
$cols.=$key.$seprator;
$qpmArray[":".$key]=$val;
$i++;
}
$this->dbConnect();

$stmt = $this->dbh->prepare("INSERT INTO $table($cols) VALUES($fields)");
$stmt->execute($qpmArray);
$affected_rows = $stmt->rowCount();
$this->dbh = null;
if($affected_rows>0)
return true;
else
return false;
}


function updateQuery($query)
{
        $affected_rows=0;
		try
		{
		$this->dbConnect();
		$affected_rows = $this->dbh->exec($query);
		$this->dbh = null;
		if($affected_rows>0)
		{
		$this->count=$affected_rows;
        }		
       		
	  } 
	  catch(PDOException $e) 
	  {
		$this->exception=$e;
		
	  }
return $affected_rows;
}

function createTable($query)
{
       
		try
		{
		$this->dbConnect();
		
		$this->dbh->exec($query);
		
		$this->dbh=null;	
       		
	  } 
	  catch(PDOException $e) 
	  {
		$this->exception=$e;
		
	  }

}


function getSelect($sql)
{
$return='';
$count=0;
   try {
		$this->dbConnect();
		$stmt = $this->dbh->query($sql);  
		$data = $stmt->fetchAll(PDO::FETCH_OBJ);
		$count = $stmt->rowCount();
		$this->count=$count;
		$this->dbh = null;
		if($count>0)
		{
		$return =$data;
       
        }		
        else
        $return =null;		
	  } 
	  catch(PDOException $e) 
	  {
		$this->exception=$e;
		$return =null;
	  }

return $return;
	  }

function getResultsCount()
{
return $this->count;
}

function getException()
{
return $this->exception;
}
}


?>