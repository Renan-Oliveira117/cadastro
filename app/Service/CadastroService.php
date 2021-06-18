<?php
namespace App\Service;
use App\Models\Cadastro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Exception;

class CadastroService
{

    public static function store($request)
    {
        try{

            $cadastro = Cadastro::create($request);
            return[
                'status' => true,
                'contatos' => $cadastro
                
            ];
        }catch(Exception $erro){
            return[
                'status'=> false,
                'cadastro'=> $erro->getMessage(),
            ];
        }
    }

    public static function getCadastroPorId($id)
    {
        try{
            $cadastro = Cadastro::findOrFail($id);
            return[
                'status' => true,
                'cadastro' => $cadastro
            ];
        }catch(Exception $erro){
            return [
                'status' => false,
                'erro'=> $erro->getMessage()
            ];
        }
    }
    public static function upadate($request, $id)
    {
        try{
            $cadastro = Cadastro::findOrFail($id);
            $cadastro -> update($request);

            return [
                'status' => true,
                'cadastro' => $cadastro
            ];
        }catch(Exception $erro){
            return[
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try{
           $cadastro = Cadastro::findOrFail($id);
            $cadastro -> delete();
            
            return[
                'status' => true
            ];
        }catch(Exception $erro){
            return[
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

}