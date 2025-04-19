<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/styles.css">
        <title>MemberSpace - Register</title>
    </head>
    <body>

        <?php 

            require_once ('../include/app.php');
            
            
            if(isset($_POST['register'])){
                $nom = strip_tags($_POST['firstname']);
                $prenom = strip_tags($_POST['lastname']);
                $email = $_POST['email'];
                $password = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
                $phone = trim(strip_tags($_POST['phone']));

                if (isset($_POST['admin']) && isset($_POST['employee']) && isset($_POST['secretary']) || isset($_POST['admin']) && isset($_POST['employee']) || isset($_POST['secretary']) && isset($_POST['employee']) || isset($_POST['admin']) && isset($_POST['secretary'])){
                    echo "Only one of the following roles needs to be given: admin, employee or secretary ";
        ?>
                <script>

                    setTimeout(function(){
                        location.href = "register.php";
                    },3000); 

                </script>
        <?php
                }elseif(!isset($_POST['employee']) && !isset($_POST['secretary']) && !isset($_POST['admin'])){
                    echo "Please select only one of the following roles: admin, employee or secretary ";
        ?>
                <script>

                    setTimeout(function(){
                        location.href = "register.php";
                    },3000);

                </script>
        <?php
                }else{
                    if ($_POST['admin']){
                        $role = $_POST['admin'];
                    }elseif($_POST['employee']){
                        $role = $_POST['employee'];
                    }else{
                        $role = $_POST['secretary'];
                    }
                }
                
                
                $req1 = $bd -> prepare("SELECT * FROM MemberSpace WHERE firstname = :firstname");
                $req1 -> bindValue(':firstname', $_POST['firstname']);
                $req1 -> execute();
                $result1 = $req1 -> fetch();

                $req2 = $bd -> prepare("SELECT * FROM MemberSpace WHERE email = :email");
                $req2 -> bindValue(':email', $_POST['email']);
                $req2 -> execute();
                $result2 = $req2 -> fetch();

                $req3 = $bd -> prepare("SELECT * FROM MemberSpace WHERE lastname = :lastname");
                $req3 -> bindValue(':lastname', $_POST['lastname']);
                $req3 -> execute();
                $result3 = $req3 -> fetch();
                
                if($result1){
                    $msg = "firstname already exists";
                }elseif($result2){
                    $msg = "email already exists";
                }elseif($result3){
                    $msg = "lastname already exists";
                }else{
                    function generate_token($data = 20){
                        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$%#@?!&";
                        $token = ' ';
                        
                        for ($i = 0; $i < $data; $i++) {
                            $token .= $str[rand(0, strlen($str))];
                        }
                        return trim($token);
                    }  
    
                    $token = generate_token(rand(8, 20));
                    
                    $request = $bd -> prepare(
                        "INSERT INTO MemberSpace (firstname, lastname, email, password, token, role, phone) VALUES(:firstname, :lastname, :email, :password, :token, :role, :phone)"
                    );
                    
                    $request -> bindValue(':firstname', $nom);
                    $request -> bindValue(':lastname', $prenom);
                    $request -> bindValue(':email', $email);
                    $request -> bindValue(':password', $password);
                    $request -> bindValue(':token', $token);
                    $request -> bindValue(':role', $role);
                    $request -> bindValue(':phone', $phone);
                    
                    $result = $request -> execute();
                    
                    if(!$result){
                        echo "Error executing request ";
                    }else{

                        include_once '../sendMail.php'; 

                    }
                    
                    $msg = "Nous vous avons envoyé un email de confirmation. Veuillez consulter votre boîte mail.";
                    
                }
                
            }

        ?>
        <main class="register">
            
            <?php
                if(isset($msg)){
                    echo $msg;
                }
            ?>

            <header class="form-header">
                <h1>Créer un compte</h1>
            </header>
            <p class="register-info">Lorem ipsum dolevenlyor, sit amet consectetur adipisicing elit. Distinctio, dolor similique? Distinctio sequi sit itaque officiis architecto natus dolores.</p>
            <form method="post">
                <section class="inscription">
                    <label for="firstname">Nom :<input type="text"  minlength="3" maxlength="50" name="firstname" id="firstname" required></label>
                    <label for="lastname">Prénom :<input type="text"  minlength="3" maxlength="50" name="lastname" id="lastname" required></label>
                    <label for="email">e-mail :<input type="email"  name="email" id="email"  required></label>
                    <label for="password">Mot de passe :<input type="password" name="password" id="password" required></label>
                    <label for="phone">Numéro :<input type="tel" name="phone" id="phone" minlength="9" maxlength="13"  required></label>
                    <section class="role">
                        <input type="checkbox" name="admin" id="admin" value="admin" checked><label for="admin">Administrateur</label>
                        <input type="checkbox" name="employee" id="employee" value="employee"><label for="employee">Employé</label>
                        <input type="checkbox" name="secretary" id="secretary" value="secretary"><label for="secretary">Secrétaire</label>
                    </section>
                </section>
                <section class="verification">
                    <input type="checkbox" name="checkbox" id="checkbox" required><label for="checkbox">J'accepte <a href="#" target="_blank" >la politique de confidentialité</a></label>
                </section>
                <input type="submit" name="register" value="S'enregister">
            </form>
            <div class="account-option">                    
                <p class="account">Vous avez déjà un compte ?</p>
                <a href="login.php" class="help-text" target="_parent" rel="noopener noreferrer">Connectez-Vous</a>
            </div>                
        </main>

        <script src="../js/main.js" async defer></script>
    </body>
</html>