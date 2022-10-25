<?php
require_once 'db-functions.php';

$id = $_GET['id'];
echo findOneById($id);