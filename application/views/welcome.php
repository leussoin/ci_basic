<h1>
    Page listing de produits
</h1>

<a href="https://www.w3schools.com">Visit W3Schools</a>

<table id="tableau_produit">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Famille</th> 
            <th>Quantité</th>
            <th>Mesure</th>
            <th>Calorie</th>
            <th>Prix Intermarché</th>
            <th>Prix LIDL</th>
            <th>Supprimer</th>

        </tr>
    </thead>
    
    <?php foreach ($data as $produit) : ?>
        <tr class="pointer">
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php echo $produit->nom_prod ?></td>
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php echo $produit->nom_categorie ?></td>
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php echo $produit->stock_prod ?></td>
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php echo $produit->nom_mesure ?></td>
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php echo $produit->calories ?></td>
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php if ($produit->fk_id_magasin == 1) { echo $produit->prix; } ?></td> 
            <td class="pointer detail_produit" data-id="<?php echo $produit->id_prod ?>"><?php if ($produit->fk_id_magasin == 2) { echo $produit->prix; } ?></td>
            <td><i data-id="<?php echo $produit->id_prod ?>" data-nom="<?php echo $produit->nom_prod ?>" class="fa fa-trash-o supprimer_produit"></i></td>

        </tr>
    <?php endforeach ?>

</table>



