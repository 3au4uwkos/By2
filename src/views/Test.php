<?php 
    require_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "LinkParser.php");
    require_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "DBManager.php");
    $css = LinkParser::getLink("css");
    $js = LinkParser::getLink("js");
    $main = LinkParser::getLink("main");
    $home = LinkParser::getLink("home");
    $testpage = LinkParser::getLink("test");
    $current = 0;
    function showTests()
    {
      global $current, $testpage;
      $tests = DBManager::showTests($current, $_SESSION["userid"]);
      $current += 9;
      foreach($tests as $test)
      {
        echo "  <div class='col'>" . PHP_EOL;
        echo "    <div class='card text-dark bg-info mb-3' style='max-width: 18rem;'>" . PHP_EOL;
        echo "    <a href='$testpage' style='text-decoration: none;' >" . PHP_EOL;
        echo "      <div class='card-body'>" .PHP_EOL;
        echo "        <h5 class='card-title'>" . $test[0] . "</h5>". PHP_EOL;
        echo "        <p class='card-text'>" . $test[1] . "</p>" . PHP_EOL;
        echo "      </div>" . PHP_EOL;
        echo "    </a>" . PHP_EOL;
        echo "    </div>" . PHP_EOL;
        echo "  </div>" . PHP_EOL;
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ByRote</title>
  <link href="<?php echo $css ?>" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="<?php echo $js ?>" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
      .card {
        border-radius: 1em;
        text-align: center;
        padding: 1em;
      }
      .card:hover {
        background-color: rgba(200,220, 200, 0.8);
      }

      a, a:visited, a:hover, a:active {
        color: inherit;
      }
      
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container mx-auto">
    <a class="navbar-brand" href="<?php echo $main ?>">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto my-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $main ?>">Welcome</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About application</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <ul>
        <a type="button" class="btn btn-primary px-auto pe-auto" href="<?php echo $home?>"><?php echo $_SESSION['user']?></a>
      </ul>
    </div>
  </div>
</nav>

<div class="container col-md-9 text-center my-5">
  <h1> There will be your test </h1>
</div>
</body>
</html>
