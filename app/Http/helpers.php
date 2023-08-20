<?php
function getGeneralStatus($status = null, $type = null)
{
    $statuses = [
        '1' => ['Active', '<span class="badge bg-primary-light">Active</span>'],
        '2' => ['Inactive', '<span class="badge bg-warning-light">Inactive</span>']
    ];

    return 
        isset($statuses[$status])
        ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
        : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
} 
?>