<?php
function check_db_pt()
{
      $CI = &get_instance();
      $session_db_pt = strtolower($CI->session->userdata('app_pt'));
      if (empty($session_db_pt)) {
            $db_pt = "center";
      } elseif ($session_db_pt == 'msal') {
            $db_pt = 'msal';
      } elseif ($session_db_pt == 'mapa') {
            $db_pt = 'mapa';
      } elseif ($session_db_pt == 'psam') {
            $db_pt = 'psam';
      } elseif ($session_db_pt == 'peak') {
            $db_pt = 'peak';
      } elseif ($session_db_pt == 'kpp') {
            $db_pt = 'kpp';
      } elseif ($session_db_pt == 'dev') {
            $db_pt = 'dev';
      }
      return $db_pt;
}
