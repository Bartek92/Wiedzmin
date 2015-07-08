<?php

$wiedzmin_db = new PDO('sqlite:wiedzmin.db');
$wiedzmin_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
