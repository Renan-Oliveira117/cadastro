<?php

namespace App\DataTables;

use App\Models\Cadastro;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CadastroDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function($cadastro){
                return $cadastro->created_at->format('d/m/Y');
            })
            ->addColumn('action', function($cadastro){
                $acoes = link_to(
                            route('cadastro.edit',$cadastro),
                            'Editar',
                            ['class'=> 'btn btn-sm btn-primary']
                );

                $acoes .= FormFacade::button(
                    'Excluir',
                    [
                        'class' =>
                        'btn btn-sm btn-danger ml-1',
                        'onclick' => "excluir('" . route('cadastro.destroy', $cadastro) . "')"
                    ]
                    );
                return $acoes;
            });
    }


    public function query(Cadastro $model)
    {
        return $model->newQuery();
    }

 
    public function html()
    {
        return $this->builder()
                    ->setTableId('cadastro-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Novo Cadastro')

                    )
                    ->parameters([
                        'language' => ['url'=>'//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json']
                    ]);
    }


    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false),
            Column::make('id'),
            Column::make('nome')->title('Nome'),
            Column::make('email')->title('E-mail'),
            Column::make('created_at')->title('Data de Criação'),
        ];
    }



    protected function filename()
    {
        return 'Cadastro_' . date('YmdHis');
    }
}
