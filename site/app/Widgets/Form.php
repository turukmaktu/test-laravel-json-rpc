<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Form extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(Request $request)
    {
        $error = false;
        $data = false;
        $errorMessage = false;

        if(!isset($this->config['page_uid'])){
            $error = true;
            $errorMessage = 'not set page_uid';
        }else{

            if($request->get('page_uid')){

                $fildsRequest = [];

                collect($request)->map(function($param, $field) use (&$fildsRequest){
                    if(!in_array($field,['_token','page_uid'])){
                        $fildsRequest[$field] = $param ? $param : '';
                    }
                });

                $response = Http::post('http://data.test/api/v1/endpoint',[
                    'jsonrpc' => '2.0',
                    'method' => 'form@saveForm',
                    'params' => [
                        'page_uid' => $this->config['page_uid'],
                        'fields' => $fildsRequest
                    ],
                    'id' => 1
                ]);

            }else{
                $response = Http::post('http://data.test/api/v1/endpoint',[
                    'jsonrpc' => '2.0',
                    'method' => 'form@getForm',
                    'params' => [
                        'page_uid' => $this->config['page_uid']
                    ],
                    'id' => 1
                ]);
            }

            if($response->status() == 200){

                $dataResult = $response->json();

                if(isset($data['error'])){
                    $error = true;
                    $errorMessage = $dataResult['error']['message'];
                }else{

                    $fieldsDatta = [];

                    collect($dataResult['result'])->map(function($result) use (&$fieldsDatta){
                        collect($result)->map(function($item, $key) use (&$fieldsDatta){
                            $fieldsDatta[] = [ 'CODE' => $key, 'VALUE' => $item];
                        });
                    });

                    $data['FIELDS'] = $fieldsDatta;
                    $data['PAGE_UID'] = $this->config['page_uid'];

                }

            }else{
                $error = true;
                $errorMessage = 'server site.test not available';
            }

        }

        return view('widgets.form', [
            'error' => $error,
            'errorMessage' => $errorMessage,
            'data' => $data
        ]);
    }
}
