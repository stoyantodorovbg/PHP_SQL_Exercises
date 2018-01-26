<?php
include('dbConfig.php');

$data = file('employees.txt', FILE_IGNORE_NEW_LINES);

$data = cleanEmptyRows($data);
$data = findIndexedRows($data);
$data = giveKeysToData($data);

$stmt = $pdo->prepare('
INSERT INTO employees
(id, firstName, lastName, salary)
VALUES (?,?,?,?)');

foreach ($data as $row) {
    $id = $row[0]['id'];
    $firstName = $row[1]['firstName'];
    $lastName = $row[2]['lastName'];
    $salary = $row[3]['salary'];

    $stmt->execute([$id, $firstName, $lastName, $salary]);
}


function cleanEmptyRows(array $arr) {
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == "\n" || $arr[$i] == '') {
            unset($arr[$i]);
        }
    }
    return $arr;
}

function findIndexedRows(array $arr) {
    $output = [];
    for ($i = 0; $i < count($arr); $i++) {
        if (isset($arr[$i][0])
            &&
            preg_match('/^\d+$/', $arr[$i][0])
            &&
            strval(intval($arr[$i][0])) == strval($arr[$i][0])) {
            $output[] = $arr[$i];
        }
    }
    return $output;
}

function giveKeysToData($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        $rowArr = explode('|', $arr[$i]);
        for ($e = 0; $e < count($rowArr); $e++) {
            switch ($e) {
                case 0:
                    $rowArr[$e] = ['id' => $rowArr[$e]];
                    break;
                case 1:
                    $rowArr[$e] = ['firstName' => $rowArr[$e]];
                    break;
                case 2:
                    $rowArr[$e] = ['lastName' => $rowArr[$e]];
                    break;
                case 3:
                    $rowArr[$e] = ['salary' => $rowArr[$e]];
                    break;
            }
        }
        $arr[$i] = $rowArr;
    }

    return $arr;
}

