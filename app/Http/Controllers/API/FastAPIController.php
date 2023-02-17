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

  public function brainstorming(Request $request)
  {
    $objetivo = $request->input('objetivo');
    $destino = $request->input('destino');
    $excluir = $request->input('excluir');

    if(!is_null($objetivo)){
      $message = $objetivo;

      if(!is_null($destino)){
        switch($destino){
          case "instagram":
          case "facebook":
            $message .= " Debe estar enfocado a {$destino}.";
          break;

          case "ppt":
            $message .= " La propuesta será volcada a un Power Point, necesito que me lo separes en diapositivas.";
          break;

          case "html":
            $message .= " La propuesta será utilizada en una web HTML, necesito el código del body, sin incluir el head ni el propio body.";
          break;

          case "obsidian":
            $message .= " La respuesta debe estar en formato markdown.";
          break;
        }
      }

      if(!is_null($excluir)){
        $message .= " Excluir los siguientes conceptos: {$excluir}.";
      }

      $data = [
        'prompt' => $message
      ];
  
      $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/chat", [
        'json' => $data
      ]);
  
      $response = [
        'success' => false,
        'error_message' => 'UNKNOWN'
      ];
      if($api_response->getStatusCode() == 200){
        $message_response = $api_response->getBody()->getContents();
        $message_response = str_replace('"', '', $message_response);
        $message_response = trim($message_response);
        $message_response = str_replace("\n", "<br>", $message_response);

        $response = [
          'success' => true,
          'message' => $message_response
        ];
      }
    }else{
      $response = [
        'success' => false,
        'error_message' => 'El disparador o concepto es requerido.'
      ];
    }

    return response()->json($response);
  }

  public function obsidian(Request $request)
  {
    $materia = $request->input('materia');
    $temas = $request->input('temas');

    if(!is_null($materia) && !is_null($temas)){
      $message = "Generar un resúmen para la materia {$materia}.";
      $message .= " Debe incluir los temas: {$temas}.";
      $message .= " La respuesta debe estar en formato markdown. Estructurarlo divido por temas, con links internos a cada uno. Los links deben estar en una tabla de contenidos.";

      $data = [
        'prompt' => $message
      ];
  
      $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/chat", [
        'json' => $data
      ]);
  
      $response = [
        'success' => false,
        'error_message' => 'UNKNOWN'
      ];
      if($api_response->getStatusCode() == 200){
        $message_response = $api_response->getBody()->getContents();
        $message_response = str_replace('"', '', $message_response);
        $message_response = trim($message_response);
        $message_response = str_replace("\n", "<br>", $message_response);

        $response = [
          'success' => true,
          'message' => $message_response
        ];
      }
    }else{
      $response = [
        'success' => false,
        'error_message' => 'La materia y el tema son requeridos.'
      ];
    }

    return response()->json($response);
  }
}
