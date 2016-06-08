<?php
	
	if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
	if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
	require_once(DOKU_PLUGIN.'syntax.php');
	
	
	class syntax_plugin_skipentity extends DokuWiki_Syntax_Plugin {
	
		
        function getType(){ return 'formatting'; }			
		function getAllowedTypes() { 
			return array();
		}
		function getSort(){ return 25; }
		
		function connectTo($mode) {
			$this->Lexer->addEntryPattern('``(?=.*?``)',$mode,'plugin_skipentity');
			
		}
		function postConnect() {
			$this->Lexer->addExitPattern('``','plugin_skipentity');
			
		}
		function __construct() {
		    
		}
		function handle($match, $state, $pos, &$handler) {		 
 			switch ($state) {		
				case DOKU_LEXER_ENTER :     
				   return array($state, '');          
				
				case DOKU_LEXER_UNMATCHED :				  
				return array($state, $match);
                
				case DOKU_LEXER_EXIT :            
				return array($state,'');
				
				default:				
				return array($state,$match);
			}
		}
		
		function render($mode, &$renderer, $data) {
			global $INFO;

			if($mode == 'xhtml'){
			
				list($state, $match) = $data;
				
				switch ($state) {
					case DOKU_LEXER_ENTER :				    
					$renderer->doc .= '<code>';
					break;
					
					case DOKU_LEXER_UNMATCHED :
                    $renderer->doc .= $renderer->_xmlEntities($match); 
					break;
					case DOKU_LEXER_EXIT :
				    $renderer->doc .= "</code>";
				    break;
				}
				return true;
				
			} 
		
			return false;
		}
 }        
			

?>
