<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"> <img src="https://cdn.discordapp.com/attachments/898785149951557652/946290085018619924/phaohoa2.jpg" alt=""></div> --}}
                            <div class="col-lg-6 d-none d-lg-block"> <img src="https://cdn.discordapp.com/attachments/898785149951557652/952090566978576384/natural_1.jpg" height="500px" alt=""></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <?php
                                    $message = session()->get('message');
                                    if ($message)
                                    {
                                        echo  '<div class="alert alert-danger">'.$message.'</div>';
                                        session()->put('message', null);
                                    }
                                         ?>
                                    <form class="user" action="{{URL::to ('/doregister') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="register_email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="register_email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="register_name" placeholder="Name"
                                                name="register_name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="register_phone" placeholder="Phone"
                                                name="register_phone" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="register_password" placeholder="Password"
                                                name="register_password" required onkeyup='check();' onchange="check2();" >
                                                <span
													id='messagecheck1'></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="register_confirm" placeholder="Confirm Password"
                                                name="register_confirm" required onkeyup='check();'>
                                                <span
													id='messagecheck'></span>
                                        </div>
                                        <input type="submit" id="btn"  class="btn btn-primary btn-user btn-block" value="Register" disabled="disabled"/>
                                    
                                        <hr>
                                        <a href="{{ URL::to('/register') }}" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Create an Account Auth
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/backend/js/sb-admin-2.min.js') }}"></script>
    <script type="text/javascript">
		var check = function() {
			if (document.getElementById('register_password').value == document
					.getElementById('register_confirm').value) {
				document.getElementById('messagecheck').style.color = 'green';
				document.getElementById('messagecheck').innerHTML = 'matching';
				document.getElementById('btn').disabled =false;
			} else {
				document.getElementById('messagecheck').style.color = 'red';
				document.getElementById('messagecheck').innerHTML = 'not matching';
			}
            
		}
        var check2 = function(){
           
            if ((document.getElementById('register_password').value).length <6) {
				document.getElementById('messagecheck1').style.color = 'red';
				document.getElementById('messagecheck1').innerHTML = 'Mật khẩu phải hơn 6 kí tự';
			}
            console.log(document.getElementById('register_password').length);
        }
        
	</script>
</body>

</html>