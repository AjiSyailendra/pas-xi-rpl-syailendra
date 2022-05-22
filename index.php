<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAS XI RPL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- sweet alert -->
    <script src='plugins/sweetalert2/sweetalert2.all.min.js'></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'poppins';
        }
    </style>
</head>

<body>
    <?php
    include 'functions.php';

    error_reporting(0);

    session_start();

    // if ($_SESSION['status'] != "login") {
    //     header("location:../index.php");
    // }

    if (isset($_SESSION['username'])) {
        header("Location: dashbord.php");
    }

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Alhamdulillah',
                text: 'Anda berhasil log in!',
              })
            </script>";
            header("Location: dashbord.php");
        } else {
            echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Astagfirullahhh',
            text: 'email atau Sandi salah!',
          })
        </script>";
        }
    }
    ?>
    <?php echo $_SESSION['error'] ?>

    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <h3 class="mb-5">Selamat Datang</h3>
                            <form method="post">
                                <div class="form-outline mb-4">
                                    <label>email</label>
                                    <input type="text" name="email" id="email" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" required />
                                </div>
                                <a href="">
                                    <input class="btn btn-primary btn-lg w-100" value="Login" name="submit" type="submit">
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>