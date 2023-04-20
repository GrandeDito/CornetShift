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
    $data_turno = $_POST['data_turno'];
    $orario = $_POST['orario'];
    $dipendente = $_POST['dipendente'];
    $ruolo = $_POST['ruolo'];
    $sql = "UPDATE `turni` SET `data_turno`='$data_turno',`orario`='$orario',`id_dipendente`='$dipendente',`ruolo`='$ruolo' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../home.php?msg=Turno modificato correttamente");
    } else {
        echo "fallito: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci</title>
    <link rel="stylesheet" href="../css/style.css" />
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
        <div class="text-center mb-4">
            <h3>Modifica un turno </h3>
            <p>Completa il form sotto per modificare il turno</p>
        </div>
        <?php
        $sql = "SELECT * FROM turni WhERE id= $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="cotainer d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label me-2">Data:</label>
                        <input type="date" name="data_turno" value="<?php echo $row['data_turno'] ?>">
                    </div>
                    <div class="input-group col">
                        <label class="form-label me-2">Orario:</label>
                        <select class="form-select" id="" name="orario">
                            <option value="mattina" <?php echo ($row['orario'] == 'mattina') ? "selected" : ""; ?>>Mattina</option>
                            <option value="pomeriggio" <?php echo ($row['orario'] == 'pomeriggio') ? "selected" : ""; ?>>Pomeriggio</option>
                            <option value="sera" <?php echo ($row['orario'] == 'sera') ? "selected" : ""; ?>>Sera</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group col">
                        <label class="form-label me-2">Seleziona dipendente:</label>
                        <select class="form-select" id="" name="dipendente">
                            <?php
                            $sqldip = "SELECT * FROM dipendenti ORDER BY nome, cognome asc";
                            $result = mysqli_query($conn, $sqldip);
                            while ($rowdip = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $rowdip['id'] ?>" <?php echo ($row['id_dipendente'] == $rowdip['id']) ? "selected" : ""; ?>><?php echo $rowdip['nome'] . " " . $rowdip['cognome'] ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Ruolo:</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="banconista" value="banconista" <?php echo ($row['ruolo'] == 'banconista') ? "checked" : ""; ?>>
                    <label for="banconista" class="form-input-label">banconista</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="aiuto_banconista" value="aiuto banconista" <?php echo ($row['ruolo'] == 'aiuto_banconista') ? "checked" : ""; ?>>
                    <label for="aiuto_banconista" class="form-input-label">aiuto banconista</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="crepes" value="crepes" <?php echo ($row['ruolo'] == 'crepes') ? "checked" : ""; ?>>
                    <label for="crepes" class="form-input-label">crepiera</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="sala" value="sala" <?php echo ($row['ruolo'] == 'sala') ? "checked" : ""; ?>>
                    <label for="sala" class="form-input-label">sala</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="supporto" value="supporto" <?php echo ($row['ruolo'] == 'supporto') ? "checked" : ""; ?>>
                    <label for="supporto" class="form-input-label">supporto</label>
                </div>
                <div class="container d-flex justify-content-evenly">
                    <a href="../home-dettaglio.php" class="btn btn-danger">Annulla</a>
                    <button type="submit" class="btn btn-success" name="submit">
                        Salva
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>