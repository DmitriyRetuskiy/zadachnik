<?php

include_once('../model/model.php');

f_blInsertNote($_POST['name'],$_POST['textarea']);

header("Location: http://localhost/zametki/index.php");


?>