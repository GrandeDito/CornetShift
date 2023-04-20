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
                            <form method="POST" action="./login.php" class="md-5 mt-md-4 pb-4">
                                <h2 class="fw-bold mb-2">Benvenuto nel CornetCafe, </h2>
                                <!-- <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i> -->
                                <h4> Effettua il Login</h4>
                                <p class="text-white-50 mb-5">Inserisci username e password</p>

                                <div class="form-outline form-white mb-5">
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" />
                                    <!-- <label class="form-label" for="username">Username</label> -->
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
                                    <label class="form-label mt-2 text-white-50" for="password">mimimo 8 caratteri</label>
                                </div>
                                <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->
                                <button class="btn btn-outline-light btn-lg px-5 m-1" type="submit" name="action">Login</button>
                            </form>
                            <!-- <div>
                                <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>