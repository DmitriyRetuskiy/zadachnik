<?php
include_once('../model/model.php');

f_blDelNote($_GET['id']);

header("Location: http://localhost/zametki/index.php");

?>