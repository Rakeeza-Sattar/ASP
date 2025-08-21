<?php

namespace App\DataTables;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                $actions = '<div class="btn-group btn-group-sm" role="group">';
                $actions .= '<a href="' . route('items.show', $item->id) . '" 
                            class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            </a>';
                
                if (auth()->user()->hasRole(['admin', 'officer'])) {
                    $actions .= '<a href="' . route('items.edit', $item->id) . '" 
                                class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i>
                                </a>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('homeowner', function ($item) {
                return $item->home->owner->name ?? 'N/A';
            })
            ->addColumn('category_badge', function ($item) {
                $colors = [
                    'Electronics' => 'primary',
                    'Jewelry' => 'warning',
                    'Furniture' => 'info',
                    'Appliances' => 'success',
                    'Artwork' => 'danger',
                    'Other' => 'secondary'
                ];
                
                $color = $colors[$item->category] ?? 'secondary';
                return '<span class="badge bg-' . $color . '">' . $item->category . '</span>';
            })
            ->addColumn('estimated_value', function ($item) {
                return number_format($item->estimated_value, 2);
            })
            ->addColumn('photos_count', function ($item) {
                $count = $item->files()->where('type', 'photo')->count();
                return '<span class="badge bg-info">' . $count . ' photos</span>';
            })
            ->rawColumns(['action', 'category_badge', 'photos_count'])
            ->setRowId('id');
    }

    public function query(Item $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['home.owner'])
            ->select('items.*');

        // Filter based on user role
        if (auth()->user()->hasRole('homeowner')) {
            $query->whereHas('home', function ($q) {
                $q->where('owner_id', auth()->id());
            });
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('items-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->responsive(true)
            ->parameters([
                'scrollX' => true,
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(60),
            Column::make('homeowner')->title('Homeowner')->searchable(true),
            Column::make('description')->title('Description')->searchable(true),
            Column::make('category_badge')->title('Category')->searchable(false),
            Column::make('estimated_value')->title('Value')->orderable(true),
            Column::make('serial_number')->title('Serial #')->searchable(true),
            Column::make('photos_count')->title('Photos')->searchable(false),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Items_' . date('YmdHis');
    }
}