<?php


class PrepareData
{
    private $rowData;
    private $processedData;

    public function processData(string $pathToFile)
    {
        $this->getDataFromFile($pathToFile);
        $data = $this->cleanEmptyRows($this->rowData);
        $data = $this->findIndexedRows($data);
        $this->processedData = $this->giveKeysToData($data);
    }

    private function getDataFromFile(string $pathToFile)
    {
        $this->rowData = file($pathToFile, FILE_IGNORE_NEW_LINES);
    }

    private function cleanEmptyRows(array $arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] == "\n" || $arr[$i] == '') {
                unset($arr[$i]);
            }
        }
        return $arr;
    }

    private function findIndexedRows(array $arr)
    {
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

    private function giveKeysToData($arr)
    {
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

    /**
     * @return mixed
     */
    public function getProcessedData()
    {
        return $this->processedData;
    }
}