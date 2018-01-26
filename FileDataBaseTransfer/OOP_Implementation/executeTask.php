<?php
include('Services/PrepareData.php');
include('Services/PrepareDataPosition.php');
include('Models/ExecuteOnDB.php');
include('Models/Employees.php');
include('Models/Positions.php');

$prepareData = new PrepareData();
$prepareData->processData('files/employees.txt');
$processedData = $prepareData->getProcessedData();

$employeesModel = new Employees();
$employeesModel->insert($processedData);

$prepareDataPosition = new PrepareDataPosition();
$prepareDataPosition->processData('files/positions.txt');
$processedDataPositions = $prepareDataPosition->getProcessedData();

$positionModel = new Positions();
$positionModel->insert($processedDataPositions);
