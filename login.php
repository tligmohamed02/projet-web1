// appel à la base de données 
    session_start();
    require('../includes/database.php');

// Inscription d'un nouveau client
<?php
    $nom = $_POST["name"];//name=nom
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérification si l'username existe déjà
    $sql_check_username = "SELECT * FROM client WHERE email='$email'";
    $result_check_username = $bdd->query($sql_check_username);
    
    if ($result_check_username->rowCount() > 0) {
        $_SESSION['erreur']="<span style='color: red;'><strong>Erreur!!</strong> Cet mail d'utilisateur est déjà utilisé. Veuillez en choisir un autre ou connecter avec ce mail <span>";
        header("location:../connexion.php");

    } else {
        // Insertion des données dans la base de données
        $sql_insert = "INSERT INTO client (name,email , password) VALUES ('$name','$email', '$password')";
        
        if ($bdd->query($sql_insert)) {

            header("location:../hebergement.html");
            echo '<script>alert("Bonjour!");</script>';
            
            
        } else {
            header("location:../login.php");
        }
    }


// Fermet