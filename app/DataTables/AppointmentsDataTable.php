<?php

// app/DataTables/AppointmentsDataTable.php
namespace App\DataTables;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppointmentsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($appointment) {
                $actions = '<div class="btn-group btn-group-sm" role="group">';
                
                if (auth()->user()->hasRole('admin')) {
                    $actions .= '<a href="' . route('admin.appointments.show', $appointment->id) . '" 
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View
                                </a>';
                    $actions .= '<a href="' . route('admin.appointments.edit', $appointment->id) . '" 
                                class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                                </a>';
                } elseif (auth()->user()->hasRole('officer')) {
                    if ($appointment->status === 'scheduled' && $appointment->officer_id === auth()->id()) {
                        $actions .= '<a href="' . route('officer.appointments.document', $appointment->id) . '" 
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-camera"></i> Document
                                    </a>';
                    }
                } else {
                    $actions .= '<a href="' . route('homeowner.appointments.show', $appointment->id) . '" 
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View
                                </a>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('homeowner', function ($appointment) {
                return $appointment->home->owner->name ?? 'N/A';
            })
            ->addColumn('officer_name', function ($appointment) {
                return $appointment->officer->name ?? '<span class="badge bg-warning">Unassigned</span>';
            })
            ->addColumn('status_badge', function ($appointment) {
                $statusColors = [
                    'scheduled' => 'primary',
                    'in_progress' => 'info',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                    'rescheduled' => 'warning'
                ];
                
                $color = $statusColors[$appointment->status] ?? 'secondary';
                return '<span class="badge bg-' . $color . '">' . 
                       ucfirst(str_replace('_', ' ', $appointment->status)) . '</span>';
            })
            ->addColumn('appointment_date', function ($appointment) {
                return $appointment->scheduled_at ? 
                       $appointment->scheduled_at->format('M d, Y g:i A') : 'TBD';
            })
            ->rawColumns(['action', 'officer_name', 'status_badge'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['home.owner', 'officer'])
            ->select('appointments.*');

        // Filter based on user role
        if (auth()->user()->hasRole('officer')) {
            $query->where('officer_id', auth()->id());
        } elseif (auth()->user()->hasRole('homeowner')) {
            $query->whereHas('home', function ($q) {
                $q->where('owner_id', auth()->id());
            });
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('appointments-table')
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
            ->autoWidth(false)
            ->parameters([
                'scrollX' => true,
                'language' => [
                    'search' => 'Search appointments:',
                    'lengthMenu' => 'Show _MENU_ appointments',
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(60),
            Column::make('homeowner')->title('Homeowner')->searchable(true),
            Column::make('appointment_date')->title('Date & Time')->orderable(true),
            Column::make('officer_name')->title('Officer')->searchable(true),
            Column::make('status_badge')->title('Status')->searchable(false),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Appointments_' . date('YmdHis');
    }
}