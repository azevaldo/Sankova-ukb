<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatGptController extends Controller
{
    //
    public function recomendacao(){
        try{
        return view('app.geral.cliente.recomendar');
    } catch (\Exception $e) {
        return back()->with('error', 'Ocorreu um erro  : ' . $e->getMessage());
    }
    }
    
    public function recomendarCurso(Request $request)
{
    try {
        // Validação das entradas de dados
        $request->validate([
            'gostos' => ['required', 'regex:/^(?!\s*$).+/'],
            'habilidades' => ['required', 'regex:/^(?!\s*$).+/'],
            'interesses' => ['required', 'regex:/^(?!\s*$).+/'],
        ], [
            'gostos.required' => 'O campo Gostos é obrigatório.',
            'gostos.regex' => 'O campo Gostos não pode conter apenas espaços.',
            'habilidades.required' => 'O campo Habilidades é obrigatório.',
            'habilidades.regex' => 'O campo Habilidades não pode conter apenas espaços.',
            'interesses.required' => 'O campo Interesses é obrigatório.',
            'interesses.regex' => 'O campo Interesses não pode conter apenas espaços.',
        ]);

        // Captura e sanitiza as variáveis
        $gostos = $this->sanitizeInput($request->input('gostos'));
        $habilidades = $this->sanitizeInput($request->input('habilidades'));
        $interesses = $this->sanitizeInput($request->input('interesses'));

        // Criação do prompt
        $prompt = $this->createPrompt($gostos, $habilidades, $interesses);

        // Envio da requisição para o OpenRouter
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo',
            'messages' => [['role' => 'user', 'content' => $prompt]],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

        // Verifica se a requisição falhou
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Erro ao obter recomendações. Tente novamente mais tarde.')->withInput();
        }

        // Processa a resposta
        $resposta = $response->json()['choices'][0]['message']['content'] ?? 'Não foi possível obter recomendações no momento.';
        
        return redirect()->back()->with('resposta', $resposta)->withInput();
    } catch (ConnectionException $e) {
        return redirect()->back()->with('error', 'Erro de conexão! Verifique sua internet e tente novamente.')->withInput();
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro inesperado. Tente novamente mais tarde.')->withInput();
    }
}

    // Função para sanitizar as entradas
    private function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function createPrompt($gostos, $habilidades, $interesses)
{
    return "
    Com base nas seguintes informações fornecidas pelo usuário, recomende ao menos 3 cursos universitários adequados para serem feitos na universidade. 
    Por favor, siga as instruções abaixo e forneça justificativas detalhadas para cada recomendação.

    1. Gostos: $gostos
    2. Habilidades: $habilidades
    3. Interesses: $interesses

    **Instruções para análise**:
    - **Análise de Coerência e Clareza**: Verifique se as informações fornecidas fazem sentido e são claras em português. Se encontrar palavras irreconhecíveis, sequências de letras sem significado claro (como 'jksfuiduhgsghsfi') ou frases desconexas, **não forneça recomendações**. Em vez disso, avise o usuário de que as informações fornecidas não são claras o suficiente e que ele deve fornecer dados mais específicos e estruturados.
    - **Identificação de Palavras-chave em Português**: Extraia palavras-chave relevantes em português para cada categoria. Se as palavras não forem compreensíveis ou tiverem um significado vago ou irreal, **não faça recomendações** e oriente o usuário a melhorar a clareza das informações.
    - **Justificativa Detalhada**: Para cada curso universitário recomendado, forneça uma explicação detalhada sobre por que esse curso seria uma boa escolha. Considere as tendências atuais de mercado, as oportunidades de crescimento e o alinhamento com os gostos, habilidades e interesses mencionados. Seja específico e evite sugestões vagas ou genéricas.
    - **Evitar Recomendações Incoerentes**: Se a combinação de gostos, habilidades e interesses não tiver relação clara com áreas de estudo universitário, ou se parecer que não existe uma correspondência lógica, avise ao usuário que não é possível recomendar cursos neste caso.

    Lembre-se de que as recomendações devem ser práticas e realistas, considerando as tendências atuais do mercado de trabalho e, principalmente, cursos oferecidos pela universidade. Se algum dado fornecido não for claro o suficiente ou não fizer sentido, mencione isso diretamente e sugira que o usuário forneça informações mais específicas ou esclarecedoras. Se as informações não forem claras ou tiverem palavras irreconhecíveis, explique isso educadamente.";
}

    // Função para criar o prompt de maneira clara e estruturada
    private function createPrompt2($gostos, $habilidades, $interesses)
    {
        return "
        Com base nas seguintes informações fornecidas pelo usuário, recomende ao menos 3 cursos adequados. 
        Por favor, siga as instruções abaixo e forneça justificativas detalhadas para cada recomendação.
    
        1. Gostos: $gostos
        2. Habilidades: $habilidades
        3. Interesses: $interesses
    
        **Instruções para análise**:
        - **Análise de Coerência e Clareza**: Verifique se as informações fornecidas fazem sentido e são claras em português. Se encontrar palavras irreconhecíveis, sequências de letras sem significado claro (como 'jksfuiduhgsghsfi') ou frases desconexas, **não forneça recomendações**. Em vez disso, avise o usuário de que as informações fornecidas não são claras o suficiente e que ele deve fornecer dados mais específicos e estruturados.
        - **Identificação de Palavras-chave em Português**: Extraia palavras-chave relevantes em português para cada categoria. Se as palavras não forem compreensíveis ou tiverem um significado vago ou irreal, **não faça recomendações** e oriente o usuário a melhorar a clareza das informações.
        - **Justificativa Detalhada**: Para cada curso recomendado, forneça uma explicação detalhada sobre por que esse curso seria uma boa escolha. Considere as tendências atuais de mercado, as oportunidades de crescimento e o alinhamento com os gostos, habilidades e interesses mencionados. Seja específico e evite sugestões vagas ou genéricas.
        - **Evitar Recomendações Incoerentes**: Se a combinação de gostos, habilidades e interesses não tiver relação clara com áreas de estudo, ou se parecer que não existe uma correspondência lógica, avise ao usuário que não é possível recomendar cursos neste caso.
    
        Lembre-se de que as recomendações devem ser práticas e realistas, considerando as tendências atuais do mercado de trabalho. Se algum dado fornecido não for claro o suficiente ou não fizer sentido, mencione isso diretamente e sugira que o usuário forneça informações mais específicas ou esclarecedoras. Se as informações não forem claras ou tiverem palavras irreconhecíveis, explique isso educadamente.";
    }
}

