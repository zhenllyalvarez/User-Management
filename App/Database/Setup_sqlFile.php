<?php
// require_once($_SERVER["DOCUMENT_ROOT"] . "/user_management/App/Database/Database.php");

use user_management\App\Database\Database;

$db = new Database();

$sqlFile = ($_SERVER["DOCUMENT_ROOT"] . "/user_management/Database_tbl.sql");

$db->executeSQLFile($sqlFile);
