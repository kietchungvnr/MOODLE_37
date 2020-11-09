<?php
class PerPage {

	public $perpage;
	
	function __construct() {

		$this->perpageModule = 10;

	}
	
	function getAllPageLinks($count,$href) {
		$output = '';

		if(isset($_GET['folderid'])) {
			$folderid = $_GET['folderid'];
		} else {
			$folderid = '';
		}
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
		} else {
			$search = '';
		}
		if(!isset($_GET["page"])) $_GET["page"] = 1;

		if($this->perpageModule != 0)
			$pages  = ceil($count/$this->perpageModule);

		if($pages>1) {

				if($_GET["page"] == 1) 
				$output = $output . '<span class="link disabled">«</span>';
				else	
					$output = $output . '<a class="link" onclick="pageLibrary(\'' . $href . ($_GET["page"]-1) . '&folderid='   . $folderid . '&search='.$search.'\')" >«</a>';
				
				
				if(($_GET["page"]-3)>0) {
					if($_GET["page"] == 1)
						$output = $output . '<span id=1 class="link current1">1</span>';
					else				
						$output = $output . '<a class="link" onclick="pageLibrary(\'' . $href . '1&folderid='.$folderid.'&search='.$search.'\')" >1</a>';
				}
				if(($_GET["page"]-3)>1) {
						$output = $output . '<span class="dot">...</span>';
				}
				
				for($i=($_GET["page"]-2); $i<=($_GET["page"]+2); $i++)	{
					if($i<1) continue;
					if($i>$pages) break;
					if($_GET["page"] == $i)
						$output = $output . '<span id='.$i.' class="link current1">'.$i.'</span>';
					else				
						$output = $output . '<a class="link" onclick="pageLibrary(\'' . $href . $i  .'&folderid='.$folderid.'&search='.$search.'\')" >'.$i.'</a>';
				}
				
				if(($pages-($_GET["page"]+2))>1) {
					$output = $output . '<span class="dot">...</span>';
				}
				if(($pages-($_GET["page"]+2))>0) {
					if($_GET["page"] == $pages)
						$output = $output . '<span id=' . ($pages) .' class="link current1">' . ($pages) .'</span>';
					else				
						$output = $output . '<a class="link" onclick="pageLibrary(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a>';
				}
				
				if($_GET["page"] < $pages)
					$output = $output . '<a  class="link" onclick="pageLibrary(\'' . $href . ($_GET["page"]+1) . '&folderid='   . $folderid . '&search='.$search.'\')" >»</a>';
				else				
					$output = $output . '<span class="link disabled">»</span>';

		}
		return $output;
	}
}
?>