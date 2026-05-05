<?php
function prosesFrameworks(string $input): array {
    if (trim($input) === '') return [];
    return array_map('trim', explode(',', $input));
}

function validasiInput(array $data): array {
    $errors = [];
    if (empty(trim($data['nama'] ?? '')))       $errors[] = 'Nama wajib diisi.';
    if (empty(trim($data['id_dev'] ?? '')))     $errors[] = 'ID Developer wajib diisi.';
    if (empty(trim($data['kota'] ?? '')))       $errors[] = 'Kota/Tgl Lahir wajib diisi.';
    if (empty(trim($data['email'] ?? '')))      $errors[] = 'Email wajib diisi.';
    if (empty(trim($data['whatsapp'] ?? '')))   $errors[] = 'No. WhatsApp wajib diisi.';
    if (empty(trim($data['frameworks'] ?? ''))) $errors[] = 'Framework/Tools wajib diisi.';
    if (empty(trim($data['pengalaman'] ?? ''))) $errors[] = 'Pengalaman wajib diisi.';
    if (empty($data['minat'] ?? ''))            $errors[] = 'Minat Bidang wajib dipilih.';
    if (empty($data['tingkat'] ?? ''))          $errors[] = 'Tingkat Skill wajib dipilih.';
    return $errors;
}

$hasil  = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validasiInput($_POST);

    if (empty($errors)) {
        $frameworks = prosesFrameworks($_POST['frameworks']);
        $hasil = [
            'nama'       => htmlspecialchars(trim($_POST['nama'])),
            'id_dev'     => htmlspecialchars(trim($_POST['id_dev'])),
            'kota'       => htmlspecialchars(trim($_POST['kota'])),
            'email'      => htmlspecialchars(trim($_POST['email'])),
            'whatsapp'   => htmlspecialchars(trim($_POST['whatsapp'])),
            'frameworks' => $frameworks,
            'pengalaman' => htmlspecialchars(trim($_POST['pengalaman'])),
            'tools'      => $_POST['tools'] ?? [],
            'minat'      => htmlspecialchars($_POST['minat']),
            'tingkat'    => htmlspecialchars($_POST['tingkat']),
            'pesan'      => count($frameworks) > 2 ? 'Skill Anda cukup luas di bidang development!' : null,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Interaktif Developer</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto; padding: 0 15px; }
  h2 { background: #3498db; color: #fff; padding: 10px; }
  h3 { margin-top: 20px; border-bottom: 2px solid #3498db; padding-bottom: 5px; }
  table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
  th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
  th { background: #f0f0f0; width: 35%; }
  label { display: block; margin: 10px 0 4px; font-weight: bold; }
  input[type=text], input[type=email], textarea, select {
    width: 100%; padding: 7px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
  }
  .inline-label { display: inline; font-weight: normal; margin-left: 5px; }
  .group { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 4px; }
  .error { color: red; background: #ffe5e5; border: 1px solid red; padding: 8px; margin-bottom: 12px; }
  .info  { color: green; background: #e5ffe5; border: 1px solid green; padding: 8px; margin: 10px 0; }
  button { background: #3498db; color: #fff; border: none; padding: 9px 22px; cursor: pointer; border-radius: 4px; font-size: 1rem; margin-top: 10px; }
  button:hover { background: #217dbb; }
  nav { margin-bottom: 15px; }
  nav a { margin-right: 15px; text-decoration: none; color: #3498db; }
</style>
</head>
<body>

<nav><a href="blog.php">profil</a> <a href="timeline.php">Timeline</a></nav>

<h2>Profil Interaktif Developer Pemula</h2>

<h3>Data Profil</h3>
<table>
  <tr><th>Nama</th>
  <td>Zainul Hasan</td></tr>
  <tr><th>ID Developer</th>     
  <td>DEV-01</td></tr>
  <tr><th>Kota / Tgl Lahir</th>
  <td>Sumenep, 02 juli 2007</td></tr>
  <tr><th>Email</th>            
  <td>akuzen277@gmail.com</td></tr>
  <tr><th>No. WhatsApp</th>     
  <td>087846293802</td></tr>
</table>

<h3>Form Isian</h3>

<?php if (!empty($errors)): ?>
  <div class="error">
    <?php foreach ($errors as $e) echo "• $e<br>"; ?>
  </div>
<?php endif; ?>

<form method="POST">
  <label>Nama Lengkap</label>
  <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">

  <label>ID Developer</label>
  <input type="text" name="id_dev" value="<?= htmlspecialchars($_POST['id_dev'] ?? '') ?>">

  <label>Kota / Tgl Lahir</label>
  <input type="text" name="kota" value="<?= htmlspecialchars($_POST['kota'] ?? '') ?>">

  <label>Email</label>
  <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

  <label>No. WhatsApp</label>
  <input type="text" name="whatsapp" value="<?= htmlspecialchars($_POST['whatsapp'] ?? '') ?>">

  <label>Framework/Tools yang Dikuasai <small>(pisah dengan koma)</small></label>
  <input type="text" name="frameworks" placeholder="Contoh: Laravel, Vue.js, React"
         value="<?= htmlspecialchars($_POST['frameworks'] ?? '') ?>">

  <label>Cerita Singkat Pengalaman</label>
  <textarea name="pengalaman" rows="4"><?= htmlspecialchars($_POST['pengalaman'] ?? '') ?></textarea>

  <label>Tools Penunjang</label>
  <div class="group">
    <?php foreach (['VS Code','GitHub','Figma','Postman','Docker'] as $t): ?>
      <label>
        <input type="checkbox" name="tools[]" value="<?= $t ?>"
          <?= in_array($t, $_POST['tools'] ?? []) ? 'checked' : '' ?>>
        <span class="inline-label"><?= $t ?></span>
      </label>
    <?php endforeach; ?>
  </div>

  <label>Minat Bidang</label>
  <div class="group">
    <?php foreach (['Frontend','Backend','Fullstack'] as $m): ?>
      <label>
        <input type="radio" name="minat" value="<?= $m ?>"
          <?= (($_POST['minat'] ?? '') === $m) ? 'checked' : '' ?>>
        <span class="inline-label"><?= $m ?></span>
      </label>
    <?php endforeach; ?>
  </div>

  <label>Tingkat Skill Coding</label>
  <select name="tingkat">
    <option value="">— Pilih —</option>
    <?php foreach (['Dasar','Cukup','Profesional'] as $tk): ?>
      <option value="<?= $tk ?>" <?= (($_POST['tingkat'] ?? '') === $tk) ? 'selected' : '' ?>>
        <?= $tk ?>
      </option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Tampilkan Profil</button>
</form>

<?php if ($hasil): ?>
  <h3>Hasil</h3>

  <?php if ($hasil['pesan']): ?>
    <div class="info"><?= $hasil['pesan'] ?></div>
  <?php endif; ?>

  <table>
    <tr><th>Nama</th>             <td><?= $hasil['nama'] ?></td></tr>
    <tr><th>ID Developer</th>     <td><?= $hasil['id_dev'] ?></td></tr>
    <tr><th>Kota / Tgl Lahir</th> <td><?= $hasil['kota'] ?></td></tr>
    <tr><th>Email</th>            <td><?= $hasil['email'] ?></td></tr>
    <tr><th>No. WhatsApp</th>     <td><?= $hasil['whatsapp'] ?></td></tr>
    <tr><th>Minat Bidang</th>     <td><?= $hasil['minat'] ?></td></tr>
    <tr><th>Tingkat Skill</th>    <td><?= $hasil['tingkat'] ?></td></tr>
    <tr>
      <th>Frameworks</th>
      <td><?= implode(', ', array_map('htmlspecialchars', $hasil['frameworks'])) ?></td>
    </tr>
    <?php if (!empty($hasil['tools'])): ?>
    <tr>
      <th>Tools Penunjang</th>
      <td><?= implode(', ', array_map('htmlspecialchars', $hasil['tools'])) ?></td>
    </tr>
    <?php endif; ?>
  </table>

  <p><strong>Pengalaman:</strong><br><?= nl2br($hasil['pengalaman']) ?></p>
<?php endif; ?>

</body>
</html>