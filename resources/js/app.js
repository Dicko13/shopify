require('./bootstrap');

require('alpinejs');

import Swal from "sweetalert2";

window.suppressionConfirm = function(formId){
    Swal.fire({
        title: 'Attention!',
        text: "Etes-vous sur de vouloir supprimer ce produit?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.isConfirmed) {
        //   Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //   )
        // }
        document.getElementById(formId).submit();
      }
    })
}
