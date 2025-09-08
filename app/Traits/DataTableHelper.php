<?php
// app/Traits/DataTableHelper.php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait DataTableHelper
{
    /**
     * Apply search to query
     */
    protected function applySearch($query, Request $request, array $columns)
    {
        if ($request->filled('search')) {
            $search = $request->get('search');

            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', "%{$search}%");
                }
            });
        }
    }


    /**
     * Apply filters to query
     */
    protected function applyFilters(Builder $query, Request $request, array $filters = [])
    {
        foreach ($filters as $filterKey => $filterConfig) {
            if ($request->filled($filterKey)) {
                $value = $request->get($filterKey);

                if (isset($filterConfig['callback']) && is_callable($filterConfig['callback'])) {
                    // Custom callback
                    $filterConfig['callback']($query, $value);
                } elseif (isset($filterConfig['field'])) {
                    // Simple field filter
                    $field = $filterConfig['field'];
                    $operator = $filterConfig['operator'] ?? '=';

                    if (strpos($field, '.') !== false) {
                        // Relationship field
                        [$relation, $relationField] = explode('.', $field, 2);
                        $query->whereHas($relation, function ($subQ) use ($relationField, $operator, $value) {
                            $subQ->where($relationField, $operator, $value);
                        });
                    } else {
                        $query->where($field, $operator, $value);
                    }
                }
            }
        }

        return $query;
    }

    /**
     * Handle DataTable AJAX response
     */
    protected function handleDataTableResponse(Request $request, $data, string $viewPath, array $extra = [])
    {
        if ($request->ajax()) {
            // rows = hasil data paginated
            $rows = $data;

            $html = view($viewPath, array_merge($extra, compact('rows')))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'total' => $data->total(), // total dari pagination
                'current_page' => $data->currentPage(),
                'message' => 'Data berhasil dimuat'
            ]);
        }

        return null;
    }



    /**
     * Get status configuration
     */
    protected function getStatusConfig(string $type, string $status)
    {
        $configs = config("datatable.status_configs.{$type}", []);
        return $configs[$status] ?? config('datatable.status_configs.generic.active', [
            'class' => 'bg-gray-100 text-gray-800',
            'text' => ucfirst($status),
            'icon' => 'question-mark-circle'
        ]);
    }

    /**
     * Generate action buttons HTML
     */
    protected function generateActionButtons(array $actions, $model)
    {
        $html = '<div class="flex justify-center space-x-2">';

        foreach ($actions as $action) {
            $actionConfig = config("datatable.actions.{$action['type']}", []);
            $url = $action['url'] ?? '#';
            $onclick = $action['onclick'] ?? '';
            $class = $action['class'] ?? $actionConfig['class'] ?? '';
            $title = $action['title'] ?? $actionConfig['title'] ?? '';
            $icon = $action['icon'] ?? $actionConfig['icon'] ?? '';

            if ($action['type'] === 'delete') {
                $onclick = "openDeleteModal('{$action['model_type']}', '{$url}')";
            }

            $tag = isset($action['url']) ? 'a' : 'button';
            $href = isset($action['url']) ? "href=\"{$url}\"" : '';
            $onclickAttr = $onclick ? "onclick=\"{$onclick}\"" : '';

            $html .= "<{$tag} {$href} {$onclickAttr} class=\"{$class}\" title=\"{$title}\">";
            $html .= "<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">{$icon}</svg>";
            $html .= "</{$tag}>";
        }

        $html .= '</div>';
        return $html;
    }

    /**
     * Generate status badge HTML
     */
    protected function generateStatusBadge(string $type, string $status)
    {
        $config = $this->getStatusConfig($type, $status);

        return sprintf(
            '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full %s">%s</span>',
            $config['class'],
            $config['text']
        );
    }

    /**
     * Format date for display
     */
    protected function formatDate($date, string $format = 'd/m/Y')
    {
        if (!$date) return '-';

        return \Carbon\Carbon::parse($date)->format($format);
    }

    /**
     * Format date range for display
     */
    protected function formatDateRange($startDate, $endDate, string $format = 'd/m/Y')
    {
        if (!$startDate && !$endDate) return '-';

        $start = $startDate ? \Carbon\Carbon::parse($startDate)->format($format) : '-';
        $end = $endDate ? \Carbon\Carbon::parse($endDate)->format($format) : '-';

        return "{$start} - {$end}";
    }

    /**
     * Generate avatar HTML
     */
    protected function generateAvatar(string $name, string $image = null, array $options = [])
    {
        $size = $options['size'] ?? 'h-10 w-10';
        $textSize = $options['text_size'] ?? 'text-sm';

        if ($image && file_exists(public_path($image))) {
            return sprintf(
                '<img class="%s rounded-full object-cover" src="%s" alt="%s">',
                $size,
                asset($image),
                $name
            );
        }

        $initials = collect(explode(' ', $name))
            ->map(fn($word) => substr($word, 0, 1))
            ->take(2)
            ->join('');

        return sprintf(
            '<div class="%s rounded-full bg-gray-300 flex items-center justify-center"><span class="%s font-medium text-gray-700">%s</span></div>',
            $size,
            $textSize,
            $initials
        );
    }

    /**
     * Truncate text for display
     */
    protected function truncateText(string $text, int $limit = 50)
    {
        return \Illuminate\Support\Str::limit($text, $limit);
    }

    /**
     * Get pagination meta data
     */
    protected function getPaginationMeta($data, int $currentPage = 1, int $perPage = 25)
    {
        $total = is_countable($data) ? count($data) : $data->count();
        $totalPages = ceil($total / $perPage);

        return [
            'current_page' => $currentPage,
            'per_page' => $perPage,
            'total' => $total,
            'total_pages' => $totalPages,
            'start_item' => $total === 0 ? 0 : ($currentPage - 1) * $perPage + 1,
            'end_item' => min($currentPage * $perPage, $total),
        ];
    }
}
