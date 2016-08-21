<?php
/**
 * User: Jenzri Nizar
 * Date: 20/08/2016
 * Time: 15:56
 */


namespace Zf3\Minifyjscss\View\Helper;


class HeadScript extends \Zend\View\Helper\HeadScript
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

    public function itemToString($item, $indent, $escapeStart, $escapeEnd)
    {

        $file=$item->attributes['src'];
        if (!filter_var($file, FILTER_VALIDATE_URL) === false) {
            return parent::itemToString($item, $indent, $escapeStart, $escapeEnd);
        }
        //$filesToMinify = $this->getFiles(array($file));

        $info=pathinfo($file);

        $dirroot=$_SERVER['DOCUMENT_ROOT'];
        $filename=$info['dirname']."/".$info['filename']."-min.".$info['extension'];
        if($info['extension']=="js" && (!file_exists($dirroot.$filename) || (date ("F d Y H:i:s.", filemtime($dirroot.$filename))<date ("F d Y H:i:s.", filemtime($dirroot.$file)))))
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
            $item->attributes['src']=$filename;
        }
        else{
            $filename=$info['dirname']."/".$info['filename']."-min.".$info['extension'];
            $item->attributes['src']=$filename;
        }
        return parent::itemToString($item, $indent, $escapeStart, $escapeEnd);
    }

}
