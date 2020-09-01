<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Iuran Masuk</h1>
    </div>

    <div class="wrapper">
        <p><?php echo $this->session->flashdata('pesan'); ?> </p>
    </div>

    <div class="row bg-white rounded shadow">
        <div class="col-6">
            <form class="" action="" method="get">
                <div class="row px-3 my-3">
                    <div class="col">
                        <div class="form-group">
                            <center>
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <?php
                                            if (isset($_GET['norumah'])) {
                                            ?>
                                                <input class="form-control js-norumah" type="number" name="norumah" required value="<?php echo $_GET['norumah'] ?>">
                                            <?php } else { ?>
                                                <input class="form-control js-norumah" type="number" name="norumah" required placeholder="Masukkan Nomor Rumah">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <input class="btn btn-success" type="submit" name="" value="Check" style="width:100%;">
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
            <?php echo form_open_multipart("bendahara/iuranmasuk", array('class' => 'js-form-iuran'));
            // ini_set("display_errors", 0);
            if (isset($_GET['norumah'])) {
                foreach ($datawarga as $value) {
            ?>
                    <div class="row px-3 my-3">
                        <div class="col">
                            <input type="hidden" name="no_rumah" id="no_rumah" class="form-control" value="<?php echo $value->no_rumah; ?>" readonly>

                            <div class="form-group form-input">
                                <label for="bulantahun">Pembayaran Bulan - Tahun</label>
                                <select name="bulantahun" id="bulanTahun" class="form-control js-bulan-tahun">
                                    <option value="" disabled selected>Pilih</option>
                                    <?php
                                    $realtimeYear = date('Y');
                                    for ($i = 2018; $i <= $realtimeYear; $i++) {
                                        $cekbelumbayar = $this->m_admin->detailBulan($value->no_rumah, $i)->result();
                                        if ($cekbelumbayar[0]->bulan_januari == null) {
                                    ?>
                                            <option value="Januari - <?= $i; ?>"><?= "Januari - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_februari == null) {
                                        ?>
                                            <option value="Februari - <?= $i; ?>"><?= "Februari - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_maret == null) {
                                        ?>
                                            <option value="Maret - <?= $i; ?>"><?= "Maret - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_april == null) {
                                        ?>
                                            <option value="April - <?= $i; ?>"><?= "April - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_mei == null) {
                                        ?>
                                            <option value="Mei - <?= $i; ?>"><?= "Mei - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_juni == null) {
                                        ?>
                                            <option value="Juni - <?= $i; ?>"><?= "Juni - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_juli == null) {
                                        ?>
                                            <option value="Juli - <?= $i; ?>"><?= "Juli - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_agustus == null) {
                                        ?>
                                            <option value="Agustus - <?= $i; ?>"><?= "Agustus - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_september == null) {
                                        ?>
                                            <option value="September - <?= $i; ?>"><?= "September - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_oktober == null) {
                                        ?>
                                            <option value="Oktober - <?= $i; ?>"><?= "Oktober - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_november == null) {
                                        ?>
                                            <option value="November - <?= $i; ?>"><?= "November - " . $i; ?></option>
                                        <?php
                                        }
                                        if ($cekbelumbayar[0]->bulan_desember == null) {
                                        ?>
                                            <option value="Desember - <?= $i; ?>"><?= "Desember - " . $i; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <?php if ($this->session->flashdata('pembayaran')) {
                                ?>
                                    <a href="#" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text"><?= $this->session->flashdata('pembayaran'); ?></span>
                                    </a>
                                <?php
                                } ?>
                                <p class="text-danger mt-3 js-input-bulan-tahun-warning"></p>
                            </div>
                            <?php echo form_error('bulantahun'); ?>

                            <div class="form-group">
                                <label for="Jenis-Iuran">Jenis Iuran - <?php echo "Warga " . $value->jenis_warga; ?></label>
                                <input type="number" name="nominal" id="nominal" class="form-control js-nominal-pemasukan" value="" readonly>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="Tanggal">Tanggal</label>
                                <input name="tanggal" id="Tanggal" class="form-control" value="<?= date('d-m-Y'); ?>" readonly>
                                <div class="invalid-feedback">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group text-center">
                                    <input type="reset" value="Reset" class="btn btn-warning js-btn-reset">
                                    <input type="submit" name="submit_masuk" value="Submit" class="btn btn-primary">
                                    <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="row px-3 my-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="PembayaranBulan">Pembayaran Bulan - Tahun</label>
                            <select id="bulanTahun" name="bulantahun" class="form-control js-bulan-tahun">
                                <option value="" disabled selected>Pilih</option>
                                <?php
                                $no = 1;
                                foreach ($bulan as $bulan) { ?>
                                    <option value="<?= $bulan ?>"> <?= $bulan ?></option>
                                <?php } ?>
                            </select>
                            <?php if ($this->session->flashdata('pembayaran')) {
                            ?>
                                <a href="#" class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="text"><?= $this->session->flashdata('pembayaran'); ?></span>
                                </a>
                            <?php
                            } ?>
                            <p class="text-danger mt-3 js-input-bulan-tahun-warning"></p>
                        </div>
                        <?php echo form_error('bulantahun'); ?>

                        <div class="form-group">
                            <label for="Jenis-Iuran">Jenis Iuran</label>
                            <input type="number" name="nominal" id="nominal" class="form-control js-nominal-pemasukan" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Tanggal">Tanggal</label>
                            <input name="tanggal" id="Tanggal" class="form-control" value="<?= date('d-m-Y'); ?>" readonly>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group text-center">
                                <input type="reset" value="Reset" class="btn btn-warning js-btn-reset">
                                <input type="submit" name="submit_masuk" value="Submit" class="btn btn-primary js-btn-submit">
                                <!-- <input type="reset" value="Reset" class="btn btn-danger"> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            echo form_close();
            ?>
        </div>
    </div>
</div>

<script>
    $(".js-norumah").keyup(() => {
        $("#alert").hide();
        $('.js-bulan-tahun').attr('disabled', false);
    });
    $('.js-btn-reset').click(function() {
        $(".js-norumah, .js-nominal-pemasukan").val("");
        $(".js-nominal-pemasukan").val("");
    });
    $('.js-bulan-tahun').focus(() => {
        if ($('.js-norumah').val() == null || $('.js-norumah').val() == "") {
            $('.js-input-bulan-tahun-warning').text("Nomor Rumah belum diisi");
            $('.js-norumah').focus();
            $('.js-bulan-tahun').attr('disabled', true);
        } else {
            $('.js-input-bulan-tahun-warning').text("");
            $('.js-bulan-tahun').attr('disabled', false);
        }
    });

    $("form.js-form-iuran").submit((e) => {
        if ($('.js-bulan-tahun').val() == null || $('.js-bulan-tahun').val() == "") {
            e.preventDefault();
            $('.js-input-bulan-tahun-warning').text("Pembayaran Bulan - Tahun Belum diisi");
        } else {
            $('.js-input-bulan-tahun-warning').text("");
        }
    });

    $('.js-bulan-tahun').change(() => {
        // str.split(" ")
        let rawDate = $('.js-bulan-tahun').val();
        let monthIndexes = {
            "Januari": 1,
            "Februari": 2,
            "Maret": 3,
            "April": 4,
            "Mei": 5,
            "Juni": 6,
            "Juli": 7,
            "Agustus": 8,
            "September": 9,
            "Oktober": 10,
            "November": 11,
            "Desember": 12,
        }
        let month = rawDate.split(" - ")[0];
        monthIndex = monthIndexes[month];


        let d = new Date();
        let year = rawDate.split(" - ")[1];

        let tanggal = `${year}-${monthIndex}-<?=date('t');?> `
        let status = "<?= $datawarga[0]->jenis_warga; ?>";
        let url = "<?= base_url(); ?>";
        console.log(status);
        console.log(tanggal);

        $.ajax({
            url: `${url}Bendahara/ajaxHandlerTampilTarif?jenis_iuran=${status}&tanggal=${tanggal}`,
            method: "GET",
            success: (res) => {
                console.log(JSON.parse(res));
                const response = JSON.parse(res);

                $('.js-nominal-pemasukan').val(response.nominal);
            },
            error: (e) => {
                console.log(e);
            }
        });
    });
</script>