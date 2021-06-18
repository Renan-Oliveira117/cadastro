<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\CadastroDataTable;
use App\Http\Requests\CadastroRequest;
use App\Models\Cadastro;
use App\Service\CadastroService;
use Illuminate\Http\Request;
use Exception;

class CadastroController extends Controller
{
    public function index(CadastroDataTable $cadastroDataTable)
    {  
      return $cadastroDataTable->render('cadastro.index');
    }
    public function create()
    {

      return view('cadastro.form');
    }

    public function store(CadastroRequest $request)
    {
      $cadastro = CadastroService::store($request->all());

      if($cadastro['status']){
        return redirect()->route('cadastro.index')
                        ->withSucesso('Cadastro salvo com sucesso');
      }

      return back()->withInput()
                    ->withFalha('Ocorreu um erro ');
    }

    public function edit($id)
    {
      $cadastro = CadastroService::getCadastroPorId($id);

      if ($cadastro['status']){
        return view('cadastro.form',[
        'cadastro' => $cadastro['cadastro']
        ]);
                          
      }
      return back()->withFalha('Ocorreu um erro ao selecionar o cadastro '); 
    }

    public function update(CadastroRequest $request, $id)
    {
        $cadastro = CadastroService::upadate($request->all(), $id);

        if ($cadastro['status']){
            return redirect()->route('cadastro.index')
                    ->withSucesso('Cadastro atualizado com sucesso');

        }
        return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
      $cadastro = CadastroService::destroy($id);

        if ($cadastro['status']){
            return 'Contato excluida com sucesso';
        }

        abort(403,'Erro ao excluir,' .$cadastro['erro']);
    }


}
