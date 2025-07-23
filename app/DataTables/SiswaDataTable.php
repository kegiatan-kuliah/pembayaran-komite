<?php

namespace App\DataTables;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SiswaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function($model){ 
                return '
                    <div class="d-flex gap-2">
                        <a href="'.route('siswa.edit', $model->id).'" class="btn btn-info">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="'.route('siswa.destroy', $model->id).'" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                ';
            })
            ->addColumn('kelas', function($model) {
                return $model->kelas->nama;
            })
            ->addColumn('angkatan', function($model) {
                return $model->angkatan->nama;
            })
            ->addColumn('nama', function($model) {
                return $model->user->nama;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Siswa $model): QueryBuilder
    {
        $query = $model->newQuery();

        if ($this->kelas_id) {
            $query->where('id_kelas', $this->kelas_id);
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('siswa-table')
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
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->title('#')
                ->width(20),
            Column::make('nama'),
            Column::make('nisn'),
            Column::make('angkatan'),
            Column::make('kelas'),
            Column::make('alamat'),
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
        return 'Siswa_' . date('YmdHis');
    }
}
