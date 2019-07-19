<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'admin.users.btn.action')
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->rawColumns([
                'action',
                'checkbox'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query()->where(function($q){
            if(request()->has('level')){
                return $q->where('level', request('level'));
            }
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom' => 'Bfltrip',
                        'lengthMenu' => [[10, 25, 50, -1],[10, 25, 50, trans('admin.all_record')]],
                        'buttons' => [
                            ['extend' => 'print', 'className' => 'btn btn-info margin', 'text' => '<i class="fa fa-print"></i> '.trans('admin.print')],
                            ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file-excel-o"></i> '.trans('admin.ex_excel')],
                            ['extend' => 'csv', 'className' => 'btn btn-primary margin', 'text' => '<i class="fa fa-file-excel-o"></i> '.trans('admin.ex_csv')],
                            ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"></i> '.trans('admin.reload')],
                            ['className' => 'btn btn-primary margin', 'text' => '<i class="fa fa-plus"></i> '.trans('admin.create'),
                                'action' => 'function(){ window.location.href = "'.\URL::current().'/create"}'
                            ],
                            ['className' => 'btn btn-danger btn-deleteall', 'text' => '<i class="fa fa-trash"></i> '.trans('admin.delete')],
                        ],
                        'initComplete' => "function () {
                            this.api().columns([2,3,4]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language' => datatable_lang() 
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all();"/>',
                'exportable' => false,
                'searchable' => false,
                'orderable' => false,
                'printable' => false,
            ], [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID'
            ], [
                'name' => 'name',
                'data' => 'name',
                'title' => 'User Name'
            ], [
                'name' => 'email',
                'data' => 'email',
                'title' => 'User Email'
            ], [
                'name' => 'level',
                'data' => 'level',
                'title' => 'User Level'
            ], [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Created At'
            ], [
                'name' => 'updated_at',
                'data' => 'updated_at',
                'title' => 'Updated At'
            ], [
                'name' => 'action',
                'data' => 'action',
                'title' => 'Actions',
                'exportable' => false,
                'searchable' => false,
                'orderable' => false,
                'printable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
