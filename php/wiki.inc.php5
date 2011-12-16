<?php

/*******************************************************************************
Wiki parser
********************************************************************************
Version:	0.2
Nickname:	Water
Autor:		Mildred (mildred593 {at} online.fr)
		http://mildred632.online.fr/
		http://louve.dyndns.org/
		http://purl.org/NET/louve/2005/root/
********************************************************************************
Fichier PHP sous licence GPL	http://www.april.org/gnu/gpl_french.html
PHP file under GPL licence	http://www.gnu.org/licenses/gpl.html
Fichier PHP sous licence Créatice Commons By-ShareAlike 2.0
		http://creativecommons.org/licenses/by-sa/2.0/
*******************************************************************************/

// Licence: GPL 2 or GPL > 2
// Author: mildred593 at online.fr
// http://louve.dyndns.org

/*
Changelog

1.0	1 feb 2005
	Première version

1.0.1	2 feb 2005
	Compatibilité php4
	Plus de passage par référence avec affectation: func(&$i=0)

*/

class parseWiki{
	function defaultConfig($self="defaultConfig"){
		$this->opt=array(
			'pregBlock'=>array(
				// ext rec re mode apply_to new_mode next_type preg
				array(1, 0, 0, 0,	NULL,		0, "hr",	"/^-{4,}/"),
				array(1, 0, 0, 0,	NULL,		0, "hrclear",	"/^={4,}/"),
				array(2, 0, 0, 0,	NULL,		0, "title",	"/^(=+)([^=].*[^=])(=*)$/"),
				array(2, 0, 0, 0,	NULL,		0, "title2",	"/^(!+)([^!].*[^!])(!*)$/"),
				array(2, 1, 0, 0,	"ul2",	0, "ul",	"/^(\.|-)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ul",		0, "ul2",	"/^(\.|-)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	NULL,		0, "ul",	"/^(\.|-)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ul",		0, "ul",	"/^( )((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ul2",	0, "ul2",	"/^( )((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ol2",	0, "ol",	"/^(#)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ol",		0, "ol2",	"/^(#)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	NULL,		0, "ol",	"/^(#)((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ol",		0, "ol",	"/^( )((\.|#|-)*\s*(.*))$/"),
				array(2, 1, 0, 0,	"ol2",	0, "ol2",	"/^( )((\.|#|-)*\s*(.*))$/"),
				array(1, 0, 0, 0,	NULL,		0, "code",	"/^<code>(.*)<\/code>$/"),
				array(1, 0, 1, 0,	NULL,		1, "p",		"/^(.*)<code>.*$/"),
				array(1, 0, 0, 1,	NULL,		2, "code",	"/^.*<code>(.*)$/"),
				array(1, 0, 1, 2,	"code",	1, "code",	"/^(.*)<\/code>.*$/"),
				array(1, 0, 0, 1,	"code",	0, "p",		"/^.*<\/code>(.*)$/"),
				array(1, 0, 0, 2,	"code",	2, "code",	"/^(.*)$/"),
				array(0, 0, 0, 0,	NULL,		0, NULL,	"/^\s*$/"),
				array(1, 0, 0, 0,	NULL,		0, "p",		"/^(.*)$/")
				// extract:	identify  pred number. Which text should be used
				// recur:	recursive boolean
				// redo:	reparse line boolean
				// mode:	let you continue a block if current mode is equal
				//		to that parameter and preg matches
				//		initial mode: 0
				// apply_to:	desactivate rule if current type is not equal to
				//		that parameter. If NULL, applies evrywhere.
				// new_mode:	Let you begin a block if preg matches
				// next_type:	if apply_type is true, change type to that parameter
				// preg:	Perl regular expression.
			),
			'pregInline'=>array(
				array("em",			"//", NULL, "//"),
				array("strong",	"**", NULL, "**"),
				array("quote",	"<<", NULL, ">>"),
				array("add",		"++++", NULL, "++"),
				array("rem",		"----", NULL, "--"),
				array("link",		"[[", "][", "]]"),
				array("object",	"[(", ")(", ")]"),
				array("include",	"((", ")(", "))")
			),
			'trTypes'=>array(
				'ol2'=>'ol',
				'ul2'=>'ul'
			)
		);
		$this->countRecursive=0;
		$this->maxRecursion=10;
	}
	function setOpt($option, $value, $self="setOpt"){
		$this->opt[$option] = $value;
	}
	function getOpt($option, $self="getOpt"){
		return (!empty($this->opt[$option])) ? $this->opt[$option] : false;
	}
	function trType($type, $self="trType"){
		$arr=$this->getOpt('trTypes');
		return str_replace(array_keys($arr), array_values($arr), $type);
	}
	function fixMSWordEntities($res, $self="fixMSWordEntities"){
		$wR = array(chr(0x82) => '&#8218;', chr(0x83) => '&#402;', chr(0x84) => '&#8222;',
			chr(0x85) => '&#8230;', chr(0x86) => '&#8224;', chr(0x87) => '&#8225;',
			chr(0x88) => '&#710;', chr(0x89) => '&#8240;', chr(0x8A) => '&#352;',
			chr(0x8B) => '&#8249;', chr(0x8C) => '&#338;', chr(0x91) => '&#8216;',
			chr(0x92) => '&#8217;', chr(0x93) => '&#8220;', chr(0x94) => '&#8221;',
			chr(0x95) => '&#8226;', chr(0x96) => '&#8211;', chr(0x97) => '&#8212;',
			chr(0x98) => '&#732;', chr(0x99) => '&#8482;', chr(0x9A) => '&#353;',
			chr(0x9B) => '&#8250;', chr(0x9C) => '&#339;', chr(0x9F) => '&#376;',
			chr(0x80) => '&#8364;');
		return str_replace(array_keys($wR), array_values($wR), $res);
	}
	function parseBlock($wikitext, $debug=false, $self="parseBlock"){
		$this->countRecursive++;
		if($this->countRecursive>=$this->maxRecursion) return $wikitext."@";
		$array = $this->arrayBlock($wikitext);
	//	if($debug){
	//		ob_start();
	//		print_r($array);
	//		$print = ob_get_contents();
	//		ob_end_clean();
	//		print "<pre>".htmlspecialchars($print)."</pre>";
	//	}
		$result = '';
		$oldtype=NULL;
		foreach($array as $j=>$item){ // for each bloc found
			$nexttype=isset($array[$j+1]['type'])?$array[$j+1]['type']:NULL;
			$result.=$this->callBlock(
				$item['type'],
				$item['wikilines'],
				$item['lines'],
				$item['regs'],
				array(
					'recursive'=>$item['recursive'],
					'prevtype'=>$oldtype,
					'nexttype'=>$nexttype));
			$result.=$add;
			$oldtype=$item['type'];
		}
		$this->countRecursive--;
		return $result;
	}
	function parseInline($wikitext, $self="parseInline"){
		$function = $this->getOpt('fct_blank_text');
		$array = $this->arrayInline($wikitext);
		//if(!is_array($array)) return false;
		$result = '';
		foreach($array as $item){
			if(is_array($item))
				$result.=$this->callInline(array_shift($item), $item);
			elseif($function)
				$result.=$this->$function($item);
			else	$result.=$item;
		}
		return $result;
	}
	function arrayBlock($wikitext, $self="arrayBlock"){
		$wikitext = str_replace("\r\n", "\n", $wikitext);
		$wikitext = str_replace("\r", "\n", $wikitext);
		if(!strlen($wikitext))		$lines=array();
		elseif(strpos($wikitext, "\n"))	$lines=explode("\n", $wikitext);
		else				$lines=array($wikitext);
		$type=NULL;
		$force=0;
		$i=0; // index of current bloc
		$result=array();
		$mode=0;
		$j=0; // index of the current line
		$jmax=count($lines)-1;
		//foreach($lines as $line){
		for($j=0; $j<=$jmax; $j++){
			$line=$lines[$j];
			// for each line
			$line = rtrim($line);
			$print=1;
			$wikiline=$line;
			foreach($this->getOpt('pregBlock') as $ruleid=>$array){
				// for each rule
				list($print, $recursive, $redo, $newmode, $matchtype, $setmode, $newtype, $preg)=$array;
				if($newmode!=$mode) continue;
					// If mode dont match, continue
				
				if($matchtype!=NULL && $matchtype!=$type) continue;
					// If type dont match, continue
				
				if(!preg_match($preg, $line, $regs)) continue;
					// If preg don't match, continue
				
				if($print && isset($regs[$print]))
					$line=$regs[$print];
				else	$line="";
					// Find line with preg
				
				break;
				// break because we found a rule
			}
			$mode=$setmode;
			$type=$newtype;
			if(isset($result[$i]["rawtype"]) && $result[$i]["rawtype"]!=$type){
				$i++;
			}elseif(isset($result[$i]["recursive"]) && $result[$i]["recursive"]!=$recursive){
				$i++;
			}
			// rule found
			if(strlen($wikiline)){
				$result[$i]["rawtype"]=$type;
				$result[$i]["type"]=$this->trType($type);
				$result[$i]["lines"][]=$line;
				$result[$i]["wikilines"][]=$wikiline;
				$result[$i]["recursive"]=$recursive;
				$result[$i]["regs"][]=$regs;
			}
			if($redo) $j--;
		} // end for each line
		return $result;
	}
	function arrayInline($str, $i=0, $self="arrayInline"){
		return $this->arrayInline_2($str, &$i);
	}
	function arrayInline_2($str, &$i, $self="arrayInline_2"){
		$max=strlen($str)-1;
		$part=0;
		$result=array();
		while($i<=$max){
			if($str[$i]=="\\"){
				$result[$part].=$str[$i+1];
				$i+=2;
				continue;
			}
			foreach($this->getOpt('pregInline') as $array){
				list($name, $start, $sep, $stop)=$array;
				$len=strlen($start);
				$len_end=strlen($stop);
				$substr=substr($str, $i, $len);
				if($substr==$start) break;
			}
			if($substr==$start){
				$part++;
				$result[$part]=array($name);
				$i+=$len;
				$j=1;
				while($i<=$max){
					if($str[$i]=="\\"){
						$result[$part][$j].=$str[$i+1];
						$i+=2;
						continue;
					}
					if(!is_null($sep)){
						$len_sep=strlen($sep);
						$substr_sep=substr($str, $i, $len_sep);
						if($substr_sep==$sep){
							$j++;
							$i+=$len_sep;
							continue;
						}
					}
					$substr_end=substr($str, $i, $len_end);
					if($substr_end==$stop){
						$i+=$len_end;
						break;
					}
					$result[$part][$j].=$str[$i];
					$i++;
				}
				$part++;
				continue;
			}
			$result[$part].=$str[$i];
			$i++;
		}
		return $result;
	}
}


class WikiParser extends parseWiki{

    // singleton
    private static $instance;
    private function __construct(){}
    public static function instance()
    {
        if (!isset(self::$instance)) self::$instance = new WikiParser();
        return self::$instance;
    }

	function parse($str, $self="parse"){
		$this->defaultConfig();
		$this->setOpt('fct_blank_text', 'specialchars');
		return $this->parseBlock($str);
	}
	function specialchars($str, $self="specialchars"){
		return htmlspecialchars($str);
		//return $this->fixMSWordEntities(htmlspecialchars($str));
	}
	function callBlock($name, $wikilines, $lines, $regs, $misc, $self="callBlock"){
		if($misc['recursive'])
			$parse="parseBlock";
		else	$parse="parseInline";
		switch($name){
		case "hrclear":
			return "<hr class=\"clear\" />";
		case "hr":
			return "<hr />";
		case "title":
		case "title2":
			$count=count($lines);
			$return='';
			for($i=0;$i<$count;$i++){
				$level=4-strlen($regs[$i][1]);
				if($name=="title2") $level+=3;
				if($level>6 || $level<1) return "";
				$content=$this->$parse($lines[$i]);
				$return.= "<h$level>$content</h$level>";
			}
			return $return;
		case "list":
			return $this->xhtmlList($wikilines, $lines);
		case "ul":
		case "ol":
			$return='';
			if($misc['prevtype']!=$name)	$return.="<$name>";
			$return.="\t<li>".$this->$parse(join("\n", $lines))."</li><!--$name-->";
			if($misc['nexttype']!=$name)	$return.="</$name>";
			return $return;
		case "code":
			return "<pre>".$this->$parse(join("\n", $lines))."</pre>";
		case "p":
			return "<p>".str_replace("\n", "<br />", $this->$parse(join("\n", $lines)))."</p>";
		default:
		}
	}
	function callInline($name, $params, $self="callInline"){
		switch($name){
		case "em":
			return "<em>".$this->parseInline(join(" ", $params))."</em>";
		case "strong":
			return "<strong>".$this->parseInline(join(" ", $params))."</strong>";
		case "quote":
            if ( Progfolio::instance()->language == Progfolio::FRENCH )
                return "«&nbsp;".$this->parseInline(join(" ", $params))."&nbsp;»";
            return "“".$this->parseInline(join(" ", $params))."”";
		case "add":
			return "<ins>".$this->parseInline(join(" ", $params))."</ins>";
		case "rem":
			return "<del>".$this->parseInline(join(" ", $params))."</del>";
		case "link":
			switch(count($params)){
			case 1:
				$link=$text=$params[0];
				break;
			case 2:
				$text=$params[0];
				$link=$params[1];
				break;
			}
			$link=$this->specialchars($link);
			$text=$this->parseInline($text);
			return "<a href=\"$link\" rel=\"nofollow\">$text</a>";
		case "object":
			$class="";
			switch(count($params)){
			case 1:
				$link=$text=$params[0];
			case 2:
				$text=$params[0];
				$link=$params[1];
			case 3:
				$text=$params[0];
				$link=$params[1];
				$class=" class=\"$params[2]\"";
			}
			$link=$this->specialchars($link);
			$text=$this->parseInline($text);
			return "<img src=\"$link\" alt=\"$text\"$class title=\"$text\"$class />";
		case "include":
			$link=$params[0];
			$link=$this->specialchars($link);
			return "<?include src=\"$link\" ?>";
		default:
		}
	}
}

/*
class wiki2html extends wiki2xhtml{
	function parse($str, $self="parse"){
		$this->defaultConfig();
		$this->setOpt('fct_blank_text', 'specialchars');
		return $this->parseBlock($str);
	}
	function specialchars($str, $self="specialchars"){
		return htmlspecialchars($str);
		//return $this->fixMSWordEntities(htmlspecialchars($str));
	}
	function callBlock($name, $wikilines, $lines, $regs, $misc, $self="callBlock"){
		if($misc['recursive'])
			$parse="parseBlock";
		else	$parse="parseInline";
		switch($name){
		case "hrclear":
			return "<hr class=\"clear\">\n";
		case "hr":
			return "<hr>\n";
		case "title":
		case "title2":
			$count=count($lines);
			$return='';
			for($i=0;$i<$count;$i++){
				$level=4-strlen($regs[$i][1]);
				if($name=="title2") $level+=3;
				if($level>6 || $level<1) return "";
				$content=$this->$parse($lines[$i]);
				$return.= "<h$level>$content</h$level>\n";
			}
			return $return;
		case "list":
			return $this->xhtmlList($wikilines, $lines);
		case "ul":
		case "ol":
			$return='';
			if($misc['prevtype']!=$name)	$return.="<$name>\n";
			$return.="\t<li>".$this->$parse(join("\n", $lines))."</li><!--$name-->\n";
			if($misc['nexttype']!=$name)	$return.="</$name>\n";
			return $return;
		case "code":
			return "<pre>".$this->$parse(join("\n", $lines))."</pre>\n";
		case "p":
			return "<p>".str_replace("\n", "\n<br>", $this->$parse(join("\n", $lines)))."</p>\n";
		default:
		}
	}
	function callInline($name, $params, $self="callInline"){
		switch($name){
		case "em":
			return "<em>".$this->parseInline(join(" ", $params))."</em>";
		case "strong":
			return "<strong>".$this->parseInline(join(" ", $params))."</strong>";
		case "add":
			return "<ins>".$this->parseInline(join(" ", $params))."</ins>";
		case "rem":
			return "<del>".$this->parseInline(join(" ", $params))."</del>";
		case "link":
			switch(count($params)){
			case 1:
				$link=$text=$params[0];
				break;
			case 2:
				$text=$params[0];
				$link=$params[1];
				break;
			}
			$link=$this->specialchars($link);
			$text=$this->parseInline($text);
			return "<a href=\"$link\" rel=\"nofollow\">$text</a>";
		case "object":
			$class="";
			switch(count($params)){
			case 1:
				$link=$text=$params[0];
			case 2:
				$text=$params[0];
				$link=$params[1];
			case 3:
				$text=$params[0];
				$link=$params[1];
				$class=" class=\"$params[2]\"";
			}
			$link=$this->specialchars($link);
			$text=$this->parseInline($text);
			return "<img src=\"$link\" alt=\"$text\"$class>";
		case "include":
			$link=$params[0];
			$link=$this->specialchars($link);
			return "<!--#include virtual=\"$link\" -->";
		default:
		}
	}
}
*/

?>