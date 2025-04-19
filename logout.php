<?php 
    
    session_start();

    if(isset($_SESSION['firstname'])){
        
        session_unset();
        session_destroy();
        header('Location:index.php');

    }else{
        echo 'Aucun utilisateur n\'est connecté. Pas besoin de logout !<br> Vous serez redirigé vers la Home Page dans 3sec.';
    
?>

        <script>
            
            setTimeout(function() {
                location.href = "/index.php"
            }, 3000);

        </script>

<?php

    }

?>