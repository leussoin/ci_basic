$('#tableau_produit').DataTable( {} );

$( ".supprimer_produit" ).on('click', function() {
    var id = $(this).data("id");
    var nom = $(this).data("nom");
    if (confirm('voulez vous supprimer ' + nom + " ?")) {
        $.ajax({
            url: 'index.php/produit/supprime_produit',
            type: 'post',
            data: {id:id},
            success: function(){ 
              alert('success!');
            },
            error: function(){
              alert('error!');
            }
          });
    }

    

});


$( ".detail_produit" ).on('click', function() {
    var id = $(this).data("id");
    
    window.location.href = 'index.php/produit/'+id;
});
