<?php include "include/header.php" 
$kosikDetailProduktu = []; //prazdny zoznam(kosik)

if (isset($_SESSION['cart'])&& !empty($_SESSION['cart'])) //ak existuje session cart a neni prazdny
    $placeholder=implode(',', array_fill(0, count($_SESSION['cart']), '?')); // naplna pole
    try {
        //prirpava sql prikazu pre ulozenie ID do kosika
        $stmt = $conn-> prepare("SELECT * FROM produkty WHERE id  IN ($placeholder)");
        //vykonanie sql prikazu pre ulozenie ID  do kosika
        $stmt ->execute(array_vcalues($_SESSION['cart']));
        //ziskanie zaznamov z vykonaneho prikazu
        $kosikDetailProduktu = $stmt->fetchAll(PDO::FETCH_ASSOC);
     } catch(PDOException $e) {
        echo "Poziadavka zlyhala" . $e->getMessage();
     }


?>
<div class="container nt-3 ">
    <div class="cart_header">
        <h2>Váš nákupný košík</h2>
    </div>
            <!-- ak neni kosik prazdy -->
    <?php if (!empty($kosikDetailProduktu)): ?> 
            <!-- tak pre kazdu vec v kosiku sa stane -->
        <?php foreach (!empty($kosikDetailProduktu as $produkt)):?>
    <div class="row cart-item" >
        <div class="col-md-2">
            <img src="<?=$produkt['img']?>" alt="Obázok produktu">
        </div>

        <div class="col-md-5">
            <h5 class="mt-2"><?=htmlspecialchars('$produkt['Nazov']')?></h5>
        </div>

        <div class="col-md-3">
            <p class="mt-2"><?=htmlspecialchars('$produkt['Cena']')?></p>
        </div>

        <div class="col-md-2">
            <button class="btn btn-danger btn-sm btn-remove mt-2" >Vymazať</button>
        </div>
    </div>
    <?php endforeach;?>
    <?php else:?>
        <p>váš košík je prázdny</p>
    <?php endif;?>



</div>
<?php include "include/footer.php" ?>