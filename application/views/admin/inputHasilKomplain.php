  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Input Hasil Komplain</h1>
</div>

<div class="container">
    <div class="row bg-white rounded shadow border-left-primary">
        <div class="col px-0">
        <?= form_open('c_halaman_admin/', ['id' => 'default-form', 'log' => 'Input Hasil Komplain']);?>
            <div class="row px-3 my-3">
                <div class="col">
                    <div class="form-group form-input">
                        <textarea name="hasil_komplain" id="" cols="30" rows="10" class="ckeditor"></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
                </div>
            </div>
        <?= form_close();?>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>