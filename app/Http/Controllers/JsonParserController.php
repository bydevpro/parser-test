<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JsonParserController extends Controller
{
    //Задание 1.
    public function index()
    {
        $response = Http::get('https://u0362146.plsk.regruhosting.ru/api');
        //переменная для заполнения нужными данными
        $request = array("summPrice" => 0, "uniqueWarehouse" => array());

        //цикл для обхода статуса 429 - слишком много запросов
        while ($response->status() == 429) {
            //ожидание в 3 секунды, что бы не перегружать сервер
            sleep(3);
            //повтор запроса 
            $response = Http::get('https://u0362146.plsk.regruhosting.ru/api');
        }

        //декодируем ответ в массив
        $data = $response->json();

        //перебираем массив полученных данных
        foreach ($data as $item) {
            //заполняем поля нашего массива. Здесь суммируем показатели Price
            $request['summPrice'] = $request['summPrice'] + $item['Price'];
            //Собираем в массив склады
            $request['uniqueWarehouse'][] = $item['warehouseName'];
        }
        /*кодируем массив в json. параметр JSON_UNESCAPED_UNICODE
         нужен для читаемого отбражения кириллических символов */
        $request = json_encode($request, JSON_UNESCAPED_UNICODE);

        //использовалось для консольной проверки запросов
        //echo "<script>console.log('{$request}' );</script>";
        //выводим наш json в шаблоне
        return view('index', compact('request'));
    }
}