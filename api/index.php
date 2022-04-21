<?php
	try {
        require_once("lib/util.php");
        require_once("routeur.php");
    } catch (Throwable $e) {
        echo(json_encode(Util::reponseErrServ($e->getMessage()." Page:".$e->getFile()." Ligne:".$e->getLine())));
    }
?>