<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MemberSpace - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>

    <?php

        require_once '../include/app.php';

        if(isset($_POST['login'])){
            $password = strip_tags($_POST['password']);
            $email = $_POST['email'];   
            
            $request = $bd -> prepare("SELECT * FROM MemberSpace WHERE email = :email");
            $request -> execute(array('email' => $email));
            $result = $request -> fetch();

            if(!$result){
                $msg = "Could not login to MemberSpace with email '{$email}'. Please try another login attempt";
            }elseif($result['is_valid'] == 0){
                
                $msg = "Could not login to MemberSpace with «{$email}».<br>It's not validated by the system administrator.<br>We will send you a confirmation email.";
                function generate_token($data = 20){
                    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$%#@?!&";
                    $token = '';
                        
                    for ($i = 0; $i < $data; $i++) {
                        $token .= $str[rand(0, strlen($str))];
                    }
                    
                    return $token;
                }                  
                
                $token = generate_token(rand(8, 20));
                
                $req = $bd -> prepare("UPDATE MemberSpace SET token = :token WHERE email = :email");
                $req -> bindValue(':token', $token);;
                $req -> bindValue(':email', $email);
                $req -> execute();

                include_once '../sendMail.php';                 

            }else{

                if(isset($_POST['agree'])){
                    setcookie('RememberMe', $_POST['email'], time() + 3600*24*7*2, '/', '', true);
                    setcookie('email', $_POST['password'], time() + 3600*24*7*2, '/', '', true);
                    $msg = 'Remember me !'; 
                    static $agree = 1;
                    
                }else{

                    $_COOKIE['RememberMe'] ? $agree = 1 : $agree = 0;
                    $agree == 1 ? $msg = 'Welcome back !' : $msg = 'Use RememberMe to login more easily next time !';
                                                            
                }

                $response = $bd -> prepare("UPDATE MemberSpace SET agree = :agree WHERE email = :email");
                $response -> bindValue(':email', $email);
                $response -> bindValue(':agree', $agree);
                $response -> execute();
                
                $is_password = password_verify($password, $result['password']);                

                if($is_password){
                    session_start();

                    $_SESSION['id'] = $result['id'];
                    $_SESSION['firstname'] = $result['firstname'];
                    $_SESSION['lastname'] = $result['lastname'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['role'] = $result['role'];
                    $_SESSION['phone'] = $result['phone'];

                ?>
            
                    <script>

                        setTimeout(function(){
                            location.href = "MemberSpace.php";
                        }, 3000);

                    </script>
            
                <?php 

                }else{
                    $msg = "Please enter a corresponding password for '{$result['email']}'.";
                }
            }
        }

    ?>

        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <main class="login">

            <form method="post">

            <?php

                if(isset($msg)){
                    echo $msg;
                }

            ?>
                
                <h1 class="login-head">Connexion</h1>
                
                <label for="email" >e-mail : <input type="email" name="email" id="email" value = "<?php echo $_COOKIE['RememberMe'] ? $_COOKIE['RememberMe'] : ""; ?>" required></label>
                <label for="password" >Mot de passe : <input type="password" name="password" id="password" value = "<?php echo $_COOKIE['email'] ? $_COOKIE['email'] : ""; ?>" required></label>            
                <div class="agree">                    
                    <label for="agree">Se souvenir de moi</label><input type="checkbox" name="agree" id="agree">
                </div>
                <input type="submit" name="login" value="Se connecter">
                <div class="account-option">                    
                    <p class="account">Pas encore de compte ?</p>
                    <a href="register.php" class="help-text" target="_parent" rel="noopener noreferrer">Inscrivez-vous</a>/<a href="password-reset.php" target="_parent">Reset-password</a>
                </div>    
            </form>
        </main>
        
        <script src="../js/main.js" async defer></script>
    </body>
</html>