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
    
    function getCaseTypes($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Loan Company', '<span class="badge bg-primary-light">Loan Company</span>'],
            '2' => ['Employment Case', '<span class="badge bg-warning-light">Employment Case</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }
    
    function getAppointmentStatus($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Requested', '<span class="badge bg-info-light">Requested</span>'],
            '2' => ['Scheduled', '<span class="badge bg-primary-light">Scheduled</span>'],
            '3' => ['Process start', '<span class="badge bg-info-light">Process start</span>'],
            '4' => ['Under observation', '<span class="badge bg-secondary-light">Under observation</span>'],
            '5' => ['Negotiating with 3rd party', '<span class="badge bg-info-light">Negotiating with 3rd party</span>'],
            '6' => ['Waiting for customer response', '<span class="badge bg-warning-light">Waiting for customer response</span>'],
            '7' => ['Suspended', '<span class="badge bg-danger-light">Suspended</span>'],
            '8' => ['Resolved', '<span class="badge bg-success-light">Resolved</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    } 
?>