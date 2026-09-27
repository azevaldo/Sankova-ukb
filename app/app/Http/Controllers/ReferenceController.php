<?php

 

namespace App\Http\Controllers;

use App\Services\IzipayService;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    protected $izipayService;

    public function __construct(IzipayService $izipayService)
    {
        $this->izipayService = $izipayService;
    }

    /**
     * Cria uma nova referência.
     */
    public function create(Request $request)
    {
        $data = [
            'numero' => null,
            'validade' => '18/02/2025 23:59',
            'montante' => '10000.00', // Utilize ponto como separador decimal
            'cliente' => [
                'nome' => 'Cliente não informado',
                'email' => 'cliente@example.com',
                'telefone' => '900000000',
            ],
            'metadados' => new \stdClass(), // Envie um objeto vazio em vez de um array vazio
        ];
        

        return $this->izipayService->createReference($data);
    }

    /**
     * Lista todas as referências.
     */
    public function list(Request $request)
    {
        $page = $request->query('page', 1);
        $pageSize = $request->query('pageSize', 50);

        return $this->izipayService->listReferences($page, $pageSize);
    }
}
