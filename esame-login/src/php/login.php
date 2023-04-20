<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cornet-login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form method="POST" action="./login.php" class="md-5 md-4">
                                <?php
                                include "./db.php";
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Recupero i dati inseriti dall'utente
                                    $username = $_POST["username"];
                                    $password = $_POST["password"];

                                    // Controllo se l'utente esiste nel database
                                    $sql = "SELECT * FROM amministratori WHERE usern = '$username' AND passwd = '$password'";
                                    $result = $conn->query($sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if ($result->num_rows > 0) {
                                        // L'utente esiste
                                        session_start();
                                        // $_SESSION['session_id'] = session_id();
                                        $_SESSION["username"] = $username;
                                        header("Location: ../home.php");
                                    } else {
                                        // L'utente non esiste, mostro un messaggio di errore
                                        echo 'Username o password errati.<br><a href="./index.php">riprova</a>';
                                    }
                                }
                                ?> </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>