<?php
require (Youtube.php");
$channel="UC-9-kyTW8ZkZNDHQJ6FgpwQ"; //youtube music channel id
$Youtube = new Youtube($channel);//Channel id or channel user
$video   = $Youtube->video(3); //Here you choose the number of videos to be processed
for($i=0;$i<$video['qtde'];$i++)
{
    echo'<h1>'.$video['titulo'][$i].'</h1><br>';
    echo'<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video['video'][$i].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>
