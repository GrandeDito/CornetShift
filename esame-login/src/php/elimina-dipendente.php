<?php
include "db.php";
$id = $_GET['id'];
$sql = "DELETE FROM dipendenti WHERE id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: dipendenti.php?msg=Dipendente eliminato correttamente");
} else {
    echo "fallito: " . mysqli_error($conn);
}
