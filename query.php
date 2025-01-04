<div class="container">
    <div class="box">
      <?php
          // POST request
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input_pw = $_POST["password"] ? $_POST["password"] : "";

            base64_decode($input_pw);

            if (preg_match("/[a-zA-Z]/", $input_pw)) {
              echo "alphabet in the pw :(";
            }
            else{

              $pw = preg_replace(
                "/\d{2,5}\@[3-9]{3}(42){3,5}[^\dAEIOU\.\*\(\)]{2}\!\$/",
                "n3wPa55W0rd",
                $input_pw
              );

              if ($pw == "n3wPa55W0rd") {
                echo '비밀번호가 올바릅니다.';
              }
              else{
                echo "Wrong nickname or pw";
              }
            }
          }
          // GET request
          else{
            echo "Not GET request";
          }
      ?>
    </div>
</div>
