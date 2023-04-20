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
    <?php
    include "db.php";
    // Avvio la sessione
    session_start();
    // Controllo se l'utente è loggato, altrimenti reindirizzo alla pagina di login
    if (!isset($_SESSION["username"])) {
        header("Location: ./index.php");
        exit();
    }
    if (isset($_POST['submit'])) {
        $data_turno = $_POST['data_turno'];
        $orario = $_POST['orario'];
        $dipendente = $_POST['dipendente'];
        $ruolo = $_POST['ruolo'];

        $sql = "SELECT * FROM turni WHERE data_turno='$data_turno' AND orario = '$orario' AND id_dipendente ='$dipendente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '    <script>
            alertError();
        </script>';
        } else {
            $sqlt = "INSERT INTO `turni`(`id`, `data_turno`, `orario`, `id_dipendente`,`ruolo`) VALUES (NULL,'$data_turno','$orario','$dipendente','$ruolo')";
            $resultt = mysqli_query($conn, $sqlt);
            if ($resultt) {
                header("Location: ../home.php?msg=Aggiunto un nuovo turno correttamente");
            } else {
                echo "fallito: " . mysqli_error($conn);
            }
        }
    }
    ?>
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
        <a href="./php/logout.php">Logout</a>
    </div>
    <div class="container content">
        <div class="text-center mb-4">
            <h3>Inserisci un nuovo turno </h3>
            <p>Completa il form sotto per aggiungere un nuovo turno</p>
        </div>
        <div class="cotainer d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width: 300px;" onsubmit="return validaData()">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label me-2">Data:</label>
                        <input type="date" name="data_turno" id="data_t">
                        <small id="errore" class="form-text" style="color: #b02a37;"></small>
                    </div>
                    <div class="input-group col">
                        <label class="form-label me-2">Orario:</label>
                        <select class="form-select" id="" name="orario">
                            <option value="mattina">Mattina</option>
                            <option value="pomeriggio">Pomeriggio</option>
                            <option value="sera">Sera</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group col">
                        <label class="form-label me-2">Seleziona dipendente:</label>
                        <select class="form-select" id="" name="dipendente">
                            <?php $sqldip = "SELECT * FROM dipendenti ORDER BY nome, cognome asc";
                            $resultdip = mysqli_query($conn, $sqldip);
                            while ($rowdip = mysqli_fetch_assoc($resultdip)) {
                                echo $rowdip['nome'];
                            ?>
                                <option value="<?php echo $rowdip['id'] ?>"><?php echo $rowdip['nome'] . " " . $rowdip['cognome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Ruolo:</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="banconista" value="banconista" checked>
                    <label for="banconista" class="form-input-label">banconista</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="aiuto_banconista" value="aiuto_banconista">
                    <label for="aiuto_banconista" class="form-input-label">aiuto banconista</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="crepes" value="crepes">
                    <label for="crepes" class="form-input-label">crepiera</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="sala" value="sala">
                    <label for="sala" class="form-input-label">sala</label> &nbsp;
                    <input type="radio" class="form-check-input" name="ruolo" id="supporto" value="supporto">
                    <label for="supporto" class="form-input-label">supporto</label>
                </div>
                <div class="container d-flex justify-content-evenly">
                    <a href="../home.php" class="btn btn-danger">Annulla</a>
                    <button type="submit" class="btn btn-success" name="submit">
                        Salva
                    </button>
                </div>
                <div class="container text-center p-3 error" id="presente">
                    <p>Il dipendente è già stato assegnato a questo turno</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const presenterr = document.getElementById("presente");

        function alertError() {
            presenterr.classList.remove("error");
        }

        function validaData() {
            var data = document.getElementById("data_t").value;
            if (data == "") {
                document.getElementById("errore").innerHTML = "Il campo data non può essere vuoto";
                return false;
            }
            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>