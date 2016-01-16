<html>
    <head>
        <title> COMP4711 LAB1 A00907822 EUNWON MOON </title>
    </head>
    <body style="text-align:center;">
     <?php
        //initialize value when there is no 'board' value
        if(isset($_GET['board']))
             $squares= $_GET['board'];
        else
             $squares='---------';
        
        //start game!
        $game = new Game($squares);

        class Game{            
            var $position;
            
            //constructor  start Game class
            function __construct($squares){
                
                echo '<header><h1>Welcome to the Tic-Tac-Toe Game.</h1></header>';
                echo '<nav style="height:80px">';
                
                //read the string value of game playing and sprit to char array
                $this->position = str_split($squares);
                
                //if the game is not just started or didnt finished, the computer play.
                if($squares <> '---------' && !$this->endGame()){
                    $loc = $this->findPlace();
                    $this->position[$loc]='x'; //add computer's playing
                }
                
                //check the result of the game
                //  if the game is finished without winner
                if($this->endGame ()){
                    echo '<h2 style="color:grey;">GAME OVER!! DRAW!!!</h2>';
                    echo '<button type="button"><a href="?board=---------">New Game!</a></button></br></nav>';
                }
                //check if the player win the game
                else if ($this->winner($this->position,'o')){  
                    echo '<h2 style="color:red;">You win. Lucky guesses!</h2>';
                    echo '<button type="button"><a href="?board=---------">New Game!</a></button></br></nav>';
                    $this->position[$loc]='-';      //if the player win, calcel the computer movement
                }
                //check if the computer win the game
                else if ($this->winner($this->position,'x')){   //o win 
                    echo '<h2 style="color:blue;">Computer win.:)</h2>';
                    echo '<button type="button"><a href="?board=---------">New Game!</a></button></br></nav>';
                }
                //if the gmae is not finished keep playing
                else {
                    echo '<h2>No winner yet, but you are losing.</h2></br></nav>';                           
                }
                //show the cells
                $this->display();
            }
            
            //the function to check if the '$token' team is win or not
            function winner($position, $token) {
                $won = false;
                //vertically win check
                for($row=0;$row<3;$row++) {
                    if (($position[3*$row] == $token) &&
                        ($position[3*$row+1] == $token) &&
                        ($position[3*$row+2] == $token)) {
                        $won = true;
                    }
                }
                //horizontally win check
                for($col = 0; $col < 3; $col++){
                    if (($position[$col] == $token) &&
                    ($position[$col+3] == $token) &&
                    ($position[$col+6] == $token)) {
                        $won = true;
                    }
                }
                //diagonally  win check
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
                echo '<table cols="3" border="1" style="margin:auto; fontsize:large; fontweight:bold; text-align:center">';
                echo '<tr style="height:160">'; // open the first row
                for ($pos=0; $pos<9;$pos++) {
                    echo $this->show_cell($pos);
                    if ($pos %3 == 2 && $pos<>8) 
                        echo '</tr><tr style="height:160">'; // start a new row for the next square
                }
                echo '</tr>'; // close the last row
                echo '</table>';                
            }
            
            //the function to display each cell depending on the value
            // computer's cell is showing moose
            // player's cell is showing olaf
            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-'){
                    if($token == 'o')
                        return '<td style="width:160"><img src="olaf.png"></td>';
                    else
                        return '<td style="width:160"><img src="com.png"></td>';
                }
                // now the hard case
                $this->newposition = $this->position; // copy the original
                $this->newposition[$which] = 'o'; // this would be their move
                $move = implode($this->newposition); // make a string from the board array
                $link = '?board='.$move; // this is what we want the link to be

                return '<td style="width:160"><a href="'.$link.'"><img src="blank.png"></a></td>';
            }
            
            //computer side algorithm to play
            //guess the next movement and check if the spot is winnable spot
            // or if should be blocked not to lose
            // if neither spot is existed, choose random spot.
            function findPlace(){
                
                //to check the winning spot
                for($i=0; $i<9; $i++){
                    if($this->position[$i] == '-'){
                        $this->newposition = $this->position;                    
                        $this->newposition[$i] = 'x';
                        if($this->winner($this->newposition,'x'))
                            return $i;
                    }
                }
                
                //to theck the competitors's winning spot
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
            
            //check if the game is finished or not without winner
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