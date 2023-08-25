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