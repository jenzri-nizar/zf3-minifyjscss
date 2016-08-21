<?php
/**
 * User: Jenzri Nizar
 * Date: 19/08/2016
 * Time: 14:21
 */

namespace Zf3\Scss\View\Helper;

use Leafo\ScssPhp\Compiler;
class headLink extends \Zend\View\Helper\HeadLink
{

    protected $baseUrl;

    /**
     * @return String
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param String $baseUrl
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
        $filename=$info['dirname']."/".$info['filename'].".css";
        if($info['extension']=="scss" && (!file_exists(".".$filename) || (date ("F d Y H:i:s.", filemtime(".".$filename))<date ("F d Y H:i:s.", filemtime(".".$file)))))
        {
            $compiler = new Compiler();
            $string= $compiler->compile(file_get_contents($dirroot.$file));
            file_put_contents($dirroot.$filename,$string);

            $item->href=$filename;
        }

        return parent::itemToString($item);
    }

}