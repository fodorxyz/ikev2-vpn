<?php
$template = file_get_contents('configs/ikev2.mobileconfig');

$requiredGet = [
    'domain',
    'vpnUsername',
];

$requiredPost = [
    'domain',
    'vpnUsername',
    'vpnSecret',
    'vpnPassword',
];
$domain = (!empty($_GET['domain'])) ? $_GET['domain'] : '';
$vpnUsername = (!empty($_GET['vpnUsername'])) ? $_GET['vpnUsername'] : '';

$provided = array_keys($_GET);
if (!empty(array_diff($requiredGet, $provided))) {
    echo <<<FORM
    <form action="" method="GET">
    <label>Domain</label><br />
    <input name='domain' value='{$domain}'><br />
    <label>vpnUsername</label><br />
    <input name='vpnUsername' value=''><br />
    <input type="submit"/>
FORM;
    exit;
}

$provided = array_keys($_POST);
if (!empty(array_diff($requiredPost, $provided))) {
    echo <<<FORM
    <p>This server has access logs turned off and this page does no logging of its own</p>
<form action="?domain={$domain}&vpnUsername={$vpnUsername}" method="POST">
    <label>Domain</label><br />
    <input name='domain' value='{$domain}'><br />
    <label>vpnUsername</label><br />
    <input name='vpnUsername' value='{$vpnUsername}'><br />
    <label>Vpn Secret</label><br />
    <input name='vpnSecret' type='password' value=''><br />
    <label>VPN Password</label><br />
    <input name='vpnPassword' type='password' value=''><br />
    
    <input type='submit'>
</form>
FORM;
    exit;
}

$vpnSecret = $_POST['vpnSecret'];
$vpnPassword = $_POST['vpnPassword'];

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $vpnUsername . '.mobileconfig');

echo str_replace(
    [
        '{{DOMAIN}}',
        '{{VPNUSERNAME}}',
        '{{VPNSECRET}}',
        '{{VPNPASSWORD}}',
    ],
    [
        $domain,
        $vpnUsername,
        $vpnSecret,
        $vpnPassword
    ],
    $template
);