<?php
include "db.php";
// Avvio la sessione
session_start();
// Controllo se l'utente è loggato, altrimenti reindirizzo alla pagina di login
if (!isset($_SESSION["username"])) {
    header("Location: ./index.php");
    exit();
}
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $telefono = $_POST['telefono'];
    $sql = "UPDATE `dipendenti` SET `nome`='$nome',`cognome`='$cognome',`telefono`='$telefono' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: dipendenti.php?msg=Dipendente modificato correttamente");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dipendente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="nav-item">
                <a href="../home.php">Gestione turni</a>
            </div>
            <div class="nav-item">
                <a href="./dipendenti.php">Gestione dipendenti</a>
            </div>
        </div>
    </nav>
    <div class="logout">
        <a href="./logout.php">logout</a>
    </div>
    <div class="container content">
        <div class="text-center mb-4">
            <h3>Modifica dipendente</h3>
            <p>clicca modifica dopo aver modificato correttamente le informazioni</p>
        </div>
        <?php
        $sql = "SELECT * FROM dipendenti WhERE id= $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="cotainer d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $row['nome'] ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Cognome:</label>
                        <input type="text" class="form-control" name="cognome" value="<?php echo $row['cognome'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $row['telefono'] ?>">
                </div>

                <div class="container d-flex justify-content-evenly">
                    <a href="dipendenti.php" class="btn btn-danger">annulla</a>
                    <button type="submit" class="btn btn-success" name="submit">
                        Modifica
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>