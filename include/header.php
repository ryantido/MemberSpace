                    <link rel="stylesheet" href="/css/header.css">
                    <link rel="stylesheet" href="/css/styles.css">                    
                    <script src="/js/main.js" async defer></script>
                    <header>
                        <div class="logo-side">
                            <span class="App-logo" onclick="redirect()">MemberSpace</span>
                            <?php 
                            
                                echo !isset($_SESSION['email']) ? '<div class="desciption">
                                    <h1>Bienvenue sur notre application</h1>
                                    <p>Ici, vous avez la possibilité de gérer efficacement vos données !</p>
                                </div>' : '<div class="flex-row" style="display: flex; justify-content: space-between;gap: 25px; align-items: center;">
                            
                                <a href="/views/MemberSpace.php" target="_Self" rel="noopener noreferrer" style="color: #f0f0f0; font-weight: bold; font-size: large;">Espace Membre</a>
                                <a href="/index.php" target="_Self" rel="noopener noreferrer" style="color: #f0f0f0; font-weight: bold; font-size: large;">Acceuil</a>
                                <a href="/views/profile.php" target="_Self" rel="noopener noreferrer" style="color: #f0f0f0; font-weight: bold; font-size: large;">Profile</a>
                                </div>'; 
                                
                            ?>
                        </div>
                        
                        <div class="option">
                            <div>                                
                               <?php echo isset($_SESSION['email']) ? "<b>Bonjour, ". $_SESSION['firstname'] ." ". $_SESSION['lastname']."</b><br>" : '<a href="views/register.php" class="sign-in" target="_Self" rel="noopener noreferrer">S\'enregistrer</a>'; ?>
                            </div>
                            <div class="settings">
                                <div class="active-option" onmouseover="showDropDown()" onclick="subHideDropDown()" onmouseout="hideDropDown()">
                                    <img src="/public/icon-cog.svg" alt="setting" title="Paramètre" class="setting">
                                    <p>Options</p>
                                </div>
                                <div class="options hidden" title="user-options">                            
                                    <a href="#" onclick="subHideDropDown()"><p class="option" title="Langue Française" >Français</p></a>
                                    <a href="#" onclick="subHideDropDown()"><p class="option" title="Langue anglaise" >Anglais</p></a>
                                    <?php echo isset($_SESSION['email']) ? '<a href="/logout.php" onclick="subHideDropDown()"><p class="option">Déconnexion</p></a>' : ''; ?>
                                </div>
                            </div>
                        </div>
                    </header>