<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    private $results = [];

    public function index()
    {
        return view('scraper.autoria');
    }

    public function scraper(Request $request)
    {
        $data = $request->all();
        $client = new Client();
        //$url = 'https://auto.ria.com/uk/legkovie/?page=1';
        if (!empty($data['engine'])) {
            $url = "https://auto.ria.com/uk/search/?indexName=auto,order_auto,newauto_search&categories.main.id=1&brand.id[0]={$data['id_car']}&model.id[0]={$data['id_model']}&engine.gte={$data['engine']}";
            if (!empty($data['engineL'])) {
                $url .= "&engine.lte={$data['engineL']}";
                if (!empty($data['yearG'] || !empty($data['yearL']))) {
                    $url .= "&year[0].gte={$data['yearG']}&year[0].lte={$data['yearL']}";
                }
            }
            if (!empty($data['yearG'] || !empty($data['yearL']))) {
                $url .= "&year[0].gte={$data['yearG']}&year[0].lte={$data['yearL']}";
            }
        }
        elseif ($data['model']) {
            $url = "https://auto.ria.com/uk/legkovie/{$data['car']}/{$data['model']}/";
            if (!empty($data['yearG'] || !empty($data['yearL']))) {
                $url = "https://auto.ria.com/uk/search/?indexName=auto,order_auto,newauto_search&categories.main.id=1&brand.id[0]={$data['id_car']}&model.id[0]={$data['id_model']}&year[0].gte={$data['yearG']}&year[0].lte={$data['yearL']}&size=100";
            }
        }
        else {
            if (!empty($data['yearG']) || !empty($data['yearL'])) {
                $url = "https://auto.ria.com/uk/search/?indexName=auto,order_auto,newauto_search&categories.main.id=1&brand.id[0]={$data['id_car']}&year[0].gte={$data['yearG']}&year[0].lte={$data['yearL']}&size=100";

            }
            else {

                $url = "https://auto.ria.com/uk/legkovie/{$data['car']}/";
            }
        }
        $response = $client->request('GET', $url);

        $response->filter('.content')->each(function ($item) {
            $this->results[$item->filter('.ticket-title')->text()] = $item->filter('.item-char')->each(function ($node) {
                return $node->text();
            });
        });
        $cars = $this->results;
        $html = view('content.cars')->with('cars', $cars)->renderSections()['cars'];
        return response()->json(['html' => $html]);
    }

    public function getModel(Request $request)
    {
        $data = $request->all();
        $models = [
            'BMW' => [
                'M4' => [
                    'id' => 44857,
                ],
                'M3' => [
                    'id' => 3292,
                ],
                'M2' => [
                    'id' => 44856,
                ],
            ],
            'Subaru' => [
                'Forester' => [
                    'id' => 663,
                ],
                'Imprezza' => [
                    'id' => 664,
                ],
                'WRX STI' => [
                    'id' => 59651,
                ],
            ],
            'VAZ' => [
                '2115' => [
                    'id' => 861,
                ],
                '2108' => [
                    'id' => 853,
                ],
                '2106' => [
                    'id' => 851,
                ],
            ],
        ];
        if ($data['car'] === 'bmw')
        {
            return response()->json($models['BMW']);
        }
        elseif ($data['car'] === 'subaru')
        {
            return response()->json($models['Subaru']);
        }if ($data['car'] === 'vaz')
        {
            return response()->json($models['VAZ']);
        }
    }

    public function findByDate($url, $yearG = 0, $yearL = 0)
    {
        $url .= "&year[0].gte={$yearG}&year[0].lte={$yearL}";
        return $url;
    }
}
