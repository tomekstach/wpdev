<?php

/**
 * Theme functions. Initializes the Vamtam Framework.
 *
 * @package vamtam/morz
 */

define('VAMTAM_ENVATO_THEME_ID', '21623322');

require_once get_template_directory() . '/vamtam/classes/framework.php';

new VamtamFramework(array(
  'name' => 'morz',
  'slug' => 'morz',
));

// only for one page home demos
function vamtam_onepage_menu_hrefs($atts, $item, $args)
{
  if ('custom' === $item->type && 0 === strpos($atts['href'], '/#')) {
    $atts['href'] = $GLOBALS['vamtam_inner_path'] . $atts['href'];
  }
  return $atts;
}

if (($path = parse_url(get_home_url(), PHP_URL_PATH)) !== null) {
  $GLOBALS['vamtam_inner_path'] = untrailingslashit($path);
  add_filter('nav_menu_link_attributes', 'vamtam_onepage_menu_hrefs', 10, 3);
}

remove_action('admin_head', 'jordy_meow_flattr', 1);

require_once VAMTAM_DIR . 'customizer/setup.php';

require_once VAMTAM_DIR . 'customizer/preview.php';

// this filter fixes some invalid HTML generated by the third-party plugins
add_filter('vamtam_escaped_shortcodes', 'vamtam_shortcode_compat_fix');
function vamtam_shortcode_compat_fix($codes)
{
  $codes[] = 'gallery';
  $codes[] = 'fl_builder_insert_layout';

  return $codes;
}

// Envato Hosted compatibility
add_filter('option_' . VamtamFramework::get_purchase_code_option_key(), 'vamtam_envato_hosted_license_key');
function vamtam_envato_hosted_license_key($value)
{
  if (defined('SUBSCRIPTION_CODE')) {
    return SUBSCRIPTION_CODE;
  }

  return $value;
}

if (class_exists('Vamtam_Importers') && is_callable(array('Vamtam_Importers', 'set_menu_locations'))) {
  Vamtam_Importers::set_menu_locations();
}

function post_title_shortcode()
{
  return get_the_title();
}
add_shortcode('post_title', 'post_title_shortcode');

function post_br_tel_shortcode()
{
  $tel  = do_shortcode('[acf field="br_telefon"]');
  $fax  = do_shortcode('[acf field="br_fax"]');
  $html  = '';

  if ($tel) {
    $html .= '<h4>tel. ' . $tel . '</h4>';
  }

  if ($fax) {
    $html .= '<h4>faks ' . $fax . '</h4>';
  }

  return $html;
}
add_shortcode('post_br_tel', 'post_br_tel_shortcode');

function post_br_emailwww_shortcode()
{
  /*
	<h4>E-mail: <a href="mailto:[acf field=br_email]">[acf field="br_email"]</a></h4>
	<p><a href="http://[acf field=br_www]" target="_blank" rel="noopener noreferrer">[acf field="br_www"]</a></p>
	*/
  $email  = do_shortcode('[acf field="br_email"]');
  $www  = do_shortcode('[acf field="br_www"]');
  $html  = '';

  if ($email) {
    $html .= '<h4>E-mail: <a href="mailto:' . $email . '">' . $email . '</a></h4> ';
  }

  if ($www) {
    $html .= '<p><a href="http://' . $www . '" target="_blank" rel="noopener noreferrer">' . $www . '</a></p> ';
  }

  return $html;
}
add_shortcode('post_br_email_www', 'post_br_emailwww_shortcode');

function post_br_address_shortcode()
{
  /*
	<h4>[acf field="br_adres"]</h4>
	<h4>[acf field="br_kod_pocztowy"] [acf field="br_miasto"]</h4>
	<p>województwo [acf field="br_wojewodztwo"]</p>
	*/
  $html  = do_shortcode('<h4>[acf field="br_adres"]</h4> <h4>[acf field="br_kod_pocztowy"] [acf field="br_miasto"]</h4> <p>województwo [acf field="br_wojewodztwo"]</p>');

  return $html;
}
add_shortcode('post_br_address', 'post_br_address_shortcode');

function post_dl_tel_shortcode()
{
  $tel  = do_shortcode('[acf field="dl_telefon"]');
  $fax  = do_shortcode('[acf field="dl_fax"]');
  $html  = '';

  if ($tel) {
    $html .= '<h4>tel. ' . $tel . '</h4>';
  }

  if ($fax) {
    $html .= '<h4>faks ' . $fax . '</h4>';
  }

  return $html;
}
add_shortcode('post_dl_tel', 'post_dl_tel_shortcode');

function post_dl_emailwww_shortcode()
{
  /*
	<h4>E-mail: <a href="mailto:[acf field=dl_email]">[acf field="dl_email"]</a></h4>
	<p><a href="http://[acf field=dl_www]" target="_blank" rel="noopener noreferrer">[acf field="dl_www"]</a></p>
	*/
  $email  = do_shortcode('[acf field="dl_email"]');
  $www  = do_shortcode('[acf field="dl_www"]');
  $html  = '';

  if ($email) {
    $html .= '<h4>E-mail: <a href="mailto:' . $email . '">' . $email . '</a></h4> ';
  }

  if ($www) {
    $html .= '<p><a href="http://' . $www . '" target="_blank" rel="noopener noreferrer">' . $www . '</a></p> ';
  }

  return $html;
}
add_shortcode('post_dl_email_www', 'post_dl_emailwww_shortcode');

function post_dl_address_shortcode()
{
  /*
	<h4>[acf field="dl_adres"]</h4>
	<h4>[acf field="dl_kod_pocztowy"] [acf field="dl_miasto"]</h4>
	<p>województwo [acf field="dl_wojewodztwo"]</p>
	*/
  $html  = do_shortcode('<h4>[acf field="dl_adres"]</h4> <h4>[acf field="dl_kod_pocztowy"] [acf field="dl_miasto"]</h4> <p>województwo [acf field="dl_wojewodztwo"]</p>');

  return $html;
}
add_shortcode('post_dl_address', 'post_dl_address_shortcode');

function post_dl_table_shortcode($atts = [], $content = null, $tag = '')
{

  $atts = array_change_key_case((array) $atts, CASE_LOWER);

  $dl_atts = shortcode_atts(['field' => '', 'value' => ''], $atts, $tag);
  // [acf field="dl_produkty_serwis"]
  $results = explode(', ', do_shortcode('[acf field="' . $dl_atts['field'] . '"]'));

  if (in_array($dl_atts['value'], $results)) {
    $html = '<span class="pp-icon icon-circle_full_check" style="color: #44c400;"> </span>';
  } else {
    $html = '<span class="fas fa-times-circle" style="color: #cccccc;"> </span>';
  }

  return ($html);
}

function post_dl_table_init()
{
  add_shortcode('post_dl_table', 'post_dl_table_shortcode');
}

add_action('init', 'post_dl_table_init');

function excerpt_br_shortcode()
{
  $content  = '[acf field="br_adres"]<br/>
	[acf field="br_kod_pocztowy"] [acf field="br_miasto"]<br/>
	województwo [acf field="br_wojewodztwo"]<br/>';
  $tel    = do_shortcode('[acf field="br_telefon"]');
  $fax    = do_shortcode('[acf field="br_fax"]');
  $email    = do_shortcode('[acf field="br_email"]');
  $www    = do_shortcode('[acf field="br_www"]');

  $html = do_shortcode($content);

  if ($tel) {
    $html .= 'tel. ' . $tel . '<br/>';
  }

  if ($fax) {
    $html .= 'faks ' . $fax . '<br/>';
  }

  if ($email) {
    $html .= '<a href="mailto:' . $email . '">adres e-mail</a>';
  }

  if ($www) {
    if ($email) {
      $html .= ' | ';
    }
    $html .= '<a href="http://' . $www . '" target="_blank" rel="noopener noreferrer">strona www</a>';
  }

  return $html;
}
add_shortcode('excerpt_br', 'excerpt_br_shortcode');

function map_address_br_shortcode()
{
  $address = urlencode(do_shortcode('[acf field="br_adres"]+[acf field="br_kod_pocztowy"]+[acf field="br_miasto"]'));

  return '<iframe src="https://maps.google.com/maps?q=' . $address . '&iwloc=near&output=embed" style="border:0;width:100%;" height="300" frameborder="0"></iframe>';
}
add_shortcode('map_address_br', 'map_address_br_shortcode');

function excerpt_dl_shortcode()
{
  $badges    = [
    ['title' => 'dystrybutor', 'url' => '/wp-content/uploads/2019/07/DYS-1.png'],
    ['title' => 'autoryzowany serwis wapro B2C', 'url' => '/wp-content/uploads/2019/07/ASA-1.png'],
    ['title' => 'autoryzowane centrum serwisowe', 'url' => '/wp-content/uploads/2019/08/ASC-1.png'],
    ['title' => 'autoryzowane centrum szkoleniowe', 'url' => '/wp-content/uploads/2019/08/ACS-1.png'],
    ['title' => 'autoryzowany serwis', 'url' => '/wp-content/uploads/2019/08/AS-1.png'],
    ['title' => 'złoty partner', 'url' => '/wp-content/uploads/2019/08/PZ-1.png'],
    ['title' => 'srebrny partner', 'url' => '/wp-content/uploads/2019/08/PS-1.png'],
    ['title' => 'brązowy partner', 'url' => '/wp-content/uploads/2019/08/PB-1.png'],
    ['title' => 'punkt sprzedaży', 'url' => '/wp-content/uploads/2019/08/POS-1.png'],
    ['title' => 'złoty dealer', 'url' => '/wp-content/uploads/2019/08/DZ-1.png'],
    ['title' => 'srebrny dealer', 'url' => '/wp-content/uploads/2019/08/DS-1.png'],
    ['title' => 'brązowy dealer', 'url' => '/wp-content/uploads/2019/08/DB-1.png']
  ];

  $content  = '[acf field="dl_adres"]<br/>
	[acf field="dl_kod_pocztowy"] [acf field="dl_miasto"]<br/>
	województwo [acf field="dl_wojewodztwo"]<br/>';
  $tel    = do_shortcode('[acf field="dl_telefon"]');
  $fax    = do_shortcode('[acf field="dl_fax"]');
  $email    = do_shortcode('[acf field="dl_email"]');
  $www    = do_shortcode('[acf field="dl_www"]');

  $html = do_shortcode($content);

  if ($tel) {
    $html .= 'tel. ' . $tel . '<br/>';
  }

  if ($fax) {
    $html .= 'faks ' . $fax . '<br/>';
  }

  if ($email) {
    $html .= '<a href="mailto:' . $email . '">adres e-mail</a>';
  }

  if ($www) {
    if ($email) {
      $html .= ' | ';
    }
    $html .= '<a href="http://' . $www . '" target="_blank" rel="noopener noreferrer">strona www</a>';
  }

  $etykiety = explode(', ', do_shortcode('[acf field="dl_etykieta"]'));

  if (count($etykiety)) {
    $html .= '<br/>';
  }

  foreach ($badges as $badge) {
    if (in_array($badge['title'], $etykiety)) {
      $html .= '<div style="width:60%;padding-top:5px"><img src="' . $badge['url'] . '" alt="' . $badge['title'] . '" height="30px" border="0" align="middle" /></div>';
    }
  }

  return $html;
}
add_shortcode('excerpt_dl', 'excerpt_dl_shortcode');

function map_address_dl_shortcode()
{
  $address = urlencode(do_shortcode('[acf field="dl_adres"]+[acf field="dl_kod_pocztowy"]+[acf field="dl_miasto"]'));

  return '<iframe src="https://maps.google.com/maps?q=' . $address . '&iwloc=near&output=embed" style="border:0;width:100%;" height="300" frameborder="0"></iframe>';
}
add_shortcode('map_address_dl', 'map_address_dl_shortcode');

function map_obszar_br_shortcode()
{
  $voivodeships = [
    ['id' => 'pl2', 'class' => 'pl1', 'url' => 'dolnoslaskie', 'title' => 'dolnośląskie'],
    ['id' => 'pl3', 'class' => 'pl2', 'url' => 'kujawsko-pomorskie', 'title' => 'kujawsko-pomorskie'],
    ['id' => 'pl4', 'class' => 'pl3', 'url' => 'lubelskie', 'title' => 'lubelskie'],
    ['id' => 'pl5', 'class' => 'pl4', 'url' => 'lubuskie', 'title' => 'lubuskie'],
    ['id' => 'pl15', 'class' => 'pl5', 'url' => 'lodzkie', 'title' => 'łódzkie'],
    ['id' => 'pl7', 'class' => 'pl6', 'url' => 'malopolskie', 'title' => 'małopolskie'],
    ['id' => 'pl6', 'class' => 'pl7', 'url' => 'mazowieckie', 'title' => 'mazowieckie'],
    ['id' => 'pl8', 'class' => 'pl8', 'url' => 'opolskie', 'title' => 'opolskie'],
    ['id' => 'pl9', 'class' => 'pl9', 'url' => 'podkarpackie', 'title' => 'podkarpackie'],
    ['id' => 'pl10', 'class' => 'pl10', 'url' => 'podlaskie', 'title' => 'podlaskie'],
    ['id' => 'pl11', 'class' => 'pl11', 'url' => 'pomorskie', 'title' => 'pomorskie'],
    ['id' => 'pl16', 'class' => 'pl12', 'url' => 'slaskie', 'title' => 'śląskie'],
    ['id' => 'pl17', 'class' => 'pl13', 'url' => 'swietokrzyskie', 'title' => 'świętokrzyskie'],
    ['id' => 'pl12', 'class' => 'pl14', 'url' => 'warminsko-mazurskie', 'title' => 'warmińsko-mazurskie'],
    ['id' => 'pl13', 'class' => 'pl15', 'url' => 'wielkopolskie', 'title' => 'wielkopolskie'],
    ['id' => 'pl14', 'class' => 'pl16', 'url' => 'zachodniopomorskie', 'title' => 'zachodniopomorskie']
  ];

  $obszar = explode(', ', do_shortcode('[acf field="br_obszar_dzialania"]'));

  $html = '<ul class="poland">';

  foreach ($voivodeships as $voivodeship) {
    $html .= '<li id="' . $voivodeship['id'] . '" class="' . $voivodeship['class'];

    if (in_array($voivodeship['title'], $obszar)) {
      $html .= ' active-region';
    }

    $html .= '"><a href="#' . $voivodeship['url'] . '" title="' . $voivodeship['title'] . '">' . $voivodeship['title'] . ' <span class="bg"></span></a></li>';
  }

  $html .= '</ul>';

  return $html;
}
add_shortcode('map_obszar_br', 'map_obszar_br_shortcode');

function map_obszar_dl_shortcode()
{
  $voivodeships = [
    ['id' => 'pl2', 'class' => 'pl1', 'url' => 'dolnoslaskie', 'title' => 'dolnośląskie'],
    ['id' => 'pl3', 'class' => 'pl2', 'url' => 'kujawsko-pomorskie', 'title' => 'kujawsko-pomorskie'],
    ['id' => 'pl4', 'class' => 'pl3', 'url' => 'lubelskie', 'title' => 'lubelskie'],
    ['id' => 'pl5', 'class' => 'pl4', 'url' => 'lubuskie', 'title' => 'lubuskie'],
    ['id' => 'pl15', 'class' => 'pl5', 'url' => 'lodzkie', 'title' => 'łódzkie'],
    ['id' => 'pl7', 'class' => 'pl6', 'url' => 'malopolskie', 'title' => 'małopolskie'],
    ['id' => 'pl6', 'class' => 'pl7', 'url' => 'mazowieckie', 'title' => 'mazowieckie'],
    ['id' => 'pl8', 'class' => 'pl8', 'url' => 'opolskie', 'title' => 'opolskie'],
    ['id' => 'pl9', 'class' => 'pl9', 'url' => 'podkarpackie', 'title' => 'podkarpackie'],
    ['id' => 'pl10', 'class' => 'pl10', 'url' => 'podlaskie', 'title' => 'podlaskie'],
    ['id' => 'pl11', 'class' => 'pl11', 'url' => 'pomorskie', 'title' => 'pomorskie'],
    ['id' => 'pl16', 'class' => 'pl12', 'url' => 'slaskie', 'title' => 'śląskie'],
    ['id' => 'pl17', 'class' => 'pl13', 'url' => 'swietokrzyskie', 'title' => 'świętokrzyskie'],
    ['id' => 'pl12', 'class' => 'pl14', 'url' => 'warminsko-mazurskie', 'title' => 'warmińsko-mazurskie'],
    ['id' => 'pl13', 'class' => 'pl15', 'url' => 'wielkopolskie', 'title' => 'wielkopolskie'],
    ['id' => 'pl14', 'class' => 'pl16', 'url' => 'zachodniopomorskie', 'title' => 'zachodniopomorskie']
  ];

  $obszar = explode(', ', do_shortcode('[acf field="dl_obszar_dzialania"]'));

  $html = '<ul class="poland">';

  foreach ($voivodeships as $voivodeship) {
    $html .= '<li id="' . $voivodeship['id'] . '" class="' . $voivodeship['class'];

    if (in_array($voivodeship['title'], $obszar)) {
      $html .= ' active-region';
    }

    $html .= '"><a href="#' . $voivodeship['url'] . '" title="' . $voivodeship['title'] . '">' . $voivodeship['title'] . ' <span class="bg"></span></a></li>';
  }

  $html .= '</ul>';

  return $html;
}
add_shortcode('map_obszar_dl', 'map_obszar_dl_shortcode');

function badges_dl_shortcode()
{
  $badges    = [
    ['title' => 'dystrybutor', 'url' => '/wp-content/uploads/2019/07/DYS-1.png'],
    ['title' => 'autoryzowany serwis wapro B2C', 'url' => '/wp-content/uploads/2019/07/ASA-1.png'],
    ['title' => 'autoryzowane centrum serwisowe', 'url' => '/wp-content/uploads/2019/08/ASC-1.png'],
    ['title' => 'autoryzowane centrum szkoleniowe', 'url' => '/wp-content/uploads/2019/08/ACS-1.png'],
    ['title' => 'autoryzowany serwis', 'url' => '/wp-content/uploads/2019/08/AS-1.png'],
    ['title' => 'złoty partner', 'url' => '/wp-content/uploads/2019/08/PZ-1.png'],
    ['title' => 'srebrny partner', 'url' => '/wp-content/uploads/2019/08/PS-1.png'],
    ['title' => 'brązowy partner', 'url' => '/wp-content/uploads/2019/08/PB-1.png'],
    ['title' => 'punkt sprzedaży', 'url' => '/wp-content/uploads/2019/08/POS-1.png'],
    ['title' => 'złoty dealer', 'url' => '/wp-content/uploads/2019/08/DZ-1.png'],
    ['title' => 'srebrny dealer', 'url' => '/wp-content/uploads/2019/08/DS-1.png'],
    ['title' => 'brązowy dealer', 'url' => '/wp-content/uploads/2019/08/DB-1.png']
  ];
  $html    = '';

  $etykiety  = explode(', ', do_shortcode('[acf field="dl_etykieta"]'));

  foreach ($badges as $badge) {
    if (in_array($badge['title'], $etykiety)) {
      $html .= '<img src="' . $badge['url'] . '" alt="' . $badge['title'] . '" border="0" align="middle" style="width: 212px;margin-right: 20px;" />';
    }
  }

  return $html;
}
add_shortcode('badges_dl', 'badges_dl_shortcode');

add_filter('wpcf7_validate_number*', 'custom_online_number_validation_filter', 20, 2);

function custom_online_number_validation_filter($result, $tag)
{
  $tags = [
    'number-mag', 'number-mag-biznes', 'number-fakir', 'number-kaper', 'number-gang', 'number-best',
    'number-aukcje', 'number-analizy', 'number-mobile', 'number-jpk-biznes', 'number-jpk'
  ];
  if (in_array($tag->name, $tags)) {
    $sum = 0;

    foreach ($tags as $item) {
      $sum += intval($_POST[$item]);
    }

    if ($sum <= 0) {
      $result->invalidate($tag, "Proszę wybrać conajmniej jeden program!");
    }

    if (
      !isset($_POST['posiada-online']) and intval($_POST['number-jpk-biznes']) > 0 and intval($_POST['number-mag']) == 0 and
      intval($_POST['number-fakir']) == 0 and intval($_POST['number-kaper']) == 0
    ) {
      $result->invalidate($tag, "Jeżeli wybrałeś WAPRO JPK musisz zaznaczyć WAPRO Mag, WAPRO Fakir lub WAPRO Kaper bądź zaznaczyć Mam już WAPRO Online jeżeli posiadasz wykupiona usługę.");
    }

    if (
      !isset($_POST['posiada-online']) and intval($_POST['number-jpk']) > 0 and intval($_POST['number-mag']) == 0 and
      intval($_POST['number-fakir']) == 0 and intval($_POST['number-kaper']) == 0
    ) {
      $result->invalidate($tag, "Jeżeli wybrałeś WAPRO JPK Biuro musisz zaznaczyć WAPRO Mag, WAPRO Fakir lub WAPRO Kaper bądź zaznaczyć Mam już WAPRO Online jeżeli posiadasz wykupiona usługę.");
    }

    if (intval($_POST['number-jpk']) > 0 and intval($_POST['number-jpk-biznes']) > 0) {
      $result->invalidate($tag, "Jeżeli zaznaczyłeś WAPRO JPK Biznes to nie możesz zaznaczyć WAPRO JPK Biuro.");
    }

    if (intval($_POST['number-mag']) > 0 and intval($_POST['number-mag-biznes']) > 0) {
      $result->invalidate($tag, "Jeżeli zaznaczyłeś WAPRO Mag Biznes to nie możesz zaznaczyć WAPRO Mag.");
    }
  }

  return $result;
}

add_filter('wpcf7_validate_acceptance', 'custom_online_acceptance_validation_filter', 20, 2);

function custom_online_acceptance_validation_filter($result, $tag)
{
  if ($tag->name == 'zgoda-rodo') {
    if (!isset($_POST['zgoda-rodo'])) {
      $result->invalidate($tag, "Wyrażenie zgody jest wymagane.");
    }
  }

  return $result;
}

add_filter('wpcf7_validate_select*', 'custom_archive_select_validation_filter', 20, 2);

function custom_archive_select_validation_filter($result, $tag)
{
  $programy = [
    ['name' => 'program_version_aukcje', 'title' => 'WAPRO Aukcje'],
    ['name' => 'program_version_analizy', 'title' => 'WAPRO Analizy'],
    ['name' => 'program_version_best', 'title' => 'WAPRO Best'],
    ['name' => 'program_version_fakir', 'title' => 'WAPRO Fakir'],
    ['name' => 'program_version_fakturka', 'title' => 'WAPRO Fakturka'],
    ['name' => 'program_version_gang', 'title' => 'WAPRO Gang'],
    ['name' => 'program_version_jpk', 'title' => 'WAPRO JPK'],
    ['name' => 'program_version_kaper', 'title' => 'WAPRO kaper'],
    ['name' => 'program_version_mag', 'title' => 'WAPRO mag'],
    ['name' => 'program_version_mobile', 'title' => 'WAPRO Mobile'],
    ['name' => 'program_version_mobile_android', 'title' => 'WAPRO Mobile Android'],
    ['name' => 'program_version_wf_kaper_dos', 'title' => 'WF-KaPeR DOS'],
    ['name' => 'program_version_wf_mag_dos', 'title' => 'WF-MAG DOS'],
    ['name' => 'program_version_wf_fakir_dos', 'title' => 'WF-FaKir DOS']
  ];

  foreach ($programy as $key => $value) {
    if ($tag->name == $value['name'] and $_POST['program'] == $value['title']) {
      if ($_POST[$tag->name] == 'wybierz numer wersji') {
        $result->invalidate($tag, "Proszę wybrać wersję programu!");
      }
    }
  }

  return $result;
}

add_action("wpcf7_posted_data", "wpcf7_modify_this");

function wpcf7_modify_this($posted_data)
{

  if (array_key_exists('posiada-online', $posted_data)) {
    if ($posted_data['posiada-online'][0] == "") {
      $posted_data['posiada-online'][0] = "Nie";
    } else {
      $posted_data['posiada-online'][0] = "Tak";
    }
  }

  return $posted_data;
}

add_action('check_admin_referer', 'logout_without_confirm', 10, 2);

function logout_without_confirm($action, $result)
{
  /**
   * Allow logout without confirmation
   */
  if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
    $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : 'url-you-want-to-redirect';
    $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
    header("Location: $location");
    die;
  }
}

add_action('login_enqueue_scripts', 'style_login_page', 10);

function style_login_page()
{
  wp_enqueue_style('core', get_template_directory_uri() . '/custom/login.css', false, '20190928001');
}

add_filter('wpcf7_validate_text*', 'custom_archive_text_validation_filter', 20, 2);

function custom_archive_text_validation_filter($result, $tag)
{
  if ($tag->name == 'your-nip-register' or $tag->name == 'NIP') {
    require_once 'custom/NIP24/NIP24Client.php';

    \NIP24\NIP24Client::registerAutoloader();

    $nip24 = new \NIP24\NIP24Client('wRocgSXQIItj', '2PEXnwYwCwVA');

    //$nip = '7171642051';
    if ($tag->name == 'your-nip-register') {
      $nip = preg_replace('/\s+/', '', str_replace('-', '', strip_tags($_POST['your-nip-register'])));
    } else {
      $nip = preg_replace('/\s+/', '', str_replace('-', '', strip_tags($_POST['NIP'])));
    }
    $nip_eu = 'PL' . $nip;

    // Sprawdzenie stanu konta
    $account = $nip24->getAccountStatus();

    if (!$account) {
      $result->invalidate($tag, $nip24->getLastError());
    } else {
      // Wywołanie metody zwracającej szczegółowe dane firmy
      $all = $nip24->getAllDataExt(\NIP24\Number::NIP, $nip, false);

      if (!$all) {
        $result->invalidate($tag, $nip24->getLastError());
      }
    }

    /*$url    = 'https://mcl.assecobs.pl/ERP_Service/services_integration_api/ApiWebService.ashx?wsdl&dbc=ABS_TEST';
    //$url    = 'https://mcl.assecobs.pl/ERP_Service_Prod/services_integration_api/ApiWebService.ashx?wsdl&dbc=ABS_PROD';

    $client = new SoapClient($url, array("trace" => 1, "exception" => 0));

    //$params   = array('ArrayCustomerGetData' => array('CustomerGetData' => array('NIPSameCyfry' => $nip)));
    //$response = $client->CUSTOMERGET($params);

    $params   = array('ArrayDPAgreementGetData' => array('DPAgreementGetData' => array('NIPSameCyfry' => $nip)));
    $response = $client->DPAgreementGet($params);

    print_r($response);*/

    //if (email_exists($_POST['your-nip-register'])) {
    //$result->invalidate($tag, "Uzytkownik o podanym NIP-ie juz istnieje w systemie.");
    //}
  }

  if ($tag->name == 'your-login-admin') {
    if (username_exists($_POST['your-login-admin'])) {
      $result->invalidate($tag, "Uzytkownik o podanej nazwie juz istnieje w systemie.");
    }
  }

  return $result;
}

add_filter('wpcf7_validate_email*', 'custom_archive_email_validation_filter', 20, 2);

function custom_archive_email_validation_filter($result, $tag)
{
  if ($tag->name == 'email-admin') {
    if (email_exists($_POST['email-admin'])) {
      $result->invalidate($tag, "Uzytkownik o podanym adresie email juz istnieje w systemie.");
    }
  }

  return $result;
}

add_filter('wpcf7_validate_checkbox', 'custom_archive_checkbox_validation_filter', 20, 2);

function custom_archive_checkbox_validation_filter($result, $tag)
{
  if ($tag->name == 'dl-produkty-szkolenie') {
    if (
      !isset($_POST['dl-produkty-sprzedaz']) &&
      !isset($_POST['dl-produkty-wdrozenie']) &&
      !isset($_POST['dl-produkty-serwis']) &&
      !isset($_POST['dl-produkty-szkolenie'])
    ) {
      $result->invalidate($tag, 'Proszę wybrać przynajmniej jedną opcję!');
    }
  }

  return $result;
}

add_action('wpcf7_mail_sent', 'after_sent_mail');

/**
 * Everything which shlould be done after the cf7 will send an email.
 *
 * @param   object $cf7
 * @return  void
 */
function after_sent_mail($cf7)
{
  global $wpdb;
  // Run code after the email has been sent
  $wpcf7 = WPCF7_ContactForm::get_current();
  $submission = WPCF7_Submission::get_instance();

  if ($submission) {
    //Below statement will return all data submitted by form.
    $data = $submission->get_posted_data();

    // Register dealer form
    if ($data['_wpcf7'] == '45267') {
      // Adding user
      $user_id = username_exists($data['your-login-admin']);

      if (!$user_id and email_exists($data['email-admin']) == false) {
        if (strlen($data['password']) < 2) {
          $data['password'] = randomPassword();
        }
        $user_id = wp_create_user($data['your-login-admin'], $data['password'], $data['email-admin']);

        $user = new \WP_User($user_id);
        $user->set_role('registered');

        $biura_id = get_blog_id_from_url("biura.wpdev.wapro.pl");
        if ($biura_id) {
          add_user_to_blog($biura_id, $user_id, 'brakbiuro');
        }

        $wpdev_id = get_blog_id_from_url("wpdev.wapro.pl");
        if ($wpdev_id) {
          add_user_to_blog($wpdev_id, $user_id, 'brak');
        }

        $pomoc_id = get_blog_id_from_url("pomoc.wpdev.wapro.pl");
        if ($pomoc_id) {
          add_user_to_blog($pomoc_id, $user_id, 'brak');
        }
      }

      // TODO: Modify user data (NIP, etc.)
      // NIP in the user data
      update_field('field_5dad6f08461cd', $data['your-nip-register'], 'user_' . $user_id);

      // Adding dealer localization
      // Add Post with dealer localization
      $post_id = 45129;
      $post = get_post($post_id);

      if (isset($post) && $post != null) {
        // new post data array
        $args = array(
          'comment_status' => $post->comment_status,
          'ping_status'    => $post->ping_status,
          'post_author'    => $post->post_author,
          'post_content'   => $post->post_content,
          'post_excerpt'   => $post->post_excerpt,
          'post_name'      => $post->post_name,
          'post_parent'    => $post->post_parent,
          'post_password'  => $post->post_password,
          'post_status'    => 'draft',
          'post_title'     => $data['your-company'],
          'post_type'      => $post->post_type,
          'to_ping'        => $post->to_ping,
          'menu_order'     => $post->menu_order
        );

        // Create new post
        $new_post_id = wp_insert_post($args);

        // UserID in the post data
        update_field('field_5d9dce5fc0656', $user_id, 'post_' . $new_post_id);

        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
          $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
          wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");

        if (count($post_meta_infos) != 0) {
          $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
          foreach ($post_meta_infos as $meta_info) {
            $meta_key = $meta_info->meta_key;
            if ($meta_key == '_wp_old_slug') continue;
            if ($meta_key == 'dl_adres') {
              $meta_value = addslashes($data['your-adres']);
            } elseif ($meta_key == 'dl_kod_pocztowy') {
              $meta_value = addslashes($data['your-code']);
            } elseif ($meta_key == 'dl_miasto') {
              $meta_value = addslashes($data['your-city']);
            } elseif ($meta_key == 'dl_wojewodztwo') {
              $meta_value = addslashes($data['wojewodztwo']);
            } elseif ($meta_key == 'dl_obszar_dzialania') {
              $json = 'a:' . count($data['dl-obszar-dzialania']) . ':{';
              $i = 0;
              foreach ($data['dl-obszar-dzialania'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['dl-obszar-dzialania'] = $json . '}';
              $meta_value = addslashes($data['dl-obszar-dzialania']);
            } elseif ($meta_key == 'dl_telefon') {
              $meta_value = addslashes($data['telefon']);
            } elseif ($meta_key == 'dl_fax') {
              $meta_value = addslashes($data['fax']);
            } elseif ($meta_key == 'dl_email') {
              $meta_value = addslashes($data['email-kontakt']);
            } elseif ($meta_key == 'dl_www') {
              $meta_value = addslashes($data['your-wwww']);
            } elseif ($meta_key == 'dl_produkty_serwis') {
              $json = 'a:' . count($data['dl-produkty-serwis']) . ':{';
              $i = 0;
              foreach ($data['dl-produkty-serwis'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['dl-produkty-serwis'] = $json . '}';
              $meta_value = addslashes($data['dl-produkty-serwis']);
            } elseif ($meta_key == 'dl_produkty_sprzedaz') {
              $json = 'a:' . count($data['dl-produkty-sprzedaz']) . ':{';
              $i = 0;
              foreach ($data['dl-produkty-sprzedaz'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['dl-produkty-sprzedaz'] = $json . '}';
              $meta_value = addslashes($data['dl-produkty-sprzedaz']);
            } elseif ($meta_key == 'dl_produkty_szkolenie') {
              $json = 'a:' . count($data['dl-produkty-szkolenie']) . ':{';
              $i = 0;
              foreach ($data['dl-produkty-szkolenie'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['dl-produkty-szkolenie'] = $json . '}';
              $meta_value = addslashes($data['dl-produkty-szkolenie']);
            } elseif ($meta_key == 'dl_produkty_wdrozenie') {
              $json = 'a:' . count($data['dl-produkty-wdrozenie']) . ':{';
              $i = 0;
              foreach ($data['dl-produkty-wdrozenie'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['dl-produkty-wdrozenie'] = $json . '}';
              $meta_value = addslashes($data['dl-produkty-wdrozenie']);
            } else {
              $meta_value = addslashes($meta_info->meta_value);
            }
            $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            $wpdb->query($sql_query);
          }
          $sql_query .= implode(" UNION ALL ", $sql_query_sel);
          $wpdb->query($sql_query);
        }
      }

      // Send information to ERP
      // TODO: Use webservices to send data to ERP???
    }

    // Register dealer form
    if ($data['_wpcf7'] == '46621') {
      // Adding user
      $user_id = username_exists($data['your-login-admin']);

      if (!$user_id and email_exists($data['email-admin']) == false) {
        if (strlen($data['password']) < 2) {
          $data['password'] = randomPassword();
        }
        $user_id = wp_create_user($data['your-login-admin'], $data['password'], $data['email-admin']);

        $user = new \WP_User($user_id);
        $user->set_role('registeredbiuro');

        $dealer_id = get_blog_id_from_url("partnerzy.wpdev.wapro.pl");
        if ($dealer_id) {
          add_user_to_blog($dealer_id, $user_id, 'brak');
        }

        $wpdev_id = get_blog_id_from_url("wpdev.wapro.pl");
        if ($wpdev_id) {
          add_user_to_blog($wpdev_id, $user_id, 'brak');
        }

        $pomoc_id = get_blog_id_from_url("pomoc.wpdev.wapro.pl");
        if ($pomoc_id) {
          add_user_to_blog($pomoc_id, $user_id, 'brak');
        }
      }

      // Adding dealer localization
      // Add Post with dealer localization
      $post_id = 45990;
      $post = get_post($post_id);

      if (isset($post) && $post != null) {
        // new post data array
        $args = array(
          'comment_status' => $post->comment_status,
          'ping_status'    => $post->ping_status,
          'post_author'    => $post->post_author,
          'post_content'   => $post->post_content,
          'post_excerpt'   => $post->post_excerpt,
          'post_name'      => $post->post_name,
          'post_parent'    => $post->post_parent,
          'post_password'  => $post->post_password,
          'post_status'    => 'draft',
          'post_title'     => $data['your-company'],
          'post_type'      => $post->post_type,
          'to_ping'        => $post->to_ping,
          'menu_order'     => $post->menu_order
        );

        // Create new post
        $new_post_id = wp_insert_post($args);

        // TODO: Modify user data (add main localization)
        //update_field('field_5dad6f08461cd', $data['your-nip-register'], 'user_' . $user_id);

        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
          $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
          wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");

        if (count($post_meta_infos) != 0) {
          $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
          foreach ($post_meta_infos as $meta_info) {
            $meta_key = $meta_info->meta_key;
            if ($meta_key == '_wp_old_slug') continue;
            if ($meta_key == 'br_adres') {
              $meta_value = addslashes($data['your-adres']);
            } elseif ($meta_key == 'br_kod_pocztowy') {
              $meta_value = addslashes($data['your-code']);
            } elseif ($meta_key == 'br_miasto') {
              $meta_value = addslashes($data['your-city']);
            } elseif ($meta_key == 'br_wojewodztwo') {
              $meta_value = addslashes($data['wojewodztwo']);
            } elseif ($meta_key == 'br_obszar_dzialania') {
              $json = 'a:' . count($data['br-obszar-dzialania']) . ':{';
              $i = 0;
              foreach ($data['br-obszar-dzialania'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['br-obszar-dzialania'] = $json . '}';
              $meta_value = addslashes($data['br-obszar-dzialania']);
            } elseif ($meta_key == 'br_telefon') {
              $meta_value = addslashes($data['telefon']);
            } elseif ($meta_key == 'br_fax') {
              $meta_value = addslashes($data['fax']);
            } elseif ($meta_key == 'br_email') {
              $meta_value = addslashes($data['email-kontakt']);
            } elseif ($meta_key == 'br_www') {
              $meta_value = addslashes($data['your-wwww']);
            } elseif ($meta_key == 'br_online') {
              // IMPROVE !!!
              $meta_value = addslashes($data['zgloszenie-biura']);
            } elseif ($meta_key == 'br_rodzaj_biura') {
              $json = 'a:' . count($data['br-rodzaj-biura']) . ':{';
              $i = 0;
              foreach ($data['br-rodzaj-biura'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['br-rodzaj-biura'] = $json . '}';
              $meta_value = addslashes($data['br-rodzaj-biura']);
            } elseif ($meta_key == 'br_zakres_uslug') {
              $json = 'a:' . count($data['br-zakres-uslug']) . ':{';
              $i = 0;
              foreach ($data['br-zakres-uslug'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['br-zakres-uslug'] = $json . '}';
              $meta_value = addslashes($data['br-zakres-uslug']);
            } elseif ($meta_key == 'br_zakres_uslug_online') {
              $json = 'a:' . count($data['br-zakres-uslug-online']) . ':{';
              $i = 0;
              foreach ($data['br-zakres-uslug-online'] as $item) {
                $json .= 'i:' . $i . ';s:' . strlen($item) . ':"' . $item . '";';
                $i++;
              }
              $data['br-zakres-uslug-online'] = $json . '}';
              $meta_value = addslashes($data['br-zakres-uslug-online']);
            } else {
              $meta_value = addslashes($meta_info->meta_value);
            }
            $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            $wpdb->query($sql_query);
          }
          $sql_query .= implode(" UNION ALL ", $sql_query_sel);
          $wpdb->query($sql_query);
        }
      }

      // Send information to ERP
      // TODO: Use webservices to send data to ERP???
    }
  }
}

function my_login_redirect($redirect_to, $request, $user)
{
  if (isset($user->roles) && is_array($user->roles)) {
    if (in_array('registered', $user->roles)) {
      $redirect_to =  'https://partnerzy.wpdev.wapro.pl/dziekujemy-za-rejestracje/';
    }

    if (in_array('registeredbiuro', $user->roles)) {
      $redirect_to =  'https://biura.wpdev.wapro.pl/dziekujemy-za-rejestracje/';
    }
  }

  return $redirect_to;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);

function randomPassword()
{
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#$%^&*!?<>';
  $pass = array();
  $alphaLength = strlen($alphabet) - 1;
  for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  return implode($pass);
}