<?php
// Saving data from form in text file in JSON format

require_once 'bootstrap.php';


$error_symbol = false;
$result = false;


if (isset($_POST['num_1']) && isset($_POST['num_2']) && isset($_POST['symbol'])) {
    if (empty($_POST['num_1']) || empty($_POST['num_2']) || empty($_POST['symbol'])) {
        $_SESSION['error'] = 'All fields are required';
    } else {
        $num_1 = (int)$_POST['num_1'];
        $num_2 = (int)$_POST['num_2'];

        switch ($_POST['symbol']) {
            case '+':
                $result = $num_1 + $num_2;
                break;

            case '-':
                $result = $num_1 - $num_2;
                break;

            case '*':
                $result = $num_1 * $num_2;
                break;

            case '/':
                $result = $num_1 / $num_2;
                break;

            case '**':
                $result = $num_1 ** $num_2;
                break;
        }
        $data = array(
            'num_1' => $_POST['num_1'],
            'num_2' => $_POST['num_2'],
            'symbol' => $_POST['symbol'],
            'result' => $result,
            'date' => date("Y-m-d H:i:s"),
        );

        $arr_data = getCalculations();

        $arr_data[] = $data;

        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

        if (file_put_contents(CALCULATIONS_FILE, $jsondata)) {
            $_SESSION['error'] = 'Here you are!';
        } else {
            $_SESSION['error'] = 'Unable to save data in "calculations.txt"';
        }
    }
}

header('location: index.php');

exit;