  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Input Hasil Komplain</h1>
</div>

<div class="container">
    <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
        <?= form_open_multipart('ketuaRT/insertHasilKomplain', ['id' => 'default-form', 'log' => 'Input Hasil Komplain']);?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                        <label for="input-nomor_komplain">Nomor Pengaduan</label>
                        <input type="text" name="nomor_komplain" value="<?= $no_komplen ?>" id="input-nomor_komplain" readonly class="form-control">
                    </div>
                    <div class="form-group form-input">
                        <label for="input-hasil_komplain">Tindak Lanjut</label>
                        <textarea name="hasil_komplain" id="input-hasil_komplain" cols="30" rows="10" class="form-control" placeholder="Tindak Lanjut"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="input-gambar">
                            <label class="custom-file-label">Choose file</label>
                            <div class="invalid-feedback"></div>  
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <input type="reset" value="Reset" class="btn btn-danger">
                    <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
                </div>
            </div>
        <?= form_close();?>
        </div>
    </div>
</div>
</div>
</div>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<!-- <script>
$('#formKomplain').submit(function(event){
    event.preventDefault();
    console.log("HAI");

    let _data = $('#formKomplain').serialize();

    $.ajax({
        url: "/ketuaRT/insertHasilKomplain",
        type: 'POST',
        data: _data,
        success: function(data){
            Swal.fire({
                title: "Berhasil",
                text: data.message,
                icon: "success"
            }).then(function() {
                location = data.url
            });
        }
    })
})
</script> -->