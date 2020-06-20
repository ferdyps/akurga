function konfirmasi_data(base_url, id) {
    Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Setelah di konfirmasi, data tidak bisa diubah lagi..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        reverseButtons: true
    })
    .then((result) => {
        if(result.value) {
            $.ajax({
                url: base_url + id,
                type: "get",
                data: id,
                dataType: "json",
                success:function(data){
                    if ($.isEmptyObject(data.errors)) {
                        Swal.fire({
                            title: "Berhasil",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: data.errors,
                            icon: "error"
                        });
                    }
                },
                error:function(){
                    Swal.fire({
                        title: "Data Proses",
                        text: "Error di System..!",
                        icon: "error"
                    });
                }
            });
        }
    });
}
// =============================================================
$(document).ready(function () {
// =============================================================
    //Function for All Form. Supported with Input File..
    $('#default-form').submit(function() {
        $('input').blur();
        event.preventDefault();

        console.log($(this).attr("log"));

        var formData = new FormData($(this)[0]);
        var base_url = $(this).attr("action");

        $.ajax({
            url: base_url,
            type: "post",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            async: true,
            timeout: 40000,
            beforeSend:function(){
                $('.btn-submit').attr("disabled", true);
                $('#status').removeClass("d-none");
                $('#btn-text').addClass("d-none");
            },
            complete:function(){
                $('.btn-submit').attr("disabled", false);
                $('#status').addClass("d-none");
                $('#btn-text').removeClass("d-none");
            },
            success:function(data){
                if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors) && $.isEmptyObject(data.pict) && $.isEmptyObject(data.pict2) && $.isEmptyObject(data.tgl_rpt) && $.isEmptyObject(data.no_srt)) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        location = data.url
                    });
                } else if(data.form_errors) {
                    for(var form_data in data.form_errors) {
                        $('#input-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                        $('#input-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                    }
                } else if (data.pict) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict,
                      icon: "warning"
                  });
                } else if (data.pict2) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict2,
                      icon: "warning"
                  });
                } else if (data.tgl_rpt) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.tgl_rpt,
                      icon: "warning"
                  });
                }else if (data.no_srt) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.no_srt,
                      icon: "warning"
                  });
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: data.errors,
                        icon: "error"
                    });
                }
            },
            error:function(){
                Swal.fire({
                    title: "Error",
                    text: "Error pada System!",
                    icon: "error"
                });
            }
        });
    });

    $('#edit-formrpt').submit(function() {
        $('input').blur();
        event.preventDefault();

        console.log($(this).attr("log"));

        var formData = new FormData($(this)[0]);
        var base_url = $(this).attr("action");

        $.ajax({
            url: base_url,
            type: "post",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            async: true,
            timeout: 40000,
            beforeSend:function(){
                $('.btn-submit').attr("disabled", true);
                $('#status').removeClass("d-none");
                $('#btn-text').addClass("d-none");
            },
            complete:function(){
                $('.btn-submit').attr("disabled", false);
                $('#status').addClass("d-none");
                $('#btn-text').removeClass("d-none");
            },
            success:function(data){
                if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors) && $.isEmptyObject(data.pict) && $.isEmptyObject(data.pict2) && $.isEmptyObject(data.tgl_rpt) && $.isEmptyObject(data.no_srt)) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        location = data.url
                    });
                } else if(data.form_errors) {
                    for(var form_data in data.form_errors) {
                        $('#edit-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                        $('#edit-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                    }
                } else if (data.pict) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict,
                      icon: "warning"
                  });
                } else if (data.pict2) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict2,
                      icon: "warning"
                  });
                }else if (data.tgl_rpt) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.tgl_rpt,
                      icon: "warning"
                  });
                }else if (data.no_srt) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.no_srt,
                      icon: "warning"
                  });
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: data.errors,
                        icon: "error"
                    });
                }
            },
            error:function(){
                Swal.fire({
                    title: "Error",
                    text: "Error pada System!",
                    icon: "error"
                });
            }
        });
    });

    $('#edit-formkgt').submit(function() {
        $('input').blur();
        event.preventDefault();

        console.log($(this).attr("log"));

        var formData = new FormData($(this)[0]);
        var base_url = $(this).attr("action");

        $.ajax({
            url: base_url,
            type: "post",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            async: true,
            timeout: 40000,
            beforeSend:function(){
                $('.btn-submit').attr("disabled", true);
                $('#status').removeClass("d-none");
                $('#btn-text').addClass("d-none");
            },
            complete:function(){
                $('.btn-submit').attr("disabled", false);
                $('#status').addClass("d-none");
                $('#btn-text').removeClass("d-none");
            },
            success:function(data){
                if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors) && $.isEmptyObject(data.pict) && $.isEmptyObject(data.pict2) && $.isEmptyObject(data.tgl_rpt)) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.message,
                        icon: "success"
                    }).then(function() {
                        location = data.url
                    });
                } else if(data.form_errors) {
                    for(var form_data in data.form_errors) {
                        $('#edit-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                        $('#edit-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                    }
                } else if (data.pict) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict,
                      icon: "warning"
                  });
                } else if (data.pict2) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.pict2,
                      icon: "warning"
                  });
                }else if (data.tgl_rpt) {
                  Swal.fire({
                      title: "Peringatan",
                      text: data.tgl_rpt,
                      icon: "warning"
                  });
                }else {
                    Swal.fire({
                        title: "Gagal",
                        text: data.errors,
                        icon: "error"
                    });
                }
            },
            error:function(){
                Swal.fire({
                    title: "Error",
                    text: "Error pada System!",
                    icon: "error"
                });
            }
        });
    });
// =============================================================
    $('form input').on('keyup', function () {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text("The " + $(this).attr('placeholder').split("..").join("") + " field is required.");
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('form textarea').on('keyup', function () {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text("The " + $(this).attr('placeholder').split("..").join("") + " field is required.");
        } else {
            $(this).removeClass('is-invalid');
        }
    });
// =============================================================
    $(document).on('click', ':reset', function() {
        $('input[type="hidden"]').val(null);
        $('input').removeClass('is-invalid');
        $('textarea').removeClass('is-invalid');
    });

    $('#dataTable2').DataTable();
// =============================================================
});
