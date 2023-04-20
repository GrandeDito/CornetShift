<?php
// Avvio la sessione
session_start();
// Controllo se l'utente è loggato, altrimenti reindirizzo alla pagina di login
if (!isset($_SESSION["username"])) {
    header("Location: ./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dipendenti</title>
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
        <a href="./logout.php">Logout</a>
    </div>
    <div class="container content">
        <h2 class="center">Benvenuto nel CornetCafe, <span class="username"><?php echo $_SESSION["username"] ?></span></h2>
        <h4>Ecco l'elenco dei dipendenti:</h4>
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <a href="inserisci-dipendente.php" class="btn btn-dark mb-3 m-2 ms-0">
            Aggiungi dipendente
        </a>
        <table class="table table-hover text-center" id="tab_dip">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Azione</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db.php";
                $sql = "SELECT id,nome, cognome, telefono FROM dipendenti ORDER BY nome ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr onmouseover="this.style.backgroundColor=`#eee`;" onmouseout="this.style.backgroundColor=`transparent`;">
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['cognome'] ?></td>
                        <td><?php echo $row['telefono'] ?></td>
                        <td>
                            <a href=" modifica-dipendente.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="elimina-dipendente.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/dipendenti.js"></script>
</body>

</html>