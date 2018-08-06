function confirmFunction(type) {

    /* var x = confirm("Are you sure you want to delete?");
                    if (x) {
                        return true;
                    }
                    else {
                        return false;
                    }*/
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
            swal({
      title: "¿Estás seguro?",
      text: "Desea "+type+" la informacion.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, "+type+"!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
         //$( ".delete_user" ).submit();
         $( ".delete" ).trigger( "click" );        // submitting the form when user press yes
      } else {
        swal("Cancelled", "No se "+type+" !", "error");
      }
    });
}

