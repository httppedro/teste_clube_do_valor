<?php
/**
 * Plugin Name: Clicked Registers
 * Description: Um plugin de exemplo para adicionar um comando WP-CLI e exibir quantas vezes foi clicado o botão.
 * Version: 1.0
 * Author: Seu Nome
 */

 if ( defined( 'WP_CLI' ) && WP_CLI ) {
  WP_CLI::add_command( 'listar-registros', 'listar_registros_comando' );
}

function listar_registros_comando( $args, $assoc_args ) {
  global $wpdb;
  $tabela = $wpdb->prefix . 'registros_data_hora';

  $registros = $wpdb->get_results("SELECT * FROM $tabela ORDER BY data_hora DESC", ARRAY_A);

  if (empty($registros)) {
      WP_CLI::success('Nenhum registro encontrado.');
      return;
  }

  WP_CLI\Utils\format_items( 'table', $registros, array( 'id', 'data_hora' ) );
}

