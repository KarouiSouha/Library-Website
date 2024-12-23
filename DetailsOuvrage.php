<?php
    include 'DbConnect.php';
    $query=$pdo->query('select * from ouvrages');
    $ouvrages=$query->fetchAll();

    $query1 = $pdo->prepare("SELECT COUNT(*) AS total FROM adherent");
    $query1->execute();
    $result=$query1->fetch(PDO::FETCH_ASSOC);

    $query = $pdo->prepare("SELECT COUNT(*) AS total FROM feedback");
    $query->execute();
    $resultFeed=$query->fetch(PDO::FETCH_ASSOC);

    //Requette pour assigner le nom et l'image de l'admin
    $result1 = ['username' => 'Admin', 'picture' => 'default.png']; // Valeurs par défaut

    // Vérification de l'existence de 'idAdmin' dans $_GET
    if (isset($_GET['idAdmin']) && is_numeric($_GET['idAdmin'])) {
        $idAdmin = intval($_GET['idAdmin']); // Conversion en entier pour éviter les injections SQL
        // Requête pour assigner le nom et l'image de l'admin
        $query2 = $pdo->prepare("SELECT username, picture FROM admin WHERE idAdmin = ?");
        $query2->execute([$idAdmin]);
        $result1 = $query2->fetch(PDO::FETCH_ASSOC) ?: $result1; // Si aucune donnée n'est trouvée, utiliser les valeurs par défaut
    }
       
    $template="DetailsOuvrage";
    $title="Détails Ouvrage";
    include 'layout.phtml';
?>
