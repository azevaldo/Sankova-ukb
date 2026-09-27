<?php

 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

class IzipayService
{
    protected $appId;
    protected $appSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->appId = env('IZIPAY_APP_ID');
        $this->appSecret = env('IZIPAY_APP_SECRET');
        $this->baseUrl = env('IZIPAY_BASE_URL');
    }

    /**
     * Gera a assinatura HMAC para autenticação.
     */
// Função para gerar a assinatura HMAC
protected function generateHmac($uri, $method, $body = '')
{
    $timestamp = time(); // Timestamp atual em formato UNIX
    $nonce = bin2hex(random_bytes(8)); // Gera um valor aleatório (nonce)
    $bodyMd5 = '';

    if (!empty($body)) {
        $bodyMd5 = base64_encode(md5($body, true)); // Hash MD5 do corpo da requisição
    }
    // String a ser assinada
    $stringToSign = $this->appId . $method . $nonce . $uri . $timestamp . $bodyMd5;

    // Gerando a assinatura com HMAC-SHA256
    $signature = base64_encode(hash_hmac('sha256', $stringToSign, base64_decode($this->appSecret), true));

    // Retorna o cabeçalho Authorization completo
    return sprintf('ApiKey %s:%s:%s:%s', $this->appId, $signature, $nonce, $timestamp);
}

    
    
    public function createReference($data)
    {
        $uri = '/v1/referencias';
        $method = 'POST';
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); // Garantir JSON válido
        $authorizationHeader = $this->generateHmac($uri, $method, $body);
        $response = Http::withHeaders([
            'Authorization' => $authorizationHeader,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . $uri, $data);
    
         Log::info('Debug HMAC', [
            'appId' => $this->appId,
            'appSecret' => $this->appSecret,
            'uri' => $uri,
            'method' => $method,
            'hmac' => $authorizationHeader,
            'body' => $body
        ]);
        

        if ($response->successful()) {
            return response()->json($response->json(), 201);
        } elseif ($response->status() == 422) {
            return response()->json(['errors' => $response->json()], 422);
        } else {
            return response()->json([
                'error' => 'Erro ao processar a requisicao',
                'detalhes' => $response->body(),
                'codigo' => $response->status()
            ], $response->status());
        }
    }
    

    

    /**
     * Cria uma referência de pagamento.
     */
    public function createReference2($data)
    {
        $uri = '/v1/referencias';
        $method = 'POST';
    
        // Converter o montante para o formato correto (removendo vírgulas e espaços)
        $data['montante'] = number_format(floatval(str_replace(',', '.', $data['montante'])), 2, '.', '');
    
        // Converter validade para formato ISO 8601
        $data['validade'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $data['validade'])->toIso8601String();
    
        $body = json_encode($data);
    
        $response = Http::withHeaders([
            'Authorization' => $this->generateHmac($uri, $method, $body),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . $uri, $data);
    
        // Log detalhado para debug
        Log::info('Requisição para IziPay', [
            'url' => $this->baseUrl . $uri,
            'headers' => [
                'Authorization' => $this->generateHmac($uri, $method, $body),
                'Content-Type' => 'application/json'
            ],
            'body' => $body
        ]);
    
        if ($response->successful()) {
            return response()->json($response->json(), 201);
        } else {
            Log::error('Erro ao autenticar na API IziPay', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers()
            ]);
            return response()->json([
                'error' => 'Erro ao processar a requisicao',
                'detalhes' => $response->body(),
                'codigo' => $response->status()
            ], $response->status());
        }
    }
    
    

    /**
     * Lista todas as referências.
     */
    public function listReferences($page = 1, $pageSize = 50)
    {
        $uri = '/v1/referencias';
        $method = 'GET';

        $authorization = $this->generateHmac($uri, $method);

        if (!$authorization) {
            return response()->json(['error' => 'Falha ao gerar autenticação'], 500);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $authorization,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . $uri, [
                'page' => $page,
                'pageSize' => $pageSize,
            ]);

            Log::info('Resposta da API (Listagem): ' . $response->body());

            return response()->json($response->json(), $response->status());
        } catch (Exception $e) {
            Log::error('Erro ao listar referências: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }
}
