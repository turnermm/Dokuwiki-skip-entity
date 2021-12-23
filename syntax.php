<?php
	
	if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
	if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
	require_once(DOKU_PLUGIN.'syntax.php');
	
	
	class syntax_plugin_skipentity extends DokuWiki_Syntax_Plugin {
	
		
        function getType(){ return 'formatting'; }			
		function getAllowedTypes() { 
            global $PARSER_MODES;
            foreach(array('monospace','emphasis') AS $del_val) {
                $this->array_val_delete($PARSER_MODES['formatting'],$del_val);
            }            
          //  $PARSER_MODES['formatting'] = array('strong','underline','subscript', 'superscript', 'deleted', 'footnote');
            if($this->getConf('allow_formats')) {
                return array('formatting');
            }
			return array();
		}
		function getSort(){ return 25; }
		
		function connectTo($mode) {			
        	$this->Lexer->addEntryPattern('```?(?=.*?```?)',$mode,'plugin_skipentity');			
		}
        
		function postConnect() {
            $this->Lexer->addExitPattern('```?','plugin_skipentity');
		}
        
		function __construct() {	}
        
		function handle($match, $state, $pos,  Doku_Handler $handler) {		 
 			switch ($state) {		
				case DOKU_LEXER_ENTER :     
				   return array($state, trim($match));          
				
				case DOKU_LEXER_UNMATCHED :				  
				return array($state, $match);
                
				case DOKU_LEXER_EXIT :            
				return array($state,'');
				
				default:				
				return array($state,$match);
			}
		}
		
		function render($mode,  Doku_Renderer  $renderer, $data) {
			global $INFO;

			if($mode == 'xhtml'){
			
				list($state, $match) = $data;
				
				switch ($state) {
					case DOKU_LEXER_ENTER :
                    if($match == '``') { 
                              $renderer->doc .= '<code>';                                
                       }
                      else { 
                         $renderer->doc .= '<code class="skipentity">';                         
                      }   
                      break;
					
					case DOKU_LEXER_UNMATCHED :
                        $match = $renderer->_xmlEntities($match); 
                        $match = str_replace("\n","<br>", $match);
                        if(strpos($match,'  ') !== false) {
                            $match = preg_replace("/\s/m","&nbsp;",$match);                         
                        }                       
                        $renderer->doc .= $match;                 
					break;
					case DOKU_LEXER_EXIT :
				    $renderer->doc .= "</code>";
				    break;
				}
				return true;
				
			} 
		
			return false;
		}
        
    function array_val_delete(&$ar,$del_val){
        if (($key = array_search($del_val, $ar)) !== false) {
        unset($ar[$key]);
    }
   }     
 }        
			

?>
