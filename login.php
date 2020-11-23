<?php
    // start session
    session_start();

    unset($_SESSION['msg']);

    // import database
    include_once './config/database.php';

    // get user input
    if(isset($_POST['btn_login'])){
        if(!empty($_POST['user']) || !empty($_POST['pass'])){
            $fields = [
                'user' => $_POST['user'],
                'pass' => password_hash($_POST['pass'], PASSWORD_BCRYPT)
            ];

            $sql = 'SELECT * FROM `admin_account` WHERE `username` = :user AND `password` = :pass ';
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':user' => $fields['user'],
                ':pass' => $fields['pass']
            ]);
            if($stmt->rowCount() > 0){
                echo 'User Verified';
            }

        }else {
            if(!isset($_SESSION['msg'])){
                $_SESSION['msg'] = 'Please enter all required fields';
            }
        }
        

        
    }
?>

<?php include_once './templates/header.php'; ?>
<div class="login-page">
    <div class="container">
        <h4 class="login-text text-uppercase text-center">
            <img src="images/ESUT-logo.png" alt="" width="80" class="login-logo"><br>
            Enugu State University of Science & Technology
        </h4>
        <h5 class="text-center text-capitalize text-light mb-4 mt-2">Examination Veririfcation System With Bi<i class="fa fa-fingerprint"></i>metrics</h5>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div id="login-card" class="card shadow">
                    <div class="card-body">
                        <?php
                              if(isset($_SESSION['msg'])){
                               echo '<div class="alert alert-danger" role="alert">'.$_SESSION['msg'].'</div>';
                                header('Refresh: 3; URL=login.php');
                            }
                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <h4 style="font-size: 1.2rem;"><i class="fa fa-lock"></i> Administrator Login</h4><hr>
                            <div class="form-group">
                                <label for="user">Username</label>
                                <input type="text" class="form-control" name="user" id="user">
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass">
                            </div>
                            <button type="submit" class="btn btn-esut btn-block" name="btn_login">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

<?php include_once './templates/footer.php'; ?>
    




