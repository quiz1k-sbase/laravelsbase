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
        $url = "https://auto.ria.com/uk/search/?indexName=auto,order_auto,newauto_search&categories.main.id=1";
        if(!empty($data))
        {
            if (!empty($data['car']))
            {
                $url .= "&brand.id[0]={$data['id_car']}";
            }
            if (!empty($data['model'])) {
                $url .= "&model.id[0]={$data['id_model']}";
            }
            if (!empty($data['engine'])) {
                $url .= "&engine.gte={$data['engine']}";
            }
            if (!empty($data['engineL'])) {
                $url .= "&engine.lte={$data['engineL']}";
            }
            if (!empty($data['engineL'])) {
                $url .= "&year[0].lte={$data['yearL']}";
            }
            if (!empty($data['yearG']) || !empty($data['yearL'])) {
                $url .= "&year[0].gte={$data['yearG']}&year[0].lte={$data['yearL']}";
            }
            $url .= "&country.import.usa.not=-1&price.currency=1&abroad.not=0&custom.not=1&page=0&size=100";
        }

        $response = $client->request('GET', $url);

        $response->filter('.ticket-item')->each(function ($item) {
            $this->results[] =  [
                'title' => $item->filter('.ticket-title')->text(),
                'description' => $item->filter('.item-char')->each(function ($node) {
                    return $node->text();
                }),
                'href' => $item->filter('.m-link-ticket')->getNode(0)->getAttribute('href'),
                'img' => $item->filter('img')->getNode(0)->getAttribute('src'),
                'price' => $item->filter('.green')->text(),
            ];
        });

        $cars = $this->results;

        foreach ($cars as $car => $val) {
            $url = $val['href'];
            $item = $client->request('GET', $url);
            $html = $item->filter('.history-car');
            $empty = $html->count() ? $html->html() : 0;
            if (!empty($empty)) {
                $cars[$car] += [
                    'vin' => $empty,
                ];
            }
            else {
                $cars[$car] += [
                    'vin' => 'No data found',
                ];
            }
        }

        $html = view('content.cars')->with(['cars' => $cars])->renderSections()['cars'];
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
                '2101' => [
                    'id' => 846,
                ],
                '2102' => [
                    'id' => 847,
                ],
                '2103' => [
                    'id' => 848,
                ],
                '2104' => [
                    'id' => 849,
                ],
                '2105' => [
                    'id' => 850,
                ],
                '2106' => [
                    'id' => 851,
                ],
                '2107' => [
                    'id' => 852,
                ],
                '2108' => [
                    'id' => 853,
                ],
                '2109' => [
                    'id' => 854,
                ],
                '2110' => [
                    'id' => 856,
                ],
                '2111' => [
                    'id' => 857,
                ],
                '2112' => [
                    'id' => 858,
                ],
                '2113' => [
                    'id' => 859,
                ],
                '2114' => [
                    'id' => 860,
                ],
                '2115' => [
                    'id' => 861,
                ],
                '2120 Надежда' => [
                    'id' => 862,
                ],
                '2121' => [
                    'id' => 863,
                ],
                '21213' => [
                    'id' => 29496,
                ],
                '21214' => [
                    'id' => 53490,
                ],
                '2123' => [
                    'id' => 865,
                ],
                '2131' => [
                    'id' => 864,
                ],
                '2170' => [
                    'id' => 31636,
                ],
                '2171' => [
                    'id' => 32632,
                ],
                '2172' => [
                    'id' => 2547,
                ],
                '2190' => [
                    'id' => 37962,
                ],
                '2345' => [
                    'id' => 60849,
                ],
                'Granta' => [
                    'id' => 45653,
                ],
                'Kalina' => [
                    'id' => 2168,
                ],
                'Priora' => [
                    'id' => 2665,
                ],
                'Samara' => [
                    'id' => 34812,
                ],
                'Нива' => [
                    'id' => 34811,
                ],
                'Ока' => [
                    'id' => 868,
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
}
