<?php
namespace swg ;

class SecretWordGame
{

    private const HIDDEN_CHAR = '?' ;

    private array $secret ;

    public function __construct(string $secret)
    {
        $this->secret = str_split(strtolower($secret), 1);
    }

    public function try(?array $word=null): array{

        $result = "" ;
        $index = 0 ;

        if (isset($word)){
            foreach ($word as $i => $iValue) {
                $word[$i] = strtolower($iValue);
            }
          //  for ($index, $indexMax = count($this->secret); $index < $indexMax; $index++) {
                if($this->secret[$index] === " "){
                    $result .= " " ;
                } elseif (isset($word[$index])) {
                    if ($this->secret[$index] === $word[$index]) {
                        $result .= $this->secret[$index];
                    } else {
                        $result .= self::HIDDEN_CHAR;
                    }
                } /*else {
                    break;
                }*/
           // }
        }

        if ($index < count($this->secret)) {
            ///for ($index, $indexMax = count($this->secret); $index < $indexMax; $index++) {
                if($this->secret[$index] === " ") {
                    $result .= " ";
                }
                else {
                    $result .= self::HIDDEN_CHAR;
                }
            }
       // }

        $win = implode("", $word) === implode("", $this->secret) ;
        return $this->generateResponse($word, $win, $result) ;

    }

    private function generateResponse(array $word, bool $win, string $result): array
    {
        return array(
            'word' => $word,
            'win' => $win,
            'result' => $result
        );
    }

    public function generateInput(?array $response): void{
       /* htmlspecialchars(join("", $response['word']));*/

        /*echo "<div id='secret-word'>".$response['result']."</div>" ;*/

        for ($i=0, $iMax = strlen($response['result']); $i< $iMax; $i++)
        {
            if($response['result'][$i]==="?"){
                echo "<input type='text' class='secret-letter-input' name='word[$i]' value=''>";
            }
            elseif ($response['result'][$i]===""){
                echo "<div class='secret-letter-separator'></div>";

            }else{

                echo "<input type='text' class='secret-letter-input' name='word[$i]' disabled />";
               ?> <span style="font-size: 3em"><?php echo $response['result'][$i]?> </span> <?php
echo "<input type='hidden' name='word[$i]' class='secret-word' value='".$response['result'][$i]. "' >";

            }
        }

            echo <<<EOT
                <br><br>
                        <button type='submit' class='btn btn-dark' style="background: black; text-align: center; color: white">Try</button>
                EOT;


        /*echo <<<EOT
            <input type='text' name='word' id='word'
                    value='$lastWord' ><br>
            EOT;*/
    }


    public function generateWin() : void{
        echo "<div id='secret-word'>".implode("", $this->secret)."</div>" ;
        echo "<div id='secret-word-win'>!!! YOU WIN !!!</div>" ;
    }

}
?>
<style>

         </style>