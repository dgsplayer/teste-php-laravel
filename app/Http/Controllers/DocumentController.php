<?php
/**
 * Controller responsável para importação e processamento de arquivo JSON
 *
 * PHP version 8.1
 *
 * @category  PHP
 * @author    Douglas Campos <douglasmpcampos@gmail.com>
 * @copyright AI Solutions 2023
 * @version   1.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document; 
use Illuminate\Support\Carbon;

class DocumentController extends Controller
{
    public function import(Request $request)
    {
        // Validação do arquivo JSON
        $request->validate([
            'json_file' => 'required|file|mimes:json',
        ], [
            'json_file.mimes' => 'O arquivo deve ser um JSON válido.',
        ]);

        // Lê o conteúdo do arquivo JSON
        $jsonContent = file_get_contents($request->file('json_file')->getPathname());

        // Decodifica o JSON para uma array associativa
        $data = json_decode($jsonContent, true);
  
        // Loop
        foreach ($data['documentos'] as $documento) {
            
            $categoria = 3; // importa como parcial
            $titulo = $documento['titulo'];
            $conteudo = $documento['conteúdo']; 

            // Construção
            $document = new Document();
            $document->created_at = now();
            $document->category_id =  $categoria;
            $document->title = $titulo;
            $document->contents = $conteudo;
            $document->save();
        }

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Importado com sucesso.');
    }

    public function process()
    {
       
        $documents = Document::where('category_id', 3)->get();

        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'Sem documentos para processar.');
        }

        $documents->each(function ($document) {
            $document->update([
                'category_id' => 4, // importação completa
                'updated_at' => Carbon::now()
            ]);
        });
  
        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Documentos processados com sucesso.');
    }

}
