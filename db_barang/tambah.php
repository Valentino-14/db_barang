<!DOCTYPE html>
<html>
<head>
  <title>Tambah Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Form Tambah Barang</h2>
  <form action="proses_tambah.php" method="post">
    <div class="mb-3">
      <label for="kode_barang" class="form-label">Kode Barang</label>
      <input type="text" class="form-control" id="kode_barang" name="kode_barang" required maxlength="20">
    </div>

    <div class="mb-3">
      <label for="nama_barang" class="form-label">Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" required maxlength="50">
    </div>

    <div class="mb-3">
      <label for="jumlah_barang" class="form-label">Jumlah</label>
      <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required min="1">
    </div>

    <div class="mb-3">
      <label for="satuan_barang" class="form-label">Satuan</label>
      <select class="form-select" id="satuan_barang" name="satuan_barang" required>
        <option value="">-- Pilih Satuan --</option>
        <option value="pcs">pcs</option>
        <option value="kg">kg</option>
        <option value="liter">liter</option>
        <option value="meter">meter</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="harga_beli" class="form-label">Harga Beli</label>
      <input type="number" class="form-control" id="harga_beli" name="harga_beli" required step="0.01">
    </div>

    <div class="form-check form-switch mb-3">
      <input class="form-check-input" type="checkbox" id="status_barang" name="status_barang" checked>
      <label class="form-check-label" for="status_barang">Barang Tersedia</label>
    </div>

    <button type="submit" class="btn btn-success">Simpan Barang</button>
    <a href="tabel_barang.php" class="btn btn-secondary">Kembali</a>
  </form>
</body>
</html>
