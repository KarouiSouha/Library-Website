<?php 
    include("DBconnect.php");
    //Requette pour compter les adhérents
    $query = $pdo->prepare("SELECT COUNT(*) AS total FROM adherent");
    $query->execute();
    $result=$query->fetch(PDO::FETCH_ASSOC);

    $query = $pdo->prepare("SELECT COUNT(*) AS total FROM feedback");
    $query->execute();
    $resultFeed=$query->fetch(mode: PDO::FETCH_ASSOC);



    // Initialisation des variables
$result1 = ['username' => 'Admin', 'picture' => 'default.png']; // Valeurs par défaut

// Vérification de l'existence de 'idAdmin' dans $_GET
if (isset($_GET['idAdmin']) && is_numeric($_GET['idAdmin'])) {
    $idAdmin = intval($_GET['idAdmin']); // Conversion en entier pour éviter les injections SQL
    // Requête pour assigner le nom et l'image de l'admin
    $query1 = $pdo->prepare("SELECT username, picture FROM admin WHERE idAdmin = ?");
    $query1->execute([$idAdmin]);
    $result1 = $query1->fetch(PDO::FETCH_ASSOC) ?: $result1; // Si aucune donnée n'est trouvée, utiliser les valeurs par défaut
}
    // // Requette pour assigner le nom et l'image de l'admin
    // $query1=$pdo->prepare("SELECT username,picture FROM admin where idAdmin=?");
    // $query1->execute([$_GET['idAdmin']]);
    // $result1=$query1->fetch(PDO::FETCH_ASSOC);

    $title='Acceuil';
    $template='index';
    include("layout.phtml");
?>