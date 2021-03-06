<?php
namespace com\diakogiannis\phpresteasy\api\web;
/**
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 09/12/18
 * Time: 16:41
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */

require_once __DIR__.'/../../Constants.php';
/**
 * Class AbstractRestController
 * @abstract
 */
class AbstractRestController
{
    /**
     * @param $content
     */
    public static function flushJSONContent($content){
        ob_start();
        header(HEADER_JSON);
        echo(json_encode($content));
        ob_end_flush();
    }

}