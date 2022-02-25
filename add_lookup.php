<!DOCTYPE html>
<html>
  <head>
    <style>
      .error {color: red;}
      .msg {color: green;}
    </style>
  </head>
<body>
  
  <?php
    session_start();
    if ($_SESSION['message'] ?? '') {
      echo '<div class="msg">'.$_SESSION['message'].'</div>';
      unset($_SESSION['message']);
    }

    $tnameErr = $gnameErr = $wsErr = $tname = $gname =$note = "";
    $formValid = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if (empty($_POST["tname"])) {
        $tnameErr = "Twitch screen name is required";
        $formValid = false;
      } else {
        $tname = $_POST["tname"];
      }
      
      if (empty($_POST["gname"])) {
        $gnameErr = "Global screen name is required";
        $formValid = false;
      } else {
        $gname = $_POST["gname"];
      }

      if (empty($_POST["note"])) {
        $note = "";
      } else {
        $note = $_POST["note"];
      }

      if ($formValid) {
        if (1 == rand(1, 2)) {
          $_SESSION['message'] = "Success! You have submitted the values: <b>" . $tname . " / " . $gname . " / " . $note . "</b>";
          header('Location: ./add_lookup.php');
          exit();
        } else {
          $wsErr = "Error while trying to submit the form!";
        }
      }
    }
    ?>

<h2>Enter your Twitch and Global Poker User Information</h2>

<form  method="POST">

  <?= $wsErr ? "<div class='error'>" . $wsErr . "</div>" : "" ?>
  
  <label for="tname">Twitch Screen Name:</label><br>
  <input type="text" id="tname" name="tname" value=""><br><br>
  <span class="error">* <?= $tnameErr; ?></span>
  <label for="gname">Global Screen Name:</label><br>
  <input type="text" id="gname" name="gname" value=""><br><br>
  <span class="error">* <?= $gnameErr; ?></span>
  <label for="note">Note:</label><br>
  <input type="textarea" id="note" name="note" value=""><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
