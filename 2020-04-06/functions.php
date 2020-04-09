<?php

if (function_exists('getCalculations') == FALSE) {
    function getCalculations() {
        $data = [];

        if (file_exists(CALCULATIONS_FILE)) {
            $data = file_get_contents(CALCULATIONS_FILE);
            $data = json_decode($data, TRUE) ?? [];
        }

        return $data;
    }
}