<?php
global $wpdb;
$pluginImagePath  = trailingslashit(plugins_url());
$table_name = $wpdb->prefix . 'critters_form_api_secret_key';
if(isset($_POST['submit'])){
$data = array(
    'api_key' => $wpdb->prepare('%s', $_POST['api_key']),
    'secret_key' => $wpdb->prepare('%s', $_POST['secret_key'])
);

$data_submit = $wpdb->insert($table_name, $data);
if ($data_submit) {
    echo '<h1 class="captcha_heading">Gegevens succesvol ingevoerd.</h1>';
} else {
    echo '<h1 class="captcha_heading">Fout: gegevens niet ingevoerd.</h1>';
}
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
<center>
<div class="main_captcha_div">
    <h1 class="captcha_heading">Voer Captcha API of geheime sleutel in</h1>
    <form method="post" action="" class="captcha_form">
        <label class="captcha_label">Voer de API-sitesleutel in</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="captcha_input" type="text" value="" name="api_key" placeholder="Voer de API-sleutel in" required><br><br><br>
        <label class="captcha_label">Voer de geheime sleutel in</label>
        <input class="captcha_input secret_key" type="text" value="" name="secret_key" placeholder="Voer de geheime sleutel in" required><br><br>
        <p class="recaptcha_note">Dit is v2-versie van recaptcha</p>
        <input type="submit" class="captcha_submit" value="Indienen" name="submit">
    </form>
</div>
</center>
