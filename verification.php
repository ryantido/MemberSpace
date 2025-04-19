<?php 

    require_once './include/app.php';

    if ($_GET){
        if (isset($_GET['email']) && isset($_GET['token'])){
            $email = $_GET['email'];
            $token = $_GET['token'];

            if (!empty($email) && !empty($token)){
                $request = $bd -> prepare("SELECT * FROM MemberSpace WHERE email = :email AND token = :token");
                
                $request -> bindValue(':email', $email);
                $request -> bindValue(':token', $token);
                $request -> execute();

                $response = $request -> rowCount();
                $data = $request -> fetch(PDO::FETCH_ASSOC);    

                if ($response == 1){
                    $req = $bd -> prepare("UPDATE MemberSpace SET token = :token , is_valid = :is_valid, update_at = :update_at WHERE email = :email");

                    $req -> bindValue(':is_valid', 1);
                    $req -> bindValue(':email', $email);
                    $req -> bindValue(':token', 'valid');
                    $req -> bindValue(':update_at', date('Y-m-d H:i:s'));

                    $result = $req -> execute();

                    if ($result) {


                        session_start();

                        $_SESSION['email'] = $email;
                        $_SESSION['firstname'] = $data['firstname'];
                        $_SESSION['lastname'] = $data['lastname'];
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['role'] = $data['role'];                        
                        $_SESSION['phone'] = $data['phone'];

                        ?>

                            <script>
                                alert('Email verified successfully');
                                setTimeout(function(){

                                    location.href = "./views/MemberSpace.php";
                                }, 1000);

                            </script>

                        <?php
                        
                    }else{

                        ?>

                            <script>
                                alert('Error while requesting email verification');
                                setTimeout(function(){

                                    location.href = "index.php";
                                }, 1000);
                            </script>

                        <?php

                    }
                }else{
                    echo 'Email verification failed';

                    ?>

                        <script>
                            setTimeout(function(){

                                location.href = "index.php";
                            }, 3000);
                                
                        </script>

                    <?php 
                }

            }else{
                echo 'Email verification failed : No arguments passed';

                ?>

                    <script>
                        setTimeout(function(){

                            location.href = "sendMail.php";
                        }, 3000);
                                
                    </script>

                <?php
            }
        }else{
            echo ' Argument failed : No arguments passed';

            ?>

                <script>
                    setTimeout(function(){

                        location.href = "sendMail.php";
                    }, 3000);
                                    
                </script>

            <?php
        }
    }else{
            echo ' Not Get !';

        ?>

            <script>
                setTimeout(function(){

                    location.href = "sendMail.php";
                }, 3000);
                                    
            </script>

        <?php        
    }

?>