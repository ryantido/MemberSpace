<title>MemberSpace</title>
<?php

    session_start();

    if(!isset($_SESSION['id'])){
        echo '<script>alert("Access denied ! You need to login first."); location.href = "login.php";</script>';
        
    }else{

        require '../include/header.php';
        $user = $_SESSION['fisrtname'].' '.$_SESSION['lastname'];

        ?>

            <link rel="stylesheet" href="../css/update.css">
            <link rel="stylesheet" href="../css/member.css">
            <main class="member-container">
                <h1><?php echo "Bienvenue dans ton espace, $user !"; ?></h1>
                <section class="inner"></section>
                <button type="button" style="background: lightsalmon;">
                    <a 
                        href="/index.php" 
                        style=" 
                            color: #f0f0f0; 
                            font-family: poppins, sans-serif; 
                            padding-left:1.5rem; 
                            padding-right: 1.5rem; 
                            font-size:20px;
                        "
                    >
                        Acceuil
                    </a>
                </button>
            </main>

        <?php
        
    }

    
?>