<?php
$bankList = array(
  array("value" => "bca", "placeholder" => "BCA"),
  array("value" => "royal", "placeholder" => "Blue By BCA"),
  array("value" => "bni", "placeholder" => "BNI"),
  array("value" => "bri", "placeholder" => "BRI"),
  array("value" => "mandiri", "placeholder" => "Mandiri"),
  array("value" => "cimb", "placeholder" => "CIMB Niaga"),
  array("value" => "Permata", "placeholder" => "Permata"),
  array("value" => "danamon", "placeholder" => "Danamon"),
  array("value" => "dki", "placeholder" => "Bank DKI"),
  array("value" => "tabungan_pensiunan_nasional", "placeholder" => "BTPN/ Jenius"),
  array("value" => "national_nobu", "placeholder" => "Bank Nobu"),
  array("value" => "artos", "placeholder" => "Bank Jago"),
  array("value" => "hana", "placeholder" => "Hana Bank/ Line"),
  array("value" => "linkaja", "placeholder" => "LinkAja!"),
  array("value" => "gopay", "placeholder" => "GoPay"),
  array("value" => "ovo", "placeholder" => "OVO"),
  array("value" => "dana", "placeholder" => "DANA"),
);

$url = "https://cekrek.heirro.dev/api/check";

if (isset($_POST["submit"])) {
  $account = array(
    "bank" => $_POST["bank"],
    "number" => $_POST["number"],
  );
  
  $result = null;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "accountBank=".$account["bank"]."&accountNumber=".$account["number"]);
  curl_setopt($ch, CURLOPT_POST, 1);
  $headers = array();
  $headers[] = "Content-Type: application/x-www-form-urlencoded";
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);
  $data = json_decode($response, true);
  
  if ($data["status"] == 200) {
    $result = $data["data"][0]["accountName"];
  } else {
    $result = $data["message"];
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>CheckRek</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
  <center><h3>Cek Nomor Rekening / E-Wallet</h3></center>
    <form action="" method="post">
      <div class="form-group">
        <label for="bank">Pilih Bank / E-Wallet:</label>
        <select id="bank" name="bank" class="form-control">
          <?php foreach ($bankList as $bank) { ?>
            <option value="<?php echo $bank["value"]; ?>"><?php echo $bank["placeholder"]; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="number">Nomor Rekening:</label>
        <input type="number" id="number" name="number" required class="form-control">
      </div>
      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
    </form>
    <?php if (isset($_POST["submit"])) { 
      $selectedBank = $_POST["bank"];
      $accountNumber = $_POST["number"];
      $accountName = $result;
    ?>
      <br>
      <table class="table table-bordered">
       <tr>
        <th>Yang di pilih</th>
         <th>Nomor Akun</th>
          <th>Nama Akun</th>
    </tr>
    <tr> 
    <td><?php echo $selectedBank; ?></td>      
    <td><?php echo $accountNumber; ?></td> 
    <td><?php echo $accountName; ?></td> 
</tr>
    <?php } ?>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-/yu1q3+v/4u1iZgU6V/U6oYU6VuU6y/e7V5js5c5v5VZssIM6UO/DG/8cTTj9zUu0" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<html>
