<?php include './includes/session.php' ?>
<?php
function getData($sql)
{
    $pdo = new Database();
    $conn = $pdo->connect($sql);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        foreach ($stmt as $row) {
            $image = 'images/' . $row['photo'];
            echo "
                <div class='brand-card'>
                    <div class='brand-card-image'>
                        <img src='" . $image . "' alt='" . $row['name'] . "'/>
                    </div>
                    <div class='brand-card-content'>
                        <h4><a href='products.php?product=" . $row['product_slug'] . "'>" . $row['name'] . "</a></h4>
                        <span>" . $row['price'] . '$' . "</span>
                    </div>
                </div>
                ";
        }
    } catch (PDOException $e) {
        echo "There is some problem in the connection: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Jumpman</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <!-- Intro Section -->
    <section class="brand" id="jordan">
        <div class="column">
            <img src="images/summer jays.jpg" alt="Jordan 1" />
        </div>
        <div class="column">
            <h1>JORDAN 4'S AND JORDAN 1'S</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus
                consectetur explicabo repellendus neque vel consequatur fugiat.
                Itaque, sequi assumenda laboriosam, atque omnis, cum modi alias fuga
                esse nemo animi incidunt perferendis natus. Rem quaerat, tenetur ipsam
                officia quas voluptas nobis voluptatibus, doloremque eum minima velit
                deleniti odit? Fugit, deserunt nisi.
            </p>
        </div>
    </section>
    <!-- Jordan Sale Section -->
    <section class="brand-container">
        <?php
        $sqlOne = "SELECT * FROM jumpman.products WHERE category_id=1 ORDER BY rand() LIMIT 4;";
        getData($sqlOne);
        ?>
    </section>

    <!-- Popular Section -->
    <section class="popular" id="popular">
        <h1>POPULAR RIGHT NOW</h1>
        <div class="divider"></div>
        <div class="popular-container">
            <div class="card">
                <div class="sneaker">
                    <img src="images/nike x dior airforce.png" alt="Nike X Dior" />
                </div>
                <div class="info">
                    <h1 class="title">Nike x Dior</h1>
                    <h3>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam,
                        officiis.
                    </h3>
                    <div class="sizes">
                        <button class="size-popular">39</button>
                        <button class="size-popular">40</button>
                        <button class="size-popular">41</button>
                        <button class="size-popular">42</button>
                        <button class="size-popular">43</button>
                        <button class="size-popular">44</button>
                    </div>
                    <div class="purchase">
                        <button class="popular-purchase">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="sneaker">
                    <img src="images/ultaboost 22.jpg" alt="Ultraboost" />
                </div>
                <div class="info">
                    <h1 class="title">Ultraboost 22</h1>
                    <h3>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam,
                        officiis.
                    </h3>
                    <div class="sizes">
                        <button class="size-popular">39</button>
                        <button class="size-popular">40</button>
                        <button class="size-popular">41</button>
                        <button class="size-popular">42</button>
                        <button class="size-popular">43</button>
                        <button class="size-popular">44</button>
                    </div>
                    <div class="purchase">
                        <button class="popular-purchase">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="sneaker">
                    <img src="images/puma.png" alt="Puma" />
                </div>
                <div class="info">
                    <h1 class="title">Puma</h1>
                    <h3>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam,
                        officiis.
                    </h3>
                    <div class="sizes">
                        <button class="size-popular">39</button>
                        <button class="size-popular">40</button>
                        <button class="size-popular">41</button>
                        <button class="size-popular">42</button>
                        <button class="size-popular">43</button>
                        <button class="size-popular">44</button>
                    </div>
                    <div class="purchase">
                        <button class="popular-purchase">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Nike Section -->
    <section class="brand" id="nike">
        <div class="column">
            <h1>NIKEY SHOES</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde veniam
                eveniet ex quidem rerum alias nostrum. Laboriosam est eos perferendis?
                Veniam laudantium numquam libero, deserunt laborum perspiciatis. Quas
                explicabo deleniti similique dignissimos. Necessitatibus atque, eos
                velit expedita consequatur commodi quis inventore? Ad, blanditiis
                expedita corporis eveniet alias delectus nihil officia?
            </p>
        </div>
        <div class="column">
            <img src="images/jordan 1 retro.png" alt="Jordans" />
        </div>
    </section>
    <!-- Nike Sale Section -->
    <section class="brand-container">
        <?php
        $sqlTwo = "SELECT * FROM jumpman.products WHERE category_id=2 ORDER BY rand() LIMIT 4;";
        getData($sqlTwo);
        ?>
    </section>
    <!-- Adidas Section -->
    <section class="brand" id="adidas">
        <div class="column">
            <img src="images/adidas boots.webp" alt="Adidas" />
        </div>
        <div class="column">
            <h1>THREE STRIPES LIFESTYLE</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus
                possimus odit ullam eveniet, aperiam laboriosam tempore minus ipsa
                saepe similique doloremque eaque non reprehenderit sunt commodi
                recusandae eius illo neque? Excepturi omnis harum rem necessitatibus
                ea vel, reiciendis illum eum porro expedita minus earum facilis
                laborum voluptas aliquam, hic delectus.
            </p>
        </div>
    </section>
    <!-- Adidas Sale Content Section -->
    <section class="brand-container">
        <?php
        $sqlThree = "SELECT * FROM jumpman.products WHERE category_id=3 ORDER BY rand() LIMIT 4;";
        getData($sqlThree);
        ?>
    </section>
    <!-- Yeezy Section -->
    <section class="brand" id="yeezy">
        <div class="column">
            <h1>SO YOU WANNA GO TO THE MOON?</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum
                quis illo eius asperiores? Similique distinctio, voluptates fugit,
                dolore aut ratione officia nihil dolorem omnis eaque, in dignissimos?
                Laudantium aperiam dolores voluptas, sunt itaque tenetur asperiores.
                In natus dolorem voluptas, qui sequi cumque eligendi dicta voluptatem
                similique esse laudantium doloremque culpa.
            </p>
        </div>
        <div class="column">
            <img src="images/yeezy-knit-runner.jpg" alt="yeezy knit runner" />
        </div>
    </section>
    <!-- Puma Sale Section -->
    <section class="brand-container">
        <?php
        $sqlFour = "SELECT * FROM jumpman.products WHERE category_id=4 ORDER BY rand() LIMIT 4;";
        getData($sqlFour);
        ?>
    </section>
    <?php include './includes/footer.php' ?>
    <script src="./js/app.js"></script>
</body>

</html>