<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Reset - Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>

        <?php

            require_once '../include/app.php';
            
            if (isset($_POST['reset-request'])){
                $email = $_POST['email'];

                $request = $bd -> prepare("SELECT email, is_valid FROM MemberSpace WHERE email = :email");
                $request -> execute(array(':email' => $email));
                $result = $request -> fetch();

                if (!$result){
                    $msg = "Could not reset password. No match email found.";
                }elseif($result['is_valid'] == 0){
                    $msg = "Your email isn't verified. You've received a confirmation email. Check your email and try again !";

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
                    if (strip_tags($_POST['password']) != strip_tags($_POST['password2'])){
                        $msg = "Passwords doesn't match.";
                    }else{
                        $password = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);

                        $req2 = $bd -> prepare("UPDATE MemberSpace SET password = :password, update_at = :update_at");
                        $req2 -> bindValue(':update_at', date('Y-m-d H:i:s'));            
                        $req2 -> bindValue(':password',$password);
                        $response = $req2 -> execute();

                        if($response){
                            $msg = "Password reset successfully ! You'll be redirect to login.";                    

                    ?>

                            <script>

                                setTimeout(function(){
                                    location.href = "login.php";
                                },3000);

                            </script>

                    <?php

                        }else{
                            $msg = "Error while resetting password";

                    ?>
                            <script>
                                
                                setTimeout(function(){
                                    location.href = "login.php";
                                },3000);

                            </script>
                    <?php                    
                    
                        }

                    }
                }
                
            }

        ?>

        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <main class="login">
            <form  method="post">
                
                <?php
                    if(isset($msg)){
                        echo $msg;
                    }
                ?>

                <h1 class="login-head">Réinitialiser le mot de passe</h1>
                <label for="email" >e-mail : <input type="email" name="email" id="email" required></label>
                <label for="password" >Nouveau Mot de passe : <input type="password" name="password" id="password" required></label>
                <label for="password2">Confirmer Mot de passe :<input type="password" name="password2" id="password2" required></label>    
                <input type="submit" name="reset-request" value="Soumettre">
            </form>
        </main>
        
        <script src="../js/main.js" async defer></script>
    </body>
</html>