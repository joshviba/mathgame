<?php session_start();
$color = "";
$rightOrWrong = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["logout"])) {
    $_SESSION["login"] = null;
    unset($_SESSION["totalQuestions"]);
    unset($_SESSION["questionsRight"]);
  } elseif (empty($_POST["userAns"]) || is_null($_POST["userAns"]) || !is_Numeric($_POST["userAns"])) {
    $color = 'class="text-danger"';
    $rightOrWrong = "You must enter a number for an answer.";
  } elseif ($_POST["correctAns"] == $_POST["userAns"]){
    $color = 'class="text-success"';
    $_SESSION["totalQuestions"]++;
    $_SESSION["questionsRight"]++;
    $rightOrWrong = "Correct!";
  } else {
    $color = 'class="text-danger"';
    $_SESSION["totalQuestions"]++;
    $rightOrWrong = "WRONG! " . $_POST["number1"];
    if($_POST["operandUsed"] == "+"){
      $rightOrWrong .= " + " . $_POST["number2"] . " = " . $_POST["correctAns"];
    } elseif ($_POST["operandUsed"] == "-") {
      $rightOrWrong .= " - " . $_POST["number2"] . " = " . $_POST["correctAns"];;
    }
  }
  $_POST["userAns"] = "";
}

if (!isset($_SESSION["login"])){
  $_SESSION["totalQuestions"] = 0;
  $_SESSION["questionsRight"] = 0;
  header("Location: login.php");
}

$num1 = rand(0,20);
$num2 = rand(0,20);
$operand = rand(0,1);
switch($operand){
  case 0:
  $answer = $num1 + $num2;
  $operand = "+";
  break;
  case 1:
  $answer = $num1 - $num2;
  $operand = "-";
  break;
  case 2:
  $answer = $num1 * $num2;
  $operand = "x";
  break;
  case 3:
  $answer = $num1 / $num2;
  $operand = "/";
  break;
  default:
}


?>
<html>
<link href="style/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="style/mathguess.css" type="text/css" />
<header>
  <title>Math Game!</title>
</header>
<body>
  <div class="container">
    <nav class="pull-left">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <input type="hidden" name="logout" value="1" />
          <button type="submit" name="logout">Log Out</button>
        </div>
      </form>
    </nav><br />
    <h1>Math Guessing</h1>
    <div>
      <label class="col-xs-2 col-xs-offset-3"><?php echo $num1;?></label>
      <label class="col-xs-2"><?php echo $operand;?></label>
      <label class="col-xs-2"><?php echo $num2;?></label>
    </div>
    <div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <input type="hidden" name="number1" value="<?php echo $num1;?>" />
          <input type="hidden" name="operandUsed" value="<?php echo $operand;?>" />
          <input type="hidden" name="number2" value="<?php echo $num2;?>" />
          <input type="hidden" name="correctAns" value="<?php echo $answer;?>" />
          <div>
            <input class="form-control" type="text" name="userAns" placeholder="Enter Answer" />
            <button type="submit" name="submitAns" class="btn-primary col-xs-2 col-xs-offset-5">Submit</button>
          </div>
        </div>
      </div>
      <hr />
      <divclass="col-xs-offset-3 col-xs-6">
      <p <?php echo $color; ?>>
        <strong><?php echo $rightOrWrong; ?></strong>
      </p>
      <p>
        Score: <?php echo $_SESSION["questionsRight"]; ?>/<?php echo $_SESSION["totalQuestions"]; ?>
      </p>

    </div>

  </div>
</body>
</html>
