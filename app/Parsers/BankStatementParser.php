<?php


namespace App\Parsers;

use App\Parsers\BankDocument;


class BankStatementParser
{
    protected $documents; // Свойство для хранения "отпарсенных" документов
    //Конструктор принимает на вход путь к файлу
    function __construct($fileaddr) {
        $maas = file($fileaddr); // Открываем файл как массив строк
        $documents = []; // Создаем пустой массив для хранения документов
        $docid = 0; // Устанавливаем счетчик ID документа на 0
        foreach ($maas as $key => $value) { //Начинаем парсить каждую строку
            $value2 = rtrim($value); // Тримируем правую сторону строки от управляющих символов
            $value2 = mb_convert_encoding($value2, "utf-8", "windows-1251"); // Конвертируем значение в utf-8 так как изначальная кодировка файла windows-1251
            $result = explode('=', $value2); // Разбиваем строку на Ключ => Значение
            if (count($result) == 2) { // Проверяем прошла ли разбивка
                if ($result[0] == 'СекцияДокумент') { //Если разбивка прошла и ключ результата СекцияДокумент то
                    $workflow = new BankDocument(); //Создаем новый Объект
                }
                if (isset($workflow)) { //Если объект создан то
                    $workflow->set($result[0], $result[1]); // Назначаем Свойство, Содержимое
                }
            } else { //Если разбивка не прошла
                if ($result[0] == 'КонецДокумента') { //То проверяем конец ли это документа
                    $documents[$docid] = $workflow; //Добавляем в массив документов новый документ
                    $docid++; //Плюсуем счетчик
                }
            }
        }
        $this->documents = $documents; // Передаем массив документов в Свойство класса
    }

    function getDocs() {
        return $this->documents; // Отдаем документы по запросу
    }

}
