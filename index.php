<?php
/* ZIBUU ENTERTAINMENT, (C) 2015 - 2020.
 ________   ______   ____     __  __  __  __
/\_____  \ /\__  _\ /\  _`\  /\ \/\ \/\ \/\ \
\/____//'/'\/_/\ \/ \ \ \L\ \\ \ \ \ \ \ \ \ \
     //'/'    \ \ \  \ \  _ <'\ \ \ \ \ \ \ \ \
    //'/'___   \_\ \__\ \ \L\ \\ \ \_\ \ \ \_\ \
    /\_______\ /\_____\\ \____/ \ \_____\ \_____\
    \/_______/ \/_____/ \/___/   \/_____/\/_____/

*/

// Reading our raw input data
$raw_us = $_POST['en_US'];
$raw_es = $_POST['es_MX'];
// Setting up our prefixes for each language
$prefix_us = '&c&l[ALERT]&r&7 ';
$prefix_es = '&c&l[AVISO]&r&7 ';
// Formatting our output data
$english = "$prefix_us$raw_us";
$spanish = "$prefix_es$raw_es";


// Converting variable texts to JSON
class GeneralData {
    public $type;
    public $key;
    public $languages = array();

    function  __construct(){
      $this->type = $_POST['type'];
      $this->key = $_POST['key'];
        for ( $i=1; $i-->0;){
            array_push($this->languages, new Messages);
        }
    }
}


// Converting translations texts to JSON
if($_POST['prefix'] == 0) {
class Messages {
    public $en_US;
    public $es_MX;
    // If no prefix was selected, return a raw translation message
    function __construct() {
      $this->en_US = $_POST['en_US'];
      $this->es_MX = $_POST['es_MX'];
    }
  }
}


// If a prefix was selected, return a formatted translation message
else {
  class Messages {
    public $en_US;
    public $es_MX;
    function __construct() {
      $this->en_US = $GLOBALS['english'];
      $this->es_MX = $GLOBALS['spanish'];
    }
  }
}


// Detecting if any data was received and writing it to our JSON file
if(isset($_POST['form_status'])) {
  $data = json_encode(new GeneralData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $document = fopen('default.json', 'a');
  fwrite($document, "$data,\n");
  fclose($document);
}

// Reading our JSON file to print its content on the site
$read = file_get_contents('default.json');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Zibuu – Translations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="contact-clean">
        <form method="post" action="">
            <input type="hidden" name="form_status" value="1">
            <h2 class="text-center">Translations</h2>
          </br><p><?php echo "<b>Value added:</b> ",json_encode(new GeneralData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></p>
            <div class="form-group"><select class="form-control" name="type"><option value="text">Message</option><option value="sign">Sign text</option></select></div>
            <div class="form-group"><input required="true" class="form-control" type="text" name="key" placeholder="Translation key" style="margin-bottom: 50PX;"></div>
            <div class="form-group"><input required="true" class="form-control" type="text" name="en_US" placeholder="English translation"></div>
            <div class="form-group"><input required="true" class="form-control" type="text" name="es_MX" placeholder="Spanish translation"></div>
            <div class="form-group">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="prefix" value="1" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Automatically add message prefix</label></div>
            </div>
            <div class="form-group"><button class="btn btn-primary" type="submit" style="margin-right: 30PX;">ADD TRANSLATION</button><button class="btn btn-primary" type="reset">clear</button></div>
            <h2 class="text-center">Translated messages</h2><textarea class="form-control" wrap="hard" name="translation" readonly=""><?php echo $read ?></textarea>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
