<?php

namespace App\DataTables;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApartmentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $edit = "<a href='" . route('apartments.edit', $query->id) . "' class='btn btn-inverse-primary m-2'><i class='bi bi-pen-fill'></i></a>";
            $delete = "<a href='" . route('delete_apartment', $query->id) . "' id='delete'  class='btn btn-inverse-danger  m-2 '><i class='bi bi-trash-fill'></i></a>";
            return $edit . $delete;
        })
        ->addColumn('image', function ($query) {

            return '<img width="150px" src="' . asset($query->image) . '">';
        })
        ->addColumn('hotel',function($query){
            return $query->hotel->name;
        })
        ->addColumn('status', function ($query) {
            return $query->status == 1 ? "<span class='badge badge-success'>Active</span>" : '<span class="badge badge-danger">In Active</span>';
        })
        ->rawColumns(['status', 'image', 'action','hotel'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Apartment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('apartment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('image'),
            Column::make('max_persons'),
            Column::make('num_beds'),
            Column::make('price'),
            Column::make('hotel'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Apartment_' . date('YmdHis');
    }
}
