<?php
include 'koneksi.php';
$id = $_GET['idkonsol'];
$data = mysqli_query($koneksi, "select * from datakonsol where idkonsol='$id'");
$sesi = mysqli_query($koneksi, "SELECT MAX(IDSesi) AS IDSesiSekarang FROM sesi;");
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE IDPelanggan NOT IN (SELECT IDPelanggan FROM sesi);");
$d = mysqli_fetch_array($data);
$s = mysqli_fetch_array($sesi);
$idsesi_sekarang = $s['IDSesiSekarang'] + 1;
?>

<form method="post" class="form-horizontal" action="tambahsesiproses.php">
    <input type="hidden" class="form-control" name="idkonsol" value="<?php echo $d['IDKonsol']; ?>" readonly>
    <input type="hidden" class="form-control" name="idsesi" value="<?php echo $idsesi_sekarang ?>" readonly>
    <div class="form-group">
        <label for="pelanggan" class="col-sm-3 control-label">Pelanggan</label>
        <div class="col-sm-9">
            <select class="form-control" name="pelanggan">
                <?php if (mysqli_num_rows($pelanggan) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($pelanggan)) { ?>
                        <option value="<?php echo $row['IDPelanggan']; ?>"><?php echo $row['NamaPelanggan']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="" disabled selected>Semua Pelanggan Sedang Bermain</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="waktubermain" class="col-sm-3 control-label">Waktu Bermain</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="Waktu Bermain (Dalam Menit)" name="waktubermain">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if (mysqli_num_rows($pelanggan) > 0) { ?>
                <button type="submit" class="btn btn-success" name="tambah">Simpan</button>
            <?php } else { ?>
                <button type="button" class="btn btn-success disabled" data-toggle="tooltip"
                    title="Tidak ada pelanggan yang tersedia.">Simpan</button>
            <?php } ?>
        </div>
    </div>
</form>