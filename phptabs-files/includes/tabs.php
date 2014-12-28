<?php
class Tabs{
	
	public $menus = array();		
	public $content = array();
	private $path;
	
	function __construct($path){
		$this->path=$path;
	}
	function selected_tab($page,$index){
		if($index!=0){
			echo '<div class="tab_selected_starter"></div>';
		}
		else{
			echo '<div class="tab_starter"></div>';
		}
		echo '<div class="tab_selected_bg"><span><a href="?sel='.$index.'" id="selected_color">'.$page.'</a></span></div>';
		echo '<div class="tab_selected_end"></div>';						
	}
	// function tab_start_ns(){
	// 	echo '<div class="tab_starter"></div>';
	// }
	function tab_mid_ns($page,$index){						
    	echo '<div class="tab_bg"><span><a href="?sel='.$index.'">'.$page.'</a></span></div>';
	}
	// function tab_separator(){
 //    	echo '<div class="tab_separator"></div>';
	// }
	// function tab_close(){						
 //    	echo '<div class="tab_bg"><span><a href="#" onClick="window.close()">Close Page</a></span></div>';
	// 	echo '<div class="tab_close_end"></div>';
	// }
	
	function render_tabs($sel){
	
echo '	<div class="header">
        <div class="tabs_main">
        	<div class="tabs_sub">
	';
	
		$length=count($this->menus);
		
		for($i=0;$i<$length;$i++){
			if($sel==$i){
				$this->selected_tab($this->menus[$i],$i);
			}						
			if($sel!=$i && $i==0){							
				// $this->tab_start_ns();
				$this->tab_mid_ns($this->menus[$i],$i);
			}
			if($sel!=$i && $i!=0 && $i!=($sel+1)){
				// $this->tab_separator();
				$this->tab_mid_ns($this->menus[$i],$i);
			}
			if($sel!=$i && $i!=0 && $i==($sel+1)){							
				$this->tab_mid_ns($this->menus[$i],$i);
			}
			if(($i+1)==$length){
				if($sel+1!=$length){
					// $this->tab_separator();
				}
			// 	// $this->tab_close();
			}
		}
echo '
        	</div>
        </div>    
    </div>  

';

	}
	function add_tabs($new_page,$new_content){
		array_push($this->menus, $new_page);
		array_push($this->content,$new_content);
	}
	function render_content($sel){
		echo '
     <div class="content_area">
     	<div class="round_container_xsides">
        	<div class="round_container_ysides">
                <div class="round_container">               	
                    <p>'.$this->content[$sel].'
                   </p>
                </div>
            </div>
        </div>
     </div>';

	}
	function include_css(){
		echo '<link href="'.$this->path.'/styles.css" type="text/css" rel="stylesheet" />';
	}
}