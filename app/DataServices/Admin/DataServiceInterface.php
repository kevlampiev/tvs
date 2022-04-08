<?php


namespace App\DataServices\Admin;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Http\Request;

interface DataServiceInterface
{
    /*
     * Получение всез записей
     */
    public static function getAll();

    /*
     * Получение записей по отбору
    */
    public static function getSelected(Request $request);

    /*
     *  Обеспечение view всеми необходимыми данными, чтобы отредактировать запись о модели
    */
    public static function provideEditor(Model $model):array ;
    /*
     * Создание новой модели
    */
    public static function create(Request $request, Model $model):Model;
    /*
     * Запуск модели на редактирование
    */
    public static function edit(Request $request, Model $model);
    /*
     *Сохранение результатов редактирования или добавления
    */
    public static function saveChanges(Request $request, Model $model);
    /*
     * Сохранение новой модели в БД
    */
    public static function store(Request $request);
    /*
     * Обновление записи о модели в базе данных
     */
    public static function update(Request $request, Model $model);

    /*
     * Удаление модели
     */
    public static function delete(Model $model);


}
