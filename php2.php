<html>
	<head>
		<title>PHP Test</title>
	</head>
	<body>
        <?php
            if(isset($_GET['board'])){
                $position = $_GET['board'];
            }
            $game = new Game($position);
            class Game {
		var $position;
		function __construct($squares) {
                    $this->position = str_split($squares);
                    if ($this->winner('x')) {
			echo 'You win. Lucky guesses!';
                    } else if ($this->winner('o')) {
			echo 'I win. Muahahahaha';
                    } else {
                    // make a move
			$this->pick_move();
			if ($this->winner('o')) {
                            echo 'I win. Muahahahaha';
			}
                    }
                    $this->display();
		}
		function pick_move() {
                    for ($cell = 0; $cell < 9; $cell++) {
			if ($this->position[$cell] == '-') {
                            $this->position[$cell] = 'o';
				return;
                        }
                    }
                }
		function winner($token) {
                    $won = false;
                    // rows
                    for ($row = 0; $row < 3; $row++) {
			if (($this->position[3*$row] == $token) &&
                            ($this->position[3*$row+1] == $token)&&
                            ($this->position[3*$row+2] == $token)) {
                            $won = true;
			}
                    }
                    // columns
                    for ($col = 0; $col < 3; $col++) {
			if (($this->position[$col] == $token) && ($this->position[$col+3] == $token)&&($this->position[$col+6] == $token)) {
                            $won = true;
			}
                    }
                    // diagonals
                    if (($this->position[0] == $token)&&($this->position[4] == $token)&&($this->position[8] == $token)) {
			$won = true;
                    } else if (($this->position[6] == $token)&&($this->position[4] == $token)&&($this->position[2] == $token)) {
			$won = true;
                    }
                    return $won;
		}
		function display() {
                    echo '<table cols="3" style="font-size:large; font-weight:bold">';
                    echo '<tr>'; // open first row
                    for ($pos = 0; $pos < 9; $pos++) {
                    	echo $this->show_cell($pos);
			if ($pos %3 == 2) echo '</tr><tr>';
                    }
                    echo '</tr>';
                    echo '</table>';
		}
		function show_cell($which) {
                    $token = $this->position[$which];
                    if ($token <> '-') return '<td>'.$token.'</td>';
			$this->newposition = $this->position;
			$this->newposition[$which] = 'x';
			$move = implode($this->newposition);
			$link = '/4711/index.php?board='.$move;
			return '<td><a href="'.$link.'">-</a></td>';
                }  
            }
	?> 
	</body>
</html>