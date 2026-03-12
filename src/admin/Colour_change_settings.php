<?php
$pluginImagePath  = trailingslashit(plugins_url());
$insert = false;
if ( isset( $_POST['submit'] ) ){
    global $wpdb;
    $tablename=$wpdb->prefix.'change_color';
    $data=array(
        'color' => $_POST['colorvalue'] );
     $insert = $wpdb->insert( $tablename, $data);
}
 if($insert){ 
    echo "<h1>Uw kleur is succesvol gewijzigd</h1>";
 }else{
    echo "";
 }
 ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="<?php echo  $pluginImagePath."critters_plugin/css/style.css"; ?>">
<body>
  <div class="color_outer_section">
    <h1>Selecteer kleur voor knoppen</h1>
    <form method="post" action="<?php the_permalink(); ?>">
      <label for="favcolor">Selecteer kleur voor knoppen:</label> <input type="color" name="test"  id="myColor" value="#ffffff"><br><br>
      <button type="submit" class="color_button" name="submit" onclick="myFunction()">Verander kleur</button>
      <p id="demo"></p>
      <input type="hidden" id="demo1" name="colorvalue"  />
    </form>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myColor");
  var defaultVal = x.defaultValue;
  var currentVal = x.value;
  if (defaultVal == currentVal) {
    document.getElementById("demo").innerHTML = "Default value and current value is the same: "
    + x.defaultValue + " and " + x.value
    + "<br>Change the color of the color picker to see the difference!";
  } else {
    document.getElementById("demo").innerHTML = "Uw geselecteerde kleur is: " + currentVal;
    document.getElementById("demo1").value = currentVal;
  }
}
</script>
</body>
</html>