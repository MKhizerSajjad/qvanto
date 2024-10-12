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

    function getBoolStatus($status = null, $type = null)
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
            '2' => ['Vendor', '<span class="badge bg-warning-light">Vendor</span>'],
        ];

        return
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }

    function getRelations($status = null, $type = null)
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

    function getLeadStatus($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Chiuso Spark 1up', '<span class="badge bg-info-light">Chiuso Spark 1up</span>'],
            '2' => ['Fatto Watt', '<span class="badge bg-secondary-light">Fatto Watt</span>'],
            '3' => ['In Chiusura', '<span class="badge bg-info-light">In Chiusura</span>'],
            '4' => ['Non Risponde', '<span class="badge bg-warning-light">Non Risponde</span>'],
            '5' => ['Mi Ha Bloccato', '<span class="badge bg-danger-light">Mi Ha Bloccato</span>'],
            '6' => ['Rimandato', '<span class="badge bg-primary-light">Rimandato</span>'],
            '7' => ['Chiuso Spark 2up', '<span class="badge bg-success-light">Chiuso Spark 2up</span>'],
        ];

        return
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }

    function getLeadType($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Meta', '<span class="badge bg-info-light">Meta</span>'],
            '2' => ['Linkedin', '<span class="badge bg-secondary-light">Linkedin</span>'],
            '3' => ['Direct', '<span class="badge bg-info-light">Direct</span>'],
            '4' => ['Walkin', '<span class="badge bg-warning-light">Walkin</span>'],
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
