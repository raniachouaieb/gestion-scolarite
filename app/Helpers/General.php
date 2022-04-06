<?php
function uploadImage($folder, $image){
$image->store('/',$folder);
$filename = $image->hashName();
$path = 'uploads/'.$folder.'/'.$filename;
return $path;

}
