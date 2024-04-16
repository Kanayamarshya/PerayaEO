<?php 
// Include config file 
require_once "config.php"; 
 
// Define variables and initialize with empty values 
$nama = $email = $kontak = $pesan =""; 
$nama_err = $email_err = $kontak_err = $pesan_err = ""; 
 
// Processing form data when the form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Validate Nama 
    $input_nama = trim($_POST["nama"]); 
    if (empty($input_nama)) { 
        $nama_err = "Masukkan nama."; 
    } else { 
        $nama = $input_nama; 
    } 
 
    // Validate Email
    $input_email = trim($_POST["email"]); 
    if (empty($input_email)) { 
        $email_err = "Masukkan email."; 
    } else { 
        $email = $input_email; 
    } 
 
    // Validate Kontak
    $input_kontak = trim($_POST["kontak"]); 
    if (empty($input_kontak)) { 
        $kontak_err = "Masukkan kontak."; 
    } else { 
        $kontak = $input_kontak; 
    } 
 
     // Validate pesan 
     $input_pesan = trim($_POST["pesan"]); 
     if (empty($input_pesan)) { 
         $pesan_err = "Masukkan pesan."; 
     } else { 
         $pesan = $input_pesan; 
     } 
 
 
    // Check input errors before inserting into the database 
    if (empty($nama_err) && empty($email_err) && empty($kontak_err) && empty($pesan_err)) { 
        // Prepare an insert statement 
        $sql = "INSERT INTO tamu (nama, email, kontak, pesan) VALUES (?, ?, ?, ?)"; 
 
        if ($stmt = mysqli_prepare($link, $sql)) { 
            // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "ssss", $param_nama, $param_email, $param_kontak, $param_pesan); 
 
            // Set parameters 
            $param_nama = $nama; 
            $param_email = $email; 
            $param_kontak = $kontak; 
            $param_pesan = $pesan; 
 
            // Attempt to execute the prepared statement 
            if (mysqli_stmt_execute($stmt)) { 
                // Records created successfully. Redirect to the landing page 
                header("location: contact.php"); 
                exit(); 
            } else { 
                echo "Something went wrong. Please try again later."; 
            } 
        } 
 
        // Close statement 
        mysqli_stmt_close($stmt); 
    } 
 
    // Close connection 
    mysqli_close($link); 
} 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web\css\all.min.css">
    
    <style type="text/css">
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body> 
<?php include 'navbar.php'; ?>
        <div class="container mt-5"> 
            <div class="row"> 
                <div class="col-md-12"></div>
                    <br><br>
                    <br><br>
                    </div> 
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>"> 
                            <label>Nama</label> 
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"> 
                            <span class="help-block"><?php echo $nama_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>"> 
                            <label>Email</label> 
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"> 
                            <span class="help-block"><?php echo $email_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($kontak_err)) ? 'has-error' : ''; ?>">
                            <label>Kontak</label> 
                            <input type="text" name="kontak" class="form-control" value="<?php echo $kontak; ?>"> 
                            <span class="help-block"><?php echo $kontak_err;?></span> 
                        </div> 
                        <div class="form-group <?php echo (!empty($pesan_err)) ? 'has-error' : ''; ?>"> 
                        <label>Pesan</label> 
                        <textarea name="pesan" class="form-control"><?php echo $pesan; ?></textarea> 
                        <span class="help-block"><?php echo $pesan_err; ?></span> 
                        </div> 
 
                       <div class="mt-3"> 
                        <input type="submit" class="btn btn-primary" value="Submit"> 
                    </form> 
                </div> 
            </div> 
        </div> 
    </div> 
</body> 
<?php include 'footer.php'; ?>
</html>