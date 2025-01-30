<?php

// Copyright 2021-2024 SnehTV, Inc.
// Licensed under MIT (https://github.com/mitthu786/TS-JioTV/blob/main/LICENSE)
// Created By: TechieSneh

error_reporting(0);
include "functions.php";

// Fetch credentials
$cred = getCRED();
$jio_cred = json_decode($cred, true);

if (!$jio_cred) {
    die("Invalid credentials");
}

$ssoToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjcmVhdGVkRm9yIjoiSmlvVFYiLCJkZXZpY2VJZCI6IjZmY2FkZWI3YjRiMTBkNzciLCJpYXQiOjE3MzgyMjQxMjAsInNJZCI6IlUyRnNkR1ZrWDE5cDE5ZnZxcnFqSGdVMWZNa1dGQ3YwR2F4d2VTUVFvUWc9IiwidW5pcXVlIjoiNmVjZWFjNTYtZjcwNi00NzFlLTlhZDQtOGQ3NmE0MWVhODVkIiwidXNlclR5cGUiOiJKSU8ifQ.B4TuijmDfSdIE8G0YKopwXYxLjcYUcQrrwrdaHgPk9k';
$access_token = 'eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImF1dGhUb2tlbklkIjoiZWFjYmFkZDMtNTJhOC00ZmUyLTgyNGMtNGRkNzhkZWMyMTYxIiwidXNlcklkIjoiNmVjZWFjNTYtZjcwNi00NzFlLTlhZDQtOGQ3NmE0MWVhODVkIiwidXNlclR5cGUiOiJKSU8iLCJvcyI6ImFuZHJvaWQiLCJkZXZpY2VUeXBlIjoicGhvbmUiLCJhY2Nlc3NMZXZlbCI6IjkiLCJkZXZpY2VJZCI6IjZmY2FkZWI3YjRiMTBkNzciLCJleHRyYSI6IntcIm51bWJlclwiOlwiQ2FoS0t2Q3ExRGdUMWl4Mjd0STFSbi9vcE5SUWpMSmtYelkvUTFLZVVBcThLZy9qdjkrTGtFUT1cIixcInBsYW5kZXRhaWxzXCI6e1wiUGFja2FnZUluZm9cIjpbe1wicGxhbmlkXCI6XCIxXCIsXCJzdWJzY3JpcHRpb25zdGFydFwiOjE3Mzc2MzEwMzEsXCJzdWJzY3JpcHRpb25lbmRcIjoxNzY5NzYwMTIwLFwicGxhbnR5cGVcIjpcInByZW1pdW1cIixcImJ1c2luZXNzVHlwZVwiOlwiamlvXCIsXCJub3Rlc1wiOlwiXCJ9XX0sXCJqVG9rZW5cIjpcIjY5ZTRhZGUyYzI0OWRjM2Y3ZmZhMmRkNzE4ZGYwNzk5LjNkMjZhY2IyOGE3OWI5OTU4OGRlYmY4MzY0NjQ5NjkwMzRkMjQwYjBjMGNkZDBmYjNjZTk5YzA3NjMzMjlmODc2MTkxNjZjNzk5OWIzZTMzMmZkZjVjMWZhNTc5N2NmYjhjMzhmMWVlNDU3NzM4ZDUyNDlhYjA4MGVhNDkyOWY2ODdhOTM3OGNjOTRiZjJkYjAzNWUxNzBhMTZmMTE1MTM3Y2ZlOTFkNWQwNWM1YjZiZjM5NGYyNjIyMDE2ODhlN2FiODBlMDI2MDkyZGE4ODI1Y2U0YjVkZGViMjA4ZjViODZmOTY2ZTk2MmJlNGUxMDA1MjgyY2JiZDQzMWQ4ZDczYjI5ZWQ0NzQ0NGRkOWVmMGU3MWY3NmY0MTM2ZDdiMDcwNDc5NjRmNjU2OTQ2ZmQyMWNlYzFjOTQ4MjMyNzE4OTI4OGIzM2EwODVkNDNhY2U4ZGJiYzExZTYxMTYzMTk3NjExMDQzNzY4YjNiYzM2NjhiN2ZiM2I2MjA2ODMwOTk3NmVjZmU5YTI0NDFmNDllNDBjZGFjNTg4ZTQ3YWQ2MGVmNDBhMWEwNGFkNTM1MDM1ZDkzM2Q1Mjg3MGEzMzA5Yzk0ZTRiYmM0YmRlODQ5Zjg2MjlmYjAwMTU5NTcyNGY1NTIwYmNhYzk3ZDhmYWNiYmI3MTYxMWVkOWE5MGY3NzI3ZGUxNTk4M2FlMjY5MTE0ZjQzZGYzNTY1YWNlNzM0NDJkMTIyMzMzNzAwMTRmZThhNTU5MjhhNTZmYmQ2YWMyMmUyMmY1ZDc3ZTU4YzI0ZDE4OGJiMGE2Zjc4NGZhNWY2N2E4MDRiODY5MGQwZTc1OWZjNTJlNDhlMmE4NzQ2NmVkYmYyMjM2NGE0NmI3MWVmNzZlOWM5YTRlZGY2ODE2NzhjZmVlNzc3ZmFlNTY1Y2I1MzJiYjFkZjg2ZGIyXCIsXCJ1c2VyRGV0YWlsc1wiOlwibDZKdmlPUmZYQWhBZWlUR2tkcWZTMkdNVkR1S21jZ0FuK3pNTDJseU05M2lPaHJ0dHhTUTg2dDFjaHM0MTFIelR3OGZTekh6Rmc1VFJ2T2QrTTB4U3orL2hIL0p6aWtFTElHZk5oYmFOTXdheGhCbWJRZ3g1NStBZU05Q3dXUTIyR0tqRGg2aDFpMGN6OUZsalZRd3A3OTR1KzNDSldoakRGc2cwVndjSmR0Z1k3RWR4dUx2RVN4TjlTQXBVNGY4a1lSL2ZjT2FhcVdCOS8zREhiRFZNL2JiUTNDOTZ4TVJjTTlOVFk0SnJWbUFWaUZjS2JMdy95dXNHRTliZ05jWEI4c0JjR1YyZWpaOWw0WnRPWnljUkFkWTJsVTlzUFk4ZlFzPVwifSIsInN1YnNjcmliZXJJZCI6IjUzOTc0MTY1OTIiLCJhcHBOYW1lIjoiUkpJTF9KaW9UViIsInZlcnNpb24iOiJ2MSJ9LCJleHAiOjE3MzgyMzEzMjAsImlhdCI6MTczODIyNDEyMH0.OV_MxZqBVLpeUYRVc9zbXc768bqjrR7vOX43YGQZWjTMaRqJEvPqxb6kN_vVy1gdieUziGimumZ-3EPgOKAVXg';
$crm = '5397416592';
$uniqueId = 'shanthosh_58';
$device_id = '6fcadeb7b4b10d77';

$cookies = $_REQUEST["ck"] ?? '';
$cookies = hex2bin($cookies);
$headers = jio_headers($cookies, $access_token, $crm, $device_id, $ssoToken, $uniqueId);

// Function to fetch and echo data
function fetchAndEchoData($url, $headers)
{
    $data = cUrlGetData($url, $headers);
    if ($data === false) {
        http_response_code(500);
        echo "Error fetching data from: $url";
        return false;
    }
    echo $data;
    return true;
}

if (!empty($_REQUEST["key"]) && !empty($cookies)) {
    $url = 'https://tv.media.jio.com/streams_live/' . urlencode($_REQUEST["key"]);
    fetchAndEchoData($url, $headers);
} elseif (!empty($_REQUEST["pkey"]) && !empty($cookies)) {
    $url = 'https://tv.media.jio.com/fallback/bpk-tv/' . urlencode($_REQUEST["pkey"]);
    fetchAndEchoData($url, $headers);
} elseif (!empty($_REQUEST["ts"]) && !empty($cookies)) {
    header("Content-Type: video/mp2t");
    header("Connection: keep-alive");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Expose-Headers: Content-Length, Content-Range");
    header("Access-Control-Allow-Headers: Range");
    header("Accept-Ranges: bytes");

    $url = 'https://jiotvmblive.cdn.jio.com/' . urlencode($_REQUEST["ts"]);
    fetchAndEchoData($url, $headers);
} else {
    http_response_code(400);
    echo "Invalid request parameters.";
}
