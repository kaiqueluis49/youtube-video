<?php
/*
    Class Youtube Videos
    Adaptation by Kaique Luiz
    28/09/2020
*/
class Youtube
{
    /**
     * Channel ID or Channel User.
     *
     * @access private
     * @var string
     */
    private $channel = ""; //canal
    private $videos=array();

    /**
     * Class constructor.
     *
     * @param string $channel Channel ID or Channel User.
     * @access public
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Make the request for a number of videos always by the most recent.
     *
     * @access public
     * @return array with the videos (video title and video ID [embed code])
     */
    public function Video($qtde_vd) //function that searches for videos listing by the most recent (PS: qtde_vd is a variable which represents the number of videos desired.)
    {
        $xml = null;

        if ( @fopen('https://www.youtube.com/feeds/videos.xml?user=' . $this->channel, 'r') !== false ) 
        {
            $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?user=' . $this->channel); // Channel User
        } 
        elseif ( @fopen('https://www.youtube.com/feeds/videos.xml?channel_id=' . $this->channel, 'r') !== false )
        {
            $xml = simplexml_load_file('https://www.youtube.com/feeds/videos.xml?channel_id=' . $this->channel); // Channel ID
        }

        if ($xml !== null) 
        {
            $namespaces = $xml->getNamespaces(true);
            for($i=0;$i<$qtde_vd;$i++) //loop videos
            {
                $video = $xml->entry[$i]->children($namespaces['yt']);
                $this->videos['video'][$i]=$video->videoId;
                $this->videos['titulo'][$i]=$xml->entry[$i]->title;
                if(!isset($this->videos['qtde']))
                {
                    $this->videos['qtde']=1;
                }
                else
                {
                    $this->videos['qtde']++;
                }
            }
            return $this->videos;

        } 
		else
		{
            return false;
        }
    }
}
?>