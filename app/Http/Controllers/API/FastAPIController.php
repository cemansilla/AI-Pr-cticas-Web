<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FastAPIController extends Controller
{
  private $client;

  public function __construct(Client $client){
    $this->client = new Client();
  }

  public function image(Request $request)
  {
    $response = [
      'success' => false,
      'error_message' => "UNKNOWN"
    ];

    $prompt = $request->input('prompt');

    $data = [
      'prompt' => $prompt
    ];

    $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/image", [
      'json' => $data
    ]);

    if($api_response->getStatusCode() == 200){
      $stable_diffusion_response = json_decode($api_response->getBody()->getContents());

      $response = [
        'success' => true,
        'image' => env('API_PYTHON_BASE_URL') . "images/" . $stable_diffusion_response->file_name
      ];
    }

    return response()->json($response);
  }

  public function imageHandler(Request $request)
  {
    $response = [
      'success' => false,
      'error_message' => "UNKNOWN"
    ];

    $filename = $request->get('file_name');
    $remote_url = env('API_PYTHON_BASE_URL') . 'images/' . $filename;

    $response = [
      'success' => true,
      'image_url' => $remote_url,
      'filename' => $filename
    ];

    return response()->json($response);
  }

  public function chat(Request $request)
  {
    $response = [
      'success' => false,
      'error_message' => "UNKNOWN"
    ];

    $message = $request->input('message');

    $data = [
      'prompt' => $message
    ];

    $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/chat", [
      'json' => $data
    ]);

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
    $response = [
      'success' => false,
      'error_message' => 'UNKNOWN'
    ];

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

  public function voice(Request $request)
  {
    $response = [
      'success' => false,
      'error_message' => 'UNKNOWN'
    ];

    if($request->hasFile('audio_file') && $request->file('audio_file')->isValid()) {
      try{
        $folder = 'audio';
        $file = $request->file('audio_file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs($folder, $fileName);
        $fileContent = fopen(storage_path("app\\" . $filePath), 'r');

        $api_response = $this->client->post(env('API_PYTHON_BASE_URL') . "pyapi/audio", [
          'multipart' => [
            [
              'name' => 'file',
              'contents' => $fileContent,
            ],
            [
              'name' => 'file_name',
              'contents' => $fileName
            ],
          ]
        ]);

        if($api_response->getStatusCode() == 200){
          $message_response = $api_response->getBody()->getContents();
          $message_response = str_replace('"', '', $message_response);
          $message_response = trim($message_response);
          $message_response = str_replace("\n", "<br>", $message_response);

          $response = [
            'success' => true,
            'message' => $message_response
          ];
        }else{
          $response = [
            'success' => false,
            'error_message' => $api_response->getBody()->getContents()
          ];
        }
      }catch(\Exception $e){
        $response = [
          'success' => false,
          'error_message' => $e->getMessage()
        ];
      }
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
