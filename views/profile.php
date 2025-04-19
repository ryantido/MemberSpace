<?php 

    session_start();

    if (isset($_SESSION['id'])){
    
        require '../include/header.php';

        ?>
            <title>MemberSpace - Profile</title>
            <link rel="stylesheet" href="../css/profile.css">
            <div class='overlay'>
            <form action="" method='post' class='updateData'>
                <h1>Consultez vos données !</h1>
                <div class="form-group type-1">
                    <section class="userName">
                    <label htmlFor="firstName">Noms :</label>
                    <input type="text" name='firstName' value=<?= $_SESSION['firstname'] ?> id='firstName'  />
                    </section>
                    <section class="userName">
                    <label htmlFor="lastName" >Prénoms :</label>
                    <input type="text" name='lastName' value=<?= $_SESSION['lastname'] ?> id='lastName'  />
                    </section>
                </div>
                <div class="form-group full-width">
                    <label htmlFor="email">e-mail :</label>
                    <input type='email' name='email' value=<?= $_SESSION['email'] ?> id='email'  />
                </div>
                <div class="form-group full-width">
                    <label htmlFor="email">role :</label>
                    <input type='email' name='email' value=<?= $_SESSION['role'] ?> id='email'  />
                </div>
                <div class="form-group full-width">
                    <label htmlFor="phone">Numéro :</label>
                    <input type="phone" name='phone' value=<?= $_SESSION['phone'] ?> id='phone'  />
                </div>
                <input type="submit" value="Modifier" style="display: inline;" onclick="location.href='update.php?id=<?=$_SESSION['id']?>'" />
                <button type='button' onclick="location.href='delete.php?id=<?=$_SESSION['id']?>'">
                    Supprimer
                </button>
                </form>
            </div>

        <?php

    }else{
        echo '<script>alert("Warning ! You need to login first !"); location.href = "login.php";</script>';
    }

?>