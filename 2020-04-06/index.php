<?php

require_once 'bootstrap.php';

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Calculator</title>
</head>
<body>
<div class="container mt-5">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
    <?php endif; ?>
    <form action="insert.php" method="POST" class="mx-3 mt-3">
        <input name="num_1" type="text" class="form-control d-inline-block w-25"
               value="<?php echo isset($_POST['num_1']) ? $_POST['num_1'] : '' ?>">

        <select name="symbol" class="form-control d-inline-block w-25">
            <?php
            foreach ($actions as $action) {

                $selected = '';

                if (isset($_POST['symbol']) && $_POST['symbol'] == $action['value']) {
                    $selected = ' selected="selected"';
                }

                echo sprintf('<option value="%s" %s>%s</option>', $action['value'], $selected, $action['name']);
            }
            ?>
        </select>

        <input name="num_2" type="text" class="form-control d-inline-block w-25" value="<?php echo isset($_GET['num_2']) ? $_GET['num_2'] : '' ?>">

        <button class="btn btn-success">Calculate</button>
        <a class="btn btn-danger" href="<?php echo $_SERVER['PHP_SELF']; ?>">Clear</a>
    </form>
</div>


<?php

$calculations = getCalculations();

foreach ($calculations as $fetch):
    ?>
<br>
<div class="container mt-2">
    <div class="card bg-light p-3" style="max-width: 18rem;">
        <p><?php echo $fetch ['date']; ?></p>
            <h5><span class="text-primary font-weight-bold"><?php
                    echo $fetch['num_1'];
                    echo $fetch['symbol'];
                    echo $fetch['num_2'];
                    echo "=";
                    echo $fetch['result']; ?></span></h5>
     </div>
</div>
<?php endforeach; ?>
</body>
</html>

<?php
unset($_SESSION['error']);
?>