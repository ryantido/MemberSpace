<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MemberSpace - Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/index.css">
    </head>
    <body>
        
        <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php

            session_start();       
                
        ?>

            <main class="not-in">
                <?php require './include/header.php'; ?>
                    <section class="hero-section">
                        <h1>Here's why we're Working For !</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae repellendus temporibus ex rerum veniam! In nihil quod error explicabo nulla? Suscipit harum quaerat quam explicabo repudiandae commodi possimus quae nesciunt.
                            Quod molestiae ex ut consequuntur. Reprehenderit aliquam ipsam neque? Nobis, sint! Accusamus veniam aut asperiores laboriosam saepe deleniti pariatur ex, cumque nobis quia rem. Vel sint dignissimos fugit eaque saepe!
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae repellendus temporibus ex rerum veniam! In nihil quod error explicabo nulla? Suscipit harum quaerat quam explicabo repudiandae commodi possimus quae nesciunt.
                            Quod molestiae ex ut consequuntur. Reprehenderit aliquam ipsam neque? Nobis, sint! Accusamus veniam aut asperiores laboriosam saepe deleniti pariatur ex, cumque nobis quia rem. Vel sint dignissimos fugit eaque saepe!
                        </p>
                    </section>
                    <div class="flexed-slide">
                        <div class="slide">
                            <h1>Slide nth</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, exercitationem voluptas. Aperiam perspiciatis non labore, voluptas veniam ratione quibusdam, quis praesentium sed repellendus possimus ea dignissimos impedit ullam, ipsa error.
                            Error fuga voluptates at placeat nihil ex, reiciendis nemo quas culpa praesentium odio possimus, itaque pariatur, fugit tenetur adipisci ipsam. Sapiente neque fuga soluta praesentium, provident asperiores aut esse voluptatum?</p>
                        </div>
                        <div class="slide">
                            <h1>Slide nth</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, exercitationem voluptas. Aperiam perspiciatis non labore, voluptas veniam ratione quibusdam, quis praesentium sed repellendus possimus ea dignissimos impedit ullam, ipsa error.
                            Error fuga voluptates at placeat nihil ex, reiciendis nemo quas culpa praesentium odio possimus, itaque pariatur, fugit tenetur adipisci ipsam. Sapiente neque fuga soluta praesentium, provident asperiores aut esse voluptatum?</p>
                        </div>
                        <div class="slide">
                            <h1>Slide nth</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, exercitationem voluptas. Aperiam perspiciatis non labore, voluptas veniam ratione quibusdam, quis praesentium sed repellendus possimus ea dignissimos impedit ullam, ipsa error.
                            Error fuga voluptates at placeat nihil ex, reiciendis nemo quas culpa praesentium odio possimus, itaque pariatur, fugit tenetur adipisci ipsam. Sapiente neque fuga soluta praesentium, provident asperiores aut esse voluptatum?</p>
                        </div>
                    </div>
                    <div class="flexed-slide">
                        <section class="comment-section">
                            <img src="public/images/logo.svg" alt="user-img">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis sed accusamus saepe sint, nam excepturi? Necessitatibus fugit laudantium at, saepe tempore nulla eius nostrum, aliquid dolores officia, exercitationem hic!</p>
                        </section>
                        <section class="comment-section">
                            <img src="public/images/logo.svg" alt="user-img">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis sed accusamus saepe sint, nam excepturi? Necessitatibus fugit laudantium at, saepe tempore nulla eius nostrum, aliquid dolores officia, exercitationem hic!</p>
                        </section>
                        <section class="comment-section">
                            <img src="public/images/logo.svg" alt="user-img">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis sed accusamus saepe sint, nam excepturi? Necessitatibus fugit laudantium at, saepe tempore nulla eius nostrum, aliquid dolores officia, exercitationem hic!</p>
                        </section>
                    </div>

                    <?php echo !isset($_SESSION['email']) ? "<a href=\"views/login.php\" class=\"sign-in margined\" target=\"_Self\" rel=\"noopener noreferrer\">Se connecter</a>" : "<a href=\"views/MemberSpace.php\" class=\"sign-in margined\" target=\"_Self\" rel=\"noopener noreferrer\">Continuer</a>"; ?>

            </main>
  
        <script src="./js/main.js" async defer></script>
    </body>
    
</html>