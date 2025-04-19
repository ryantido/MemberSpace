<?php

    require_once '../include/app.php';
    session_start();

    if(!isset($_SESSION['id'])){
        echo "Access denied ! Please login first.";
    }else{

        if($_GET){
    
            $id = $_GET['id'];

            if($_SESSION['id'] == $id){

                $request = "SELECT * FROM MemberSpace WHERE id = $id";
                $result = $bd -> query($request);
                $response = $result -> fetch();
        
                if($response){
    
                    $req = "DELETE FROM MemberSpace WHERE id = $id";
                    $result2 = $bd -> exec($req);
    
                    echo "Successfully deleted";
        
                    session_unset();
                    session_destroy();
        
                }else{
                    echo "Failed to delete Member";
                }
        
            }else{
                echo "Failed to delete Member, Access denied !";
            }
    
        }else{
            echo "Not found Member";
        }

    }

?>

<script>

    setTimeout(function(){

        location.href = "/index.php";
    },3000);

</script>
