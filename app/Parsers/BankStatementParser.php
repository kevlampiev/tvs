<?php


namespace App\Parsers;

use App\Parsers\BankDocument;


class BankStatementParser
{
    private $fieldsGlossary = [
//        'СекцияДокумент' => 'doctype',
        'Сумма' => 'amount',
        'ДатаСписано' => 'date_open',
        'Плательщик' => 'payer',
        'ПлательщикИНН' => 'payer_inn',
        'Получатель' => 'receiver',
        'ПолучательИНН' => 'receiver_inn',
        'НазначениеПлатежа' => 'description',
    ];
    protected $documents; // Свойство для хранения "отпарсенных" документов

    /**
     *
     */
    function __construct($fileaddr)
    {
        $maas = file($fileaddr);  // Открываем файл как массив строк
        setlocale(LC_CTYPE, 'ru_RU');
        $documents = [];

        foreach ($maas as $key => $value) {

            $value2 = rtrim($value);

            if (!mb_detect_encoding($value, 'UTF-8', TRUE))  {
                $value2 = mb_convert_encoding($value2, "utf-8", "windows-1251"); // Конвертируем значение в utf-8 так как изначальная кодировка файла windows-1251
            }

            $result = explode('=', $value2); // Разбиваем строку на Ключ => Значение
            if (count($result) == 2) { // Проверяем прошла ли разбивка
                if ($result[0] == 'СекцияДокумент') { //Если разбивка прошла и ключ результата СекцияДокумент то
                    $workflow = []; //Создаем новый подмассив
                }

                if (array_key_exists($result[0], $this->fieldsGlossary)) {
                    $workflow[$this->fieldsGlossary[$result[0]]] = $result[1];
                }

            } else { //Если разбивка не прошла
                if ($result[0] == 'КонецДокумента') { //То проверяем конец ли это документа
                    if (!isset($workflow['date_open'])) $workflow['date_open'] = date('d.m.Y');
                    $documents[] = $workflow;

                }
            }
        }
        $this->documents = $documents;

    }


    function getDocs() {
        return $this->documents; // Отдаем документы по запросу
    }

}
