<?php

class Core_Database
{
	private static $db = null;

	private function __construct(){}

	public static function getConnect()
	{
	    if(self::$db == null)
        {
            global $CFG;
            $pdoString = "mysql:";
            $pdoString .= "host=".$CFG->dbhost.";";
            $pdoString .= "dbname=".$CFG->dbname;
            self::$db = new PDO($pdoString, $CFG->dbuser, $CFG->dbpass);
            self::$db->query( "SET CHARSET utf-8");
        }
		return self::$db;
	}
}
