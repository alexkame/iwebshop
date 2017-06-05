<?php
class NumGame{
    var $mNumber=0;
    public function startGame(){
         return $this->mNumber = mt_rand(1000,9999);
    }
    public function setNum($num){
        $this->mNumber=$num;
    }
    public function verifyNum($Num){
        $return = 0;
        if($Num == $this->mNumber)$return = 0;
        else if($Num >$this->mNumber)$return = 1;
        else $return = 2;
        return $return;
    }
    
}
?>
