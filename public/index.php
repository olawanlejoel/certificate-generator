<?php
require_once __DIR__ . '/../src/CertificateGenerator.php';

$generator = new CertificateGenerator();
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    try {
        $result = $generator->generate($name, $occupation);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Certificate Generator</title>
  </head>
  <body>
    <center>
      <br><br><br>
      <h3>Certificate Generator</h3>
      <br><br><br><br>
      <form method="post" action="">
      <div class="form-group col-sm-6">
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name Here..." required>
      </div>
      <div class="form-group col-sm-6">
        <input type="text" name="occupation" class="form-control" id="organization" placeholder="Enter Organization Name Here..." required>
      </div>
      <button type="submit" name="generate" class="btn btn-primary">Generate</button>
    </form>
    <br>
    <?php if ($error): ?>
      <div class='alert alert-danger col-sm-6' role='alert'>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php elseif ($result): ?>
      <div class='alert alert-success col-sm-6' role='alert'>
        Congratulations! <?= htmlspecialchars(strtoupper($result['name'])) ?> on your excellent success.
      </div>
      <?php if (file_exists(__DIR__ . '/' . $result['image'])): ?>
        <img src="<?= htmlspecialchars($result['image']) ?>">
        <br><br>
        <a href="<?= htmlspecialchars($result['image']) ?>" class="btn btn-success" download>Download My Internship Certificate</a>
        <br><br>
      <?php else: ?>
        <div class='alert alert-danger col-sm-6' role='alert'>
          Sorry, there was a problem generating your certificate image.
        </div>
      <?php endif; ?>
    <?php endif; ?>
    </center>

      <footer>  
          <center><p>Built with &#10084; by <a href="https://joel-new.netlify.app">Olawanle Joel</a></p></center>
      </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
