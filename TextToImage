<?php

class TextToImage {

    var $fontSize = 12;
    var $fontColor = "#8892BF";
    var $fontColorAllocated = null;
    var $lineHeight = 0;
    var $align = "center";
    var $text = "Sachin Puri";
    var $angle = 0;
    var $underline = true;
    var $fontFile = "arial.ttf";
    var $image = "";
    var $imageWidth = 500;
    var $imageHeight = 0;
    var $startYPosition=0;
    var $padding=0;
    var $lines=array();
    var $backgroundColor='transparent';
    
    function setText($text){
        $this->text=$text;
    }
    
    function setFontSize($fontSize){
        $this->fontSize=$fontSize*0.75;
    }
    
    function setFontFile($fontFile){
        $this->fontFile=$fontFile;
    }
    
    function setFontColor($fontColorHex){
        $this->fontColor = $fontColorHex;
    }
    
    function setLineHeight($lineHeight){
        $this->lineHeight=$lineHeight;
    }
    
    function setUnderline($isUnderline){
        $this->underline=$isUnderline;
    }
    
    function setPadding($padding){
        $this->padding=$padding;
    }
    
    function setHAlignment($alignment){
        $this->align=$alignment;
    }
    
    function setWidth($width){
        $this->imageWidth=$width;
    }
    
    function setHeight($height){
        $this->imageHeight=$height;
    }
    
    function setBackgroundColor($bgColor){
        $this->backgroundColor = $bgColor;
    }
    
    function textToLines(){
        $lines=array();
        $wordSizeArray=array();
        $arrWords=explode(" ", $this->text);        
        foreach($arrWords as $word){
            $wordSize=imagettfbbox($this->fontSize, $this->angle, $this->fontFile, $word. " ");
            $wordWidth=abs($wordSize[0])+abs($wordSize[2]);
            $wordSizeArray[]=array('word'=>$word, 'size'=>$wordWidth);
        }
        
        $line='';
        $lineWidth=0;
        foreach($wordSizeArray as $wordDetail){
            $word=$wordDetail['word'];
            $wordWidth=$wordDetail['size'];
            $lineWidth+=$wordWidth;
            if($lineWidth<$this->imageWidth-($this->padding*2)){
                $line.= ' ' . $word;
            }else{
                $line.= "\n" . $word;
                $lineWidth=$wordWidth;
            }
        }
        
        return explode("\n",$line);
    }

    function draw() {
        $this->lines = $this->textToLines();       
        
        if($this->lineHeight == 0){
            if($this->underline){
                $this->lineHeight = $this->fontSize + ($this->fontSize*80/100);
            }else{
                $this->lineHeight = $this->fontSize + ($this->fontSize*60/100);
            }
        }
        
        $this->startYPosition = $this->fontSize+1;
        
        list($fontColorRed, $fontColorBlue, $fontColorGreen) = $this->hex2rgb($this->fontColor);
        if($this->imageHeight==0){
            $this->imageHeight = $this->lineHeight * count($this->lines) + ($this->padding*2);
        }

        $this->image = imagecreatetruecolor($this->imageWidth, $this->imageHeight);        
        
        imagesavealpha($this->image, true);
        $this->fontColorAllocated = imagecolorallocate($this->image, $fontColorRed, $fontColorBlue, $fontColorGreen);
                
        if($this->backgroundColor == 'transparent'){
            $bgcolor = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
        }else{
            list($bgColorRed, $bgColorBlue, $bgColorGreen) = $this->hex2rgb($this->backgroundColor);
            $bgcolor = imagecolorallocate($this->image, $bgColorRed, $bgColorBlue, $bgColorGreen);
        }
        
        imagefill($this->image, 0, 0, $bgcolor);

        $this->writeText();
        
        header("content-type: image/png");
        imagepng($this->image);
        imagedestroy($this->image);
    }
    
    function getStartXPositionOfLine($xBottomLeft, $lineWidth){        
        switch ($this->align) {
            case 'left':
                $startXPosition = abs($xBottomLeft) + $this->padding;
                break;
            case 'right':
                $startXPosition = $this->imageWidth - $lineWidth - 1 - $this->padding;
                break;
            case 'center':
                $startXPosition = ($this->imageWidth - $lineWidth) / 2;
                break;
            default:
                $startXPosition = abs($xBottomLeft);
                break;
        }
        
        return $startXPosition;
    }

    function writeText() {       
        
        $lineNumber=1;
        foreach($this->lines as $line){   
            
            $line=trim($line);
            list($xBLeft, $yBLeft, $xBRight, $yBRight, $xTRight, $yTRight, $xTLeft, $yTLeft) = imagettfbbox($this->fontSize, $this->angle, $this->fontFile, $line);
            $lineWidth = abs($xBLeft) + abs($xBRight);
            
            $startXPosition = $this->getStartXPositionOfLine($xBLeft, $lineWidth);            
            
            if($lineNumber==1 && $this->padding>0){
                $this->startYPosition+=$this->padding;
            }
            
            imagettftext($this->image, $this->fontSize, $this->angle, $startXPosition, $this->startYPosition, $this->fontColorAllocated, $this->fontFile, $line);
            $this->underline($startXPosition, $lineWidth);
            $this->startYPosition+=$this->lineHeight;
            $lineNumber++;
        }
    }
    
    function underline($startXPosition, $lineWidth){
        if ($this->underline) {
            $underlineY=$this->startYPosition+5;
            imagesetthickness($this->image, 2);
            imageline($this->image, $startXPosition, $underlineY, $startXPosition+$lineWidth, $underlineY, $this->fontColorAllocated);
        }
    }

    function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        
        return $rgb;
    }
    
    function pr($str){
        echo "<pre>";
        print_r($str);
        echo "</pre>";
    }

}
?>
