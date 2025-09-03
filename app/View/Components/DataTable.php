<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public string $title;
    public string $description;
    public string $searchPlaceholder;
    public array $columns;
    public array $filters;
    public array|string|bool $addButton;
    public ?string $searchRoute;
    public string $tableId;
    public bool $showPagination;
    public bool $showEntriesSelect;
    public string $customStyles;
    public bool $showBackButton;
    public ?string $exportRoute;
    public bool $showSearch;

    public function __construct(
        string $title = 'Data Table',
        string $description = 'Kelola data dengan mudah',
        string $searchPlaceholder = 'Cari data...',
        array $columns = [],
        array $filters = [],
        array|string|bool $addButton = false,
        ?string $searchRoute = null,
        string $tableId = 'dataTable',
        bool $showPagination = true,
        bool $showEntriesSelect = true,
        string $customStyles = '',
        bool $showBackButton = false,
        ?string $exportRoute = null,
        bool $showSearch = true
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->searchPlaceholder = $searchPlaceholder;
        $this->columns = $columns;
        $this->filters = $filters;
        $this->addButton = $addButton;
        $this->searchRoute = $searchRoute;
        $this->tableId = $tableId;
        $this->showPagination = $showPagination;
        $this->showEntriesSelect = $showEntriesSelect;
        $this->customStyles = $customStyles;
        $this->showBackButton = $showBackButton;
        $this->exportRoute = $exportRoute;
        $this->showSearch = $showSearch;
    }

    public function render()
    {
        return view('components.data-table');
    }

    /**
     * Get default columns if none provided
     */
    public function getDefaultColumns(): array
    {
        if (empty($this->columns)) {
            return [
                ['label' => 'ID', 'field' => 'id', 'sortable' => true],
                ['label' => 'Nama', 'field' => 'name', 'sortable' => true],
                ['label' => 'Aksi', 'field' => 'actions', 'sortable' => false]
            ];
        }
        return $this->columns;
    }

    /**
     * Check if component has filters
     */
    public function hasFilters(): bool
    {
        return !empty($this->filters);
    }

    /**
     * Check if component has add button
     */
    public function hasAddButton(): bool
    {
        return (bool) $this->addButton;
    }


    /**
     * Get columns for view
     */
    public function getColumns(): array
    {
        return $this->getDefaultColumns();
    }
}
