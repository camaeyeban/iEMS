<?php
	// IP ADDRESS OR SERVER NAME OF MYSQL SERVER
	$host="localhost";

	// DATABASE YOU WANT TO USE. MUST EXIST
	$db="ems_test";

	// USERNAME TO CONNECT TO SERVER
	$user="root";

	// PASSWORD TO CONNECT TO SERVER
	$pwd="";

	// 1=SAVES ALL SQL QUERIES TO LOG FILE
	$keeplog=0;

	// PATH WHERE LOG SHOULD BE KEPT
	$logpath="/logs/";

	// 1=SHOW FULL MYSQL ERROR (QUERY, DB CONNECT INFO) | 0=SHOW MYSQL ERROR
	$fullErr=0;

	// 1=Rollback support on database (begin; commit; or begin; rollback;) This should only
	// be active if your tables are transactional like InnoDB. MyISAM does not provide
	// transactional support
	$rollBackSup=0;
?>