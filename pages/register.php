
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VETTALK</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
<!-- Sign Up Modal -->


<!-- Outer Row -->
<div class="row justify-content-center">

<div class="col-xl-6 col-lg-6 col-md-6">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row shadow">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> 
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-left">
              <h1 class="h4 text-gray-900 mb-4" >Register an Account  </h1>
            </div>
    <hr>
    <form role="form" method="POST" action="code.php?action=add">

      <div class="form group">
      <label> First Name </label>
             <input class="form-control" name="firstname" placeholder="ex. Juan" required>
           </div>
           <div class="form-group">
           <br><label> Last Name </label>
             <input class="form-control" name="lastname" placeholder="ex. Dela Cruz" required>
           </div>
           <div class="form-group">
           <label> Birthdate </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="birthdate" required>
           </div>
           <div class="form-group">
           <label> Gender </label><br>
              <input type="radio" id="male" name="gender" value="Male">
              <label for="male">Male&nbsp&nbsp</label>
              <input type="radio" id="female" name="gender" value="Female">
              <label for="female">Female</label><br>
           </div>
           <div class="form-group">
           <label> Address </label>
             <textarea rows="5" cols="50" class="form-control" placeholder="Complete Address" name="address" required></textarea>
           </div>
           <div class="form-group">
           <label> Phone Number </label>
              <input class="form-control" placeholder="09xxxxxxxxx" name="phonenumber" required>
            </div>
           <div class="form-group">
           <br><label> Email Address </label>
             <input class="form-control" placeholder="example@example.com" name="email_add" required>
           </div>

        <!--<div class="modal-body">
            <div class="form group">
                <label>User Id</label>
                <input type="text" name="user_id" class="form-control" placeholder="Enter Pet Owner ID">
            </div> -->

            <div class="form group">
            <br><label>User Role</label>
                <select type="text" name="user_role" readonly class="form-control">
                    <option value="4">Pet Owner</option>
                </select>
            </div>

            <div class="form group">
            <br><label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>

            <div class="form group">
            <br><label>Password </label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>

            <div class="form group">
            <br><label>Confirm Password </label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            </div>
        </div>
        <div class="modal-footer" >
            <button type="button" class="btn btn-danger"><a style="color:white" href="login.php">Cancel</a></button>
            <button type="submit" name="registerbtn" class="btn btn-success">Submit</button>
        </div>
    </form>

    </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
