<?php


namespace App\Parsers;


class BankStatementParser
{
    private $dataSet = []; //исходный файл, раздербаненный на массив
    private $statementDate;
    private $fieldsGlossary = [
        'Сумма' => 'amount',
        'ДатаСписано' => 'date_open',
        'Плательщик' => 'payer',
        'Плательщик1' => 'payer',
        'ПлательщикИНН' => 'payer_inn',
        'Получатель' => 'receiver',
        'Получатель1' => 'receiver',
        'ПолучательИНН' => 'receiver_inn',
        'НазначениеПлатежа' => 'description',
    ];
    //Массив с глоссарием для всех переменных
    private $commonFields = [
        'ДатаКонца' => '',
    ];
    protected $documents; // Свойство для хранения "отпарсенных" документов


    /**
     *
     */
    function __construct($fileaddr)
    {
        $this->dataSet = file($fileaddr);  // Открываем файл как массив строк
        if ($this->fileIsValid()) {
            $this->documents = $this->preprocess();
        }
    }


    public function fileIsValid(): bool
    {
        $hasHeader = false;
        foreach ($this->dataSet as $key => $value) {
            if (trim($value) == '1CClientBankExchange') $hasHeader = true;
        }
        return $hasHeader;
    }

    //предварительная обработка файла, могут быть неправильные (неполняе) данные о проводках
    protected function preprocess(): array
    {
        $documents = []; //набор выписок

        foreach ($this->dataSet as $key => $value) {
            $result = $this->decodeString($value); // Разбиваем строку на Ключ => Значение
            if (count($result) == 2) { // Проверяем прошла ли разбивка
                if ($result[0] == 'СекцияДокумент') { //Если разбивка прошла и ключ результата СекцияДокумент то
                    $statementRecord = [];
                }

                //ЗАполняем поля массива документов
                if (array_key_exists($result[0], $this->fieldsGlossary)) {
                    $statementRecord[$this->fieldsGlossary[$result[0]]] = $result[1];
                }
                //Заполняем массив общих переменных
                if (array_key_exists($result[0], $this->commonFields)) {
                    $this->commonFields[$result[0]] = $result[1];
                }
            } else { //Если разбивка не прошла
                if ($result[0] == 'КонецДокумента') { //То проверяем конец ли это документа
                    $documents[] = $statementRecord ?? [];
                }
            }
        }

        return $this->cureData($documents);
    }

    /**
     *Переводит строку в массив "ключ-значение
     */
    private function decodeString(string $row): array
    {
        setlocale(LC_CTYPE, 'ru_RU');
        $row = trim($row);
        if (!mb_detect_encoding($row, 'UTF-8', TRUE)) {
            $row = mb_convert_encoding($row, "utf-8", "windows-1251"); // Конвертируем значение в utf-8 так как изначальная кодировка файла windows-1251
        }
        return explode('=', $row);
    }


    /**
     *Проверяет и "лечит" загруженные документы
     */
    private function cureData(array $arr): array
    {

        foreach ($arr as &$elem) {

            //если какое-то поле не определено, заменяем нулями
            foreach ($this->fieldsGlossary as $gloss) {
                if (!key_exists($gloss, $elem) || !isset($elem[$gloss]) || trim($elem[$gloss]) == '') {
                    $elem[$gloss] = 0;
                }
            }
            //отдельный случай - дата, ее меняем на дату окончания документов
            if (($elem['date_open'] == 0) || (trim($elem['date_open']) == '') || is_null($elem['date_open'])) {
                $elem['date_open'] = $this->commonFields['ДатаКонца'];
            }

        }
        return $arr;

    }

    public function getDocs()
    {
        return $this->documents;
    }

}
