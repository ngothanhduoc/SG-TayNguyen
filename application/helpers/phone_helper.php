<?php

if (!function_exists('format_phone')) {

    function format_phone($phone, $country_code = '84') {
        if (empty($phone) === TRUE)
            return false;
        $phone = str_replace('+', '', $phone);
        if ($phone[0] == 0) {
            $phone = $country_code . substr($phone, 1, strlen($phone));
        }
        return $phone;
    }

    function get_telco_by_phone($phone) {
        $arrTelco = array(
            '8490' => 'mobifone', '8493' => 'mobifone', '84120' => 'mobifone', '84121' => 'mobifone', '84122' => 'mobifone', '84126' => 'mobifone', '84128' => 'mobifone',
            '8497' => 'viettel', '8498' => 'viettel', '84162' => 'viettel', '84163' => 'viettel', '84164' => 'viettel', '84165' => 'viettel', '84166' => 'viettel', '84167' => 'viettel', '84168' => 'viettel', '84169' => 'viettel',
            '8491' => 'vinaphone', '8494' => 'vinaphone', '84123' => 'vinaphone', '84124' => 'vinaphone', '84125' => 'vinaphone', '84127' => 'vinaphone', '84129' => 'vinaphone',
            '8492' => 'vietnammobile', '84188' => 'vietnammobile', '84186' => 'vietnammobile',
            '84996' => 'beeline', '84199' => 'beeline', '84993' => 'beeline', '8499' => 'beeline',
            '8495' => 'sfone',
            '8496' => 'viettel',
        );
        if (strlen($phone) == 11) {
            $prefix = substr($phone, 0, 4);
        } else {
            $prefix = substr($phone, 0, 5);
        }
        return $arrTelco[$prefix];
    }

}
?>