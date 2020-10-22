<?php


namespace frontend\services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class YandexService
{
    const API_KEY = "37dcfea9-daf6-4b98-970f-208966a12141";
    const GEO_URL = "https://geocode-maps.yandex.ru/1.x/";

    public static function geoocode($url)
    {

        $client = new Client([
          'base_uri' => self::GEO_URL,
        ]);

        try {

            $response = $client->request('GET', '', [
              'query' => [
                'geocode' => $url,
                'apikey' => self::API_KEY,
                'format' => 'json',
                'results' => 1
              ]
            ]);

            $content = $response->getBody()->getContents();
            $response_data = json_decode($content, true);
            $result = $response_data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];


        } catch (RequestException $e) {
            $result = '0 0';
        }

        return $result;
    }
}