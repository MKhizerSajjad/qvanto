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
    
    function getYesNo($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Yes', '<span class="badge bg-primary-light">Yes</span>'],
            '2' => ['No', '<span class="badge bg-warning-light">No</span>']
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
            '1' => ['Ah Long', '<span class="badge bg-primary-light">Ah Long</span>'],
            '2' => ['Pinjaman Berlesen', '<span class="badge bg-warning-light">Pinjaman Berlesen</span>'],
            '3' => ['Penipuan Siber', '<span class="badge bg-warning-light">Penipuan Siber</span>'],
            '4' => ['Dadah', '<span class="badge bg-warning-light">Dadah</span>'],
            '5' => ['Hak Masyarkat Setempat', '<span class="badge bg-warning-light">Hak Masyarkat Setempat</span>'],
            '6' => ['Others', '<span class="badge bg-warning-light">Others</span>'],
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
            '3' => ['Rescheduled', '<span class="badge bg-primary-light">Process start</span>'],
            '4' => ['Pending', '<span class="badge bg-warning-light">Pending</span>'],
            '5' => ['Completed with 3rd party', '<span class="badge bg-success-light">Completed with 3rd party</span>'],
            '6' => ['Rejected', '<span class="badge bg-danger-light">Rejected</span>'],
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
            '8' => ['Withdrawed', '<span class="badge bg-primary-light">Withdrawed</span>'],
            '9' => ['Resolved', '<span class="badge bg-success-light">Resolved</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }
    
    function getPaymentStatus($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Paid', '<span class="badge bg-success-light">Paid</span>'],
            '2' => ['Late Payment', '<span class="badge bg-primary-light">Late Payment</span>'],
            '3' => ['Partially Paid', '<span class="badge bg-info-light">Partially Paid</span>'],
            '4' => ['Pending', '<span class="badge bg-warning-light">Pending</span>'],
            '5' => ['Unpaid', '<span class="badge bg-danger-light">Unpaid</span>'],
        ];

        return 
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    } 
?>