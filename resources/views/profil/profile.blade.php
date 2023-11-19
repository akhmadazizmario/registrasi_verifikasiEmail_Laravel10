<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Data profil</title>
</head>

<body>
    <section class=" p-3 mb-5  rounded w-100 h-100">
        <div class="container h-100">
            <div class="row h-100">
                <h1>Data Profile</h1>
                <hr>
                <table class="table align-middle mb-0 bg-secondary-emphasis mt-5">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="fw-bold mb-1"><?= $user['name'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?= $user['email'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?= $user['alamat'] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="p-3 mb-5  rounded w-100 h-100">
        <div class="container">
            <div class="row">
                <a class="nav-link">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <strong>Logout</strong></button>
                    </form>
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
