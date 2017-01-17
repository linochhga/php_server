<?php
class Navigation {
	private $session;
	private $current = null;
	private $list = [];
	
	public function __construct($session) {
		$this->session = $session;
	}
	
	public function add($title, $file, $access) {		
		/* $access - dostęp zależny od sesji:
		 * Liczba ujemna to dostęp tylko dla niezalogowanych użytkowników.
		 * Liczba zero to dostęp dla wszystkich.
		 * Liczba dodatnia to dostęp tylko dla zalogowanych użytkownków. */
		$this->list[$file] = ["title" => $title, "access" => $access];
	}
	
	public function setCurrent($current) {
		$this->current = $current;
	}
	
	public function isAvailable($file) {
		if(isset($this->list[$file])) {
			if($this->list[$file]['access'] == 0 ||
			  ($this->list[$file]['access'] > 0 && $this->session->isLogged()) ||
			  ($this->list[$file]['access'] < 0 && !$this->session->isLogged())) {
				return true;
			}
		}
		return false;
	}
	
	public function outputHTML() {
		foreach($this->list as $file => $item) {
			if(!self::isAvailable($file))
				continue;
				
			if($file == $this->current)
				echo '<li class="active">';
			else
				echo '<li>';
				
			echo '<a href="index.php?strona='.$file.'">'.$item['title'].'</a>';
			echo "</li>\n";
		}
	}
}
?>
