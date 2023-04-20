<?php
include "./php/db.php";
// Avvio la sessione
session_start();
// Controllo se l'utente è loggato, altrimenti reindirizzo alla pagina di login
if (!isset($_SESSION["username"])) {
  header("Location: ./php/index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CornetCafe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <nav>
    <div class="navbar">
      <div class="nav-item">
        <a href="./home.php">Gestione turni</a>
      </div>
      <div class="nav-item">
        <a href="./php/dipendenti.php">Gestione dipendenti</a>
      </div>
    </div>
  </nav>
  <div class="logout">
    <a href="./php/logout.php">Logout</a>
  </div>
  <div class="container content">
    <?php
    if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>
    <h2 class="center">Benvenuto nel CornetCafe, <span class="username"><?php echo $_SESSION["username"] ?></span></h2>
    <h4>Ecco i turni di questa settimana:</h4>
    <div class="container d-flex justify-content-evenly">
      <a href="./php/inserisci-turno.php" class="btn btn-dark m-2 mb-3">
        Aggiungi turno di un dipendente
      </a>
      <a id="btn-dettaglio" class="btn btn-dark m-2 mb-3" href="./home.php">
        Mostra turni finali
      </a>
      <a id=" btn-semplice" class="btn btn-dark m-2 mb-3" href="./home-dettaglio.php">
        Modifica il turno di un dipendente
      </a>
    </div>

    <div id="semplice" style="display: block;" class="tabrel">
      <?php
      include "./php/db.php";
      // Query per raggruppare i turni per data e orario e ottenere il nome e il cognome dei dipendenti che hanno lo stesso turno nello stesso giorno
      $sql = "SELECT t.data_turno, t.orario, t.id, GROUP_CONCAT(d.nome, ' ', d.cognome SEPARATOR ', ') AS dipendenti
        FROM turni t
        JOIN dipendenti d
        ON t.id_dipendente = d.id
        GROUP BY t.data_turno, t.orario
        ORDER BY t.data_turno DESC, FIELD(t.orario, 'mattina', 'pomeriggio', 'sera')";
      $result = $conn->query($sql);
      $current_date = null;
      $num_rows = 1;
      if ($result->num_rows > 0) {
        // Se ci sono risultati, visualizzali in unaa1ePxKmAHDeGMeoU tabella
        echo "<table class='table table-hover text-center' id='tab_semp'><thead class='table-dark'><tr><th>Data</th><th>Orario</th><th>Dipendenti</th></tr></thead>";
        while ($row = $result->fetch_assoc()) {
          $data = $row["data_turno"];
          $giorni_settimana = array('Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica');
          $mesi_italiano = array(
            1 => 'Gennaio',
            2 => 'Febbraio',
            3 => 'Marzo',
            4 => 'Aprile',
            5 => 'Maggio',
            6 => 'Giugno',
            7 => 'Luglio',
            8 => 'Agosto',
            9 => 'Settembre',
            10 => 'Ottobre',
            11 => 'Novembre',
            12 => 'Dicembre'
          );
          $giorno_settimana = $giorni_settimana[date('w', strtotime($data))];
          $giorno_mese = date('j', strtotime($data));
          $mese = $mesi_italiano[date('n', strtotime($data))];
          $data_formattata = $giorno_settimana . ' ' . $giorno_mese . ' ' . $mese;
          $orario = $row["orario"];
          $dipendenti = $row["dipendenti"];
          // if ($data_formattata != $current_date) {
          //   // Se la data è diversa, stampa una nuova riga per la data
          //   echo "<tr>"; 
          //   echo "<td rowspan='" . $num_rows . "'>" . $data_formattata . "</td>";
          //   echo "<td>" . $row['orario'] . "</td>";
          //   echo "<td>" . $row['dipendenti'] . "</td>";
          //   echo "</tr>";
          //   // Aggiorna la variabile della data corrente e il numero di righe
          //   $current_date = $data_formattata;
          //   $num_rows = 1;
          // } else {
          //   // Se la data è la stessa della riga precedente, stampa solo la colonna dell'orario e dei dipendenti
          //   echo "<tr>";
          //   echo "<td>" . $row['orario'] . "</td>";
          //   echo "<td>" . $row['dipendenti'] . "</td>";
          //   echo "</tr>";

          //   // Aggiorna il numero di righe
          //   $num_rows++;
          // }
          // echo '<tr onmouseover="this.style.backgroundColor=`#eee`;" onmouseout="this.style.backgroundColor=`transparent`;"><td>' . $data . "</td><td>" . $orario . "</td><td>" . $dipendenti . "</td> <td><a href='./php/modifica-turno.php?id=" . $row['id'] . "' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a><a href='./php/elimina-turno.php?id=" . $row['id'] . "'class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a></td></tr>";
          echo '<tr onmouseover="this.style.backgroundColor=`#eee`;" onmouseout="this.style.backgroundColor=`transparent`;"><td>' . $data_formattata . "</td><td>" . $orario . "</td><td>" . $dipendenti . "</td></tr>";
        }
        // Imposta rowspan per l'ultima riga
        echo "</table>";
      } else {
        // Se non ci sono risultati, mostra un messaggio di errore
        echo "Nessun turno trovato";
      }

      ?>
    </div>
  </div>
  <script src="./js/home.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>