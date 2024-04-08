<?php 
include "include/header.php";
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
 
if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['add_to_cart'];
 
    if (!in_array($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $productId;
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
 
<style>
    .row + .row {
        margin-top: 30px;
    }
 
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border: none;
        border-radius: 10px;
    }
 
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
 
    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
 
    .card-body {
        padding: 15px;
        text-align: center;
    }
 
    .card-title {
        margin-bottom: 15px;
        font-weight: bold;
    }
 
    .card-text {
        margin-bottom: 15px;
        color: #555;
    }
 
    .btn-success {
        color: #fff;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        box-shadow: none;
    }
 
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    </style>
<?php
    try {
        $stmt = $conn->query("SELECT * FROM produkty");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Poziadavka zlyhala: " . $e->getMessage();
    }
?>
<div class="container py-5">
    <h1>Potreby pre vaše mačky</h1>
    <?php 
    $counter = 0;
    foreach ($results as $row) {
        if ($counter % 4 == 0) {
            if ($counter > 0) {
                echo '</div>';
            }
            echo '<div class="row">';
        }
 
        echo '<div class ="col-lg-3">';
        echo    '<div class="card" style="width: 18rem;">';
        echo        '<img class="card-img-top" src="'. $row["img"]. '" alt="Card image cap">';
        echo        '<div class="card-body">';
        echo            '<h5 class="card-title">'. $row["Nazov"] .'</h5>';
        echo            '<p class="card-text">'. $row["popis"]. '</p>';
        echo                '<p class="card-text">'. $row["Cena"]. ' €</p>';
        echo            '<a href="?add_to_cart='. $row["ID"]. '" class="btn btn-success">Kúpiť</a>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';
 
        $counter++;
    }
    if ($counter > 0) {
        echo '</div>';
    }
    ?>
</div>
<?php include "include/footer.php"?>