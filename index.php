<?php
if (isset($_GET['vs'])) {
    highlight_file(__FILE__);
    exit;
}
$template = file_get_contents('configs/ikev2.mobileconfig');
$uuidReplacement = '{{UUID}}';
$uuidsToReplace = substr_count($template, $uuidReplacement);

for ($i = 0; $i < $uuidsToReplace; $i++) {
    $uuid = guidv4(openssl_random_pseudo_bytes(16));
    $template = preg_replace('/'.$uuidReplacement.'/', $uuid, $template, 1);
}

$requiredGet = [
    'domain',
    'vpnUsername',
];

$requiredPost = [
    'domain',
    'vpnUsername',
    'vpnSecret',
];
$domain = (!empty($_GET['domain'])) ? $_GET['domain'] : '';
$vpnUsername = (!empty($_GET['vpnUsername'])) ? $_GET['vpnUsername'] : '';

$provided = array_keys($_GET);
if (!empty(array_diff($requiredGet, $provided))) {
    echo <<<FORM
    <html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body>
    <form action="" method="GET">
    <label>Domain</label><br />
    <input name='domain' value='{$domain}'><br />
    <label>VPN Username</label><br />
    <input name='vpnUsername' value=''><br />
    <input type="submit"/></body></html>
FORM;
    exit;
}

$provided = array_keys($_POST);
if (!empty(array_diff($requiredPost, $provided))) {
    echo <<<FORM
        <html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body>
    <p>This server has access logs turned off and this page does no logging of its own</p>
    <p><a href="?domain={$domain}&vpnUsername={$vpnUsername}&vs">View Source</a></p>
<form action="?domain={$domain}&vpnUsername={$vpnUsername}" method="POST">
    <label>Domain</label><br />
    <input name='domain' value='{$domain}'><br />
    <label>VPN Username</label><br />
    <input name='vpnUsername' value='{$vpnUsername}'><br />
    <label>VPN Secret</label><br />
    <input name='vpnSecret' type='password' value=''><br />
    
    <input type='submit'>
</form></body></html>
FORM;
    exit;
}

$domain = $_POST['domain'];
$vpnUsername = $_POST['vpnUsername'];
$vpnSecret = $_POST['vpnSecret'];

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $vpnUsername . '.mobileconfig');

echo str_replace(
    [
        '{{DOMAIN}}',
        '{{VPNUSERNAME}}',
        '{{VPNSECRET}}',
    ],
    [
        $domain,
        $vpnUsername,
        $vpnSecret,
    ],
    $template
);


function guidv4($data) {
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
