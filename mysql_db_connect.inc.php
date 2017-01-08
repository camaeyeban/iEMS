<?php
	class mysql_db_connect {

		//private variables
		var $dbLink; //Link to database
		var $dbName; //Name of databse
		var $hostName; //Name of server
		var $dbUser; //Database user name
		var $dbPwd; //Database password
		var $dbQryResult; //Result of last query
		var $dbResultLine; //One Result line of last query
		var $keepLog; //Should a log of all queries be kept
		var $logPath; //Path where log should be saved
		var $fullErr; //Display full or partial error
		var $rollBackSup; //Are you using tables with transactional support (ie. InnoDB)

		// Constructor
		// Creates object and makes connection to database.
		function mysql_db_connect() {
			// Read config info from cfg file and saves them in class
			require("mysql_db_connect.cfg.php");
			$this->dbName = $db;
			$this->hostName = $host;
			$this->dbUser = $user;
			$this->keepLog = $keeplog;
			$this->logPath = $logpath;
			$this->fullErr = $fullErr;
			$this->rollBackSup = $rollBackSup;
			if (strlen($pwd) > 0) { $this->dbPwd = "Yes"; } else { $this->dbPwd = "No"; }

			// Creates connection to server and selects appropriate database
			$dbLink = mysql_connect($this->hostName, $this->dbUser, $pwd) or $this->goError($qry, mysql_error());
			mysql_select_db($this->dbName) or $this->goError($qry, mysql_error());
		}

		// Displays the end of the error message
		function endError($err, $from) {
			// Displays error
			print $err."<br><br>";

			// Displays conection details as well as the page using this class if set
			if ($this->fullErr == 1) {
				print "System variables:<br>";
				print "Host: ".$this->hostName."<br>";
				print "Database: ".$this->dbName."<br>";
				print "User: ".$this->dbUser."<br>";
				print "Password Used: ".$this->dbPwd."<br>";
				print "Refering Page: ".$from."<br>";
			}
			print "</font>";
			print "<br><Br>Please contact your system administrator for assistance!<br><br>";

			// Make sure script dies
			die(date(r, time()));
		}

		// Displays error if a rollback could not be done.
		function rollError($err, $from) {
			print "<font color=\"red\" face=\"Helvitica\" size=\"+2\"><b>ERROR:</b></font><br>";
			print "<font face=\"Helvitica\">";
			if ($this->fullErr == 1) {
				print "<b>Query:</b> <i>$qry</i><br>";
			}
			print "<font color=\"red\"><b>Could not roll back transaction!!</b></font><br><Br>\n";
			$this->endError($err, $from);
		}

		// If something has gone wrong, displays an error
		function goError($qry, $err, $from) {
			// Rolls back transaction if required
			if ($this->rollBackSup == 1) {
				print "<font color=\"red\"><b>Transaction rolled back!</b></font><br><Br>\n";
				mysql_query("rollback;") or $this->rollError(mysql_error());
			}
			print "<font color=\"red\" face=\"Helvitica\" size=\"+2\"><b>ERROR:</b></font><br>";
			print "<font face=\"Helvitica\">";
			if ($this->fullErr == 1) {
				print "<b>Query:</b> <i>$qry</i><br>";
			}
			$this->endError($err, $from);
		}

		// Executes a query ($qry). $from is the page you are calling from - optional
		function db_qry($qry, $from="") {
			$this->dbQryResult = mysql_query($qry) or $this->goError($qry, mysql_error(), $from);

			// If required, write query to a log file
			if ($this->keepLog == 1) {
				$fp = fopen($this->logPath."mysql_db_class.log", "a+");
				fputs($fp, date("r", time())." - ".$from."\n");
				fputs($fp, $qry."\n");
				fclose($fp);
			}
		}

		// Returns the resultset, one row at a time in an array
		function get_data() {
			$this->dbResultLine = mysql_fetch_array($this->dbQryResult);
			return $this->dbResultLine;
		}

		// Number of rows in resultset
		function row_count() {
			$qtyLines = mysql_num_rows($this->dbQryResult);
			return $qtyLines;
		}

		// Array with field names of resultset
		function get_fields() {
			$fldList = Array();
			for ($fldCntr = 0; $fldCntr < mysql_num_fields($this->dbQryResult); $fldCntr++) {
				$fldList[$fldCntr] = mysql_field_name($this->dbQryResult, $fldCntr);
			}
			return $fldList;
		}
		
		

	}
?>