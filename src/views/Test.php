<?php 
    require_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "LinkParser.php");
    require_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "DBManager.php");
    $css = LinkParser::getLink("css");
    $js = LinkParser::getLink("js");
    $main = LinkParser::getLink("main");
    $home = LinkParser::getLink("home");
    $testpage = LinkParser::getLink("test");
    $createTest = LinkParser::getLink("createTest");
    $logo = LinkParser::getLink("logo");
    $info = LinkParser::getLink("info");
    $favicon16 = LinkParser::getLink("favicon16");
    $favicon32 = LinkParser::getLink("favicon32");
    $faviconApple = LinkParser::getLink("faviconApple");
    $manifest = LinkParser::getLink("manifest");
    $script = LinkParser::getLink("addPair");
    
    $test_id = $_GET['id'] ?? null;

    if (!$test_id) {
      die("Test ID not provided.");
    }

    $test = DBManager::getTest($test_id);
    if($test === FALSE){
      die("There is no test with such id");
    }

    $questions = array();
    $answers = array();
    $keys = array();

    $key = '';
    $value = '';

    for($i = 0; $i < count($test); $i++){
      if($i % 2 == 0){
        $key = $test[$i];
        array_push($keys, $key);
      }
      else{
        $value = $test[$i];
        $questions[$key] = $value;
        array_push($answers, $value);
      }
    }

    shuffle($keys);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href='<?php echo $faviconApple ?>'>
  <link rel="icon" type="image/png" sizes="32x32" href='<?php echo $favicon32 ?>'>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $favicon16 ?>">
  
  <link rel="manifest" href="<?php echo $manifest?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ByRote</title>
  <link href="<?php echo $css ?>" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="<?php echo $js ?>" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
        .question-container {
            text-align: center;
            margin-top: 50px;
        }

        .answer-btn {
            width: 100%;
            margin-bottom: 20px;
        }

        .next-btn {
            margin-top: 20px;
            display: none; /* Hides the button initially */
        }

        .correct {
            background-color: green;
            color: white;
        }

        .incorrect {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
<script src="http://localhost:3000/src/controllers/TestLogic.js"></script>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container mx-auto">
    <a class="navbar-brand" href="<?php echo $main ?>">
      <img src = '<?php echo $logo ?>' alt = 'Logo' width="80">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto my-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $main ?>">Welcome</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $info ?>">About application</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tests
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $home ?>">My tests</a></li>
            <li><a class="dropdown-item" href="<?php echo $createTest ?>">Create test</a></li>
            <li><hr class="dropdown-divider"></li>
          </ul>
        </li>
      </ul>
      <ul>
        <a type="button" class="btn btn-primary px-auto pe-auto" href="<?php echo $home?>"><?php echo $_SESSION['user']?></a>
      </ul>
    </div>
  </div>
</nav>

  <div class="container col-md-9 text-center my-5" id='1'>
    <div class="row justify-content-center question-container">
      <div class="col-12">
          <h3 id="question" class="mb-4">Question text will appear here</h3>
      </div>
      <div class="col-md-6">
          <button id="answer1" class="btn btn-primary answer-btn"></button>
      </div>
      <div class="col-md-6">
          <button id="answer2" class="btn btn-primary answer-btn"></button>
      </div>
      <div class="col-md-6">
          <button id="answer3" class="btn btn-primary answer-btn"></button>
      </div>
      <div class="col-md-6">
          <button id="answer4" class="btn btn-primary answer-btn"></button>
      </div>
      <div class="col-12 text-center">
          <button id="next-btn" class="btn btn-success next-btn">Go Further</button>
      </div>
    </div>
    
  </div>
</body>
</html>
