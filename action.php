<?php
/**
 * Action Component for the Wrap Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author    Myron Turner<turnermm02@shaw.ca>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_skipentity extends DokuWiki_Action_Plugin {

     /**
      * register the eventhandlers     
    */
    function register(Doku_Event_Handler $controller){
        $controller->register_hook('DOKUWIKI_STARTED', 'AFTER', $this, 'handle_started', array ());    
    }

    function handle_started(Doku_Event $event, $param) {
  
              $multiple = $this->getConf('multiple');      
     }


}

