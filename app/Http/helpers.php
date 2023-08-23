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
    
    function getUserType($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Admin', '<span class="badge bg-primary-light">Admin</span>'],
            '2' => ['Employee', '<span class="badge bg-warning-light">Employee</span>'],
            '3' => ['Customer', '<span class="badge bg-success-light">Customer</span>']
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    } 
?>