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
            '1' => ['Chiuso Spark 1up', '<span class="badge bg-success">Chiuso Spark 1up</span>'], //converted
            '2' => ['Fatto Watt', '<span class="badge bg-success">Fatto Watt</span>'], //converted
            '3' => ['In Chiusura', '<span class="badge bg-info">In Chiusura</span>'],
            '4' => ['Non Risponde', '<span class="badge bg-warning">Non Risponde</span>'],
            '5' => ['Mi Ha Bloccato', '<span class="badge bg-danger">Mi Ha Bloccato</span>'],
            '6' => ['Rimandato', '<span class="badge bg-secondary">Rimandato</span>'],
            '7' => ['Chiuso Spark 2up', '<span class="badge bg-success">Chiuso Spark 2up</span>'], //converted
        ];

        return
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }

    function getTimelineStatus($status = null, $type = null)
    {
        $statuses = [
            '1' => ['Chiuso Spark 1up', '<div class="timeline-marker badge badge-success">✔</div>'], //converted
            '2' => ['Fatto Watt', '<div class="timeline-marker badge badge-success">✔</div>'], //converted
            '3' => ['In Chiusura', '<span class="timeline-marker badge bg-info">⏳</span>'],
            '4' => ['Non Risponde', '<div class="timeline-marker badge badge-warning">✘</div>'],
            '5' => ['Mi Ha Bloccato', '<div class="timeline-marker badge badge-danger">✘</div>'],
            '6' => ['Rimandato', '<span class="timeline-marker badge bg-secondary">📅</span>'],
            '7' => ['Chiuso Spark 2up', '<div class="timeline-marker badge badge-success">✔</div>'], //converted⚙️ 🚫
        ];

        return
            isset($statuses[$status])
            ? ($type === 'badge' ? $statuses[$status][1] : $statuses[$status][0])
            : ($type === 'badge' ? array_column($statuses, 1) : array_column($statuses, 0));
    }

    function getLeadType($status = null, $type = null)
    {
        $statuses = [
            '1' => ['ALL-IN Meta', '<span class="badge bg-info">ALL-IN Meta</span>'],
            '2' => ['Normal Meta', '<span class="badge border border-info text-info">Normal Meta</span>'],
            '3' => ['ALL-IN Tik Tok', '<span class="badge bg-warning">ALL-IN Tik Tok</span>'],
            '4' => ['Normal Tik-Tok', '<span class="badge border border-warning text-warning">Normal Tik-Tok</span>'],
            '5' => ['Normal Altro', '<span class="badge bg-secondary">Normal Altro</span>'],
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

    function numberFormat($amount, $type=null) {
        $formatted = number_format($amount, 2, '.', ',');

        switch ($type) {
            case 'euro':
                return $formatted . '€';
            case 'percentage':
                return $formatted . '%';
            default:
                return $formatted;
        }
    }

?>
