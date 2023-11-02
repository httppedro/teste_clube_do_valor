<?php
/*
Plugin Name: Widget button
Description: Adicione registros de data e hora ao banco de dados ao clicar no botão.
Version: 0.1
*/

// Registre o shortcode
function button_widget_shortcode() {
  ob_start();
  ?>
  <form method="post">
      <button type="submit" name="registrar_data_hora">Registrar Data e Hora</button>
  </form>
  <?php
  if (isset($_POST['registrar_data_hora'])) {
      global $wpdb;
      $tabela = $wpdb->prefix . 'registros_data_hora';

      $data_hora = current_time('mysql');
      
      $wpdb->insert($tabela, array('data_hora' => $data_hora));
      echo "Registro de data e hora adicionado com sucesso!";
  }
  return ob_get_clean();
}
add_shortcode('button_widget', 'button_widget_shortcode');

// Ative o plugin
register_activation_hook(__FILE__, 'button_widget_ativar');

function button_widget_ativar() {
  global $wpdb;
  $tabela = $wpdb->prefix . 'registros_data_hora';
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $tabela (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      data_hora datetime NOT NULL,
      PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

// Desative o plugin
register_deactivation_hook(__FILE__, 'button_widget_desativar');

function button_widget_desativar() {
  global $wpdb;
  $tabela = $wpdb->prefix . 'registros_data_hora';
  $wpdb->query("DROP TABLE IF EXISTS $tabela");
}