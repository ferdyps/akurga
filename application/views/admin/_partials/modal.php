<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= site_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="cetakLaporanPengadaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Periode Pmbayaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- <div class="modal-body">Pilih periode tanggal</div> -->
            <!-- <form action="" method="POST" target="_blank">
                <table>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-left: 15px"  >Dari Tanggal</div>
                        </td>
                        <td align="center" width="5%">
                            <div class="form-group">:</div>
                        </td>
                        <td>
                            <div class="form_group">
                                <input type="date" class="form-control" name="tgl_dari" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group" style="margin-left: 15px"  >Sampai Tanggal</div>
                        </td>
                        <td align="center" width="5%">
                            <div class="form-group">:</div>
                        </td>
                        <td>
                            <div class="form_group">
                                <input type="date" class="form-control" name="tgl_sampai" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-top: 10px; margin-bottom: 10px">Cancel</button>
                        <input type="submit" name="cetak_pengadaan" class="btn btn-primary " style="margin-top: 10px; margin-bottom: 10px; margin-left: 10px " value="Cetak" >
                        </td>
                    </tr>
                </table>

            </form> -->
                        <form method="POST" action="<?php echo base_url(); ?>laporanpdf/pembayaran" >      
                       
                        <div class="modal-body">
                            <div class="control-group">
                        <label class="col-sm-5 control-label">Mulai Tanggal</label>
                        <div class="col-sm-6">
                        <input type="date" name="from" id="stayf"  class="form-control" style="width:200px;height:25px">
                        </div>
                            </div>
                            <div class="control-group" style="margin-top: 25px">           
                        <label class="col-sm-5 control-label">Sampai Tanggal</label>
                        <div class="col-sm-6">
                        <input type="date" name="end" id="stayf" class="form-control" style="width:200px;height:25px">
                        </div>
                            </div>
                        </div>        
                        
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel
                            </button>
                            <!-- <button class="btn btn-info" type="submit" name="submit" value="proses" onclick="return valid();">Search -->
                                
                            <button class=" btn btn-primary "> <i class="fa fa-file "></i> Cetak Laporan</a>
                           
                        </div>
                        
                       
                        </form>
                                    
        </div>
    </div>
</div>