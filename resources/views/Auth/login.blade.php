<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
        <meta name="description" content="Selamat Datang di Aplikasi SIM-BK SMKN 1 Purwakarta">  
        <link rel="icon" href="{{ asset('assets/nepurfav.ico') }}" type="image/x-icon">  
        <meta name="author" content="">  
    
        <title>SIMBK Nepur - Login</title>  
    
        <!-- Custom fonts for this template-->  
        <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">  
        <link  
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"  
            rel="stylesheet">  
    
        <!-- Custom styles for this template-->  
        <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">  
    
        <style>  
            html, body {  
                height: 100%;  
                margin: 0;  
            }  
            .container {  
                display: flex;  
                justify-content: center;  
                align-items: center;  
                height: 100%;  
            }  
            .card {  
                width: 100%;  
                max-width: 800px; /* Adjust this value as needed */  
            }  
        </style>  
    </head>  
    
    <body class="bg-primary">  
    
        <div class="container">  
            <div class="card o-hidden border-0 shadow-lg">  
                <div class="card-body p-0">  
                    <!-- Nested Row within Card Body -->  
                    <div class="row">  
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>  
                        <div class="col-lg-6">  
                            <div class="p-5">  
                                <div class="text-center">  
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>  
                                </div>  
                                @if ($errors->any())  
                                    <div class="alert alert-danger">  
                                        <ul>  
                                            @foreach ($errors->all() as $item)  
                                                <li>{{ $item }}</li>  
                                            @endforeach  
                                        </ul>  
                                    </div>  
                                @endif  
                                <form class="user" method="POST" action="">  
                                    @csrf  
                                    <div class="form-group">  
                                        <input type="text" name="username" class="form-control form-control-user"  
                                            id="Username" aria-describedby="Username" placeholder="Username"  
                                            value="{{ old('username') }}">  
                                    </div>  
                                    <div class="form-group">  
                                        <input type="password" name="password"  
                                            class="form-control form-control-user" id="Password"  
                                            placeholder="Password">  
                                    </div>  
                                    <button id="login_btn" class="btn btn-primary btn-user btn-block" type="submit" disabled>Masuk</button>  
                                </form>  
                                <hr>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    
        <!-- Bootstrap core JavaScript-->  
        <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>  
        <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>  
    
        <!-- Core plugin JavaScript-->  
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>  
    
        <!-- Custom scripts for all pages-->  
        <script src="js/sb-admin-2.min.js"></script>  
    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const usernameInput = document.getElementById('Username');
                const passwordInput = document.getElementById('Password');
                const loginButton = document.getElementById('login_btn');

                function checkInputs() {
                    if (usernameInput.value && passwordInput.value) {
                        loginButton.disabled = false;
                    } else {
                        loginButton.disabled = true;
                    }
                }

                usernameInput.addEventListener('input', checkInputs);
                passwordInput.addEventListener('input', checkInputs);
            });
        </script>
    </body>  
</html>
