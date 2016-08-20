<?php
/**
 * Created by PhpStorm.
 * User: Jenzri
 * Date: 20/08/2016
 * Time: 15:56
 */

namespace Zf3\Minify\View\Helper;


class HeadLink  extends \Zend\View\Helper\HeadLink
{
    protected $baseUrl;

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param mixed $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function itemToString(\stdClass $item)
    {

        $file=$item->href;
        $info=pathinfo($file);

        $dirroot=$_SERVER['DOCUMENT_ROOT'];
        $filename=$info['dirname']."/".$info['filename']."-min.css";
        if($info['extension']=="css" && (!file_exists($dirroot.$filename) || (date ("F d Y H:i:s.", filemtime($dirroot.$filename))<date ("F d Y H:i:s.", filemtime($dirroot.$file)))))
        {
            $filename=$info['dirname']."/".$info['filename']."-min.".$info['extension'];
            $lastModified = $_SERVER['REQUEST_TIME'] - 86400;
            $minify = new \Minify(new \Minify_Cache_File());
            $output = $minify->serve('Files', array(
                'files' => [$dirroot.$file], // controller casts to array
                'quiet' => true,
                'lastModifiedTime' => $lastModified,
                'encodeOutput' => false,
                'maxAge' => 86400
            ));


            file_put_contents($dirroot.$filename, $output['content']);
            $item->href=$filename;
        }
        else{
            $filename=$info['dirname']."/".$info['filename']."-min.".$info['extension'];
            $item->href=$filename;
        }
        return parent::itemToString($item);
    }



}