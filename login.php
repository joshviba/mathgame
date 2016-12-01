<?php session_start();
$nameErr = "";
$correctEmail = "a@a.a";
$correctPass = "aaa";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if($_POST["email"] == $correctEmail && $_POST["password"] == $correctPass){
    $_SESSION["login"] = "true";
    $_SESSION["totalQuestions"] = 0;
    $_SESSION["questionsRight"] = 0;
    header("Location: index.php");
  } else {
    $nameErr = "<div style='color: red'>* Email or Password incorrect</div>";
  }
}
?>
<html>
<link href="style/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="style/mathguess.css" type="text/css" />
<header>
  <title>Login Page</title>
</header>
<body>
  <div class="container">
    <h1>Log In to Enjoy a Math Game!</h1>
    <form class="form-horizontal" method="post"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group"><?php echo $nameErr;?>
      <label class="control-label">Email:</label>
      <input class="form-control" type="email" required placeholder="ex@one.two" name="email" size="15" />
    </div>
    <div class="form-group">
      <label class="control-label">Password:</label>
      <div>
        <input class="form-control" type="password" placeholder="Enter Password" required name="password" size="15" />
      </div>
    </div>
    <button class="btn-primary col-xs-offset-3 col-xs-2" name="Submit" type="submit">Submit</button>
  </form>
</div>
</body>
</html>
