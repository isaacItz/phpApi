<?php
try {
    $conn = new PDO("sqlsrv:Server=127.0.0.1,1433;Database=mi_empresa", "sa", "<P@ssword>");
    echo "Conexión exitosa a SQL Server.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}