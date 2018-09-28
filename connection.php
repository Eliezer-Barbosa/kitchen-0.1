<?php

  $conn = new mysqli('localhost', 'root', 'root', 'employees');
  //$conn = new mysqli('localhost', 'id6887954_employee', 'employee', 'id6887954_employees');

if ($conn->connect_errno) {
    die('Falhou em conectar: (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

return $conn;
