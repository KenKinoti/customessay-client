<?php

namespace App\DataTables;

use App\Models\Tips\Tip;
use Yajra\DataTables\Services\DataTable;

class TipsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTables
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($tip) {
                return view('app.tips.actions.dropdown', ['tip' => $tip,]);
            })
            ->editColumn('created_at', function ($tip) {
                return $tip->formattedDate('created_at');
            })
            ->editColumn('updated_at', function ($tip) {
                return $tip->formattedDate('updated_at');
            })
            ->editColumn('title', function ($tip) {
                return view('app.partials.link', [
                    'link' => route('tips.show', ['tip' => $tip->id]),
                    'text' => $tip->title,
                ]);
            })
            ->editColumn('published', function ($tip) {
                return view('app.tips.status', ['tip' => $tip]);
            })
            ->rawColumns(['title', 'published', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Tip $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tip $model)
    {
        return $model->newQuery()->select('id', 'title', 'published', 'created_at', 'updated_at');
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
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name' => 'title', 'data' => 'title', 'title' => 'Title', 'width' => '40%'],
            'published',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tips_' . date('YmdHis');
    }
}
