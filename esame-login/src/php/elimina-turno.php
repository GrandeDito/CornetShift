<?php
include "db.php";
$id = $_GET['id'];
$sql = "DELETE FROM turni WHERE id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../home-dettaglio.php?msg=turno eliminato correttamente");
} else {
    echo "fallito: " . mysqli_error($conn);
}
