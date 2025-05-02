<!doctype html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="RSK-KKSS - Rumah Sewa Kolej Komuniti Sungai Siput">
  <title>RSK-KKSS - Rumah Sewa (Versi Seronok)</title>
  
  <!-- Bootstrap CSS (Kerana, kenapa tidak?) -->
  <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
  
  <!-- jQuery (Tongkat sihir pembangunan web!) -->
  <script src="jQueryAssets/jquery-1.11.1.min.js"></script>
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
    }

    .form-container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: auto;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    textarea {
      height: 80px;
    }

    .form-buttons {
      text-align: center;
      margin-top: 20px;
    }

    .form-buttons input {
      background-color: #ff6347;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-buttons input:hover {
      background-color: #e53e36;
    }
  </style>
</head>

<body>

  <div class="form-container">
    <h2>Borang Pendaftaran</h2>
    <form>
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>

      <label for="jantina">Jantina</label>
      <select id="jantina" name="jantina" required>
        <option value="">Sila Pilih</option>
        <option value="Lelaki">Lelaki</option>
        <option value="Perempuan">Perempuan</option>
      </select>

      <label for="semester">Semester</label>
      <select id="semester" name="semester" required>
        <option value="">Sila Pilih</option>
        <option value="Semester 1">Semester 1</option>
        <option value="Semester 2">Semester 2</option>
        <option value="Semester 3">Semester 3</option>
      </select>

      <label for="program">Program</label>
      <select id="program" name="program" required>
        <option value="">Sila Pilih</option>
        <option value="Sijil Teknologi Maklumat">Sijil Teknologi Maklumat</option>
        <option value="Sijil Teknologi Elektrik">Sijil Teknologi Elektrik</option>
        <option value="Sijil Kimpalan Automotif">Sijil Kimpalan Automotif</option>
        <option value="Sijil Pengambaran Pelancuran">Sijil Pengambaran Pelancuran</option>
      </select>

      <label for="no_kp">No. Kad Pengenalan</label>
      <input type="text" id="no_kp" name="no_kp" required>

      <label for="no_pendaftaran">No. Pendaftaran</label>
      <input type="text" id="no_pendaftaran" name="no_pendaftaran" required>

      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" required></textarea>

      <label for="no_tel">No. Telefon</label>
      <input type="text" id="no_tel" name="no_tel" required>

      <label for="pilih_rumah">Pilih Rumah</label>
      <select id="pilih_rumah" name="pilih_rumah" required>
        <option value="">Sila Pilih</option>
        <option value="Makmur">Makmur</option>
        <option value="Lintang">Lintang</option>
        <option value="Tun Sambathan">Tun Sambathan</option>
        <option value="Maybank">Maybank</option>
      </select>

      <div class="form-buttons">
        <input type="submit" value="Hantar">
        <input type="reset" value="Reset">
      </div>
    </form>
  </div>
  
</body>

</html>
