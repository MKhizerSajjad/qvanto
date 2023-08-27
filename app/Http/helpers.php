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
            '3' => ['Case Proceed', '<span class="badge bg-success-light">Case Proceed</span>'],
            '4' => ['Rescheduled', '<span class="badge bg-primary-light">Rescheduled</span>'],
            '5' => ['Pending', '<span class="badge bg-warning-light">Pending</span>'],
            '6' => ['Withdrawed', '<span class="badge bg-success-light">Withdrawed</span>'],
            '7' => ['Rejected', '<span class="badge bg-danger-light">Rejected</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }
    
    function getCaseStatus($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Process Start', '<span class="badge bg-info-light">Process Start</span>'],
            '2' => ['Under observation', '<span class="badge bg-secondary-light">Under observation</span>'],
            '3' => ['Negotiating', '<span class="badge bg-info-light">Negotiating</span>'],
            '4' => ['Waiting for customer response', '<span class="badge bg-warning-light">Waiting for customer response</span>'],
            '6' => ['Waiting for 3rd party response', '<span class="badge bg-warning-light">Waiting for 3rd party response</span>'],
            '7' => ['Suspended', '<span class="badge bg-danger-light">Suspended</span>'],
            '8' => ['Resolved', '<span class="badge bg-success-light">Resolved</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    } 
?>