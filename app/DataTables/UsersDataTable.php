<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($user) {
                $actions = '<div class="btn-group btn-group-sm" role="group">';
                $actions .= '<a href="' . route('admin.users.show', $user->id) . '" 
                            class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            </a>';
                $actions .= '<a href="' . route('admin.users.edit', $user->id) . '" 
                            class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i>
                            </a>';
                
                if ($user->id !== auth()->id()) {
                    $actions .= '<button type="button" class="btn btn-outline-danger btn-sm" 
                                onclick="deleteUser(' . $user->id . ')">
                                <i class="fas fa-trash"></i>
                                </button>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('role_badge', function ($user) {
                $roles = $user->roles->pluck('name')->toArray();
                $badges = '';
                
                foreach ($roles as $role) {
                    $color = match($role) {
                        'admin' => 'danger',
                        'officer' => 'warning',
                        'homeowner' => 'primary',
                        default => 'secondary'
                    };
                    $badges .= '<span class="badge bg-' . $color . ' me-1">' . ucfirst($role) . '</span>';
                }
                
                return $badges ?: '<span class="badge bg-secondary">No Role</span>';
            })
            ->addColumn('status_badge', function ($user) {
                $color = $user->email_verified_at ? 'success' : 'warning';
                $text = $user->email_verified_at ? 'Verified' : 'Pending';
                return '<span class="badge bg-' . $color . '">' . $text . '</span>';
            })
            ->addColumn('last_login', function ($user) {
                return $user->last_login_at ? 
                       $user->last_login_at->diffForHumans() : 'Never';
            })
            ->rawColumns(['action', 'role_badge', 'status_badge'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('roles')
            ->select('users.*');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('create')->text('<i class="fas fa-plus"></i> Add User'),
                Button::make('excel'),
                Button::make('csv'),
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
            Column::make('name')->title('Name')->searchable(true),
            Column::make('email')->title('Email')->searchable(true),
            Column::make('phone')->title('Phone')->searchable(true),
            Column::make('role_badge')->title('Role')->searchable(false),
            Column::make('status_badge')->title('Status')->searchable(false),
            Column::make('last_login')->title('Last Login')->orderable(false),
            Column::make('created_at')->title('Joined')->searchable(true),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
