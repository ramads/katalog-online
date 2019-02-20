var BODY = $('body');

// set modal
function setModal(title, body, btn_approve_class) {
    $('.modal-title').text(title);
    $('.modal-body').html(body);
    if (btn_approve_class !== null)
        $('.modal-approve-btn').removeClass().addClass('btn btn-primary modal-approve-btn '+btn_approve_class);
}

// show modal untuk store dan update data
BODY.on('click', '.show-modal', function(event) {
    event.preventDefault();

    var anchor = $(this),
        url = anchor.attr('href'),
        title = anchor.attr('title');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response) {
            setModal(title, response, 'modal-save-btn');
            $('#modal').modal('show');
        }
    });
});

// store dan update data yang menggunakan modal
BODY.on('click', '.modal-save-btn', function(event){
    event.preventDefault();
    if ($('#modal-form').parsley().validate()) {
        $('#modal-form').submit();
    }
});

BODY.on('click', '.delete-data', function(e){
    e.preventDefault();
    var $form=$(this).parent(),
        text = $form.data('confirm') ? $form.data('confirm') : 'Anda yakin melakukan tindakan ini?';

    // deklarasi function library sweet alert
    swal({
        title: "Hati-hati.",
        text: text,
        icon: "warning",
        dangerMode: true,
        buttons: {
            cancel: {
                text: "Batal",
                value: null,
                visible: true,
                closeModal: true
            },
            confirm: {
                text: "Hapus",
                value: true,
                visible: true,
                closeModal: true
            }
        }
    })
    .then(function(isConfirm) {
        if (isConfirm) {
            var url = $form.attr('action');
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response === "success" || response.status) {
                        swal("", "Data berhasil terhapus.", "success");
                        $('#dataTableBuilder').dataTable().fnDraw();
                        // $('.table.dataTable').dataTable().fnDraw();
                    } else {
                        var message = response.message ? response.message : 'Data gagal terhapus';
                        swal("Maaf :(", message, "error");
                    }
                }
            });
        }
    });
});