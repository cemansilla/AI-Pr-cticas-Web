<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FastAPIController extends Controller
{
  private $client;

  public function __construct(Client $client){
    $this->client = new Client();
  }

  public function chat(Request $request)
  {
    $message = $request->input('message');

    $data = [
      'prompt' => $message
    ];

    $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/chat", [
      'json' => $data
    ]);

    $response = [
      'success' => false
    ];
    if($api_response->getStatusCode() == 200){
      $response = [
        'success' => true,
        'message' => $api_response->getBody()->getContents()
      ];
    }

    return response()->json($response);
  }
}
