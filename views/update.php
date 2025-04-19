<?php

    require_once '../include/app.php';
    session_start();

    if(!isset($_SESSION['id'])){
        echo "
        
            <script>
                alert('Access denied ! Please login first.')
                location.href = \"login.php\";
            </script>

        ";
        
    }else{

        if($_GET){
    
            $id = $_GET['id'];

            if($_SESSION['id'] == $id){

                $request = "SELECT * FROM MemberSpace WHERE id = $id";
                $result = $bd -> query($request);
                $response = $result -> fetch();
        
                if($response){
                
                    if(isset($_POST['onchange'])){
                
                        $nom = strip_tags($_POST['firstname']);
                        $prenom = strip_tags($_POST['lastname']);
                        $email = $_POST['email'];
                        $phone  = strip_tags($_POST['phone']);
                                                
                        $req = $bd -> prepare(
                            "SELECT firstname, lastname, email FROM MemberSpace WHERE firstname = :firstname OR lastname = :lastname OR email = :email"
                        );
                        $req -> bindValue(':firstname', $_POST['firstname']);
                        $req -> bindValue(':lastname', $_POST['lastname']);
                        $req -> bindValue(':email', $_POST['email']);
                        $req -> execute();

                        $result2 = $req -> fetch(PDO::FETCH_ASSOC);  
                        
                        if($result2['firstname'] != $_SESSION['firstname'] || $result2['lastname'] != $_SESSION['lastname'] || $result2['email'] != $_SESSION['email']){
                            
                            $msg = "data already exists";                        

                        }else{

                            $req2 = $bd -> prepare(
                                "UPDATE MemberSpace SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, update_at = :update_at WHERE id = :id "
                            );

                            $req2 -> bindValue(':firstname', $nom);
                            $req2 -> bindValue(':lastname', $prenom);
                            $req2 -> bindValue(':email', $email);
                            $req2 -> bindValue(':phone', $phone);
                            $req2 -> bindValue(':update_at', date('Y-m-d H:i:s'));
                            $req2 -> bindValue(':id', $id);
                            
                            $result2 = $req2 -> execute();
                            
                            if(!$result2){
                                echo "Error executing request";
                            }else{
                                $msg = "Request successfully executed !";

                                $_SESSION['firstname'] = $nom;
                                $_SESSION['lastname'] = $prenom;
                                $_SESSION['email'] = $email;
                                $_SESSION['phone'] = $phone;

                                ?>
                            
                                    <script>
                            
                                        setTimeout(function(){
                            
                                            location.href = "/index.php";
                                        },3000);
                            
                                    </script>
                            
                                <?php     

                            }

                        }

                    }
                    
                }else{

                    echo "Failed to update Member, no match id found.";

                }
       
            }else{

                echo "Failed to update Member, Access denied";

            }
    
        }else{

            echo "Not found Member, 'cause of not get attribute found.";
            
        }

    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberSpace - Update</title>
</head>
<body>
    <?php require '../include/header.php'; ?> 
    <link rel="stylesheet" href="../css/update.css">
            <div class='overlay'>
                <form method='post' class='updateData'>
                    <h1><?php echo isset($msg) ? $msg : 'Modifiez vos données !' ?></h1>
                    <div class="form-group type-1">
                        <section class="userName">
                        <label for="firstName">Noms :</label>
                        <input type="text" name='firstname' value=<?= $_SESSION['firstname'] ?> id='firstName'  />
                        </section>
                        <section class="userName">
                        <label for="lastName" >Prénoms :</label>
                        <input type="text" name='lastname' value=<?= $_SESSION['lastname'] ?> id='lastName'  />
                        </section>
                    </div>
                    <div class="form-group full-width">
                        <label for="email">e-mail :</label>
                        <input type='email' name='email' value=<?= $_SESSION['email'] ?> id='email'  />
                    </div>
                    <div class="form-group full-width">
                        <label for="phone">Numéro :</label>
                        <input type="phone" name='phone' value=<?= $_SESSION['phone'] ?> id='phone'  />
                    </div>
                    <input type="submit" value="Modifier" style="display: inline; width: 68%;" name="onchange" />
                    <button type='button' style="background:lightgreen" onclick="location.href='profile.php'">
                        Annuler
                    </button>
                </form>
            </div>

</body>
</html>

