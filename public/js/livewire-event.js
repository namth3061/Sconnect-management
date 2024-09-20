Livewire.on('closeModal', () => {
    $("#formModal").modal("hide");
});


Livewire.on('showSuccessAlert', ($message) => {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: $message,
        confirmButtonColor: "#3a57e8"
    }).then((result) => {
        Livewire.dispatch('redirect')
    });
});

Livewire.on('showErrorAlert', ($message) => {
    Swal.fire({
        icon: 'error',
        title: "Error",
        text: $message,
        confirmButtonColor: "#3a57e8"
    })
});

Livewire.on('confirm-delete', ($data) => {
    Swal.fire({
        title: $data[0].title,
        text: $data[0].text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: $data[0].confirmButtonText
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch('handle-delete', {id: $data[0].id})
        }
    });
});

Livewire.on('showConfirm', ($message) => {
    $message.map( function($data){
        Swal.fire({
            title: $data['title'],
            text: $data['message'],
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: $data['accept'],
            cancelButtonText: $data['cancel']
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('submit')
            }
        });
    })
});
