<?php include "include/header.php" 
$kosikDetailProduktu = []; //prazdny zoznam(kosik)

if (isset($_SESSION['cart'])&& !empty($_SESSION['cart'])) //ak existuje session cart a neni prazdny
    $placeholder=implode(',', array_fill(0, count($_SESSION['cart']), '?')); // naplna pole
    try {
        $stmt = $conn-> prepare("SELECT * FROM produkty WHERE id  IN ($placeholder)");
        $stmt ->execute(array_vcalues($_SESSION['cart']));
        $kosikDetailProduktu = $stmt->fetchAll(PDO::FETCH_ASSOC);
     } catch(PDOException $e) {
        echo "Poziadavka zlyhala" . $e->getMessage();
     }


?>

<?php include "include/footer.php" ?>