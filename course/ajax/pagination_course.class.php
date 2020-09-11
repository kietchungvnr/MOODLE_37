<?php
class PerPage {

	public $perpageCourseNews, $perpageCourse;
	
	function __construct() {

		$this->perpageCourseNews = 12;

	}
	
	function getAllCourseNewsPageLinks($count,$href) {
		$output = '';

		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = '';
		}

		if(!isset($_GET["page"])) $_GET["page"] = 1;

		if($this->perpageCourseNews != 0)
			$pages  = ceil($count/$this->perpageCourseNews);

		if($pages>1) {

				if($_GET["page"] == 1) 
				$output = $output . '<span class="link disabled">«</span>';
				else	
					$output = $output . '<a class="link" onclick="getCourse(\'' . $href . ($_GET["page"]-1) . '&id='   . $id . '\')" >«</a>';
				
				
				if(($_GET["page"]-3)>0) {
					if($_GET["page"] == 1)
						$output = $output . '<span id=1 class="link current1">1</span>';
					else				
						$output = $output . '<a class="link" onclick="getCourse(\'' . $href . '1&id='.$id.'\')" >1</a>';
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
						$output = $output . '<a class="link" onclick="getCourse(\'' . $href . $i  .'&id='.$id.'\')" >'.$i.'</a>';
				}
				
				if(($pages-($_GET["page"]+2))>1) {
					$output = $output . '<span class="dot">...</span>';
				}
				if(($pages-($_GET["page"]+2))>0) {
					if($_GET["page"] == $pages)
						$output = $output . '<span id=' . ($pages) .' class="link current1">' . ($pages) .'</span>';
					else				
						$output = $output . '<a class="link" onclick="getCourse(\'' . $href .  ($pages) .'\')" >' . ($pages) .'</a>';
				}
				
				if($_GET["page"] < $pages)
					$output = $output . '<a  class="link" onclick="getCourse(\'' . $href . ($_GET["page"]+1) . '&id='   . $id . '\')" >»</a>';
				else				
					$output = $output . '<span class="link disabled">»</span>';

		}
		return $output;
	}




}
?>