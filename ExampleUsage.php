<?php
require('TextToImage.php');

$obj = new TextToImage();
$obj->setText("India \n\nIndia is a vast South Asian country with diverse terrain – from Himalayan peaks to Indian Ocean coastline – and history reaching back 5 millennia. In the north, Mughal Empire landmarks include Delhi’s Red Fort complex, massive Jama Masjid mosque and Agra’s iconic Taj Mahal mausoleum. Pilgrims bathe in the Ganges in Varanasi, and Rishikesh is a yoga center and base for Himalayan trekking.");
$obj->setFontSize(18);
$obj->setLineHeight(30);
$obj->setFontFile("fonts/comic_sans_ms.ttf");
$obj->setUnderline(1);
$obj->setPadding(10);
$obj->setHAlignment("center"); // left, right, center
$obj->setWidth(500);
$obj->setHeight(0); //0 for auto
$obj->setFontColor('#9E4562'); // Hash value
$obj->setBackgroundColor('#999999'); // Hash value
$obj->draw();
?>
