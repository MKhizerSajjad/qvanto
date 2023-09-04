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
            '1' => ['Loan shark', '<span class="badge bg-primary-light">Ah Long</span>'],
            '2' => ['Licensed Lending', '<span class="badge bg-warning-light">Pinjaman Berlesen</span>'],
            '3' => ['Cyber fruad', '<span class="badge bg-warning-light">Penipuan Siber</span>'],
            '4' => ['Drugs', '<span class="badge bg-warning-light">Dadah</span>'],
            '5' => ['Local community rights', '<span class="badge bg-warning-light">Hak Masyarkat Setempat</span>'],
            '6' => ['Others', '<span class="badge bg-warning-light">Others</span>'],

            
            // '1' => ['Ah Long', '<span class="badge bg-primary-light">Ah Long</span>'],
            // '2' => ['Pinjaman Berlesen', '<span class="badge bg-warning-light">Pinjaman Berlesen</span>'],
            // '3' => ['Penipuan Siber', '<span class="badge bg-warning-light">Penipuan Siber</span>'],
            // '4' => ['Dadah', '<span class="badge bg-warning-light">Dadah</span>'],
            // '5' => ['Hak Masyarkat Setempat', '<span class="badge bg-warning-light">Hak Masyarkat Setempat</span>'],
            // '6' => ['Others', '<span class="badge bg-warning-light">Others</span>'],
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
    
    function getCaseQuestions($type = null)
    {
                
        $questions = [
            '1' => [
                '1' => 'Type of loan',
                '2' => 'Date fo loan',
                '3' => 'Actual loan amount',
                '4' => 'Premimum Amount',
                '5' => 'Total Amount',
                '6' => 'Victims',
                '7' => 'Official detail',
                '8' => 'Your job',
                '9' => 'Husband / Wife job',
                '10' => 'Father / Mother job',
                '11' => 'Your Salary',
                '12' => 'Number of sibilings',
                '13' => 'Loan borrowed before',
                '14' => 'Loan purpose',
                '15' => 'Bad effects after loan',
                '16' => 'DO you follow any of our instruction during negotiations?',
            ],
            '2' => [
                '1' => 'Your job',
                '2' => 'Husband / Wife job',
                '3' => 'Father / Mother job',
                '4' => 'Your Salary',
                '5' => 'Number of sibilings',
                '5' => 'Loan borrowed before',
                '5' => 'Loan purpose',
                '5' => 'Bad effects after loan',
                '5' => 'DO you follow any of our instruction during negotiations?',
            ],
            '3' => [
                '1' => 'Berief of complaint',
            ],
            '4' => [
                '1' => 'Berief of complaint',
            ],
            '5' => [
                '1' => 'Your job',
                '2' => 'Husband / Wife job',
                '3' => 'Father / Mother job',
                '4' => 'Your Salary',
                '5' => 'Number of sibilings',
                '5' => 'Loan borrowed before',
                '5' => 'Loan purpose',
                '5' => 'Bad effects after loan',
                '5' => 'DO you follow any of our instruction during negotiations?',
            ],
            '6' => [
                '1' => 'Berief of complaint',
            ]
        ];

        return
            isset($questions[$type])
            ? $questions[$type]
            : $questions;
    } 

?>