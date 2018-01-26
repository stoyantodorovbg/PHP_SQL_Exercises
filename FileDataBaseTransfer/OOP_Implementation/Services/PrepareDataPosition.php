<?php


class PrepareDataPosition
{
    private $rowData;
    private $processedData;

    public function processData(string $pathToFile)
    {
        $this->processedData = $this->getDataFromFile($pathToFile);
    }

    private function getDataFromFile(string $pathToFile)
    {
        return $this->rowData = file($pathToFile, FILE_IGNORE_NEW_LINES);
    }

    /**
     * @return mixed
     */
    public function getProcessedData()
    {
        return $this->processedData;
    }

}