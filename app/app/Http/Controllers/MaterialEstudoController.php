<?php
namespace App\Http\Controllers;

use App\Models\Material_estudo;
use App\Models\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MaterialEstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        try {
            $topico = Topico::findOrFail($id);
    
            // Listando todos os materiais de estudo
            $materiais = $topico->materialEstudos()->paginate(10);
            $nMat = $topico->materialEstudos()->count();
            $consulta = "Busca por todos";
    
            return view('app.office.material_estudos.index', compact("consulta", "topico", "materiais", "nMat"));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar materiais de estudo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao carregar os materiais de estudo: ' . $e->getMessage());
        }
    }
    
    public function pesquisaNome(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'topico_id' => 'required|exists:topicos,id',
            ]);
    
            $topico = Topico::findOrFail($request->topico_id);
            $materiais = $topico->materialEstudos()
                ->where("subtema", "like", "%" . $request->nome . "%")
                ->paginate(10);
    
            $nMat = $topico->materialEstudos()
                ->where("subtema", "like", "%" . $request->nome . "%")
                ->count();
    
            $consulta = "Busca por Subtema: " . $request->nome;
            $materiais ->appends(['nome' => $request->nome,'topico_id'=>$request->topico_id]);
            return view('app.office.material_estudos.index', compact("consulta", "topico", "materiais", "nMat"));
        } catch (\Exception $e) {
            Log::error("Erro ao pesquisar material de estudo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao buscar materiais de estudo: ' . $e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validação dos campos
            $request->validate([
                'subtema' => 'required|string|min:3|max:255',
                'doc' => 'required|mimes:pdf', // Permitindo apenas arquivos PDF com até 10MB
                'topico_id' => 'required|exists:topicos,id',
            ]); 
 

            if ($request->hasFile('doc')) {
                $extensao = $request->doc->extension();
                $nomeDoc = strtotime("now") . "." . $extensao;
                $request->doc->move(public_path("/materials"), $nomeDoc);
                $path =  $nomeDoc; // caminho do arquivo
            }

             
            // Salvando as informações no banco de dados
            Material_estudo::create([
                'subtema' => $request->subtema,
                'doc' => $path,  // Salvando o caminho do arquivo PDF
                'topico_id' => $request->topico_id,
            ]);

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Material de estudo criado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao criar material de estudo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validação dos campos
            $request->validate([
                'subtema' => 'required|string|min:3|max:255',
                'doc' => 'nullable|mimes:pdf', // Permitindo apenas arquivos PDF com até 10MB, mas agora é opcional
               
            ]);
    
            // Localizando o material de estudo pelo ID
            $material = Material_estudo::findOrFail($id);
    
            // Verifica se o usuário enviou um novo arquivo e faz o upload
            if ($request->hasFile('doc')) {
                // Apagar o arquivo antigo, se existir
                if (file_exists(public_path("/materials/" . $material->doc))) {
                    unlink(public_path("/materials/" . $material->doc));
                }
    
                // Realiza o upload do novo arquivo
                $extensao = $request->doc->extension();
                $nomeDoc = strtotime("now") . "." . $extensao;
                $request->doc->move(public_path("/materials"), $nomeDoc);
                $path =  $nomeDoc; // Novo caminho do arquivo
            } else {
                // Se não enviar novo arquivo, mantém o antigo
                $path = $material->doc;
            }
    
            // Atualiza as informações no banco de dados
            $material->update([
                'subtema' => $request->subtema,
                'doc' => $path,  // Atualizando o caminho do arquivo (se necessário)
                
            ]);
    
            // Redireciona com sucesso
            return redirect()->back()
                ->with('success', 'Material de estudo atualizado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao atualizar material de estudo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Encontrar o material de estudo
            $materialEstudo = Material_estudo::findOrFail($id);

            // Deletar o arquivo associado, se existir
            if (Storage::exists($materialEstudo->doc)) {
                Storage::delete($materialEstudo->doc);
            }

            // Deletar o material de estudo do banco de dados
            $materialEstudo->delete();

            // Redireciona com sucesso
            return redirect()->back()->with('success', 'Material de estudo deletado com sucesso!');
        } catch (\Exception $e) {
            // Caso ocorra um erro, loga e retorna com erro
            Log::error("Erro ao deletar material de estudo: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());
        }
    }
}
