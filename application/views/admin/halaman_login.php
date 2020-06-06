<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-info">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-5 mx-auto p-4">
                <h1 class="h2  bg-link">Halaman Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 mx-auto mt-5">
                <form action="<?= site_url('admin/login') ?>" method="POST">
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" class="form-control" name="email" placeholder="Masukkan Username" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required />
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary w-100" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>