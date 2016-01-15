<html>
    <head>
        <title> COMP4711 LAB1 A00907822 EUNWON MOON </title>
    </head>
    <body>
     <?php
        //initialize value when there is no board value
        if(isset($_GET['board']))
             $squares= $_GET['board'];
        else
             $squares='---------';
             $game = new Game($squares);

        class Game{
            
            var $position;
            //constructor
            function __construct($squares){
                echo '<h1>Welcome to the Tic-Tac-Toe Game.</h1></br>';
                $this->position = str_split($squares);
                
                //if the game is not just started or didnt finished, play 
                if($squares <> '---------' && !$this->endGame()){
                    $loc = $this->findPlace();
                }
                
                //check the result!
                //if the game is finished without winner
                if($this->endGame ()){
                    echo '<h2>GAME OVER!! DRAW!!!</h2>';
                    echo '<button type="button"><a href="?board=---------">New Game!</a></button></br>';
                } else if ($this->winner($this->position,'o')){     // x win
                    echo '<h2>I win.:)</h2><button type="button"><a href="?board=---------">New Game!</a></button></br>';
                }
                else if ($this->winner($this->position,'x')){   //o win
                    echo '<h2>You win. Lucky guesses!</h2> <button type="button"><a href="?board=---------">New Game!</a></button></br>';
                } else {        //game is not finished yet
                    echo '<h2>No winner yet, but you are losing.</h2>'; 
                     $this->position[$loc]='x';                    
                }
                $this->display();
            }
            
            //the function to check if the token is win or not
            function winner($position,$token) {
                $won = false;
                //vertically
                for($row=0;$row<3;$row++) {
                    if (($position[3*$row] == $token) &&
                        ($position[3*$row+1] == $token) &&
                        ($position[3*$row+2] == $token)) {
                        $won = true;
                    }
                }
                //horizontally
                for($col = 0; $col < 3; $col++){
                    if (($position[$col] == $token) &&
                    ($position[$col+3] == $token) &&
                    ($position[$col+6] == $token)) {
                        $won = true;
                    }
                }
                //diagonally
                if (($position[0] == $token) &&
                    ($position[4] == $token) &&
                    ($position[8] == $token)) {
                    $won = true;
                }else if (($position[2] == $token) &&
                    ($position[4] == $token) &&
                    ($position[6] == $token)) {
                    $won = true;
                }
                return $won;
            }
            
            //the function to display the board
            function display() {
                echo '<table cols="3" border="1" style="fontsize:large; fontweight:bold; text-align:center">';
                echo '<tr style="height:160">'; // open the first row
                for ($pos=0; $pos<9;$pos++) {
                    echo $this->show_cell($pos);
                    if ($pos %3 == 2 && $pos<>8) 
                        echo '</tr><tr style="height:160">'; // start a new row for the next square
                }
                echo '</tr>'; // close the last row
                echo '</table>';                
            }
            
            //the function to show each cell depending on the value
            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-'){
                    if($token == 'o')
                        return '<td style="width:160"><img src="olaf.png"></td>';
                    else
                        return '<td style="width:160"><img src="sven.png"></td>';
                }
                // now the hard case
                $this->newposition = $this->position; // copy the original
                $this->newposition[$which] = 'o'; // this would be their move
                $move = implode($this->newposition); // make a string from the board array
                $link = '?board='.$move; // this is what we want the link to be
                // so return a cell containing an anchor and showing a hyphen
                //echo 'retruning properly';
                return '<td style="width:160"><a href="'.$link.'"><img src="blank.png"></a></td>';
            }
            
            //computer side algorithm to play
            function findPlace(){
                //to find winning spot
                for($i=0; $i<9; $i++){
                    if($this->position[$i] == '-'){
                        $this->newposition = $this->position;                    
                        $this->newposition[$i] = 'x';
                        if($this->winner($this->newposition,'x'))
                            return $i;
                        
                    }
                }
                //to find the place to block person's win
                for($i=0; $i<9; $i++){
                    if($this->position[$i] == '-') {
                        $this->newposition = $this->position;
                        $this->newposition[$i] = 'o';
                        if($this->winner($this->newposition,'o'))
                            return $i;   
                    }
                }
                //to find any blank spot
                while($num = rand(1,9)){
                    if($this->position[--$num]=='-')
                        return $num;
                    
                }
            }
            //check if the game is finished or not
            function endGame(){
                for($i=0;$i<9;$i++)
                    if($this->position[$i] == '-')
                        return false;
                return true;
            }
        }

    ?>   
    </body>
</html>