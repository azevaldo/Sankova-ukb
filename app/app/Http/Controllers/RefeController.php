<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class RefeController extends Controller
{

//get
public function listarPagamentos($page = 1, $pageSize = 50, $referencia = null)
{
    try {
        $queryParams = [
            'page' => $page,
            'pageSize' => $pageSize
        ];

     
        if ($referencia) {
            $queryParams['referencia'] = $referencia;
        }

        $queryString = http_build_query($queryParams);
        $uri = "https://api.izipay.ao/v1/pagamentos" . (!empty($queryString) ? "?{$queryString}" : "");

        $hmacSignature = $this->generateHmacSignature($uri, 'GET');


        return $this->corpoGet($uri,$hmacSignature);
                
    } catch (Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Erro interno no servidor',
            'error' => $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
    public function listarReferencias($page = 1, $pageSize = 50, $estado = null, $referencia = null)
    {
        try {
            $queryParams = [
                'page' => $page,
                'pageSize' => $pageSize
            ];
    
            if ($estado) {
                $queryParams['estado'] = "$estado";
            }
            if ($referencia) {
                $queryParams['referencia'] = $referencia;
            }
    
            $queryString = http_build_query($queryParams);
            $uri = "https://api.izipay.ao/v1/referencias" . (!empty($queryString) ? "?{$queryString}" : "");
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
            return $this->corpoGet($uri,$hmacSignature);
                
    } catch (Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Erro interno no servidor',
            'error' => $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    }


    public function listarNotificacoes($page = 1, $pageSize = 50, $estado = null)
    {
        try {
            $queryParams = [
                'page' => $page,
                'pageSize' => $pageSize
            ];
            
            
            if ($estado) {
                $queryParams['estado'] = $estado;
            }

    
            $queryString = http_build_query($queryParams);
            $uri = "https://api.izipay.ao/v1/notificacoes" . (!empty($queryString) ? "?{$queryString}" : "");
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
            return $this->corpoGet($uri,$hmacSignature);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
    
    public function detalhar($id)
    {
        try {
            $uri = "https://api.izipay.ao/v1/referencias/{$id}";
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
           
    
            return $this->corpoGet($uri,$hmacSignature);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    public function detalharPagamento($id)
    {
        try {
            $uri = "https://api.izipay.ao/v1/pagamentos/{$id}";
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
           
    
            return $this->corpoGet($uri,$hmacSignature);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    //https://api.izipay.ao/v1/referencias/{numero}/testar
    
    public function verificarReferencia($id)
    {
        try {
            $uri = "https://api.izipay.ao/v1/referencias/{$id}/testar";
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
            
    
            return $this->corpoGet($uri,$hmacSignature);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
    public function historico2($id)
    {
        try {
            $uri = "https://api.izipay.ao/v1/referencias/{$id}/historico";
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
            
    
            $ch = curl_init($uri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Apikey ' . $hmacSignature,
                'Content-Type: application/json'
            ]);
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }
    
            curl_close($ch);
    
            return $this->retorno($httpCode,$response);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    } 
    public function historico($id)
    {
        try {
            $uri = "https://api.izipay.ao/v1/referencias/{$id}/historico";
    
            $hmacSignature = $this->generateHmacSignature($uri, 'GET');
    
     
            return $this->corpoGet($uri,$hmacSignature);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
    private function corpoGet($uri,$hmacSignature){

    try{
        
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Apikey ' . $hmacSignature,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $this->retorno($httpCode,$response);
            
    } catch (Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Erro interno no servidor',
            'error' => $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    }
private function retorno($httpCode,$response){
    $responseData = json_decode($response, true);
    
    switch ($httpCode) {
        case 200:
            return response()->json([
                'status' => 200,
                'message' => 'Dados recuperados com sucesso',
                'data' => $responseData
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        case 201:
            return response()->json([
                'status' => 201,
                'message' => 'Referência criada com sucesso',
                'data' => $responseData
            ], 201, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        case 400:
            return response()->json([
                'status' => 400,
                'message' => 'Requisição inválida',
                'error' => $responseData
            ], 400, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        case 401:
            return response()->json([
                'status' => 401,
                'message' => 'Não autorizado',
                'error' => $responseData
            ], 401, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        case 402:
            return response()->json([
                'status' => 402,
                'message' => 'Conta inadimplente',
                'error' => $responseData
            ], 402, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        case 500:
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $responseData
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        default:
            return response()->json([
                'status' => $httpCode,
                'message' => 'Erro inesperado',
                'error' => $responseData
            ], $httpCode, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}
    public function notificacaoEstado($id)
{
    try {
        $uri = "https://api.izipay.ao/v1/notificacoes/{$id}";

        $hmacSignature = $this->generateHmacSignature($uri, 'PUT');

        

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Apikey ' . $hmacSignature,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $this->retorno($httpCode,$response);
                
    } catch (Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Erro interno no servidor',
            'error' => $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
    //
    public function cancelarReferencia($id)
{
    try {
        $uri = "https://api.izipay.ao/v1/referencias/{$id}";

        $hmacSignature = $this->generateHmacSignature($uri, 'DELETE');

        echo "Generated HMAC Signature: " . $hmacSignature . "\n";
        echo "Sending request to: " . $uri . "\n";

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Apikey ' . $hmacSignature,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return $this->retorno($httpCode,$response);
                
    } catch (Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Erro interno no servidor',
            'error' => $e->getMessage()
        ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}


    
    public function criar()
    {
        try {
            $uri = "https://api.izipay.ao/v1/referencias";
            $referenceRequest = [
                'montante' => 200,
                'validade' => date('Y-m-d\TH:i:s\Z', strtotime('+10 minutes'))
            ];
    
            $jsonBody = json_encode($referenceRequest, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $hmacSignature = $this->generateHmacSignature($uri, 'POST', $jsonBody);
    
            $ch = curl_init($uri);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Apikey ' . $hmacSignature,
                'Content-Type: application/json'
            ]);
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                return response()->json([
                    'status' => 500,
                    'message' => 'Erro na comunicação com a API',
                    'error' => $error
                ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
    
            curl_close($ch);
            return $this->retorno($httpCode,$response);
                
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro interno no servidor',
                'error' => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
    
    private function generateHmacSignature($uri, $method, $body = null)
    {
 
        $appId = "1e95b03b55a3412987f8a909397fc15a" ;
        $appSecret = base64_decode("y8mesmoCt36q6QA/aWGxyxQTcOpaVQYHzIBJIXJz9LI");

        $content = '';
        $nonce = bin2hex(random_bytes(16));
        $timeStamp = time();

        if ($body !== null) {
            $bodyHash = md5($body, true);
            $content = base64_encode($bodyHash);
        }

        $message = "{$appId}{$method}{$uri}{$timeStamp}{$nonce}{$content}";
        $signature = hash_hmac('sha256', $message, $appSecret, true);
        $hashed = base64_encode($signature);

        return "{$appId}:{$hashed}:{$nonce}:{$timeStamp}";
    }
}
