<?php

namespace App\DataTables;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookingDataTable extends DataTable
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
                $eye = "<a href='" . route('show_all_data', $query->id) . "' class='btn btn-inverse-primary m-2'><i class='bi bi-eye-fill'></i></a>";
                $delete = "<a href='' id='delete'  class='btn btn-inverse-danger  m-2 '><i class='bi bi-trash-fill'></i></a>";
                return $eye . $delete;
            })
            ->addColumn('price', function ($query) {
                return $query->price . ' $';
            })
            ->addColumn('booking_status', function ($query) {
                if ($query->booking_status === 'completed') {
                    return '<span class="badge badge-success">Completed</span>';
                } elseif ($query->booking_status === 'canceled') {
                    return '<span class="badge badge-danger">Canceled</span>';
                 } elseif ($query->booking_status === 'confirmed') {
                        return '<span class="badge badge-success">Confirmed</span>';
                } else {
                    return '<span class="badge badge-warning">' . $query->booking_status . '</span>';
                }
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status == 'done') {
                    return '<span class="badge badge-success">DONE</span>';
                } elseif ($query->payment_status == 'pending') {
                    return '<span class="badge badge-warning">PENDING</span>';
                } else {
                    return '<span class="badge badge-danger">' . $query->payment_status . '</span>';
                }
            })
            ->rawColumns(['action', 'price', 'payment_status', 'booking_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Booking $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('booking-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('email'),
            Column::make('phone'),
            Column::make('check_in'),
            Column::make('check_out'),
            Column::make('payment_status'),
            Column::make('booking_status'),
            Column::make('price'),
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
        return 'Booking_' . date('YmdHis');
    }
}
