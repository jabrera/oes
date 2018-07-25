<?php
class Database {
	public $user, $pass, $host, $dbname;
	
	/*
	Gets username, password, host, and database name
	*/
	function __construct($user, $pass, $host, $dbname) {
		$this->user = $user;
		$this->pass = $pass;
		$this->host = $host;
		$this->dbname = $dbname;
	}

	/*
	Connects to database
	*/
	function ConnectDB() {
		mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->dbname);
	}
}
?>