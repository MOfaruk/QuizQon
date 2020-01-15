// Dependency: sweet alert 2
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    //async: false //depricated
});

function addFriend(id) {
    jQuery.ajax({
        url:'/dashboard/add-friend/'+id,
        type: 'GET',
        data: {
        },
        success: function( data ){
            location.reload();
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
        }
    });
}

function removeFriend(id) {

    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {

        jQuery.ajax({
            url:'/dashboard/remove-friend/'+id,
            type: 'GET',
            data: {
            },
            success: function( data ){

                //$("#"+id).parent().parent().remove();                
                /*
                Swal.fire(
                'Removed!',
                'Successfully removed from your friend list',
                'success'
                );
                */
                location.reload();
            },
            error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
        });
    }
    });    
}