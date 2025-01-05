<div class="container">
    <div class="box">
      <?php
          // POST request
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input_pw = $_POST["password"] ? $_POST["password"] : "";

            if (strlen($input_pw) >= 30) {
              header("Location: information.php?error=length");
              exit();
            }
            else{
              $input_pw = base64_decode($input_pw);              
              $regex = "/\d{2,5}\@[3-9]{3}(42){1,5}[^\\dAEIOU\\*\\(\\)]{2}\\!\\$/";
              $pw = preg_replace($regex,"n3wPa55W0rd", $input_pw);

              if ($pw == "n3wPa55W0rd") {
                header("Location: information.php?success=777");
              }
              else{
                header("Location: information.php?error=invalid");
              }
              exit();
            }
          } else {
            echo "Not GET request";
          }
      ?>
    </div>
</div>
