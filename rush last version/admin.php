<?php
require_once('db.php');
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
{ 
	if (!empty($_GET['action']) && !empty($_GET['product']) && !empty($_GET['value']))
	{
		if ($_GET['action'] == '+')
				mysqli_query($db, "UPDATE products SET stock = stock + {$_GET['value']} WHERE id = '{$_GET['product']}'");
		elseif ($_GET['action'] == '-')
				mysqli_query($db, "UPDATE products SET stock = stock - {$_GET['value']} WHERE id = '{$_GET['product']}'");
    elseif ($_GET['action'] == 'Ajouter le produit')
    {
        if (!empty($_GET['new_product_category']) && !empty($_GET['new_product_price']) && !empty($_GET['new_product_stock'])
            && is_numeric($_GET['new_product_category']) && is_numeric($_GET['new_product_price']) && is_numeric($_GET['new_product_stock']))
          mysqli_query($db, "INSERT INTO products (`name`, `category_id`, `price`, `stock`) VALUES ('{$_GET['product']}', '{$_GET['new_product_category']}', '{$_GET['new_product_price']}', '{$_GET['new_product_stock']}')");
        else header('Location: error.php?reason=invalid_product');
    }
    elseif ($_GET['action'] == 'Supprimer le produit')
    {
      mysqli_query($db, "DELETE FROM products WHERE id = '{$_GET['product']}'");
    }
    elseif ($_GET['action'] == 'Ajouter la categorie')
    {
        if (!empty($_GET['new_category']))
        {
          mysqli_query($db, "INSERT INTO categories (`name`) VALUES ('{$_GET['new_category']}')");
        }
        else header('Location: error.php?reason=invalid_category');
    }
    header('Location: admin.php');
	}
?>
<html>
	<head>
  	<title>Panel admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
    <style>
			body {
      	padding: 0px;
      	background-color: #616161;
         font-family: Tahoma, Geneva, Kalimati, sans-serif;
         display: inline-block;
         margin: auto;
      }
			
			.products	{
				border: 3px solid;
			}
			
			table {
        background-color: #D3D3D3;
      }

      .new-product {
        margin-top: 5px;
        background-color: #D3D3D3;
				border: 3px solid;
        clear: both;
      }
      .new-product input {
        width: 100%;
      }
		</style>
	</head>
	<body>
    <a href="index.php">Retour au site</a>
		<?php
			$products   = mysqli_fetch_all(mysqli_query($db, "SELECT * FROM products"),   MYSQLI_ASSOC);
			$categories = mysqli_fetch_all(mysqli_query($db, "SELECT * FROM categories"), MYSQLI_ASSOC);
		?>
		<table class="products">
			<tr>
				<th>Nom</th>
				<th>Categorie</th>
				<th>Prix</th>
				<th>Stock</th>
				<th>Action</th>
			</tr>
			<?php 
				foreach ($products as $product)
				{ ?>
					<tr>
						<td><?= $product['name'] ?></td>
						<td><?= $categories[$product['category_id']-1]['name'] ?></td>
						<td><?= $product['price'] ?>€</td>
						<td><?= $product['stock'] ?></td>
						<td>
							<form method="get" action="admin.php">
								<input type="number" name="value" value="1" min="1" style="width: 42px;">
								<input type="hidden" name="product" value="<?= $product['id'] ?>">
								<input type="submit" name="action" value="+">
								<input type="submit" name="action" value="-">
								<input type="submit" name="action" value="Supprimer le produit">
							</form>
							</td>
					</tr>
				<?php 
        }
			?>
		</table>

    <table class="products">
			<tr>
				<th>Nom</th>
				<th>Categorie</th>
				<th>Prix</th>
				<th>Stock</th>
				<th>Action</th>
			</tr>
			<?php 
       foreach ($categories as $category)
				{ ?>
					<tr>
						<td><?= $category['name'] ?></td>
						<td>
							<form method="get" action="admin.php">
								<input type="number" name="value" value="1" min="1" style="width: 42px;">
								<input type="hidden" name="product" value="<?= $product['id'] ?>">
								<input type="submit" name="action" value="+">
								<input type="submit" name="action" value="-">
								<input type="submit" name="action" value="Supprimer le produit">
							</form>
							</td>
					</tr>
				<?php 
				}
			?>
		</table>
0
    <div class="new-product">
        <h4>Ajouter un produit</h4>
      <form method="get" action="admin.php" id="new-product-form">
        <label for="product">Nom: </label><input type="text" name="product"><br />
        <label for="new_product_category">Categorie: </label><br />
        <select name="new_product_category" form="new-product-form">
          <option value="">--Categorie--</option>
          <?php foreach ($categories as $category) {?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
          <?php } ?>
         </select><br />
        <label for="new_product_price">Prix: </label><input type="text" name="new_product_price"><br />
        <label for="new_product_stock">Stock: </label><input type="text" name="new_product_stock"><br />
			   <input type="hidden" name="value" value="none">
        <input type="submit" name="action" value="Ajouter le produit">
      </form>
    </div>

    <div class="new-product">
        <h4>Ajouter une categorie</h4>
      <form method="get" action="admin.php">
        <label for="new_category">Nom: </label><input type="text" name="new_category"><br />
			   <input type="hidden" name="value" value="none">
			   <input type="hidden" name="product" value="none">
        <input type="submit" name="action" value="Ajouter la categorie">
      </form>
    </div>

	</body>
</html>
	<?php
}
else exit("ERROR pas admin\n");

?>