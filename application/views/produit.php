<h1>
    Détails d'un produit 
</h1>

<?php //var_dump($data['aListeMagasin']); ?>

<form>

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" 
        name="nom_prod" 
        class="form-control" 
        value="<?php if (!empty($data['aDetailProduit']->nom_prod)) { echo $data['aDetailProduit']->nom_prod; } ?>" 
        id="nom">
    </div>

    <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select class="form-control" id="categorie" name="categorie">
            <?php foreach ($data['aListeCategorie'] as $categorie) { ?>
                <option><?php echo $categorie->nom_categorie ?></option>
            <?php } ?> 

        </select>
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="prix" id="prix" value="<?php if (!empty($data['aDetailProduit']->prix)) { echo $data['aDetailProduit']->prix; } ?>">
    </div>

    <div class="form-group">
        <label for="quantite">Quantité :</label>
        <input type="text" class="form-control"  name="quantite" id="quantite" value="<?php if (!empty($data['aDetailProduit']->qte_prod)) { echo $data['aDetailProduit']->qte_prod; } ?>">
    </div>

    <div class="form-group">
        <label for="calories">Calories :</label>
        <input type="text" class="form-control"  name="calories" id="calories" value="<?php if (!empty($data['aDetailProduit']->calories)) { echo $data['aDetailProduit']->calories; } ?>">
    </div>

    <div class="form-group">
        <label for="categorie">Magasin :</label>
        <select class="form-control" id="magasin" name="magasin">
        <?php foreach ($data['aListeMagasin'] as $magasin) { ?>
                <option><?php echo $magasin->nom_magasin ?></option>
            <?php } ?>
        </select>
    </div> 

    <button type="button" class="btn btn-success">Success</button>

</form>