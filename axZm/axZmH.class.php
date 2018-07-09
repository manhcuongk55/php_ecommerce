<?php
/**
* Plugin: jQuery AJAX-ZOOM, axZmH.class.php
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.14
* Date: 2015-11-11
* Review: 2015-11-11
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

class axZmH {

    public $axZm;
    public $regexFilename;
    public $regexPath;
    public $fileTypeArray;
    private $returnMakeFirstImage;
    private $returnMakeZoomTiles;
    private $returnMakeAllThumbs;
    private $returnCTimeCompare;
    private $fileErrorDialog;
    private $excludeParseArray;
    private $readTime = array();
    private $msgNoteInstr = 'Note: please refer to instruction on how to switch off this dialog. (All popups can be disabled by setting disableAllMsg option to true in zoomConfig.inc.php)';

    function __construct($axZm){
        $this->axZm = $axZm;
    }

    private $doctype = array(
        1 => array ('XHTML 1.0 Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'),
        array ('XHTML 1.0 Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'),
        array ('XHTML Basic 1.0' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd"><html>'),
        array ('XHTML 1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"><html>'),
        array ('XHTML Basic 1.1' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd"><html>'),
        array ('HTML 4.01 Transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>'),
        array ('HTML 4.01 Strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html>'),
        array ('HTML 3.2' => '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2 Final//EN"><html>'),
        array ('HTML 2.0' => '<!DOCTYPE html PUBLIC "-//IETF//DTD HTML//EN"><html>'),
        array ('None' => '<html>')
    );

    /**
      * Check filename validity
      * @access public
      * @param string $filename
      *    @param bool $ext
      * @return bool
      **/
    public function isValidFilename($filename){
        $regDef = "/^[a-zA-Z\_0-9ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç]+[a-zA-Z\_0-9\-\.\,\(\)\[\]\%ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç\s+]+\.+[a-zA-Z]{3,4}$/";
        if ($this->regexFilename){
            $regDef = $this->regexFilename;
        }
        if (preg_match ($regDef, $filename)){
            return true;
        }else{
            return false;
        }
    }

    /**
      * Check pathname validity
      * @access public
      * @param string $path
      * @return bool
      **/
    public function isValidPath($path){
        $regDef = "/^[a-zA-Z\_0-9\:\/ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç]+([a-zA-Z\_0-9\:\.\,\(\)\[\]\ÄÖÜßäöüßÁÀÉÈÍÌÓÒÚÙÃÂÊÎÕÔÛÇáàéèíìóòúùãâêîõôûç\-\/\s+]*)$/";
        if ($this->regexPath){
            $regDef = $this->regexPath;
        }

        if (preg_match ($regDef, $path)){
            return true;
        }else{
            return false;
        }
    }

    /**
      * Check filetype validity
      * @access public
      * @param string $filename
      * @return bool
      **/
    public function isValidFileType($filename){
         // tif and psd are only supported by imagemagick
        $fileTypes = array('jpg', 'jpeg', 'tif', 'tiff', 'gif', 'png', 'bmp', 'psd');
        if (is_array($this->fileTypeArray) && !empty($this->fileTypeArray)){
            $fileTypes = $this->fileTypeArray;
        }

        $ext = $this->getl('.',$filename);
        if (in_array(strtolower($ext), $fileTypes)){
            return true;
        }else{
            return false;
        }
    }

    final function setRegex($reg, $type){
        if ($type == 'filename'){
            $this->regexFilename = $reg;
            $this->axZm->setRegex($reg, $type);
        }
        elseif ($type == 'path'){
            $this->regexPath = $reg;
            $this->axZm->setRegex($reg, $type);
        }
    }

    final function setFileTypeArray(){
        $this->fileTypeArray = $arr;
        $this->axZm->setFileTypeArray($arr);
    }

    public function pngMod($zoom){
        if (isset($zoom['config']) && $zoom['config']['pngMode'] === true){
            return 'png';
        }else{
            return 'jpg';
        }
    }

    /**
      * Deep extend arrays in jQuery like way, Ver. 4.0+
      * @access public
      * @param string $arrDefault
      * @param int $arrExtend
      * @return array
      **/
    public function deepExtend($arrDefault, $arrExtend){
        $returnArray = array();

        foreach ($arrDefault as $k=>$v){
            if (isset($arrExtend[$k]) && is_array($arrExtend[$k]) && is_array($v)){
                $returnArray[$k] = $this->deepExtend($v, $arrExtend[$k]);
            } elseif (isset($arrExtend[$k])){
                $returnArray[$k] = $arrExtend[$k];
            } else {
                $returnArray[$k] = $v;
            }
        }

        return $returnArray;
    }

    /**
      * Get ISO language code
      * @access public
      * @return string
      **/
    public function getLang(){
        $acl = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'en');
        $lang = substr($acl, 0, 2);
        if (strlen($lang) == 2){
            return strtolower($lang);
        }else{
            return 'en';
        }
    }

    /**
      * Deep extend arrays in jQuery like way, Ver. 4.2.3+
      * @access public
      * @param array $zoom
      * @return array
      **/
    public function checkConfig($zoom){
        $zoom['config']['picX'] =             intval($this->getf('x',$zoom['config']['picDim']));
        $zoom['config']['picY'] =             intval($this->getl('x',$zoom['config']['picDim']));
        $zoom['config']['galPicX'] =         intval($this->getf('x',$zoom['config']['galleryPicDim']));
        $zoom['config']['galPicY'] =         intval($this->getl('x',$zoom['config']['galleryPicDim']));
        $zoom['config']['galFullPicX'] =     intval($this->getf('x',$zoom['config']['galleryFullPicDim']));
        $zoom['config']['galFullPicY'] =     intval($this->getl('x',$zoom['config']['galleryFullPicDim']));
        $zoom['config']['galHorPicX'] =     intval($this->getf('x',$zoom['config']['galleryHorPicDim']));
        $zoom['config']['galHorPicY'] =     intval($this->getl('x',$zoom['config']['galleryHorPicDim']));

        // Generate paths to the icons
        if (isset($_GET['buttonSet'])){$zoom['config']['buttonSet'] = $_GET['buttonSet'];}

        foreach ($zoom['config']['icons'] as $k=>$v){ // 4.2.3
            if (is_array($zoom['config']['icons'][$k]) && isset($zoom['config']['icons'][$k]['file'])){
                $zoom['config']['icons'][$k]['file'] = $zoom['config']['buttonSet'].'/'.$v['file'];
                $widthValue = $zoom['config']['icons'][$k]['w'];
                $heightValue = $zoom['config']['icons'][$k]['h'];
                $extValue = $zoom['config']['icons'][$k]['ext'];

                if (is_string($widthValue) && strpos($widthValue, '}')){
                    $widthValue = str_replace(array('{', '}'), '', $widthValue);
                    if (isset($zoom['config']['icons'][$widthValue])){
                        $zoom['config']['icons'][$k]['w'] = $zoom['config']['icons'][$widthValue];
                    }
                }
                if (is_string($heightValue) && strpos($heightValue, '}')){
                    $heightValue = str_replace(array('{', '}'), '', $heightValue);
                    if (isset($zoom['config']['icons'][$heightValue])){
                        $zoom['config']['icons'][$k]['h'] = $zoom['config']['icons'][$heightValue];
                    }
                }
                if (is_string($extValue) && strpos($extValue, '}')){
                    $extValue = str_replace(array('{', '}'), '', $extValue);
                    if (isset($zoom['config']['icons'][$extValue])){
                        $zoom['config']['icons'][$k]['ext'] = $zoom['config']['icons'][$extValue];
                    }
                }
            }
        }

        // disable one gallery if both activated
        if ($zoom['config']['useGallery'] && $zoom['config']['useHorGallery']){
            $zoom['config']['useHorGallery'] = false;
        }

        // Disable one of the galleries if both are defined
        if ($zoom['config']['fullScreenVertGallery'] && $zoom['config']['fullScreenHorzGallery']){
            $zoom['config']['fullScreenHorzGallery'] = false;
        }

        // Disable spinMod if $_GET['3dDir'] is not defined
        if ($zoom['config']['spinMod'] && !isset($_GET['3dDir'])){
            $zoom['config']['spinMod'] = false;
        }
        elseif (isset($_GET['3dDir']) && strlen($_GET['3dDir']) && !$zoom['config']['spinMod']){
            // Enable 360/3D mode if $_GET['3dDir'] is passed but not enabled
            $zoom['config']['spinMod'] = true;
            $zoom['config']['galleryNoThumbs'] = true;
            $zoom['config']['galFullButton'] = false;
            $zoom['config']['firstMod'] = 'spin';
        }

        // Overwrite any setting for touch devices
        if (!empty($zoom['config']['touchSettings']) && preg_match('/(android|blackberry|iphone|ipad|ipaq|ipod|smartphone|symbian|iemobile)/i', $_SERVER['HTTP_USER_AGENT'])){
            $zoom['config'] = $this->deepExtend($zoom['config'], $zoom['config']['touchSettings']);
        }

        // More then one picture requires $zoom['config']['keepBoxW'] AND $zoom['config']['keepBoxH']
        if ($zoom['config']['useGallery'] || $zoom['config']['useHorGallery'] || $zoom['config']['fullScreenVertGallery'] || $zoom['config']['fullScreenHorzGallery']){
            $zoom['config']['keepBoxW'] = true;
            $zoom['config']['keepBoxH'] = true;
        }

        if ($zoom['config']['pyrTiles']){
            $zoom['config']['gPyramid'] = false;
        }

        // Parameter set for imagemagick
        if ($zoom['config']['iMagick']){
            $zoom['config']['im'] = true;
            $zoom['config']['pyrProg'] = 'IM';
            $zoom['config']['gPyramidProg'] = 'IM';
            $zoom['config']['pyrStitchProg'] = 'IM';
        }

        // Parameter set - disable all massages except licensing
        if ($zoom['config']['disableAllMsg'] || isset($_GET['getFiles']) || isset($_GET['disableAllMsg'])){
            $zoom['config']['cTimeCompareDialog'] = false; // 4.1.9
            $zoom['config']['firstImageDialog'] = false;
            $zoom['config']['galleryDialog'] = false;
            $zoom['config']['pyrDialog'] = false;
            $zoom['config']['gPyramidDialog'] = false;
            $zoom['config']['warnings'] = false;
            $zoom['config']['errors'] = false;
        }

        // Hardset some settings if image tiles are not loaded directly as in example1.php ($zoom['config']['pyrLoadTiles'])
        if (!$zoom['config']['pyrLoadTiles']){
            $zoom['config']['fullScreenEnable'] = false;
            $zoom['config']['fullScreenNaviButton'] = false;
            $zoom['config']['fullScreenCornerButton'] = false;
        }else{
            $zoom['config']['pssBar'] = false;
            if ($zoom['config']['zoomLogInfoDisabled'] === false && $zoom['config']['zoomLogInfo']){
                $zoom['config']['zoomLogInfo'] = false;
                $zoom['config']['zoomLogJustLevel'] = true;
            }
        }

        // Ver. 4.1.5, 4.1.9 Set of options to make AJAX-ZOOM switch faster
        if ($zoom['config']['speedOptSet'] || isset($_GET['speedOptSet'])){
            $zoom['config']['zoomMapSwitchSpeed'] = 0;
            $zoom['config']['restoreSpeed'] = 0;
            $zoom['config']['pyrTilesFadeInSpeed'] = 200;
            $zoom['config']['pyrTilesFadeLoad'] = 200;
            $zoom['config']['galleryFadeOutSpeed'] = 0;
            $zoom['config']['galleryFadeInSpeed'] = 100;
            $zoom['config']['galleryInnerFade'] = 100;
            $zoom['config']['galleryInnerFadeCut'] = 100;
            $zoom['config']['galleryFadeInSize'] = 1;
            $zoom['config']['zoomFadeIn'] = 100;
            $zoom['config']['gallerySlideSwipeSpeed'] = 400;
        }

        // Ver. 4.2.1+
        if ($zoom['config']['stepPicDim'] && is_array($zoom['config']['stepPicDim']) && !empty($zoom['config']['stepPicDim'])){
            $zoom['config']['stepPicDim'][0] = array('w'=>$zoom['config']['picX'], 'h'=>$zoom['config']['picY'], $zoom['config']['initPicQual']);
            ksort($zoom['config']['stepPicDim']);
        }else{
            $zoom['config']['stepPicDim'] = array();
        }

        // Ver. 4.2.1+
        $this->setRegex($zoom['config']['regexFilename'], 'filename');
        $this->setRegex($zoom['config']['regexPath'], 'path');
        $this->setFileTypeArray($zoom['config']['fileTypeArray']);

        // Ver. 4.2.5
        if ( !( isset($_GET['azImg']) || isset($_GET['azImg360']) ) ){
            $startLic = microtime(true);
            $licFile1 = $this->checkSlash(dirname(dirname(__FILE__)).'/lic.php', 'remove');
            $licFile2 = $this->checkSlash(dirname(__FILE__).'/lic.php', 'remove');
            if (file_exists($licFile1)) {
                include($licFile1);
            } else if (file_exists($licFile2)){
                include($licFile2);
            }
            $this->readTime['lic'] = $this->endTimeDiff($startLic);
        }

        // Ver. 4.2.5
        if (isset($_SESSION['axZmLicenses']) && is_array($_SESSION['axZmLicenses']) && !empty($_SESSION['axZmLicenses'])){
            $possibleHostSources = array('HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
            foreach($possibleHostSources as $k=>$v){
                $host = $_SERVER[$v];
                if (substr($host, 0, 4) == 'www.'){$host = substr($host, 4);}
                if (isset($_SESSION['axZmLicenses'][$host]) && is_array($_SESSION['axZmLicenses'][$host]) && !empty($_SESSION['axZmLicenses'][$host])){
                    $zoom['config']['licenceType'] = $_SESSION['axZmLicenses'][$host]['licenceType'];
                    $zoom['config']['licenceKey'] = $_SESSION['axZmLicenses'][$host]['licenceKey'];

                    if (isset($_SESSION['axZmLicenses'][$host]['error200']) && strlen($_SESSION['axZmLicenses'][$host]['error200'])){
                        $zoom['config']['error200'] = $_SESSION['axZmLicenses'][$host]['error200'];
                    }

                    if (isset($_SESSION['axZmLicenses'][$host]['error300']) && strlen($_SESSION['axZmLicenses'][$host]['error300'])){
                        $zoom['config']['error300'] = $_SESSION['axZmLicenses'][$host]['error300'];
                    }
                }
            }
        }

        // Ver. 4.2.5
        if (isset($zoom['config']['licenses']) && is_array($zoom['config']['licenses']) && !empty($zoom['config']['licenses'])){
            $possibleHostSources = array('HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR');
            foreach($possibleHostSources as $k=>$v){
                $host = $_SERVER[$v];
                if (substr($host, 0, 4) == 'www.'){$host = substr($host, 4);}
                if (isset($zoom['config']['licenses'][$host]) && is_array($zoom['config']['licenses'][$host]) && !empty($zoom['config']['licenses'][$host])){
                    $zoom['config']['licenceType'] = $zoom['config']['licenses'][$host]['licenceType'];
                    $zoom['config']['licenceKey'] = $zoom['config']['licenses'][$host]['licenceKey'];

                    if (isset($zoom['config']['licenses'][$host]['error200']) && strlen($zoom['config']['licenses'][$host]['error200'])){
                        $zoom['config']['error200'] = $zoom['config']['licenses'][$host]['error200'];
                    }

                    if (isset($zoom['config']['licenses'][$host]['error300']) && strlen($zoom['config']['licenses'][$host]['error300'])){
                        $zoom['config']['error300'] = $zoom['config']['licenses'][$host]['error300'];
                    }
                }
            }
        }


        // Adjust some data depending on the modules used
        if (isset($_SESSION['axZmModule'])){
            foreach ($_SESSION['axZmModule'] as $key => $value){
                if (isset($zoom['config'][$key])){
                    $zoom['config'][$key] = $value;
                }
            }
        }

        // 4.2.5 - test if there is a translation
        foreach ($zoom['config']['mapButTitle'] as $k=>$v){
            $zoom['config']['mapButTitle'][$k] = $this->langVarFromArray($v, $zoom['config']['lang']);
        }

        $arrSpinPreloaderVar = array('text', 'L1', 'L2', 'L3', 'L4', 'L5');
        foreach ($arrSpinPreloaderVar as $v){
            $zoom['config']['spinPreloaderSettings'][$v] = $this->langVarFromArray($zoom['config']['spinPreloaderSettings'][$v], $zoom['config']['lang']);
            $zoom['config']['spinCirclePreloader'][$v] = $this->langVarFromArray($zoom['config']['spinCirclePreloader'][$v], $zoom['config']['lang']);
        }

        $arrFirstLevelVars = array('zoomLogLevel', 'zoomLogTime', 'zoomLogTraffic', 'zoomLogSeconds', 'zoomLogLoading', 'fullScreenExitText');
        foreach ($arrFirstLevelVars as $v){
            $zoom['config'][$v] = $this->langVarFromArray($zoom['config'][$v], $zoom['config']['lang']);
        }

        // Files
        $zoom['config']['dragToSpin']['file'] = $this->langVarFromArray($zoom['config']['dragToSpin']['file'], $zoom['config']['lang']);
        $zoom['config']['spinNoInit']['file'] = $this->langVarFromArray($zoom['config']['spinNoInit']['file'], $zoom['config']['lang']);
        
        
        // 4.2.11
        if (!isset($zoom['config']['imgFileOpt'])){
            $zoom['config']['imgFileOpt'] = array(
                noMakeFirstImage => false,
                noMakeMapImage => false,
                noMakeAllThumbs => false,
                noMakeZoomTiles => false,
                noMakeGpyramid => false,
                sameAspectRatio => false,
                sameSize => false,
                getFileSize => false
            );  
        }
        
        return $zoom;
    }

    public function langVarFromArray($arr, $lang = 'en'){
        if (is_array($arr)){
            if ($arr[$lang] || is_bool($arr[$lang]) || is_int($arr[$lang])){return $arr[$lang];}
            elseif ($arr['en'] || is_bool($arr['en']) || is_int($arr['en'])){return $arr['en'];}
            else {return '';}
        }else{
            return  $arr;
        }
    }

    /**
      * Calculate time difference betrween given timestamp and now
      * @access public
      * @param int $time
      * @return float
      **/
    public function endTimeDiff($time){
        if (!$time){return 'undefined';}
        return sprintf('%.4f', (microtime(true) - $time));
    }

    public function stepPicDim($zoom){
        if (isset($zoom['config']['stepPicDim'])
            && !empty($zoom['config']['stepPicDim'])
            && isset($_GET['respW'])
            && isset($_GET['respH'])
        ){

            $pW = intval($_GET['respW']);
            $pH = intval($_GET['respH']);
            $setW = explode('x', $zoom['config']['picDim']);
            if ($pW > 0 && $pH > 0 && ($pW > intval($setW[0]) || $pH > intval($setW[0]))){
                $numOp = count($zoom['config']['stepPicDim']);
                $n = 0;
                foreach($zoom['config']['stepPicDim'] as $k => $v){
                    $n++;
                    if ($n == $numOp || $v['w'] >= $pW || $v['h'] >= $pH){
                        $zoom['config']['picDim'] = $v['w'].'x'.$v['h'];
                        if ($v['q'] > 30){
                             $zoom['config']['initPicQual'] = $v['q'];
                        }
                        break;
                    }
                }
            }
        }
        return $zoom;
    }

    /**
      * Download original image or image in certain resolution
      * @access public
      * @param string $zoom
      * @param int $zoomID
      * @return bool
      **/
    public function downloadImage($zoom, $zoomID){
        if (!$zoom['config']['allowDownload']){
            echo 'Download is not allowed.';
            exit;
        }
        $fileName = '';

        if ($zoom['config']['pic_list_array'][$zoomID]){
            $fileName = $zoom['config']['pic_list_array'][$zoomID];
        }else{
            $flipedArray = array_flip($zoom['config']['pic_list_array']);
            if ($flipedArray[$zoomID]){
                $fileName = $zoomID;
            }
        }

        if (!$fileName){
            echo 'File not found.';
            exit;
        }


        $filePath = $this->checkSlash($zoom['config']['picDir'].'/'.$fileName,'remove');

        $ext = strtolower($this->getl('.', $filePath));

        $extAllow = array('jpg', 'jpeg', 'jpe', 'tif', 'tiff', 'bmp', 'gif', 'png', 'psd');
        if ($zoom['config']['fileTypeArray']){
            $extAllow = $zoom['config']['fileTypeArray'];
        }

        if (file_exists($filePath) && in_array($ext, $extAllow)){

            if (ini_get('zlib.output_compression')){
                ini_set('zlib.output_compression', 'Off');
            }

            if (function_exists('header_remove')){header_remove();}

            if ($zoom['config']['downloadRes']){

                if (isset($_GET['downloadRes']) && is_array($zoom['config']['downloadRes'])){
                    if (in_array($_GET['downloadRes'], $zoom['config']['downloadRes'])){
                        $zoom['config']['downloadRes'] = $_GET['downloadRes'];
                    }
                }

                if (!isset($_GET['downloadRes']) && is_array($zoom['config']['downloadRes'])){
                    $zoom['config']['downloadRes'] = $zoom['config']['downloadRes'][0];
                }

                $dim = explode('x', $zoom['config']['downloadRes']);


                $this->axZm->rawThumb(
                    $zoom,
                    array(
                        'picDir' => dirname($filePath),
                        'imgName' => basename($filePath),
                        'prevWidth' => $dim[0],
                        'prevHeight' => $dim[1],
                        'qual' => ($zoom['config']['pngMode'] ? $zoom['config']['downloadQualPng'] : $zoom['config']['downloadQual']),
                        'cache' => $zoom['config']['downloadCache'],
                        'download' => true,
                        'backColor' => $zoom['config']['pngBackgroundColor'],
                        'thumbMode' => false, // contain, cover
                        'enlarge' => false,
                        'pngMode' => $zoom['config']['pngMode'],
                        'pngKeepTransp' => $zoom['config']['pngKeepTransp'],
                        'imKeepProfiles' => $zoom['config']['imKeepProfiles']
                    )
                );


            }else{
                if ($zoom['config']['memory_limit']){ini_set('memory_limit', $zoom['config']['memory_limit']);}
                // Original image, output original image, forced download
                $len = filesize($filePath);
                $outname = $this->getl('/', $filePath);
                header('Content-Description: File Transfer');
                header('Content-Type: image/'.$ext);
                header('Content-Disposition: attachment; filename="'.$outname.'"');
                header('Content-Transfer-Encoding: binary');
                header('Cache-Control: must-revalidate');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Last-Modified: '.gmdate("D, d M Y H:i:s").' GMT');
                header('Pragma: public');
                header('Content-Length: '.$len);
                readfile($filePath);
            }
        }
    }

    /**
      * Check validation of query
      * @access public
      * @param array $zoom
      * @return bool
      **/
    public function allowAjaxQueryCheck ($zoom){
        if (!isset($zoom['config']['allowAjaxQuery']) || !isset($zoom['config']['allowAjaxQuery']['basePath'])){
            return false;
        }

        if ($zoom['config']['allowAjaxQuery']['basePathCheck'] == 'strict'){
            foreach ($zoom['config']['allowAjaxQuery']['basePath'] as $k=>$v){
                if (substr($zoom['config']['pic'], 0, strlen($v)) == $v){
                    return true;
                }
            }
            return false;
        }else{
            foreach ($zoom['config']['allowAjaxQuery']['basePath'] as $k=>$v){
                if (stristr($zoom['config']['pic'], $v)){
                    return true;
                }
            }
            return false;
        }

        return false;
    }

    /**
      * Returns first images several 360 or 3D and some info about 2d images
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getFirstImageFromMixedData($zoom, $JSONencode = true){
        $zoomSave = $zoom;
        $return = array();
        $return['image360'] = array();
        $return['imageZoom'] = array();
        $image360array = array();

        if (isset($_GET['zoomMixedData'])){
            $zoomMixedDataArr = explode('|', $_GET['zoomMixedData']);

            foreach($zoomMixedDataArr as $k=>$v){
                unset($_GET['zoomData'], $_GET['zoomDir']);
                $zoom = $zoomSave;
                $vData = explode('*', $v);
                if ($vData[0] == 'image360'){
                    $_GET['zoomDir'] = $vData[1];
                     $saveZoomDir = $vData[1];

                    unset($_GET['zoomData']);
                    $q = $this->getZoomDir($zoom);

                    $q1 = $this->preProceedList($q[0], $q[1], $q[2], $q[3]);
                    $r = $this->getFirstImageSpin($q1[0], false);

                    if ($r[0] != 'error' && $r[1] && $r[1]['folder']){
                        $return['image360'][$r[1]['folder']] = $r;
                    }else{
                        $return['error'][$this->getl('/', $saveZoomDir)] = ($r[1] && $r[1] != true) ? $r[1] : '360 spin folder not found';
                    }
                }
                else if ($vData[0] == 'imageZoom'){
                    array_push($image360array, $vData[1]);
                }
            }


            if (!empty($image360array)){
                $zoom = $zoomSave;
                $_GET['zoomData'] = implode('|', $image360array);
                $q = $this->getZoomData($zoom);
                $q1 = $this->preProceedList($q[0], $q[1], $q[2], $q[3]);
                $r = $this->getDataImages($q1[0], false);
                if ($r[0] != 'error'){
                    foreach($r[1] as $k=>$v){
                         $return['imageZoom'][$v['fileName']] = $v;
                    }
                }
            }

            return json_encode($return);
        }
    }

    /**
      * Returns images from a path
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getImages($zoom, $JSONencode = true){
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['images']){
            if (!empty($zoom['config']['pic_list_data']) && $this->allowAjaxQueryCheck($zoom)){
                $return = array();
                $returnData = array();
                foreach($zoom['config']['pic_list_data'] as $k => $v){
                    $returnData[$k]['fileName'] = $v['fileName'];
                    $returnData[$k]['thumbDescr'] = $v['thumbDescr'];
                    $returnData[$k]['fullDescr'] = $v['fullDescr'];
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode ($return) : $return;
            }else{
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['pic_list_data'])){
                    $returnError[1] = 'There are no images in '.$zoom['config']['pic'];
                }else{
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query images in this folder!';
                }
                return $JSONencode ? json_encode ($returnError) : $returnError;
            }
        }else{
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query images this way!';
            return $JSONencode ? json_encode ($returnError) : $returnError;
        }
    }

    /**
      * Returns images from  zoomData
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getDataImages($zoom, $JSONencode = true){
        $return = array();
        $returnData = array();
        $n = 0;
        foreach($zoom['config']['pic_list_data'] as $k => $v){
            $n++;
            $returnData[$n]['picPath'] = $v['picPath'];
            $returnData[$n]['fileName'] = $v['fileName'];
            $returnData[$n]['thumbDescr'] = $v['thumbDescr'];
            $returnData[$n]['fullDescr'] = $v['fullDescr'];
        }

        if (!empty($returnData)){
            $return[0] = 'ok';
            $return[1] = $returnData;
            return $JSONencode ? json_encode ($return) : $return;
        }else{
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'No images found for zoomData parameter passed: '.$zoom['config']['zoomDataPassed'];
            return $JSONencode ? json_encode ($returnError) : $returnError;
        }
    }

    /**
      * Returns subfolders from zoomDir
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getFolders($zoom, $JSONencode = true){
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['subFolders']){
            if ($this->allowAjaxQueryCheck($zoom) && !empty($zoom['config']['subFolderArray'])){
                $return = array();
                $returnData = array();
                foreach($zoom['config']['subFolderArray'] as $k => $v){
                    $returnData[$k]['folderName'] = $v;
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode ($return) : $return;
            }else{
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['subFolderArray'])){
                    $returnError[1] = 'There are no subfolders in: '.$zoom['config']['pic'];
                }else{
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subfolders in this folder!';
                }
                return $JSONencode ? json_encode ($returnError) : $returnError;
            }
        }else{
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subdolders this way!';
            return $JSONencode ? json_encode ($returnError) : $returnError;
        }
    }

    /**
      * Returns first images from subfolders
      * @access public
      * @param array $zoom
      * @param integer $number
      * @return JSON
      **/
    public function getFirstImagesFromFolders($zoom, $number = 3, $shuffle = false, $JSONencode = true){
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['subFolders']){
            if ( $zoom['config']['allowAjaxQuery']['maxImageNumber'] && $number > $zoom['config']['allowAjaxQuery']['maxImageNumber']){
                $number = $zoom['config']['allowAjaxQuery']['maxImageNumber'];
            }
            if ($number == 0){
                $number = 1;
            }

            if ($this->allowAjaxQueryCheck($zoom) && !empty($zoom['config']['subFolderArray'])){
                $return = array();
                $returnData = array();
                foreach($zoom['config']['subFolderArray'] as $k => $v){
                    $qSub = glob($zoom['config']['picDir'].$v.'/*');
                    if (count($qSub > 0)){

                        $returnData[$k]['folderName'] = $v;
                        $returnData[$k]['images'] = array();
                        $n = 0;
                        if ($shuffle){shuffle($qSub);}

                        foreach ($qSub as $file){
                            $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                            if ($this->isValidFileType($thisFile) ){
                                $n++; if ($n > $number){ break;}
                                array_push($returnData[$k]['images'], $thisFile);
                            }
                        }
                    }
                }
                $return[0] = $zoom['config']['pic'];
                $return[1] = $returnData;
                return $JSONencode ? json_encode ($return) : $return;
            }else{
                $returnError = array();
                $returnError[0] = 'error';
                if (empty($zoom['config']['subFolderArray'])){
                    $returnError[1] = 'There are no subfolders in: '.$zoom['config']['pic'];
                }else{
                    $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subfolders in this folder!';
                }
                return $JSONencode ? json_encode ($returnError) : $returnError;
            }
        }else{
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query subdolders this way!';
            return $JSONencode ? json_encode ($returnError) : $returnError;
        }
    }

    public function returnFirstImageSpin($zoom, $dir){
        $_GET['zoomDir'] = $dir; $_GET['qq'] = 1;

        $getZoomDirReturn = $this->getZoomDir($zoom);
        $zoom = $getZoomDirReturn[0];
        $pic_list_array = $getZoomDirReturn[1];
        $pic_list_data = $getZoomDirReturn[2];
        $zoomTmp = $getZoomDirReturn[3];

        $preProceedListReturn = $this->preProceedList($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
        $zoom = $preProceedListReturn[0];
        $pic_list_array = $preProceedListReturn[1];
        $pic_list_data = $preProceedListReturn[2];
        $zoomTmp = $preProceedListReturn[3];

        $data = $this->getFirstImageSpin($zoom, false);

        if (is_array($data) && is_array($data[1]) && !empty($data[1])){
            $_GET['previewPic'] = $data[1]['fileName'];
        }else{
            $_GET['previewPic'] = 'missingImage.jpg';
        }
        $_GET['previewDir'] = $data[0];
        $this->rawThumbLoad($zoom);
    }

    /**
      * Returns first images of 360 or 3D from a path
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getFirstImageSpin($zoom, $JSONencode = true){
        if (isset($zoom['config']['allowAjaxQuery']) && $zoom['config']['allowAjaxQuery']['images']){
            if ($this->allowAjaxQueryCheck($zoom)){
                $return = array();
                 $return[1] = array();

                 // regular 360
                 if (empty($zoom['config']['subFolderArray'])){
                     $return[0] = $zoom['config']['pic'];
                     if ($zoom['config']['pic_list_data'][1]){

                         $return[1]['frames'] = count($zoom['config']['pic_list_data']);
                         $return[1]['path'] = $zoom['config']['pic'];
                         $return[1]['folder'] = $this->getl('/', $this->checkSlash($zoom['config']['pic'], 'remove'));
                         $return[1]['type'] = '360';

                         if (isset($_GET['randFrame'])){
                             $return[1]['fileName'] = $zoom['config']['pic_list_data'][rand(1, $return[1]['frames'])]['fileName'];
                        }elseif (isset($_GET['frame']) && $zoom['config']['pic_list_data'][$_GET['frame']]){
                            $return[1]['fileName'] = $zoom['config']['pic_list_data'][$_GET['frame']];
                        }else{
                            $return[1]['fileName'] = $zoom['config']['pic_list_data'][1]['fileName'];
                        }
                    }
                }
                // 3D
                else
                {
                    $midFolder = ceil(count($zoom['config']['subFolderArray'])/2);
                    $return[0] = $zoom['config']['pic'].$zoom['config']['subFolderArray'][$midFolder];
                     $qSub = glob($zoom['config']['picDir'].$zoom['config']['subFolderArray'][$midFolder].'/*');

                     $subImg = array();
                    foreach ($qSub as $file){
                        $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                        if ($this->isValidFileType($thisFile) ){
                            array_push($subImg, $thisFile);
                        }
                    }
                    $countSubImg = count($subImg);
                    $return[1]['rows'] = count($zoom['config']['subFolderArray']);
                    $return[1]['frames'] = $countSubImg * $return[1]['rows'];
                    $return[1]['framesRow'] = $countSubImg;
                    $return[1]['path'] = $zoom['config']['pic'];
                    $return[1]['folder'] = $this->getl('/', $this->checkSlash($zoom['config']['pic'], 'remove'));
                    $return[1]['type'] = '3D';

                    if ($countSubImg != 0){
                        if (isset($_GET['randFrame'])){
                            $return[1]['fileName'] = $subImg[rand(0, $countSubImg - 1)];
                        }
                        elseif (isset($_GET['frame']) && $subImg[intval($_GET['frame']-1)]){
                            $return[1]['fileName'] = $subImg[intval($_GET['frame']-1)];
                        }
                        else{
                            $return[1]['fileName'] = $subImg[0];
                        }
                    }
                }

                if (!$return[1]['fileName']){
                    $return[1] = false;
                }

                return $JSONencode ? json_encode ($return) : $return;
            }else{
                $returnError = array();
                $returnError[0] = 'error';
                $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query first image of the spin!';
                return $JSONencode ? json_encode ($returnError) : $returnError;
            }
        }else{
            $returnError = array();
            $returnError[0] = 'error';
            $returnError[1] = 'Because of allowAjaxQuery option settings you are not allowed to query first image of the spin this way!';
            return $JSONencode ? json_encode ($returnError) : $returnError;
        }
    }

    /**
      * Returns first images of 360s or 3Ds from a parent folder
      * @access public
      * @param array $zoom
      * @return JSON
      **/
    public function getFirstImageSpinFolder($zoom, $JSONencode = true){
        $subFolders = $this -> getFolders($zoom, false);
        if ($subFolders[0] != 'error'){
            $pic = $zoom['config']['pic'];
            $picDir = $zoom['config']['picDir'];
            $return = array();
            $m = 0;
            foreach ($subFolders[1] as $k=>$v){
                $zoom['config']['pic'] = $pic.$v['folderName'].'/';
                $zoom['config']['picDir'] = $picDir.$v['folderName'].'/';

                $n=0;
                $zoom['config']['pic_list_data'] = array();
                $zoom['config']['subFolderArray'] = array();

                foreach (glob($this->checkSlash($zoom['config']['picDir'],'add').'*', GLOB_ONLYDIR) as $folder){
                    $n++; $zoom['config']['subFolderArray'][$n] = $this->getl('/',$folder);
                }

                $n=0;
                foreach (glob($this->checkSlash($zoom['config']['picDir'],'add').'*') as $file){
                    $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));
                    if ( $this->isValidFileType($thisFile) ){
                        $n++; $zoom['config']['pic_list_data'][$n]['fileName'] = $thisFile;
                    }
                }

                $m++;
                $return[$m] = $this->getFirstImageSpin($zoom, false);
            }

            return $JSONencode ? json_encode($return) : $return;
        }else{
            return $JSONencode ? json_encode($subFolders) : $subFolders;
        }
    }

    /**
      * Check validity of CSV
      * @access public
      * @param string $string
      * @param string $sep
      * @param string $type
      * @return mixed
      **/
    public function testCSV($string, $sep, $type){
        $array = explode($sep, $string);
        $output = array();
        if ($type == 'int'){
            foreach ($array as $k=>$v){
                $output[$k] = intval($v);
            }
        }
        if (!empty($output)){
            return implode($sep, $output);
        }else{
            return false;
        }
    }

    /**
      * Remove all tags except supported
      * @access public
      * @param string $string
      * @return string
      **/
    public function removeScriptTags($string){
        return strip_tags($string, '<ul><ol><li><br><div><span><table><tr><td><th><h1><h2><h3><h4><img>');
    }

    /**
      * Try to figure out the path of axZm direcotry
      * @access public
      * @return string
      **/
    public function installPath($fpPP = ''){
        if (!$fpPP){$fpPP = realpath($_SERVER['DOCUMENT_ROOT']);}
        //$path = str_replace(array('//','axZm'),array('/',''),str_replace(str_replace('\\','/',realpath($_SERVER['DOCUMENT_ROOT'])),'/',str_replace('\\','/',dirname(realpath(__FILE__)))));
        $path = dirname(str_replace('//', '/', str_replace(str_replace('\\', '/', $fpPP), '/', str_replace('\\','/',dirname(realpath(__FILE__))))));
        $path = $this->checkSlash($path, 'remove');
        return $path;
    }

    /**
      * Uncompress data string
      * @access public
      * @param string $data
      * $param bool $noArray
      * @return mixed
      **/
    public function uncompress($zoom, $data, $noArray){
         $r = unserialize(gzuncompress(stripslashes(base64_decode(strtr($data, '-_,', '+/=')))));

         if ($data && !$noArray && (!is_array($r) || empty($r))){

            $r = array();

            $arr = explode('|', $data);

            foreach($arr as $k=>$v){
                if ($v){
                    $i = pathinfo($v);
                    $r[$k+1]['p'] = $this->rewriteBase($zoom,$this->checkSlash($i['dirname'], 'add'));
                    $r[$k+1]['f'] = $i['basename'];
                }
            }
         }

         elseif ($data && !$noArray && is_array($r) && !is_array(array_shift(array_values($r)))){
             $newArr = array();
             foreach($r as $k=>$v){
                  if ($v){
                      $i = pathinfo($v);
                      $newArr[$k]['p'] = $this->rewriteBase($zoom, $this->checkSlash($i['dirname'], 'add'));
                      $newArr[$k]['f'] = $i['basename'];
                  }
             }
             return $newArr;
         }

         return $r;
    }

    /**
      * Compress php data to pass over query string
      * @access public
      * @param mixed $data
      * @return string
      **/
    public function compress($data){
        return strtr(base64_encode(addslashes(gzcompress(serialize($data),9))), '+/=', '-_,');
    }

    /**
      * Returns the doctype as string for html, used in examples
      * @access public
      * @param int $key The numeric key of $doctype
      * @return HTML-Output
      **/
    public function setDoctype($key = false){
        if (array_key_exists($key, $this->doctype)){
            $doc = array_values($this->doctype[$key]);
        }else{
            $doc = array_values($this->doctype[7]);
        }
        $docc = explode('<html',$doc[0]);
        $doc[0] = $docc[0]."\r\n".'<html'.$docc[1];
        return $doc[0];
    }

    public function tileExists($zoom, $fileName){
        $path = $zoom['config']['pyrTilesDir'].$this->md5path($fileName, $zoom['config']['subfolderStructure']).$this->getf('.',$fileName);
         $arr = array('0-0-0.'.$this->pngMod($zoom), 'upload.txt');
         foreach($arr as $k=>$v){
             if (file_exists($this->checkSlash($path.'/'.$v, 'remove'))){
                 return true;
            }
        }
        return false;
    }

    public function getTileSize($zoom, $fileName){
        $tilePath = $zoom['config']['pyrTilesDir'].$this->md5path($fileName, $zoom['config']['subfolderStructure']).$this->getf('.',$fileName).'/0-0-0.'.$this->pngMod($zoom);
        if (file_exists($tilePath)){
            $thisTileSize = $this->axZm->imageSize($tilePath, $zoom['config']['im'], false);
            if (is_array($thisTileSize)){
                return intval(max($thisTileSize[0], $thisTileSize[1]));
            }
        }
        return $zoom['config']['tileSize'];
    }

    /**
      * Compare original image time with images created by AJAX-ZOOM
      * @access public
      * @param array $zoom
      * @return nothing
      **/
    public function cTimeCompare($zoom){
        $startTime = microtime(true);
        $this->readTime['cTimeFiles'] = array();
        foreach ($zoom['config']['pic_list_data'] as $num => $v){
            $smallImg = $zoom['config']['thumbDir'].$this->md5path($zoom['config']['pic_list_array'][$num], $zoom['config']['subfolderStructure']).$this->composeFileName($zoom['config']['pic_list_array'][$num], $zoom['config']['picDim'], '_', $this->pngMod($zoom));
            $tileImg = $zoom['config']['pyrTilesDir'].$this->md5path($zoom['config']['pic_list_array'][$num], $zoom['config']['subfolderStructure']).$this->getf('.',$zoom['config']['pic_list_array'][$num]).'/0-0-0.'.$this->pngMod($zoom);

            if (isset($v['path'])){
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$v['path'],'add'),'add');
            }

            if (file_exists($smallImg) && file_exists($tileImg) && file_exists($zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num])){
                if ($zoom['config']['cTimeCompare'] == 'filemtime'){
                    $smallImgTime = filemtime($smallImg);
                    $tileImgTime = filemtime($tileImg);
                    $orgImageTime = filemtime ($zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num]);
                }else{
                    $smallImgTime = filectime($smallImg);
                    $tileImgTime = filectime($tileImg);
                    $orgImageTime = filectime ($zoom['config']['picDir'].$zoom['config']['pic_list_array'][$num]);
                }

                if ($orgImageTime > $smallImgTime || $orgImageTime > $tileImgTime){
                    if (!$this->returnCTimeCompare){$this->returnCTimeCompare = array();}
                    array_push($this->returnCTimeCompare, $zoom['config']['pic_list_array'][$num]);
                    array_push($this->readTime['cTimeFiles'], $zoom['config']['pic_list_array'][$num]);
                    $this->removeAxZm($zoom, $zoom['config']['pic_list_array'][$num], array('In' => true, 'Th' => true, 'tC' => true, 'mO' => true, 'Ti' => true, 'gP' => true), false);
                }
            }
        }

        $this->readTime['cTimeCompare'] = $this->endTimeDiff($startTime);
    }

    /**
      * Rotate images
      * @access public
      * @param string $filename
      * @param integer $angle
      * @return image
      **/
    public function rotateImage($filename, $angle){
        $fType = strtolower($this->getl('.', $filename));
        if (!($fType == 'jpg' || $fType == 'jpeg')){
            return readfile($filename);
        }
        $src_img = imagecreatefromjpeg($filename);

        if (function_exists('imagerotate')) {
            return imagerotate($src_img, $angle, 0);
        } else {
            $src_x = imagesx($src_img);
            $src_y = imagesy($src_img);
            if ($angle == 180) {
                $dest_x = $src_x;
                $dest_y = $src_y;
            }
            elseif ($src_x <= $src_y) {
                $dest_x = $src_y;
                $dest_y = $src_x;
            }
            elseif ($src_x >= $src_y) {
                $dest_x = $src_y;
                $dest_y = $src_x;
            }

            $rotate = imagecreatetruecolor($dest_x, $dest_y);
            imagealphablending($rotate, false);

            switch ($angle) {
                case 270:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $dest_x - $y - 1, $x, $color);
                        }
                    }
                    break;
                case 90:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $y, $dest_y - $x - 1, $color);
                        }
                    }
                    break;
                case 180:
                    for ($y = 0; $y < ($src_y); $y++) {
                        for ($x = 0; $x < ($src_x); $x++) {
                            $color = imagecolorat($src_img, $x, $y);
                            imagesetpixel($rotate, $dest_x - $x - 1, $dest_y - $y - 1, $color);
                        }
                    }
                    break;
                default: $rotate = $src_img;
            }

            return $rotate;
        }
    }

    /**
      * Rotate images
      * @access public
      * @param string $input_file
      * @param string $output_file
      * @return image
      **/
    public function exifOrientation($input_file, $output_file) {
        $data = new PelDataWindow(file_get_contents($input_file));

        if (PelJpeg::isValid($data)) {
            $jpeg = new PelJpeg();
            $jpeg->load($data);
            if ($jpeg != null) {
                $exif = $jpeg->getExif();
                if ($exif != null) {
                    $tiff = $exif->getTiff();
                    if ($tiff != null) {
                        $ifd0 = $tiff->getIfd();
                        if ($ifd0 != null) {
                            // change tag "orientation"
                            $orientation = $ifd0->getEntry(PelTag::ORIENTATION);
                            $orientation->setValue(0);

                            // Change tag "image_description"
                            $sEXIF_description = "Picture rotated automatically.";
                            $description = $ifd0->getEntry(PelTag::IMAGE_DESCRIPTION);

                            // We need to check if the image already had a description stored.
                            if ($description == null) {
                                // Create a new PelEntryAscii object to hold the description.
                                $description = new PelEntryAscii(PelTag::IMAGE_DESCRIPTION, $sEXIF_description);
                                // This will insert the newly created entry with the description into the IFD.
                                $ifd0->addEntry($description);
                            } else {
                                // Save old description found in the image
                                $sEXIF_description_old = $description->getValue();
                                // Update description
                                $description->setValue($sEXIF_description);
                            }

                            // write file
                            file_put_contents($output_file, $jpeg->getBytes());
                        }
                    }
                }
            }
        }
    }


    public function rawThumbLoad($zoom){
        // Max width / height for regular thumbs
        if (!isset($zoom['config']['allowDynamicThumbsMaxSize'])){
            $zoom['config']['allowDynamicThumbsMaxSize'] = 120;
        }

        if (isset($_GET['azImg']) && !isset($_GET['previewPic']) && !isset($_GET['previewDir'])){
            $_GET['previewPic'] = $this->getl('/', $_GET['azImg']);
            $_GET['previewDir'] = $this->rewriteBase($zoom, $this->getf('/', $_GET['azImg']));
        }

        if (!isset($_GET['width'])){$_GET['width'] = 100;}
        if (!isset($_GET['height'])){$_GET['height'] = 100;}

        if ($_GET['width'] > $zoom['config']['allowDynamicThumbsMaxSize']){$_GET['width'] = $zoom['config']['allowDynamicThumbsMaxSize'];}
        if ($_GET['height'] > $zoom['config']['allowDynamicThumbsMaxSize']){$_GET['height'] = $zoom['config']['allowDynamicThumbsMaxSize'];}

        // Standard quality
        if (!isset($zoom['config']['dynamicThumbsQualRange'])){$zoom['config']['dynamicThumbsQualRange'] = array(50, 85);}
        if (!isset($zoom['config']['dynamicThumbsQual'])){$zoom['config']['dynamicThumbsQual'] = 85;}

        if (!isset($_GET['qual'])){
            $_GET['qual'] = $zoom['config']['dynamicThumbsQual'];
        }else{
            $_GET['qual'] = intval($_GET['qual']);
        }

        // Quality range
        if ($_GET['qual'] < $zoom['config']['dynamicThumbsQualRange'][0]){$_GET['qual'] = $zoom['config']['dynamicThumbsQualRange'][0];}
        if ($_GET['qual'] > $zoom['config']['dynamicThumbsQualRange'][1]){$_GET['qual'] = $zoom['config']['dynamicThumbsQualRange'][1];}

        // Relative paths
        $zoomTmp['fromPath'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift(explode('?',$_SERVER['HTTP_REFERER'])));

        // Relative paths correction
        if ($zoomTmp['fromPath'] && substr($_GET['previewDir'], 0, 3) == '../'){
            $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['previewDir'], 2),'add'));
            if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['previewDir'], 2), 'add'), 'add'))){
                unset($zoomTmp['zoomDirInfo']);
            }
        }

        if ($zoomTmp['zoomDirInfo']){
            $_GET['previewDir'] = $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
        }
        
        $_GET['previewDir'] = $this->rewriteBase($zoom, $_GET['previewDir']);

        $path = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['installPath'].'/'.$_GET['previewDir'],'add');

        if (!is_dir($path)){
            $path = $this->checkSlash($zoom['config']['fpPP'].'/'.$_GET['previewDir'],'add');
        }

        // Enlarge smaller images
        $enlarge = false;
        if (
            isset($_GET['enlarge'])
            && $_GET['enlarge'] != 'false'
            && $_GET['enlarge'] != 'no'
            && $_GET['enlarge'] != 'undefined'
        ){
            $enlarge = true; // if crop is passed, enlarge is true anyway
        }

        // Ver. 4.1.9+
        $crop = false;
        if ($zoom['config']['dynamicThumbsAllowCrop']
            && isset($_GET['x1'])
            && isset($_GET['y1'])
            && isset($_GET['x2'])
            && isset($_GET['y2'])
        ){
            $crop = array(
                'x1' => $_GET['x1'],
                'y1' => $_GET['y1'],
                'x2' => $_GET['x2'],
                'y2' => $_GET['y2']
            );

            // Limit crop max size
            if (!isset($zoom['config']['dynamicThumbsCropMaxSize'])){
                $zoom['config']['dynamicThumbsCropMaxSize'] = 120;
            }

            if ($_GET['width'] > $zoom['config']['dynamicThumbsCropMaxSize']){
                $_GET['width'] = $zoom['config']['dynamicThumbsCropMaxSize'];
            }
            if ($_GET['height'] > $zoom['config']['dynamicThumbsCropMaxSize']){
                $_GET['height'] = $zoom['config']['dynamicThumbsCropMaxSize'];
            }
        }

        // Cache thumbnail / crop or not
        $cache = $zoom['config']['dynamicThumbsCache'];

        // If it is allowed to override the default cache value and cache is passed as parameter
        if ($zoom['config']['dynamicThumbsCacheByGET'] && isset($_GET['cache'])){
            if (
                $_GET['cache'] == 'false'
                || $_GET['cache'] == 'no'
                || $_GET['cache'] == 'undefined'
            ){
                $cache = false;
            }else{
                $cache = true;
            }
        }

        // Override default setting $zoom['config']['pngMode']
        // Generate PNG images instead of JPG
        $pngMode = null;
        if (isset($_GET['pngMode'])){
            if ($_GET['pngMode'] == 'true' || $_GET['pngMode'] == '1' || $_GET['pngMode'] == 'yes'){
                $pngMode = true;
            }elseif($_GET['pngMode'] == 'false' || $_GET['pngMode'] == '0' || $_GET['pngMode'] == 'no'){
                $pngMode = false;
            }
        }

        // Override default setting $zoom['config']['pngKeepTransp']
        // Keep transparent areas of the images when pngMode is enabled.
        // When using GD2 the results might be not satisfactory
        $pngKeepTransp = null;
        if (isset($_GET['pngKeepTransp'])){
            if ($_GET['pngKeepTransp'] == 'true' || $_GET['pngKeepTransp'] == '1' || $_GET['pngKeepTransp'] == 'yes'){
                $pngKeepTransp = true;
            }elseif($_GET['pngKeepTransp'] == 'false' || $_GET['pngKeepTransp'] == '0' || $_GET['pngKeepTransp'] == 'no'){
                $pngKeepTransp = false;
            }
        }

        // Override default setting $zoom['config']['imKeepProfiles']
        // Keep color and other profiles when using ImageMagick
        $imKeepProfiles = null;
        if (isset($_GET['imKeepProfiles'])){
            if ($_GET['imKeepProfiles'] == 'true' || $_GET['imKeepProfiles'] == '1' || $_GET['imKeepProfiles'] == 'yes'){
                $imKeepProfiles = true;
            }elseif($_GET['imKeepProfiles'] == 'false' || $_GET['imKeepProfiles'] == '0' || $_GET['imKeepProfiles'] == 'no'){
                $imKeepProfiles = false;
            }
        }

        // Enable watermark if it is not enabled
        $enableWtr = false;
        if (isset($_GET['enableWtr']) && is_array($zoom['config']['dynamicThumbsWtrmrk']) && $zoom['config']['dynamicThumbsWtrmrk']['allowEnableByGet']){
            $enableWtr = true;
        }

        ob_start();
        if ($this->isValidPath($path) && $this->isValidFilename($_GET['previewPic']) && file_exists($path.$_GET['previewPic']) ){
            // Return dynamically generated image thumb
            $this->axZm->rawThumb(
                $zoom,
                array(
                    'picDir' => $path,
                    'imgName' => $_GET['previewPic'],
                    'prevWidth' => intval($_GET['width']),
                    'prevHeight' => intval($_GET['height']),
                    'qual' => intval($_GET['qual']),
                    'cache' => $cache,
                    'download' => false,
                    'backColor' => isset($_GET['backColor']) ? $_GET['backColor'] : $zoom['config']['pngBackgroundColor'],
                    'thumbMode' => isset($_GET['thumbMode']) ? $_GET['thumbMode'] : false, // contain, cover
                    'enlarge' => $enlarge,
                    'crop' => $crop,
                    'pngMode' => $pngMode,
                    'pngKeepTransp' => $pngKeepTransp,
                    'imKeepProfiles' => $imKeepProfiles,
                    'enableWtr' => $enableWtr
                )
            );
        }

        // File does not exist, return an empty image with calculated path on it
        elseif ($this->isValidPath($path) && $this->isValidFilename($_GET['previewPic']) && !file_exists($path.$_GET['previewPic']) ){
            session_write_close();

            if (isset($_GET['textError'])){
                echo 'Image does not exist!
                Name: '.$_GET['previewPic'].'
                Path: '.$path.$_GET['previewPic'];
            }else{
                $im = imagecreatetruecolor(intval($_GET['width']), intval($_GET['height']));

                $background_color = imagecolorallocate($im, 210, 210, 210);
                imagefill($im, 0, 0, $background_color);

                $text_color = imagecolorallocate($im, 171, 0, 0);
                imagestring($im, 2, 5, 5,  'Image does not exist!', $text_color);
                imagestring($im, 1, 5, 25,  'Name: '.$_GET['previewPic'], $text_color);
                imagestring($im, 1, 5, 35,  'Path: '.$path.$_GET['previewPic'], $text_color);

                header('Content-Type: image/jpeg');
                header("Pragma: public");
                header("Cache-Control: maxage=1");
                header('Expires: ' . gmdate('D, d M Y H:i:s', time()+1) . ' GMT');
                imagejpeg($im, NULL, 100);
                imagedestroy($im);
            }
        }

        ob_end_flush();

    }

    /**
      * Construct a path for cache images
      * @access public
      * @param string $str
      * @return string
      **/
    final function md5path($str, $type){
        if ($type == 'md5'){
            $filename = $this->getf('.', $str);
            if (!$filename){$filename = $str;}
            $md5 = md5($this->getf('.', $filename));
            return substr($md5, 0, 1) . '/' . substr($md5, 1, 1) . '/';
        }
        elseif ($type == 'char'){
            $exArr = array('\\', '/', '?', '%', '*', ':', '"', '<', '>', '.', ',', '|', '(', ')', '&', '=', ' ');
            $filename = $this->getf('.', $str);
            if (!$filename){$filename = $str;}
            $l = str_split($filename, 1);
            $f1 = str_replace($exArr, '_', $l[0]);
            $f2 = str_replace($exArr, '_', $l[1]);
            if (strlen($f1) != 1){$f1 = '_';}
            if (strlen($f2) != 1){$f2 = '_';}
            return $f1 . '/' . $f2 . '/';
        }
        else {
            return '';
        }
    }

    /**
      * Send request with PHP
      * @access public
      * @param array $verb GET or POST
      * @param string $ip Target IP / hostname
      * @param int $port Target port
      * @param string $uri Target uri
      * @param int $timeout Socket timeout in seconds
      * @param array $getdata HTTP GET Data ie. array('var1' => 'val1', 'var2' => 'val2')
      * @param array $postdata HTTP POST Data ie. array('var1' => 'val1', 'var2' => 'val2')
      * @param array $custom_headers Custom HTTP headers
      * @param array $req_hdr Include HTTP request headers
      * @param array $res_hdr Include HTTP response headers
      * @return mixed
      **/
    public function httpRequestQuery(
        $verb = 'GET',
        $ip = '',
        $port = 80,
        $uri = '/',
        $timeout = 10,
        $getdata = array(),
        $postdata = array(),
        $custom_headers = array(),
        $req_hdr = false,
        $res_hdr = false
    ) {
        $ret = '';
        $verb = strtoupper($verb);
        $getdata_str = count($getdata) ? '?' : '';
        $postdata_str = '';

        foreach ($getdata as $k => $v){
            $getdata_str .= urlencode($k) .'='. urlencode($v) . '&';
        }

        foreach ($postdata as $k => $v){
            $postdata_str .= urlencode($k) .'='. urlencode($v) .'&';
        }

        $crlf = "\r\n";

        $req = $verb .' '. $uri . $getdata_str .' HTTP/1.1' . $crlf;
        $req .= 'Host: '. $ip . $crlf;
        $req .= 'User-Agent: Mozilla/5.0 Firefox/3.6.12' . $crlf;
        $req .= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' . $crlf;
        $req .= 'Accept-Language: en-us,en;q=0.5' . $crlf;
        $req .= 'Accept-Encoding: deflate' . $crlf;
        $req .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' . $crlf;
        $req .= 'Pragma: no-cache' . $crlf;

        foreach ($custom_headers as $k => $v){
            $req .= $k .': '. $v . $crlf;
        }

        if ($verb == 'POST' && !empty($postdata_str)){
            $postdata_str = substr($postdata_str, 0, -1);
            $req .= 'Content-Type: application/x-www-form-urlencoded' . $crlf;
            $req .= 'Content-Length: '. strlen($postdata_str) . $crlf;
            $req .= 'Connection: close'. $crlf . $crlf;
            $req .= $postdata_str;

        } else {
            $req .= 'Connection: close'. $crlf . $crlf;
        }

        if ($req_hdr){
            $ret .= $req;
        }

        if (($fp = @fsockopen($ip, $port, $errno, $errstr, $timeout)) == false){
            return "Error $errno: $errstr\n";
        }

        //stream_set_timeout($fp, 2);

        fputs($fp, $req);

        while ($line = fgets($fp)){
            $ret .= $line;
        }

        fclose($fp);

        $responseHeader = substr($ret, 0, strpos($ret, "\r\n\r\n") + 2);

        if (!$res_hdr){
            $ret = substr($ret, strpos($ret, "\r\n\r\n") + 4);
        }

        // Debug
        if (!strstr($responseHeader, "200")){
            $text = "Host: $ip <br>";
            $text .= "Port: $port <br>";
            $text .= "Uri: $uri <br><br>";
            $text .= "<span style=\"font-weight: bold;\">Response Header</span><br>";

            $ret .= "<script type=\"text/javascript\">jQuery.fn.axZm.zoomAlert('".str_replace( $crlf ,'<br>', $text.$responseHeader)."', 'Request Failed', 'Please check imageSlicer option in zoomConfig.inc.php', true); </script>";
        } elseif ($ret == ''){
            $ret .= "<script type=\"text/javascript\">jQuery('.axZmAlertBox').remove(); </script>";
        }

        return $ret;
    }
    
    public function rewriteBase($zoom, $string){
        if (isset($zoom['config']['rewriteBase']) && $zoom['config']['rewriteBase'] && is_string($zoom['config']['rewriteBase']) && is_string($string)){
            return preg_replace('/^\\'.$zoom['config']['rewriteBase'].'/', '', $string);
        }else{
            return $string;
        }
    }

    /**
      * Proceed $_GET['zoomData'], same as in zoomObjects.inc.php for internal use
      * @access public
      * @param array $zoom
      * @return array $zoom, $pic_list_array, $pic_list_data, $zoomTmp
      **/
    public function getZoomData($zoom){
        $zoom['config']['zoomDataPassed'] = $_GET['zoomData'];

        // Check validity of the passed file name
        if (isset($_GET['zoomFile'])){

            if (!strstr($_GET['zoomFile'], '.')){
                $_GET['zoomFile'] = $this->uncompress($zoom, $_GET['zoomFile'], true);
            }

            $_GET['zoomDir'] = $this->rewriteBase($zoom, $this->checkSlash(dirname($_GET['zoomFile']), 'add'));
            $_GET['zoomFile'] = basename($_GET['zoomFile']);

            if (!$this->isValidFilename($_GET['zoomFile'])){
                unset($_GET['zoomFile']);
            }
        }


        // Decode and uncompress data array
        $_GET['zoomData'] = $this->uncompress($zoom, $_GET['zoomData'], false);


        $pic_list_array = array();
        $pic_list_data = array();
        $zoomTmp = array();

        if (is_array($_GET['zoomData'])){


            // Try to correct relative paths
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW']) || isset($_GET['qq'])){
                $zoomTmp['fromPath'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift(explode('?',$_SERVER['HTTP_REFERER'])));
            }else{
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }

            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\'){
                $zoomTmp['fromPath'] .= 'index.html';
            }



            foreach ($_GET['zoomData'] as $k=>$v){

                if ( (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW'])) && !$_SERVER['HTTP_REFERER'] && substr($v['p'],0, 3) == '../'){
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                }

                // Relative paths correction
                if ($zoomTmp['fromPath'] && substr($v['p'],0, 3) == '../'){
                    $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($v['p'],2),'add'));
                    if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($v['p'],2),'add'),'add'))){
                        unset($zoomTmp['zoomDirInfo']);
                    }
                }

                if ($zoomTmp['zoomDirInfo']){
                    $v['p'] =  $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add');
                }

                // Check data array
                if (!$this->isValidFilename($v['f']) || !$this->isValidPath($v['p'])){
                    unset($_GET['zoomData'][$k]);
                }else{
                    // Fill $pic_list_array and $pic_list_data
                    $pic_list_array[$k] = $v['f'];
                    $pic_list_data[$k]['path'] = $v['p'];


                    if (!$zoomTmp['zoomDirFound'] AND isset($_GET['zoomDir'])){
                        if ($_GET['zoomDir'] == $v['p']){
                            $zoomTmp['zoomDirFound'] = true;
                        }
                    }
                }

                $zoomTmp['zoomDirInfo'] = false;
            }


            // Unset zoomDir if not found above
            if (!$zoomTmp['zoomDirFound'] AND isset($_GET['zoomDir'])){
                unset ($_GET['zoomDir']);
            }

            // Choose the first folder if zoomDir ($_GET['zoomDir']) is not passed or has been unset above
            if (!isset($_GET['zoomDir']) AND is_array($_GET['zoomData'])){
                reset($_GET['zoomData']);
                $_GET['zoomDir'] = $_GET['zoomData'][key($_GET['zoomData'])]['p'];
            }

            // Shops Hack
            if (in_array($_GET['example'], array('magento', 'oxid', 'xtc'))){
                // Remove gallery for shops if only one image is loaded
                if (count($pic_list_array) == 1){
                    $zoom['config']['galleryNavi'] = false;
                    $zoom['config']['useFullGallery'] = false;
                    $zoom['config']['useGallery'] = false;
                    $zoom['config']['useHorGallery'] = false;
                }

                if (count($pic_list_array) <= 3){
                    $zoom['config']['galleryScrollbarWidth'] = 0;
                    $zoom['config']['galleryPlayButton'] = false;
                } else{
                    $zoom['config']['galleryScrollbarWidth'] = 10;
                }
            }
        }
        else {
            unset($_GET['zoomData']);
        }

        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }

     /**
      * Proceed $_GET['3dDir'], same as in zoomObjects.inc.php for internal use
      * @access public
      * @param array $zoom
      * @return array $zoom, $pic_list_array, $pic_list_data, $zoomTmp
      **/
    public function get3dDir($zoom){
        $pic_list_array = array();
        $pic_list_data = array();
        $zoomTmp = array();

        if (substr($_GET['3dDir'],0, 2) == './' || substr(strtolower($_GET['3dDir']),0, 2) == 'c:'){
            $_GET['3dDir'] = substr($_GET['3dDir'], 2);
        }

        $_GET['3dDir'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', $_GET['3dDir']);
        
        $_GET['3dDir'] = $this->rewriteBase($zoom, $_GET['3dDir']);
        
        // $zoom['config']['pic'] from zoomConfig.inc.php as basePath
        $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$_GET['3dDir'],'add');
        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');

        // Try absolute path
        if (!is_dir($zoom['config']['picDir'])){
            $zoom['config']['pic'] = $this->checkSlash('/'.$_GET['3dDir'],'add');
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        }

        if (!is_dir($zoom['config']['picDir'])){

            // Try to correct relative paths
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW'])){
                $zoomTmp['fromPath'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift(explode('?',$_SERVER['HTTP_REFERER'])));
                if (!$_SERVER['HTTP_REFERER'] && stristr($_GET['3dDir'], '../')){
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                }

            }else{
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }

            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\'){
                $zoomTmp['fromPath'] .= 'index.html';
            }

            // Relative paths correction
            if ($zoomTmp['fromPath'] && substr($_GET['3dDir'],0, 3) == '../'){

                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['3dDir'],2),'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['3dDir'],2),'add'),'add'))){
                    unset($zoomTmp['zoomDirInfo']);
                }
            }

            // Not absolute path
            elseif ($zoomTmp['fromPath'] && substr($_GET['3dDir'],0, 1) != '/'){
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['3dDir'],'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['3dDir'],'add'),'add'))){
                    unset($zoomTmp['zoomDirInfo']);
                }
            }

            // Try to find the path by adding $zoom['config']['installPath']
            elseif ($zoom['config']['installPath'] && substr($_GET['3dDir'],0, 1) == '/'){
                $zoom['config']['pic'] = $this->checkSlash($zoom['config']['installPath'].'/'.$_GET['3dDir'],'add');
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'],'add');
            }

            if ($zoomTmp['zoomDirInfo']){
                $_GET['3dDir'] =  $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add'); // remove
                $zoom['config']['pic'] = $_GET['3dDir'];
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$_GET['3dDir'],'add');
            }
        }

        if (!$this->isValidPath($_GET['3dDir']) ){
            unset ($_GET['3dDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }

        // picDir should not contain/be some ajax-zoom cache directory
        if ($zoom['config']['picDir'] == $zoom['config']['thumbDir']
        || $zoom['config']['picDir'] == $zoom['config']['galleryDir']
        || strstr($zoom['config']['picDir'], $zoom['config']['pyrTilesDir'])
        || strstr($zoom['config']['picDir'], $zoom['config']['gPyramidDir'])
        || $zoom['config']['picDir'] == $zoom['config']['mapDir']
        || $zoom['config']['picDir'] == $zoom['config']['tempCacheDir']
        ){
            unset ($_GET['3dDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }

        if ($_GET['zoomCueFrames']){
            $zoom['config']['cueFrames'] = $this -> testCSV($_GET['zoomCueFrames'], ',', 'int');
        }

        // Open all files
        if (is_dir($zoom['config']['picDir'])){
            $n=0; $z=0; $nn++; $cutFrames = 1;

            // cutFrames parameter can be additionally passed over query string
            // e.g. 2 will make 36 frames out of 72, 3 will make 24 out of 72 and so on
            if (isset($_GET['cutFrames']) && intval($_GET['cutFrames']) > 0){
                $cutFrames = intval($_GET['cutFrames']);
            }

            // 4.2.4
            $exclFilter = isset($zoom['config']['spinFilesExcludeFilter']) ? $zoom['config']['spinFilesExcludeFilter'] : array();

            // etarate over files
            foreach (glob($zoom['config']['picDir'].'*') as $file){
                $thisFile = $this->getl('/', $this->checkSlash($file,'remove'));

                // Subfolders for multirow 360 Object
                if (is_dir($file)){
                    if (!is_array($zoom['config']['zAxis'])){
                        $zoom['config']['zAxis'] = array();
                        $zoom['config']['zFolder'] = array();
                        $thisNumberFiles = array();
                    }

                    // Limit to 21 levels
                    $z++; if ($z > ($zoom['config']['spinMaxRows'] || 15)){break;}

                    $zoom['config']['zFolder'][$z] = $thisFile;

                    $zoomTmp['subFiles'] = array();

                    // Read the files first, glob does not always sort as expected
                    $tt = 0;
                    foreach (glob($this->checkSlash($file,'add').'*') as $subFile){
                        $thisSubFile = $this->getl('/', $this->checkSlash($subFile,'remove'));
                        if ($this->isValidFileType($thisSubFile)){
                            $filterCheck = false;
                            if (!empty($exclFilter)){
                                if ($this->strstr_array($exclFilter, $thisFile)){
                                    $filterCheck = true;
                                }
                            }
                            if ($filterCheck === false){
                                $zoomTmp['subFiles'][] = $thisSubFile;
                                $tt++;
                            }
                        }

                        // Limit to 360 images
                        if ($tt > ($zoom['config']['spinMaxFrames'] || 360)){
                            echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                            <div style='font-size: 200%'>Error</div>
                            The number of images in one row of your spherical 3D exceeded the limit to ".($zoom['config']['spinMaxFrames'] || 360)." images.
                            AJAX-ZOOM broke up with the request.
                            </div>
                            <script>window.aZ3dError = true;</script>
                            ";
                            exit;
                        }
                    }
                    $thisNumberFiles[$z] = $tt;

                    if ($z > 1 && $thisNumberFiles[$z-1] != $tt){
                        echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                        <div style='font-size: 200%'>Error</div>
                        The number of images in subfolders (".$_GET['3dDir'].") for your spherical 3D is not equal.
                        While in one folder there are ".$thisNumberFiles[$z-1]." images, an other contains ".$tt." images.
                        As of current version this is not possible. AJAX-ZOOM broke up with the request.
                        If you are not sure why is that, please contact the support.
                        </div>
                        <script>window.aZ3dError = true;</script>
                        ";
                        exit;
                    }

                    $zoomTmp['subFiles'] = $this->natIndex($zoomTmp['subFiles'], false);

                    if (!empty($zoomTmp['subFiles'])){
                        $nn = 0;
                        foreach ($zoomTmp['subFiles'] as $k => $thisSubFile){
                            $nn++;
                            if ($nn % $cutFrames == 0){
                                $n++;
                                $pic_list_array[$n] = $thisSubFile;
                                $pic_list_data[$n]['path'] = $zoom['config']['pic'].$thisFile;
                                $zoom['config']['zAxis'][$z][$n] = $thisSubFile;
                            }
                        }
                    }

                }
                elseif (!isset($zoom['config']['zAxis'])){
                    if ($this->isValidFileType($thisFile)){
                        $filterCheck = false;
                        if (!empty($exclFilter)){
                            if ($this->strstr_array($exclFilter, $thisFile)){
                                $filterCheck = true;
                            }
                        }
                         if ($filterCheck === false){
                             $nn++;
                            if ($nn % $cutFrames == 0){
                                $n++;
                                $pic_list_array[$n] = $thisFile;
                            }
                        }
                    }
                }
            }

            if (!isset($zoom['config']['zAxis']) && !empty($pic_list_array)){
                $pic_list_array = $this->natIndex($pic_list_array, false);
            }

        }


        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }

    public function strstr_array($array, $string){
        foreach($array as $k=>$v){
            if (strstr($string, $v)){
                return true;
            }
        }
        return false;
    }

     /**
      * Proceed $_GET['zoomDir'], same as in zoomObjects.inc.php for internal use
      * @access public
      * @param array $zoom
      * @return array $zoom, $pic_list_array, $pic_list_data, $zoomTmp
      **/
    public function getZoomDir($zoom, $axZmScanDir){
        // The key (zoomID) should be an integer > 0
        $pic_list_array = array();

        // $pic_list_data is a "multidimensional" array which contains more information about the source files
        $pic_list_data = array();

        // Temp array
        $zoomTmp = array();

        // Create empty array for folders
        $zoomTmp['folderArray'] = array();

        // Open the "base directory" $zoom['config']['picDir'] and choose only folders in it (GLOB_ONLYDIR)
        // needed for some examples...
        if ($axZmScanDir){
            $n=0; // Start counter
            foreach (glob($this->checkSlash($zoom['config']['picDir'],'add').'*', GLOB_ONLYDIR) as $folder){
                $n++;
                // Fill folder array with subfolder names
                $zoomTmp['folderArray'][$n] = $this->getl('/',$folder);
            }
            $zoom['config']['folderArray'] = $zoomTmp['folderArray'];
        }

        $_GET['zoomDir'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', $_GET['zoomDir']);
        $_GET['zoomDir'] = $this->rewriteBase($zoom, $_GET['zoomDir']);
        
        // $zoom['config']['pic'] from zoomConfig.inc.php as basePath
        $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$_GET['zoomDir'],'add');
        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');

        // Try absolute path
        if (!is_dir($zoom['config']['picDir'])){
            $zoom['config']['pic'] = $this->checkSlash('/'.$_GET['zoomDir'],'add');
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'], 'add');
        }

        if (!is_dir($zoom['config']['picDir'])){

            // Try to correct relative paths
            if (isset($_GET['zoomLoadAjax']) || isset($_GET['loadZoomAjaxSet']) || isset($_GET['setHW']) || isset($_GET['qq'])){
                $zoomTmp['fromPath'] = str_replace(array('http://', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : ''), '', array_shift(explode('?',$_SERVER['HTTP_REFERER'])));
                if (!isset($_GET['qq']) && !$_SERVER['HTTP_REFERER'] && stristr($_GET['zoomDir'], '../')){
                    echo "<div style='padding: 10px; font-size: 150%; background-color: #CC1100; color: #FFFFFF' class=''>
                    <div style='font-size: 200%'>Error</div>
                    When images or folders are defined as relative paths (../) it may lead to not showing them under certain conditions.
                    A simple workaround is to always use absolute paths. Please address this message to the website administrator. Thank you.
                    </div>
                    <script>window.aZrelPathError = true;</script>
                    ";
                    exit;
                }

            }else{
                $zoomTmp['fromPath'] = $_SERVER['REQUEST_URI'];
            }

            if (substr($zoomTmp['fromPath'], -1) == '/' || substr($zoomTmp['fromPath'], -1) == '\\'){
                $zoomTmp['fromPath'] .= 'index.html';
            }

            // Relative paths correction
            if ($zoomTmp['fromPath'] && substr($_GET['zoomDir'],0, 3) == '../'){

                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['zoomDir'],2),'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).substr($_GET['zoomDir'],2),'add'),'add'))){
                    unset($zoomTmp['zoomDirInfo']);
                }
            }

            // Not absolute path
            elseif ($zoomTmp['fromPath'] && substr($_GET['zoomDir'],0, 1) != '/'){
                $zoomTmp['zoomDirInfo'] = pathinfo($this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['zoomDir'],'add'));
                if (!is_dir($this->checkSlash($zoom['config']['fpPP'].$this->checkSlash(dirname(dirname($zoomTmp['fromPath'])).'/'.$_GET['zoomDir'],'add'),'add'))){
                    unset($zoomTmp['zoomDirInfo']);
                }
            }

            // Try to find the path by adding $zoom['config']['installPath']
            elseif ($zoom['config']['installPath'] && substr($_GET['zoomDir'],0, 1) == '/'){
                $zoom['config']['pic'] = $this->checkSlash($zoom['config']['installPath'].'/'.$_GET['zoomDir'],'add');
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['pic'],'add');
            }

            if ($zoomTmp['zoomDirInfo']){
                $_GET['zoomDir'] =  $this->checkSlash('/'.$zoomTmp['zoomDirInfo']['dirname'].'/'.$zoomTmp['zoomDirInfo']['basename'], 'add'); // remove
                $zoom['config']['pic'] = $_GET['zoomDir'];
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$_GET['zoomDir'],'add');
            }
        }

        if (!$this->isValidPath($_GET['zoomDir']) ){
            unset ($_GET['zoomDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }



        // picDir should not contain/be some ajax-zoom cache directory
        if ($zoom['config']['picDir'] == $zoom['config']['thumbDir']
        || $zoom['config']['picDir'] == $zoom['config']['galleryDir']
        || strstr($zoom['config']['picDir'], $zoom['config']['pyrTilesDir'])
        || strstr($zoom['config']['picDir'], $zoom['config']['gPyramidDir'])
        || $zoom['config']['picDir'] == $zoom['config']['tempCacheDir']
        || $zoom['config']['picDir'] == $zoom['config']['mapDir']
        ){
            unset ($_GET['zoomDir'], $zoom['config']['picDir'], $zoom['config']['pic']);
        }


        if ($zoom['config']['picDir']){

            if (substr($_GET['zoomDir'],0, 2) == './' || substr(strtolower($_GET['zoomDir']),0, 2) == 'c:'){
                $_GET['zoomDir'] = substr($_GET['zoomDir'], 2);
            }

            // 4.1.10
            if (isset($_GET['qq'])){
                $n=0; // Start counter
                $zoom['config']['subFolderArray'] = array();
                foreach (glob($this->checkSlash($zoom['config']['picDir'],'add').'*', GLOB_ONLYDIR) as $folder){
                    $n++;
                    // Fill folder array with subfolder names
                    $zoom['config']['subFolderArray'][$n] = $this->getl('/', str_replace('\\', '/', $folder));
                }
            }

            $n=0; $pic_list_info = array(); $pic_list_all_info = array();

            foreach (glob($zoom['config']['picDir'].'*') as $file){
                $thisFile = $this->getl('/', $this->checkSlash($file, 'remove'));

                if ( $this->isValidFileType($thisFile) ){
                    // Add filename to the pic_list_array with the index $n ($n >= 1)
                    $n++;
                    $pic_list_array[$n] = $thisFile;

                    if ($zoom['config']['sortBy']){
                         $thisFileStat = stat($file);
                         if ($thisFileStat[$zoom['config']['sortBy']]){
                             $pic_list_info[$n] =  $thisFileStat[$zoom['config']['sortBy']];
                         }
                         $pic_list_all_info[$n] = $thisFileStat;
                    }
                }
            }

            // Sort images by value set in $zoom['config']['sortBy'] (any key returned by php stat() function)
            if ($zoom['config']['sortBy'] && !empty($pic_list_info)){
                if ($zoom['config']['sortReverse']){arsort($pic_list_info);}
                else{asort($pic_list_info);}
                $n=0; $pic_list_array_tmp = $pic_list_array;
                foreach ($pic_list_info as $k=>$v){
                    $n++;
                    if (!$pic_list_data[$n]){$pic_list_data[$n] = array();}
                    $pic_list_array[$n] = $pic_list_array_tmp[$k]; // set filename
                    $pic_list_data[$n][$zoom['config']['sortBy']] = $v;
                    $pic_list_data[$n]['stat'] = $pic_list_all_info[$k];
                }

            }else{
                // Sort piclist by filename if you want, (not necessary)
                $pic_list_array = $this->natIndex($pic_list_array, $zoom['config']['sortReverse'] ? true : false);
            }
        }

        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }



     /**
      * Proceed reluts of $pic_list_array, same as in zoomObjects.inc.php for internal use
      * @access public
      * @param array $zoom
      * @param array $pic_list_array
      * @param array $pic_list_data
      * @param array $zoomTmp
      * @return array $zoom, $pic_list_array, $pic_list_data, $zoomTmp
      **/
    public function preProceedList($zoom, $pic_list_array, $pic_list_data, $zoomTmp){
        if (!empty($pic_list_array)){

            $firstImageSize = null;
            $startTime = microtime(true);
            if (!$zoom['config']['imgFileOpt']){$zoom['config']['imgFileOpt'] = array();}

            foreach ($pic_list_array as $k=>$v){

                // Store filename under the key 'fileName'
                $pic_list_data[$k]['fileName'] = $v;

                // Heuristic approach
                if (isset($pic_list_data[$k]['path'])){
                    $picPath = $this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'],'add');
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath,'add');
                    $thisPicPath =  $this->checkSlash($pic_list_data[$k]['path'],'add');

                    if (!is_dir($zoom['config']['picDir'])){
                        $picPath = $this->checkSlash('/'.$pic_list_data[$k]['path'],'add');
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath,'add');

                        if (!is_dir($zoom['config']['picDir'])){
                            $picPath = $this->checkSlash($zoom['config']['installPath'].'/'.$pic_list_data[$k]['path'],'add');
                            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$picPath,'add');
                        }
                    }
                    $pic_list_data[$k]['picPath'] = $picPath;
                }

                // Save full path of the image
                $pic_list_data[$k]['thisImagePath'] = $this->checkSlash($zoom['config']['picDir'].'/'.$v, 'remove');

                // We need this information only once at loading process, not for zooming into an image.
                // AJAX-ZOOM passes the  additional parameter 'str' which means that this is a zoom request.
                if (!isset($_GET['str'])){
                    
                    if ($firstImageSize && ($zoom['config']['spinMod'] || $zoom['config']['imgFileOpt']['sameSize'])){
                        // Assume same image size under certain conditions
                        $pic_list_data[$k]['imgSize'] = $firstImageSize;
                    } else {
                        // Store imagesize under the key 'imgSize' (necessary!!!)
                        $pic_list_data[$k]['imgSize'] = $this->axZm->imageSize($zoom['config']['picDir'].$pic_list_array[$k], $zoom['config']['im'], false);
                    }


                    if (!$firstImageSize){$firstImageSize = $pic_list_data[$k]['imgSize'];}

                    // Store filesize under the key 'fileSize' (not necessary, just for example)
                    if ($zoom['config']['imgFileOpt']['getFileSize']){
                        $pic_list_data[$k]['fileSize'] = filesize($zoom['config']['picDir'].$pic_list_array[$k]);
                    }

                    // Under the key 'thumbDescr' you can store any short image information that will be shown under the thumb of image gallery
                    // This is just an example, if image size is important


                    // Thumb description
                    if (function_exists($zoom['config']['galleryThumbDesc'])){
                        $pic_list_data[$k]['thumbDescr'] = $zoom['config']['galleryThumbDesc']($pic_list_data, $k);
                    }

                    // Full description
                    if (function_exists($zoom['config']['galleryThumbFullDesc'])){
                        $pic_list_data[$k]['fullDescr'] = $zoom['config']['galleryThumbFullDesc']($pic_list_data, $k);
                    }
                }
            }

            // Store information in $zoom['config']
            $zoom['config']['pic_list_array'] = $pic_list_array;
            $zoom['config']['pic_list_data'] = $pic_list_data;

            // Statistics
            $this->readTime['preProceedList'] = $this->endTimeDiff($startTime);

            // Check the existance of the files and generate everything needed on the fly
            $startTimeProceedList = microtime(true);
            $proceed = $this->proceedList($zoom, $zoomTmp);

            // Statistics
            $this->readTime['proceedList'] = $this->endTimeDiff($startTimeProceedList);

            $zoom = $proceed[0];
            $zoomTmp = $proceed[1];
            $pic_list_array = $zoom['config']['pic_list_array'];
            $pic_list_data = $zoom['config']['pic_list_data'];

            $this->readTime['total'] = $this->endTimeDiff($startTime);
        }
        return array($zoom, $pic_list_array, $pic_list_data, $zoomTmp);
    }

    /**
      * Check the existance of the files and generate everything needed on the fly
      * @access public
      * @param array $zoom
      * @param array $zoomTmp
      * @return array $zoom, $zoomTmp
      **/
    public function proceedList($zoom, $zoomTmp){
        $pic_list_array = $zoom['config']['pic_list_array'];
        $pic_list_data = $zoom['config']['pic_list_data'];
        $picSave = $zoom['config']['pic'];
        if (!$zoom['config']['imgFileOpt']){$zoom['config']['imgFileOpt'] = array();}

        if (!empty($pic_list_array) AND !empty($pic_list_data))
        {

            //////////////////////////////////////////////////////////////////////////////////////////////////////
            //// Select the first picture if no zoomID ///////////////////////////////////////////////////////////
            //// passed over query string ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////////////////////

            // zoomID must be a number (integer) > 0 !!!
            settype ($_GET['zoomID'],'int');

            // Set the internal pointer of an array to its first element
            reset($pic_list_array);

            // You can also pass the filename, which has to exist in the $pic_list_array
            if (isset($_GET['zoomFile'])){
                if (in_array($_GET['zoomFile'], $pic_list_array)){
                    $flipedArray = array_flip($pic_list_array);
                    $_GET['zoomID'] = $flipedArray[$_GET['zoomFile']];
                }
            }

            // If no zoomID passed or zoomID is not a key in picture array
            if (!$_GET['zoomID'] OR !array_key_exists($_GET['zoomID'],$pic_list_array)){
                // then select the first picture in defined array
                $_GET['zoomID'] = key ($pic_list_array);
                $zoom['config']['pZoomID'] = false;
            }else{
                $zoom['config']['pZoomID'] = $_GET['zoomID'];
            }

            // Redefine the root path of the image
            if (isset($pic_list_data[$_GET['zoomID']]['path']))
            {
                $startTime = microtime(true);
                $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'],'add'),'add');

                // Heuristic approach
                if (!is_dir($zoom['config']['picDir'])){
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash('/'.$pic_list_data[$_GET['zoomID']]['path'],'add'),'add');
                    if (is_dir($zoom['config']['picDir'])){
                        $zoom['config']['pic'] = '';
                    } else {
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['installPath'].'/'.$pic_list_data[$_GET['zoomID']]['path'],'add'),'add');
                        if (is_dir($zoom['config']['picDir'])){
                            $zoom['config']['pic'] = $zoom['config']['installPath'];
                        }
                    }
                }

                $this->readTime['findPathFirstImage1'] = $this->endTimeDiff($startTime);
            }

            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            //// Check if source file exists ///////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////////////////

            // If for some reason there the original image does not exist, there is a problem, which could be solved
            // This may happen if you get images from the database entry,
            // but they do not exist in the filesystem because you may intentionally or unintentionally renamed them or whatever...
            // So we need to check the whole array if such an error occures

            if (!isset($_GET['zoomData']) && !file_exists($zoom['config']['picDir'].$pic_list_array[$_GET['zoomID']]))
            {
                // The passed zoomID is problematic! Unset it.
                unset ($_GET['zoomID']);

                $pic_list_temp_array = $pic_list_array;

                $zoomTmp['errorImages'] = array();

                // Loop through the $pic_list_array to find a picture that exists
                $startTime = microtime(true);
                foreach ($pic_list_array as $k=>$v){
                    if (isset($pic_list_data[$k]['path'])){
                        $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'],'add'),'add');
                    }

                    // If we have found an image, that exists :-)
                    if (file_exists($zoom['config']['picDir'].$pic_list_array[$k])){
                        // If we have not found an existing picture already
                        if (!$zoomTmp['picFound']){
                            // Define $_GET['zoomID'] with the image key from $pic_list_array
                            $_GET['zoomID'] = $k;
                            // Define a var that tells the loop about a successful finding
                            $zoomTmp['picFound'] = $k;

                        }
                    }
                    // There is not such a file in filesystem :-(
                    else{
                        $zoomTmp['errorImages'][$k] = $zoom['config']['picDir'].$pic_list_array[$k];
                        // Remove this picture from the arrays
                        unset($pic_list_temp_array[$k]);
                        unset($pic_list_data[$k]);
                    }
                }
                $this->readTime['findPathFirstImage2'] = $this->endTimeDiff($startTime);

                // If you have defined in zoomConfig.inc.php to show errors
                if ($zoom['config']['errors'] && !empty($zoomTmp['errorImages'])){

                    // Trigger message that lists missing images (with method drawZoomBox of axZmH.class.php)
                    $zoomTmp['fileErrorTitle']="Error images missing";

                    // Display also the paths of images that can not be found
                    foreach ($zoomTmp['errorImages'] as $k=>$v){$zoomTmp['fileErrorText'].="<li>$v</li> ";}

                    // Compute what has been removed (not needed)
                    //$zoomTmp['fileError'] = array_diff($pic_list_array, $pic_list_temp_array);
                    //foreach ($zoomTmp['fileError'] as $k=>$v){$zoomTmp['fileErrorText'].="<li>$v</li> ";}

                    $zoomTmp['fileErrorText']="<ul>".$zoomTmp['fileErrorText']."</ul>";
                    $this->fileErrorDialog="<script type=\"text/javascript\">jQuery.fn.axZm.zoomAlert('".$zoomTmp['fileErrorText']."','".$zoomTmp['fileErrorTitle']."',false);</script>";
                }

                // Redefine the basic $pic_list_array with removed items
                $pic_list_array = $pic_list_temp_array;
            }

            // Store information in $zoom['config']
            $zoom['config']['pic_list_array'] = $pic_list_array;
            $zoom['config']['pic_list_data'] = $pic_list_data;

            // Exif orientation
            if ($zoom['config']['exifAutoRotation'] && !isset($_GET['str']) && !isset($_GET['qq']) && !isset($_GET['setHW']) && !defined('PHALANGER'))
            {
                $pelLib = false;
                // http://lsolesen.github.com/pel/
                if (file_exists(dirname(__FILE__).'/classes/pel/PelJpeg.php')){
                    $pelLib = true;
                    require_once(dirname(__FILE__).'/classes/pel/PelDataWindow.php');
                    require_once(dirname(__FILE__).'/classes/pel/PelJpeg.php');
                    require_once(dirname(__FILE__).'/classes/pel/PelTiff.php');
                }

                $startTime = microtime(true);
                foreach ($pic_list_array as $k=>$v){
                    if (strtolower($this->getl('.', $v)) == 'jpg' || strtolower($this->getl('.', $v)) == 'jpeg'){
                        if (isset($pic_list_data[$k]['path'])){
                            $tempPicDir = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$k]['path'],'add'),'add');
                        }else{
                            $tempPicDir = $zoom['config']['picDir'];
                        }

                        $aryEXIF = array();
                        $aryEXIF = exif_read_data($tempPicDir.$v);

                        if (isset($aryEXIF["Orientation"])
                            && ($aryEXIF["Orientation"] == 6
                            || $aryEXIF["Orientation"] == 8
                            || $aryEXIF["Orientation"] == 3
                        )) {
                            $angle = 0;
                            if ($aryEXIF["Orientation"] == 6){
                                $angle = 270;
                            } elseif ($aryEXIF["Orientation"] == 8){
                                $angle = 90;
                            } elseif ($aryEXIF["Orientation"] == 3){
                                $angle = 180;
                            }

                            if ($angle != 0){
                                if (is_writable($tempPicDir.$v)){

                                    // Delete all already made tiles, thumbs etc.
                                    $this->removeAxZm($zoom, $v, array('In' => true, 'Th' => true, 'tC' => true, 'mO' => true, 'Ti' => true, 'gP' => true), false);

                                    // Save exif info
                                    if ($pelLib){
                                        $sourceExifFile  = new PelJpeg($tempPicDir.$v);
                                        $sourceExifInfo = $sourceExifFile->getExif();
                                     }

                                    // Rotate
                                    $rotatedImage = $this->rotateImage($tempPicDir.$v, $angle);
                                    imagejpeg($rotatedImage, $tempPicDir.$v, 100);

                                    // Transfere EXIF information
                                    if ($pelLib){
                                        $outputExifFile = new PelJpeg($tempPicDir.$v);
                                        if ($sourceExifInfo != null) {
                                            $outputExifFile->setExif($sourceExifInfo);
                                            file_put_contents($tempPicDir.$v, $outputExifFile->getBytes());
                                        }

                                        // Reset the EXIF-tag "orientation"
                                        $this->exifOrientation($tempPicDir.$v, $tempPicDir.$v);
                                    }

                                    $pic_list_data[$k]['imgSize'] = $this->axZm->imageSize($tempPicDir.$v, $zoom['config']['im'], false);
                                }else{
                                    if ($zoom['config']['errors']){
                                        echo 'alert("'.$tempPicDir.$v.' is not writable by PHP.");';
                                    }
                                }
                            }
                        }
                    }

                    $zoom['config']['pic_list_data'] = $pic_list_data;

                }
                $this->readTime['exifAutoRotation'] = $this->endTimeDiff($startTime);
            }

            // Check of original images have been changed
            if ($zoom['config']['cTimeCompare'] && !isset($_GET['setHW']) && !isset($_GET['str']) && !isset($_GET['qq'])){
                $this->cTimeCompare($zoom);
            }

            // By now we have generated and checked $pic_list_array and $pic_list_data
            // $_GET['zoomID'] is also checked and should exist
            if (isset($_GET['zoomID']) && !isset($_GET['qq']))
            {
                // Redefine the root path of the image
                if (isset($pic_list_data[$_GET['zoomID']]['path'])){
                    $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['fpPP'].$this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'],'add'),'add');
                }

                ////////////////////////////////////////////////////
                //// Important for next code and zoomLoad.php !!!///
                ////////////////////////////////////////////////////

                // 1. $zoom['config']['orgImgName'] // filename of the source image
                // 2. $zoom['config']['orgImgSize'] // imagesize of the source image
                // 3. $zoom['config']['smallImgName'] // filename of the initial image
                // 4. $zoom['config']['smallImgSize'] // imagesize of the initial image
                // 5. $zoom['config']['smallFileSize'] // filesize of thr initial image

                // 1. Filename of the source image
                $zoom['config']['orgImgName'] = $pic_list_array[$_GET['zoomID']];

                // 2. Imagesize of the source image [array(0=>width, 1=>height)]
                // Do not replace it with $pic_list_data[$_GET['zoomID']]['imgSize']
                // since this information will only be generated on load and we also need it for zooming (zoomLoad.php)
                if ($pic_list_data[$_GET['zoomID']]['imgSize']){ // from preProceedList
                    $zoom['config']['orgImgSize'] = $pic_list_data[$_GET['zoomID']]['imgSize'];
                }else{
                    $zoom['config']['orgImgSize'] = $this->axZm->imageSize($zoom['config']['picDir'].$zoom['config']['orgImgName'], $zoom['config']['im'], false);
                }


                // 3. Filename of the initial image
                // This image will be loaded first (without zoom)
                // Before it has to be resized with $zoom['config']['picDim'] and saved in $zoom['config']['thumbDir']
                // e.g. imagename is abcdefgh.jpg, $zoom['config']['picDim'] = '600x400';
                // It will be then saved as abcdefgh_600x400.jpg in $zoom['config']['thumbDir']
                $zoom['config']['smallImgName'] = $this->composeFileName($pic_list_array[$_GET['zoomID']], $zoom['config']['picDim'], '_', $this->pngMod($zoom));

                $imageSlicer = $zoom['config']['imageSlicer'];
                if (!is_array($imageSlicer)){$imageSlicer = array();}

                $slicerPostArr = array(
                    'zoomID' => $_GET['zoomID'],
                    'example' => $_GET['example'],
                    'pic' => $zoom['config']['pic'],
                    'pic_list_data' => serialize(array($_GET['zoomID'] => $pic_list_data[$_GET['zoomID']])),
                    'pic_list_array' => serialize(array($_GET['zoomID'] => $pic_list_array[$_GET['zoomID']]))
                );

                if ($imageSlicer['enabled'] && !empty($imageSlicer['parameters'])){
                    foreach ($imageSlicer['parameters'] as $a => $b){
                        if (isset($_GET[$b])){
                            $slicerPostArr[$b] = $_GET[$b];
                        }
                    }
                }

                $checkInitialImage = true;

                // Check if alternative resolutions initial image exists
                if (!$zoom['config']['imgFileOpt']['noMakeFirstImage']){
                    if ($zoom['config']['stepPicDim']
                        && is_array($zoom['config']['stepPicDim'])
                        && !empty($zoom['config']['stepPicDim'])
                    ){
                        foreach($zoom['config']['stepPicDim'] as $k=>$v){
                            if (intval($v['w']) && intval($v['h'])
                                && !file_exists($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).'/'.$this->composeFileName($zoom['config']['orgImgName'], intval($v['w']).'x'.intval($v['h']), '_', $this->pngMod($zoom)))){
                                $checkInitialImage = false;
                                break;
                            }
                        }
                    }else{
                         $checkInitialImage = file_exists($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']);
                    }
                }

                // 4. Make initial image on the fly and save it once
                // Only current displayed image will be made on the fly
                if (!$checkInitialImage){

                    // Make first image
                    if ($imageSlicer['enabled']){
                        $slicerPostArr['task'] = 'makeFirstImage';
                        $this->returnMakeFirstImage = $this->httpRequestQuery(
                            $imageSlicer['method'],
                            $imageSlicer['host'],
                            $imageSlicer['port'],
                            $imageSlicer['uri'],
                            $imageSlicer['timeout'],
                            ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                            ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                            $imageSlicer['headers']
                        );
                    } else {
                        $startTime = microtime(true);
                        $this->returnMakeFirstImage = $this->axZm->makeFirstImage($zoom, false);
                        $this->readTime['makeFirstImage1'] = $this->endTimeDiff($startTime);
                    }
                }
                elseif ($zoom['config']['mapOwnImage'] && !$zoom['config']['imgFileOpt']['noMakeMapImage']){
                    if (!isset($zoom['config']['mapDir'])){
                        $zoom['config']['mapDir'] = $this->checkSlash($zoom['config']['fpPP'].$zoom['config']['mapPath'],'add');
                    }
                    if (!file_exists($zoom['config']['mapDir'].$this->composeFileName($zoom['config']['orgImgName'], $zoom['config']['mapOwnImage'], '_', $this->pngMod($zoom)))){

                        if ($imageSlicer['enabled']){
                            $slicerPostArr['task'] = 'makeMapImage';

                            $this->returnMakeFirstImage = $this->httpRequestQuery(
                                $imageSlicer['method'],
                                $imageSlicer['host'],
                                $imageSlicer['port'],
                                $imageSlicer['uri'],
                                $imageSlicer['timeout'],
                                ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                $imageSlicer['headers']
                            );

                        } else {
                            $startTime = microtime(true);
                            $this->returnMakeFirstImage = $this->axZm->makeFirstImage($zoom, true);
                            $this->readTime['makeFirstImage2'] = $this->endTimeDiff($startTime);
                        }
                    }
                }



                // Imagesize of the initial image
                // We also need to know how big this initial image is, but only after it has been possibly made on the fly
                $startTime = microtime(true);
                if ($zoom['config']['imgFileOpt']['noMakeFirstImage']){
                      $zoom['config']['smallImgSize'] = $this->virtualResize($pic_list_data[$_GET['zoomID']]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                } else {
                    $zoom['config']['smallImgSize'] = $this->axZm->imageSize($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName'], $zoom['config']['im'], false);
                }
                $this->readTime['smallImgSizeDim'] = $this->endTimeDiff($startTime);

                // 5. Filesize of the first image for internet connection speed test
                if ($zoom['config']['imgFileOpt']['getFileSize']){
                    $startTime = microtime(true);
                    $zoom['config']['smallFileSize'] = filesize($zoom['config']['thumbDir'].$this->md5path($zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']);
                    $this->readTime['smallImgFileSize'] = $this->endTimeDiff($startTime);
                }

                // This will tell the javascript the dimensions of the initial picture if it is not already done and loaded via ajax
                // This happens if you load a new picture via javascript wich has not been "prepared" already.
                // In this case it will be prepared on the fly after calling it. The procedure can take a couple seconds.


                // Return if on-the-fly
                if (isset($_GET['setHW'])){
echo "<script type=\"text/javascript\">";
echo "
    jQuery.axZm.iw=".$this->ptj($zoom['config']['smallImgSize'][0]).";
    jQuery.axZm.ih=".$this->ptj($zoom['config']['smallImgSize'][1]).";
";
echo "</script>
";

                    // JS message
                    if (!is_bool($this->returnMakeFirstImage)){echo $this->returnMakeFirstImage;}

                    // Do not exit here in order to make pyramid images or tiles on the fly too!
                    // If $zoom['config']['pyrDialog'] OR $zoom['config']['gPyramidDialog'] is set to true
                    // and tiles or image pyramid have to be generated, a "please wait" diolog will appear during this operation.
                    // You can switch off this dialog by setting $zoom['config']['pyrDialog'] = false ....
                }

                // The following code will be executed only once on window load...
                if (!isset($_GET['str']))
                {

                    if (!isset($_GET['setHW']))
                    {
                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        //// Get all initial image sizes for Image Gallery, but only on page load ////////////////////////////////////////////
                        //// We will need to pass this parameters to and then from the gallery, when the user clicks on an different thumb ///
                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $firstThumbSize = null;
                        $startTime = microtime(true);

                        foreach ($pic_list_array as $k => $v){
                            $zoomTmp['smallImgNameTemp'] = $this->composeFileName($v, $zoom['config']['picDim'], '_', $this->pngMod($zoom));

                            // Since not all initial pictures could have been generated, check their existence first
                            // Generation of all initial pictures on the fly during first page load could take tоo long.
                            if ($zoom['config']['imgFileOpt']['noMakeFirstImage']){
                                 $pic_list_data[$k]['thumbSize'] = $this->virtualResize($pic_list_data[$k]['imgSize'], array($zoom['config']['picX'], $zoom['config']['picY']));
                            }
                            else {
                                if (file_exists($zoom['config']['thumbDir'].$this->md5path($v, $zoom['config']['subfolderStructure']).$zoomTmp['smallImgNameTemp'])){

                                    if ($firstThumbSize && ($zoom['config']['imgFileOpt']['sameAspectRatio'] || $zoom['config']['imgFileOpt']['sameSize'] || $zoom['config']['spinMod'])){
                                        $pic_list_data[$k]['thumbSize'] = $firstThumbSize;
                                    }else{
                                        $pic_list_data[$k]['thumbSize'] = $this->axZm->imageSize($zoom['config']['thumbDir'].$this->md5path($v, $zoom['config']['subfolderStructure']).$zoomTmp['smallImgNameTemp'], $zoom['config']['im'], false);
                                    }

                                    if (!$firstThumbSize){
                                        $firstThumbSize = $pic_list_data[$k]['thumbSize'];
                                    }
                                }else{
                                    $pic_list_data[$k]['thumbSize'] = false;
                                }
                            }
                        }

                        $this->readTime['smallImgSizeDimAll'] = $this->endTimeDiff($startTime);

                        // Store information
                        $zoom['config']['pic_list_data'] = $pic_list_data;

                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        //// Generate all thumbs for Image Gallery on the fly, ///////////////////////////////////////////////////////////////
                        //// Depending on the number of pictures and it's sizes this may take a while... /////////////////////////////////////
                        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        // Added the possibility to not generate thumbs
                        if (
                            (!isset($zoom['config']['galleryNoThumbs']) || $zoom['config']['galleryNoThumbs'] === false) &&
                            (!isset($zoom['config']['galleryRawThumb']) || $zoom['config']['galleryRawThumb'] === false) &&
                            (!$zoom['config']['imgFileOpt']['noMakeAllThumbs'])
                            )
                        {
                            if ($imageSlicer['enabled']){
                                $slicerPostThumbsArr = array(
                                    'task' => 'makeAllThumbs',
                                    'zoomID' => $_GET['zoomID'],
                                    'example' => $_GET['example'],
                                    'pic' => $zoom['config']['pic'],
                                    'pic_list_data' => serialize($pic_list_data),
                                    'pic_list_array' => serialize($pic_list_array)
                                );

                                if (!empty($imageSlicer['parameters'])){
                                    foreach ($imageSlicer['parameters'] as $a => $b){
                                        if (isset($_GET[$b])){
                                            $slicerPostThumbsArr[$b] = $_GET[$b];
                                        }
                                    }
                                }

                                $this->returnMakeAllThumbs = $this->httpRequestQuery(
                                    $imageSlicer['method'],
                                    $imageSlicer['host'],
                                    $imageSlicer['port'],
                                    $imageSlicer['uri'],
                                    $imageSlicer['timeout'],
                                    ($imageSlicer['method'] == 'GET' ? $slicerPostThumbsArr : array()),
                                    ($imageSlicer['method'] == 'POST' ? $slicerPostThumbsArr : array()),
                                    $imageSlicer['headers']
                                );
                            }else{
                                $startTime = microtime(true);
                                $this->returnMakeAllThumbs = $this->axZm->makeAllThumbs($zoom);
                                $this->readTime['makeAllThumbs'] = $this->endTimeDiff($startTime);
                            }
                        }else{
                            $this->returnMakeAllThumbs = false;
                        }
                    }

                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    //// Image pyramid generation for selected zoomID, not all gallery list //////////////////////////////////////////////////
                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    if ($zoom['config']['gPyramid'] && $zoom['config']['gPyramidDir'])
                    {
                        $startTime = microtime(true);
                        
                        if (!$zoom['config']['imgFileOpt']['noMakeGpyramid']){
                            // The subfolder name is the same as image name
                            $zoomTmp['gPyramidPicDir'] = $zoom['config']['gPyramidDir'].$this->md5path( $zoom['config']['orgImgName'], $zoom['config']['subfolderStructure']).$this->getf('.',$zoom['config']['orgImgName']);

                            // Check if pyramid images have been made already
                            $zoomTmp['gPyramidPicDirExists'] = is_dir($zoomTmp['gPyramidPicDir']);

                            // Overwrite the files, if a $zoom['config']['gPyramidOverwrite'] is set to true
                            if (!$zoomTmp['gPyramidPicDirExists']){
                                if ($imageSlicer['enabled']){
                                    $slicerPostArr['task'] = 'gPyramid';

                                    $this->returnMakeZoomTiles = $this->httpRequestQuery(
                                    $imageSlicer['method'],
                                    $imageSlicer['host'],
                                    $imageSlicer['port'],
                                    $imageSlicer['uri'],
                                    $imageSlicer['timeout'],
                                    ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                    ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                    $imageSlicer['headers']
                                    );

                                } else {
                                    $this->returnMakeZoomTiles = $this->axZm->gPyramid($zoom);
                                }

                                if (isset($_GET['setHW']) AND !is_bool($this->returnMakeZoomTiles)){echo $this->returnMakeZoomTiles;}
                            }
                        }

                        $this->readTime['gPyramid'] = $this->endTimeDiff($startTime);

                        // Changes chmod of all pyramid directories
                        // Ver. 4.2.1 removed
                        /*
                        if ($zoom['config']['gPyramidChmodAll']){
                            $startTime = microtime(true);
                            $this->chmodAllDir($zoom['config']['gPyramidDir'],$zoom['config']['gPyramidChmod']);
                            $this->readTime['gPyramidChmod'] = $this->endTimeDiff($startTime);
                        }
                        */

                    }

                    ////////////////////////////////////////////////////////////////////////
                    /// Image tiles generation for selected zoomID, not all gallery list ///
                    ////////////////////////////////////////////////////////////////////////
                    if ($zoom['config']['pyrTiles'] && $zoom['config']['pyrTilesDir'])
                    {
                        $startTime = microtime(true);
                        
                        if (!$zoom['config']['imgFileOpt']['noMakeZoomTiles'] && 
                            ($zoom['config']['orgImgSize'][0] >= $zoom['config']['tileSize'] || $zoom['config']['orgImgSize'][1] >= $zoom['config']['tileSize'])
                        ){
                            $this->returnMakeZoomTiles = $this->axZm->zC($zoom, false);

                            if (!$zoom['config']['imgFileOpt']['noMakeZoomTiles'] && 
                                
                                // Ver. 4.2.1 txt file could be present despite image is not downsized
                                // && !file_exists($zoom['config']['picDir'].$this->getf('.', $zoom['config']['orgImgName']).'.txt')
                                !$this->tileExists($zoom, $zoom['config']['orgImgName'])
                            ){
                                if ($imageSlicer['enabled']){
                                    $slicerPostArr['task'] = 'makeZoomTiles';
                                    $this->returnMakeZoomTiles = $this->httpRequestQuery(
                                        $imageSlicer['method'],
                                        $imageSlicer['host'],
                                        $imageSlicer['port'],
                                        $imageSlicer['uri'],
                                        $imageSlicer['timeout'],
                                        ($imageSlicer['method'] == 'GET' ? $slicerPostArr : array()),
                                        ($imageSlicer['method'] == 'POST' ? $slicerPostArr : array()),
                                        $imageSlicer['headers']
                                    );

                                } else {
                                     $this->returnMakeZoomTiles = $this->axZm->makeZoomTiles($zoom);
                                }
                            } 

                            if (isset($_GET['setHW']) AND !is_bool($this->returnMakeZoomTiles) AND $this->returnMakeZoomTiles){echo $this->returnMakeZoomTiles;}
                        }

                        $this->readTime['makeZoomTiles'] = $this->endTimeDiff($startTime);

                        // Changes chmod matched with the config
                        // Ver. 4.2.1 removed
                        /*
                        if ($zoom['config']['pyrChmodAll']){
                            $startTime = microtime(true);
                            $this->chmodAllDir($zoom['config']['pyrTilesDir'],$zoom['config']['pyrChmod']);
                            $this->readTime['makeZoomTilesChmod'] = $this->endTimeDiff($startTime);
                        }
                        */
                    }

                    //////////////////////////////////////////////////////////////////////////////////
                    // Generate code (an array) for the gallery, which will be passed to javascript //
                    //////////////////////////////////////////////////////////////////////////////////
                    if (!isset($_GET['setHW'])) //  && ($zoom['config']['useGallery'] OR $zoom['config']['useFullGallery'] OR $zoom['config']['useHorGallery'] OR $zoom['config']['galleryNavi'])
                    {
                        $startTime = microtime(true);

                        foreach ($pic_list_data as $k=>$v) {
                            $zoom['config']['galArray'][$k]['img']    = $v['fileName']; // Filename of the image
                            $zoom['config']['galArray'][$k]['ow']    = $v['imgSize'][0]; // Width of original pic
                            $zoom['config']['galArray'][$k]['oh']    = $v['imgSize'][1]; // Height of original pic
                            $zoom['config']['galArray'][$k]['iw']    = $v['thumbSize'][0]; // Width of initial pic
                            $zoom['config']['galArray'][$k]['ih']    = $v['thumbSize'][1]; //  Height of initial pic
                            $zoom['config']['galArray'][$k]['tD']    = $v['thumbDescr']; // Description under the thumb in the gallery
                            $zoom['config']['galArray'][$k]['fD']    = $v['fullDescr']; // Full Description

                            //$zoom['config']['galArray'][$k]['fT']     = $this->getl('.', $pic_list_array[$k]);
                            //$zoom['config']['galArray'][$k]['fB']     = $this->getf('.', $pic_list_array[$k]);

                            $zoom['config']['galArray'][$k]['mf'] = false;
                            $zoom['config']['galArray'][$k]['mk'] = false;
                            
                            // Map own image
                            if ( $zoom['config']['useMap'] && !$zoom['config']['imgFileOpt']['noMakeMapImage'] && $zoom['config']['mapOwnImage'] && $zoom['config']['mapDir']){

                                $ownImageSize = explode('x', $zoom['config']['mapOwnImage']);
                                $ownImageName = $this->composeFileName($v['fileName'], $ownImageSize[0].'x'.$ownImageSize[1], '_', $this->pngMod($zoom));

                                if (!file_exists($zoom['config']['mapDir'].$this->md5path( $v['fileName'], $zoom['config']['subfolderStructure']).$ownImageName)){
                                    $zoom['config']['galArray'][$k]['mf'] = true;
                                }
                            }

                            // Check if alternative resolutions initial image exists
                            if ($zoom['config']['stepPicDim'] 
                                && !$zoom['config']['imgFileOpt']['noMakeFirstImage']
                                && is_array($zoom['config']['stepPicDim'])
                                && !empty($zoom['config']['stepPicDim'])
                            ){
                                foreach($zoom['config']['stepPicDim'] as $a=>$b){
                                    if (intval($b['w']) && intval($b['h'])
                                        && !file_exists($zoom['config']['thumbDir'].$this->md5path( $v['fileName'], $zoom['config']['subfolderStructure']).$this->composeFileName($v['fileName'], intval($b['w']).'x'.intval($b['h']), '_', $this->pngMod($zoom)))){
                                        $zoom['config']['galArray'][$k]['mf'] = true;
                                        break;
                                    }
                                }
                            }

                            // Applied for zoomData and 3D (not 360)
                            if (isset($v['path'])){
                                // Note: this is absolute path to the image now
                                $zoom['config']['galArray'][$k]['ph'] = $this->checkSlash($v['picPath'], 'add');
                            }

                            // Check, whether pyramid or tiles have to be generated
                            if ($zoom['config']['gPyramid'] && !$zoom['config']['imgFileOpt']['noMakeGpyramid']){
                                if ( is_dir($zoom['config']['gPyramidDir'].$this->md5path( $v['fileName'], $zoom['config']['subfolderStructure']).$this->getf('.',$v['fileName'])) ){
                                    $zoom['config']['galArray'][$k]['mk'] = false;
                                }else{
                                    $zoom['config']['galArray'][$k]['mk']='gP';
                                }
                            }
                            elseif ($zoom['config']['pyrTiles'] && !$zoom['config']['imgFileOpt']['noMakeZoomTiles']){
                                if (($v['imgSize'][0] < $zoom['config']['tileSize'] && $v['imgSize'][1] < $zoom['config']['tileSize']) || $this->tileExists($zoom, $v['fileName']) ){
                                    $zoom['config']['galArray'][$k]['mk'] = false; // do not make tiles

                                    if ($zoom['config']['pyrAutoDetect']){
                                        $zoom['config']['galArray'][$k]['ts'] = $this->getTileSize($zoom, $v['fileName']);
                                    }
                                }else{
                                    $zoom['config']['galArray'][$k]['mk'] = 'tL';
                                }
                            }

                        } // END: foreach ($pic_list_data as $k=>$v){

                        $this->readTime['galleryData'] = $this->endTimeDiff($startTime);

                    } // END: if (!isset($_GET['setHW'])){

                } // END: if (!isset($_GET['str']))

                if (isset($pic_list_data[$_GET['zoomID']]['path'])){
                    $zoom['config']['pic'] = $this->checkSlash($zoom['config']['pic'].'/'.$pic_list_data[$_GET['zoomID']]['path'], 'add');
                }

            } // END: if ($_GET['zoomID'])

        } // END: if (!empty($pic_list_array) AND !empty($pic_list_data))
        else{
            unset ($_GET['zoomID']);
        }

        $this->readTime['pyrAutoDetect'] = $zoom['config']['pyrAutoDetect'];
        $this->readTime['imgFileOpt'] = $zoom['config']['imgFileOpt'];

        return array($zoom, $zoomTmp);
    }

    /**
      * Returns formated array or string from numeric seconds amount
      * @access public
      * @param int $time Number of seconds
      * @param string $ret Return type - 'string' or 'array'
      * @return mixed
      **/
    public function seconds2time($time, $ret = 'string'){
        if(is_numeric($time)){
            $value = array("years" => 0, "days" => 0, "hours" => 0, "minutes" => 0, "seconds" => 0);
            if ($time >= 31556926){
                $value['years'] = floor($time/31556926);
                $time = ($time%31556926);
            }
            if ($time >= 86400){
                $value['days'] = floor($time/86400);
                $time = ($time%86400);
            }
            if ($time >= 3600){
                $value['hours'] = floor($time/3600);
                $time = ($time%3600);
            }
            if($time >= 60){
                $value['minutes'] = floor($time/60);
                $time = ($time%60);
            }
            $value['seconds'] = floor($time);
            if ($ret == 'string'){
                $string = '';
                foreach ($value as $k=>$v){
                    if ($v > 0){
                        $string .= $v.' '.ucfirst($k).', ';
                    }
                }
                $string = substr($string,0, -2);
                return $string;
            }else{
                return $value;
            }
        }else{
            return false;
        }
    }

    /**
      * Generates a html table for files in specified folder. Used in /axZm/zoomBatch.php
      * @access public
      * @param array $zoom
      * @param array $pic_list_array
      * @param array $pic_list_data
      * @return HTML-Output
      **/
    public function batchList($zoom, $pic_list_array, $pic_list_data){

        $return = "<div class=\"leftFrameInnerHead\">";
            $return .= "<table class=\"leftFrameTable\" cellspacing=\"0\" cellpadding=\"1\">";
            $return .= "<thead><tr>";
                $return .= "<th style=\"width: 22px;\"><span onclick=\"$.zoomBatch.reload()\" style=\"cursor: pointer;\">&nbsp;&#8634;</span></th>";
                $return .= "<th>Filename</th>";

                // Initial image
                if ($zoom['batch']['arrayMake']['In']){
                    $return .= "<th style=\"width: 16px;\">In</th>";
                }

                // Thumbs
                if ($zoom['batch']['arrayMake']['Th']){
                    $return .= "<th style=\"width: 16px;\">Th</th>";
                }

                //gPyramid
                /*
                if ($zoom['batch']['arrayMake']['gP']){
                    $return .= "<th style=\"width: 16px;\">gP</th>";
                }*/

                // Pyramid
                if ($zoom['batch']['arrayMake']['Ti']){
                    $return .= "<th style=\"width: 16px;\">Ti</th>";
                }

                if ($zoom['batch']['allowDelete']){
                    $return .= "<th style=\"width: 16px;\">&nbsp;</th>";
                }

                $return .= "<th style=\"width: 70px;\">Imgsize</th>";
                $return .= "<th style=\"width: 45px;\">Filesize</th>";
                // Pic preview
                $return .= "<th style=\"width: 18px;\">&nbsp;</th>";
            $return .= "</tr></thead></table>";
        $return .= "</div>";

        $return .= "<div class=\"leftFrameInnerBody\">";

            // Folders
            if (isset($_SESSION['axZmBtch']['dirTreeArray'])
                && isset($_SESSION['axZmBtch']['currentDir'])
                && isset($_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']])
                && $_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']]['DIR_SUB'] > 0
            ){
                $return .= "<table class=\"leftFrameFolder\" id=\"leftFrameFolder\" cellspacing=\"0\" cellpadding=\"1\"><tbody>";
                if (!function_exists('batchParent')){function batchParent($el){return ($el['DIR_PARENT'] === $_SESSION['axZmBtch']['currentDir']);}}
                $filtered = array_filter($_SESSION['axZmBtch']['dirTreeArray'], 'batchParent');

                if ($_SESSION['axZmBtch']['currentDir'] != 'HOME'){
                    $backFolderArr = explode('_', $_SESSION['axZmBtch']['currentDir']);
                    unset($backFolderArr[(count($backFolderArr)-1)]);
                    $backFolder = implode('_', $backFolderArr);
                    if (count(explode('_', $backFolder)) == 1){
                        $backFolder = 'HOME';
                    }

                    $return .= "<tr>";
                        $return .= "<td style=\"width: 22px;\"><img src=\"".$zoom['config']['icon']."batch_folder.png\" border=\"0\" class=\"folderIcon\" title=\"Level up\"></td>";
                        $return .= "<td data-folder=\"$backFolder\">..</td>";
                        $return .= "<td style=\"width: 18px;\"> </td>";
                    $return .= "</tr>";
                }

                foreach($filtered as $k=>$v){
                    $return .= "<tr id=\"dtr$k\">";
                        $return .= "<td style=\"width: 22px;\"><img src=\"".$zoom['config']['icon']."batch_folder.png\" border=\"0\" class=\"folderIcon\"></td>";
                        $return .= "<td data-folder=\"$k\" style=\"\">".$v['DIR_NAME']."</td>";
                        $return .= "<td style=\"width: 18px;\"><input type=\"checkBox\" name=\"folders[]\" id=\"dir$k\" value=\"$k\" class=\"checkBoxFolder\"></td>";
                    $return .= "</tr>";
                }

                $return .= "</tbody></table>";
            }
            elseif (isset($_SESSION['axZmBtch']['dirTreeArray'])
                && isset($_SESSION['axZmBtch']['currentDir'])
                && isset($_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']])
                && $_SESSION['axZmBtch']['dirTreeArray'][$_SESSION['axZmBtch']['currentDir']]['DIR_SUB'] == 0){

                $return .= "<table class=\"leftFrameFolder\" id=\"leftFrameFolder\" cellspacing=\"0\" cellpadding=\"1\"><tbody>";
                    $backFolderArr = explode('_', $_SESSION['axZmBtch']['currentDir']);
                    unset($backFolderArr[(count($backFolderArr)-1)]);
                    $backFolder = implode('_', $backFolderArr);
                    if (count(explode('_', $backFolder)) == 1){
                        $backFolder = 'HOME';
                    }
                    $return .= "<tr>";
                        $return .= "<td style=\"width: 22px;\"><img src=\"".$zoom['config']['icon']."batch_folder.png\" border=\"0\" class=\"folderIcon\" title=\"Level up\"></td>";
                        $return .= "<td data-folder=\"$backFolder\">..</td>";
                        $return .= "<td style=\"width: 18px;\"> </td>";
                    $return .= "</tr>";
                $return .= "</tbody></table>";
            }


            // Images
            $return .= "<table class=\"leftFrameTable\" id=\"leftFrameTable\" cellspacing=\"0\" cellpadding=\"1\"><tbody>";
            foreach ($pic_list_array as $k=>$v){

                $md5path = $this->md5path($v, $zoom['config']['subfolderStructure']);

                $return .= "<tr id=\"d$k\">";
                    $return .= "<td style=\"width: 22px;\"><input type=\"checkBox\" name=\"f$k\" id=\"f$k\" value=\"1\"></td>";
                    $return .= "<td id=\"fname$k\">".$v."</td>"; //wordwrap($v,30,'<br>',true)

                    // Initial image
                    if ($zoom['batch']['arrayMake']['In']){
                        $return .= "<td style=\"width: 16px;\">".(file_exists($zoom['config']['thumbDir'].$md5path.$this->composeFileName($v, $zoom['config']['picDim'], '_', $this->pngMod($zoom))) ? str_replace('<img','<img id="In'.$k.'"', $zoom['batch']['iconOk']) : str_replace('<img','<img id="In'.$k.'"', $zoom['batch']['iconError']))."</td>";
                    }

                    // Thumbs
                    if ($zoom['batch']['arrayMake']['Th']){
                        $errThumb = $thumbExists = $thumbFullExists = false;

                        // Gallery
                        if ($zoom['config']['useGallery'] || $zoom['config']['fullScreenVertGallery']){
                            $thumbExists = file_exists($zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryPicDim'], '_', $this->pngMod($zoom))) ? true : false;
                        }

                        // Horizontal gallery
                        if ($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery']){
                            $thumbHorExists = file_exists($zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryHorPicDim'], '_', $this->pngMod($zoom))) ? true : false;
                        }

                        // Full gallery
                        if ($zoom['config']['useFullGallery']){
                            $thumbFullExists = file_exists($zoom['config']['galleryDir'].$md5path.$this->composeFileName($v, $zoom['config']['galleryFullPicDim'], '_', $this->pngMod($zoom))) ? true : false;
                        }

                        if (($zoom['config']['useGallery'] || $zoom['config']['fullScreenVertGallery']) && !$thumbExists){$errThumb = true;}
                        if (($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery']) && !$thumbHorExists){$errThumb = true;}
                        if ($zoom['config']['useFullGallery'] && !$thumbFullExists){$errThumb = true;}

                        $iconThumb = $errThumb ? $zoom['batch']['iconError'] : $zoom['batch']['iconOk'];
                        $iconThumb = str_replace('<img','<img id="Th'.$k.'"', $iconThumb);
                        $return .= "<td style=\"width: 16px;\">$iconThumb</td>";
                    }

                    // gPyramid
                    if ($zoom['batch']['arrayMake']['gP']){
                        $return .= "<td style=\"width: 16px;\">".(is_dir($zoom['config']['gPyramidDir'].$this->getf('.',$v)) ? str_replace('<img','<img id="gP'.$k.'"', $zoom['batch']['iconOk']) : str_replace('<img','<img id="gP'.$k.'"', $zoom['batch']['iconError']))."</td>";
                    }


                    // Pyramid
                    if ($zoom['batch']['arrayMake']['Ti']){

                        $return .= "<td style=\"width: 16px;\">".($this->tileExists($zoom, $v) ? str_replace('<img','<img id="Ti'.$k.'"', $zoom['batch']['iconOk']) : str_replace('<img','<img id="Ti'.$k.'"', $zoom['batch']['iconError']))."</td>";
                    }

                    // Delete
                    if ($zoom['batch']['allowDelete']){
                        $return .= "<td style=\"width: 16px;\">".str_replace('<img',"<img onclick=\"jQuery.zoomBatch.deleteZoom($k)\"", $zoom['batch']['iconTrash'])."</td>";
                    }

                    $return .= "<td style=\"width: 70px;\">".$pic_list_data[$k]['imgSize'][0]." x ".$pic_list_data[$k]['imgSize'][1]."</td>";
                    $return .= "<td style=\"width: 45px;\">".$this->zoomFileSmartSize($pic_list_data[$k]['fileSize'],1)."</td>";
                    $return .= "<td style=\"width: 18px;\"><img src=\"".$zoom['config']['icon']."batch_thumb.png\" id=\"prev$k\" width=\"16\" height=\"16\" border=\"0\" style=\"cursor: pointer\" data-img=\"$v\" onclick=\"jQuery.zoomBatch.previewPic($k,null,".$pic_list_data[$k]['imgSize'][0].",".$pic_list_data[$k]['imgSize'][1].")\" title=\"Preview\"></td>";
                $return .= "</tr>";
            }
            $return .= "</tbody></table>";

        $return .= "</div>";

        return $return;
    }

    /**
      * This method is used in zoomBatch.php to get the directory tree. Used in zoomBatch.php
      * @access public
      * @param string $path defines the start (home) directory where images are located (for dropdown option list)
      * @param string $baseDir should be $zoom['config']['fpPP'] as in zoomConfig.inc.php
      * @param array $exclude an array of folders that should be excluded from the returned array
      * @param int $levelString
      * @param int $level
      * @return array
      **/
    public function getDirTree($path = '', $baseDir = './', $exclude = array(), $levelString = 1, $level = 1){
        $return = $arr = $arrTemp = array();
        $excludeDefault = array('.', '..', 'cgi-bin');
        if (!$this->excludeParseArray){
            $excludeFinal = array_merge($excludeDefault, $exclude);
            $this->excludeParseArray = $excludeFinal;
        }else{
            $excludeFinal = $this->excludeParseArray;
        }

        $baseDir = $this->checkSlash($baseDir, 'remove');
        $openDir = $this->checkSlash($baseDir.$path, 'remove');

        if (!is_dir($openDir)) {return false;}

        $n=0;

        if ($level == 1){
            $return['HOME']['DIR_NAME'] = $this->getl('/', $this->checkSlash($path,'remove'));
            $return['HOME']['DIR_PATH'] = $path;
            //$return['HOME']['ROOT_PATH'] = $this->checkSlash($openDir,'add');
            $return['HOME']['DIR_LEVEL'] = 0;
            $return['HOME']['DIR_KEY'] = 'HOME';
        }

        foreach (glob($openDir.'/*', GLOB_ONLYDIR) as $file){
            $file = $this->getl('/', $this->checkSlash($file, 'remove'));
            if( !in_array($file, $excludeFinal) ){
                $n++;
                $key = $levelString.'_'.$n;
                $return[$key]['DIR_NAME'] = $file;
                $return[$key]['DIR_PATH'] =  $this->checkSlash($path.'/'.$file,'remove');
                //$return[$key]['ROOT_PATH'] = $this->checkSlash("$openDir/$file",'add');
                $return[$key]['DIR_LEVEL'] = $level;
                $return[$key]['DIR_KEY'] = $key;
                $return[$key]['DIR_PARENT'] = ($levelString === 1 ? 'HOME' : $levelString);

                $numSubDirs = 0;
                foreach(glob($openDir.'/'.$file.'/*', GLOB_ONLYDIR) as $folderSub){
                    $folderSub = $this->getl('/', $this->checkSlash($folderSub, 'remove'));
                    if( !in_array($folderSub, $excludeFinal) ){ $numSubDirs++; }
                }
                $return[$key]['DIR_SUB'] = $numSubDirs;

                $arr = $this->getDirTree($this->checkSlash($path.'/'.$file,'remove'), $baseDir, $exclude, $key, $level+1);
                if (!empty($arr)){
                    $return = array_merge($return, $arr);
                }
            }
        }

        if ($level == 1){
            $return['HOME']['DIR_SUB'] = $n;
        }

        return $return;
    }

    /**
      * Drow html options for select formfield out of an array. Used in zoomBatch.php
      * @access public
      * @param array $arr
      * @param int|bool $sel The key of selected option, accepts false
      * @return HTML-Output
      **/
    public function directoryOptions($arr=array(), $sel=false){
        $return = '';
        if (is_array($arr) AND !empty($arr)){
            foreach ($arr as $k=>$v){

                if ($v['DIR_LEVEL'] != 0){
                    $pref = str_repeat ('&nbsp;',($v['DIR_LEVEL']-1)*4).'|&#151;';
                }else{
                    $pref = '';
                }

                $return .= "<option class='opt_".$v['DIR_LEVEL']."' value='$k'";
                if ($sel==$k){$return .= " selected";}
                $return .= ">$pref ".$v['DIR_NAME']."</option>";
            }
        }
        return $return;
    }

    /**
      * Drow html options for select formfield out of an array. Used in demo.
      * @access public


      * @param array $arr
      * @param int|bool $sel The key of selected option, accepts false
      * @param string|bool $opr A callback function on array value
      * @param string|bool $add String to add after the value, eg. 'ms'
      * @return HTML-Output
      **/
    public function sOptions($arr=array(), $sel=false, $opr=false, $add=false){
        $return=array();
        $oneD = false; $n = 0;
        foreach ($arr as $k=>$v){
            if ($n == 0){$oneD = ($k === 0) ? true : false;}
            $n++;
            if ($oneD === true){$k = $v;}
            $return .= "<option value=\"".$k."\"";
            if ($k == $sel OR $v == $sel){$return .= " selected";}
            $return .= ">";
            if (function_exists($opr)){$return .= $opr($v);}
            else {$return .= $v;}
            if ($add){$return .= ' '.$add;}
            $return .= "</option>";
        }
        return $return;
    }

    /**
      * Removes initial image, gallery thumbs, gPyramid and tiles image files. Used in zoomBatch.php
      * @access public
      * @param array $zoom Config var
      * @param string $pic Orinal image filename
      * @param array $arrDel Array that defines which images have to be deleted
      * @param bool $self Defines if original image have to be deleted, default false
      * @return nothing
      **/
    public function removeAxZm($zoom, $pic, $arrDel = array(), $self = false){
        $picName = $this->getf('.',$pic);
        $subPath = $this->md5path($pic, $zoom['config']['subfolderStructure']);

        // Remove initial image(s)
        if (isset( $arrDel['In']) && $arrDel['In'] == true){
            if (is_dir($zoom['config']['thumbDir'])){
                $globResult = glob($this->checkSlash($zoom['config']['thumbDir'],'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)){
                    foreach ($globResult as $file){
                        // get the pure filename without jpg and without size (like _150x100)
                        $fileName = $this->getf('_', $this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName){
                            unlink($file);
                        }
                    }
                }
            }
        }

        // Remove gallery thumbs
        if (isset($arrDel['Th']) && $arrDel['Th'] == true){
            $zoom['config']['galleryDir'] = $this->checkSlash($zoom['config']['galleryDir'],'add');
            if (is_dir($zoom['config']['galleryDir'])){
                $globResult = glob($this->checkSlash($zoom['config']['galleryDir'],'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)){
                    foreach ($globResult as $file){
                        $fileName = $this->getf('_',$this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName){
                            unlink($file);
                        }
                    }
                }
            }
        }

        // Remove thumbs made on the fly from query string
        if (isset($arrDel['tC']) && $arrDel['tC'] == true){
            $subPathDynThumb = $this->md5path($pic, $zoom['config']['dynamicThumbsStructure']);
            $zoom['config']['tempCacheDir'] = $this->checkSlash($zoom['config']['tempCacheDir'],'add');
            if (is_dir($zoom['config']['tempCacheDir'])){
                $globResult = glob($this->checkSlash($zoom['config']['tempCacheDir'],'add').$subPathDynThumb.$picName.'_*.*');
                if (!empty($globResult)){
                    foreach ($globResult as $file){
                        $fileName = $this->getf('_',$this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName){
                            unlink($file);
                        }
                    }
                }
            }
        }

        // Remove map own images
        if (isset($arrDel['mO']) && $arrDel['mO'] == true){
            $zoom['config']['mapDir'] = $this->checkSlash($zoom['config']['mapDir'],'add');
            if (is_dir($zoom['config']['mapDir'])){
                $globResult = glob($this->checkSlash($zoom['config']['mapDir'],'add').$subPath.$picName.'_*.*');
                if (!empty($globResult)){
                    foreach ($globResult as $file){
                        $fileName = $this->getf('_',$this->getf('.',$this->getl('/',$file)));
                        if ($fileName == $picName){
                            unlink($file);
                        }
                    }
                }
            }
        }

        // Remove gPyramid
        if (isset($arrDel['gP']) && $arrDel['gP'] == true){
            $zoom['config']['gPyramidDir'] = $this->checkSlash($zoom['config']['gPyramidDir'],'add');
            if (is_dir($zoom['config']['gPyramidDir'])){
                if (is_dir($zoom['config']['gPyramidDir'].$subPath.$picName)){
                    $handle = opendir($zoom['config']['gPyramidDir'].$subPath.$picName);
                    if (is_resource($handle)){
                        while (false !== ($file = readdir($handle))){
                            if (is_file($zoom['config']['gPyramidDir'].$subPath.$picName.'/'.$file)){
                                unlink($zoom['config']['gPyramidDir'].$subPath.$picName.'/'.$file);
                            }
                        }
                    }
                    closedir($handle);
                    rmdir($zoom['config']['gPyramidDir'].$subPath.$picName);
                }
            }
        }

        // Remove tiles
        if (isset($arrDel['Ti']) && $arrDel['Ti'] == true){
            $zoom['config']['pyrTilesDir'] = $this->checkSlash($zoom['config']['pyrTilesDir'],'add');
            if (is_dir($zoom['config']['pyrTilesDir'])){
                if (is_dir($zoom['config']['pyrTilesDir'].$subPath.$picName)){
                    $handle = opendir($zoom['config']['pyrTilesDir'].$subPath.$picName);
                    if (is_resource($handle)){
                        while (false !== ($file = readdir($handle))){
                            if (is_file($zoom['config']['pyrTilesDir'].$subPath.$picName.'/'.$file)){
                                unlink($zoom['config']['pyrTilesDir'].$subPath.$picName.'/'.$file);
                            }
                        }
                    }
                    closedir($handle);
                    rmdir($zoom['config']['pyrTilesDir'].$subPath.$picName);
                }
            }
        }

        // remove original file, default false!
        if ($self === true){
            $zoom['config']['picDir'] = $this->checkSlash($zoom['config']['picDir'],'add');
            if (file_exists($zoom['config']['picDir'].$pic)){
                unlink ($zoom['config']['picDir'].$pic);
            }
        }

        return;
    }

    /**
      * Delete zoom cache files, inited in zoomSess.php on load
      * @access public
      * @param string $cacheDir Cache directory, should be $zoom['config']['tempDir']
      * @param integer $maxTime Min. difference of cache filetime from "now"
      * @return nothing
      **/
    public function delteZoomCache($cacheDir, $maxTime){
        if ($maxTime < 300){$maxTim=300;}
        $dateNow=strtotime("now");
        foreach (glob($cacheDir."*.".$this->pngMod($zoom)) as $fname){
            if (strpos($fname, 'zoom_') == true){
                if (($dateNow-filemtime($fname)) > $maxTime){ // Seconds 3600=1h
                    unlink($fname);
                }
            }
        }
    }

    public function deleteCropThumbsCache($zoom, $file){
        // todo: deleteCropThumbsCache
    }

    /**
      * Checks if slashes in paths are set correctly.
      * @access public
      * @param string $input Input path as string
      * @param string $mode case 'remove' removes last slash, case 'add' adds slash to the end
      * @return string
      **/
    public function checkSlash($input, $mode = false){
        // Replace backslashes
        $input = str_replace('\\', '/', $input);

        $doubleSlashBegin = (substr($input, 0 ,2) == '//');

        // Remove doubleslashes in $input
        $input = preg_replace('/\/+/', '/', $input);

        if ($doubleSlashBegin && defined('PHALANGER')){
            $input = '/'.$input;
        }

        // Remove slash at the end of $input
        if ($mode == 'remove'){
            if (substr($input, -1) == '/'){
                $input = substr($input, 0, -1);
            }
        }

        // Add slash at the end of $input
        elseif ($mode == 'add'){
            if (substr($input, -1) != '/' && strlen($input) > 0){
                $input .= '/';
            }
        }

        return $input;
    }

    /**
      * Convert php values to js values.
      * @access public
      * @param mixed $a Input php var
      * @return string
      **/
    public function ptj($a){
        // boolean
        if ($a === true){return 'true';}
        elseif ($a === false){return 'false';}
        // integer, written object
        elseif (is_int($a) || is_float($a) || stristr($a,'}')){return $a;}
        // string
        elseif ($a){
            $a = str_replace("\n",'',$a);
            $a = preg_replace('/\s+/', ' ', $a);
            return "'".$a."'";
        }
        // nothing
        else {return "''";}
    }

    /**
      * Rewrites $integer in appropriete measure MB, KB or BYTES
      * @access public
      * @param int $integer
      * @param int $digits Precision
      * @return string
      **/
    public function zoomFileSmartSize($integer, $digits){
        if (!$integer){$integer = 0;}
        if (!$digits){$dig='2';}
        settype ($integer,'int');
        settype ($digits,'int');
        if ($integer>=1048576){$integer = round(($integer/1024000),$digits) . " MB";}
        elseif ($integer>=1024){$integer = round(($integer/1024),0) . " KB";}
        elseif ($integer>=0){$integer = $integer . " BYTES";}
        else{$integer = "0 BYTES";}
        return $integer;
    }

    /**
      * Returns filetype (extension)
      * @access public
      * @param int $char
      * @param string $str
      * @return string
      **/
    public function getl($char, $str){
        $pos=strrpos($str,$char);
        $ext=substr($str,$pos+1);
        return $ext;
    }

    /**
      * Returns filename without extension
      * @access public
      * @param int $char
      * @param string $str
      * @return string
      **/
    public function getf($char, $str){
        $pos=strrpos($str,$char);
        $ext=substr($str,0,$pos);
        return $ext;
    }

    /**
      * Returns composed filename out of input par
      * Example input: $file = 'image.jpg', $ext = 'test', $sep = '_'
      * Example return: image_test.jpg
      * @access public
      * @param string $file
      * @param string $ext
      * @param string $sep
      * @return string
      **/
    public function composeFileName($file, $ext, $sep, $fType = 'jpg'){
        $return = $this->getf('.',$file);
        $return .= $sep;
        $return .= $ext;
        $return .= '.';
        $return .= $fType;
        return $return;
    }

    /**
      * Sorts an array and rebuilds index keys starting from 1
      * @access public
      * @param array $array
      * @param bool $reverse
      * @return array
      **/
    public function natIndex($array, $reverse){
        $i=1; $nArray=array();
        natcasesort($array);
        if ($reverse){
            $array = array_reverse($array);
        }
        foreach ($array as $k=>$v){
            $nArray[$i]=$v;
            $i++;
        }
        return $nArray;
    }

    /**
      * Generatens a random string which has $len characters
      * @access public
      * @param int $len
      * @return array
      **/
    public function rndNum($len){
        $return = '';
        $passwordChars = '0123456789'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'abcdefghijklmnopqrstuvwxyz';
        for ($index = 1; $index <= $len; $index++){
            $randomNumber = rand(1,strlen($passwordChars));
            $return .=substr($passwordChars,$randomNumber-1,1);
        }
        return $return;
    }

    /**
      * Chmod all directories in $path with $mode
      * @access public
      * @param int $path
      * @param int $mode
      * @return array
      **/
    public function chmodAllDir($path, $mode){
        $chmodArray=array(0600,0644,0755,0750,0777);
        if (in_array($mode,$chmodArray)){
            foreach (glob($path.'*', GLOB_ONLYDIR) as $dirName){
                chmod($dirName, $mode);
            }
        }
    }

    /**
      * Converts a string to UTF-8
      * @access public
      * @param string $t
      * @return string
      **/
    public function numeric_to_utf8($t){
        if (function_exists('mb_decode_numericentity')){
            $convmap = array(0x0, 0x2FFFF, 0, 0xFFFF);
            return mb_decode_numericentity($t, $convmap, 'UTF-8');
        }else{
            return $t;
        }
    }

    /**
      * Converts multidemensional php array $phpArray into javascript array
      * @access public
      * @param array $phpArray
      * @param string $jsArrayName
      * @return string
      **/
    public function arrayToJSArray($phpArray, $jsArrayName, &$html = '') {
        $html .= $jsArrayName . "=new Array();";
        foreach ($phpArray as $key => $value) {
                $outKey = (is_int($key)) ? '[' . $key . ']' : "['" . $key . "']";
                if (is_array($value)) {
                        $this->arrayToJSArray($value, $jsArrayName . $outKey, $html);
                        continue;
                }
                $html .= $jsArrayName . $outKey . "=";

                if (is_string($value)) {
                    $html .= "'" . $value . "';";
                } else if ($value === false) {
                    $html .= "false;";
                } else if ($value === NULL) {
                    $html .= "null;";
                } else if ($value === true) {
                    $html .= "true;";
                } else {
                    $html .= "'".$value . "';";
                }
        }
        return $html;
    }

    /**
      * Converts multidemensional php array $phpArray into javascript object
      * @access public
      * @param array $array
      * @param string $varname
      * @param bool $sub
      * @param bool $rn If true adds linebreak after each line
      * @param bool $string If true any value will be regarded as string
      * @return string
      **/
    public function arrayToJSObject($array, $varname, $sub = false, $rn = false, $string = false) {
        $rnStr='';
        if ($rn){$rnStr="\n";}

        $jsarray = $sub ? $varname . "{" : $varname . " = {".$rnStr;
        $varname = "\t$varname";
        reset ($array);

        // Loop through each element of the array
        while (list($key, $value) = each($array)) {
            $jskey = "'" . $key . "' : ";

            if (is_array($value)) {
                // Multi Dimensional Array
                $temp[] = $this->arrayToJSObject($value, $jskey, true, $rn, $string);
            } else {
                if (is_numeric($value) && !$string) {
                    $jskey .= "$value";
                } elseif (is_bool($value) && !$string) {
                    $jskey .= ($value ? 'true' : 'false') . "";
                } elseif ($value === NULL) {
                    $jskey .= "null";
                } else {
                    static $pattern = array("\\", "'", "\r", "\n");
                    static $replace = array('\\', '\\\'', '\r', '\n');
                    $jskey .= "'" . str_replace($pattern, $replace, $value) . "'";
                }
                $temp[] = $jskey;
            }
        }
        $jsarray .= implode(', ', $temp);

        $jsarray .= "}".$rnStr;

        return $jsarray;
    }

    /**
      * Determins the size of an resized image, returns an array with dimensions
      * @access public
      * @param array $oSize
      * @param array $rSize
      * @return array
      **/
    public function virtualResize($oSize=array(), $rSize=array()){
        $w = $rSize[0];
        $h = $rSize[1];
        $sw = $oSize[0];
        $sh = $oSize[1];
        if (($w/$sw)>($h/$sh)){$prc=$h/$sh;}
        else{$prc=$w/$sw;}
        $w = round($sw*$prc);
        $h = round($sh*$prc);
        return array($w,$h);
    }

    /**
      * This method will take the query string or an array and return either an array with parameters and their values ($ret = 'arr') or
      * it will return a new query string ($ret = 'str')
      * $parExcl are parameters from query string which have to be excluded
      * $parExcl can be passed as single string (like 'zoomID') or as an array e.g. $parExcl = array('zoomID', 'yourOtherPar', ...)
      * $parExclPreg is optional array like $parExcl, but it searches for specific string in parameter and excludes it if found
      * this function can be used for jQuery.axZm['parToPass'],
      * ajax will then append the string to the query in zoomLoad.php
      * Example: query string is: prodID=895&language=EN&zoomID=3&template=xp&somthElse=abc
      * $aaa = zoomServerPar($ret='str',array('zoomID',somthElse),false);
      * echo $aaa; //result: prodID=895&language=EN&template=xp
      * $bbb = zoomServerPar($ret='arr',array('zoomID','somthElse'),zoomServerPar);
      * print_r($bbb): //result: array('prodID' => '895', 'language' => 'EN', 'template' => 'xp')
      * $ccc = zoomServerPar($ret='str', $parExcl='zoomID', $parExclPreg=array('mthE'));
      * echo $ccc; //result: prodID=895&language=EN&template=xp
      * @access public
      * @param string $ret Possible values: arr or str
      * @param array|string $parExcl
      * @param array $parExclPreg
      * @param array|string $queryString
      **/
    public function zoomServerPar ($ret, $parExcl = false, $parExclPreg = false, $queryString = false){
        $return=array();
        if (!$parExcl && !is_array($parExcl) && !$parExclPreg && is_string($queryString)){return $queryString;}
        
        $parExclDefault = array('zoomID','zoomFile','zoomLoadAjax','loadZoomAjaxSet','load360AjaxSet','_');
        
        if (is_array($parExcl)){
            $parExcl = array_merge($parExcl, $parExclDefault);
        }

        if (!$queryString){$queryString = $_SERVER['QUERY_STRING'];} // string

        if ($queryString){
            if (is_array($queryString)){ // e.g. $_GET
                $parArr = $queryString;
            }else{
                $parArr = explode('&',$queryString);
            }

            foreach ($parArr as $key => $par){
                if (is_array($queryString)){
                    $k=$key; $v=$par;
                }else{
                    $kv=explode('=',$par);
                    $k=$kv[0]; $v=$kv[1];
                }

                if ($k){
                    if (is_array($parExcl)){
                        if (!in_array($k,$parExcl)){
                            $returnArray[$k]=$v;
                        }
                    } elseif (is_string($parExcl)){
                        if ($parExcl != $k){
                            $returnArray[$k]=$v;
                        }
                    }
                }
            }
            if (is_array($parExclPreg) AND !empty($returnArray)){
                $returnArrayTemp=$returnArray;
                foreach ($parExclPreg as $k){
                    foreach ($returnArrayTemp as $kk=>$vv){
                        if (stristr($kk,$k)){
                            unset($returnArray[$kk]);
                        }
                    }
                }
            }
            if (!empty($returnArray)){
                if ($ret=='arr'){
                    return $returnArray;
                }elseif ($ret=='str'){
                    $strArray=array();
                    foreach ($returnArray as $k=>$v){
                        array_push($strArray,$k.'='.$v);
                    }
                    return implode('&',$strArray);
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    /**
      * Returns all needed css files
      * @access public
      * @param array $zoom
      * @return HTML-Output
      **/
    public function drawZoomStyle($zoom){
        $return = '';
        $jsPath = $zoom['config']['js'];
        $cssLink = array();

        // Main AjaxZoom Css
        array_push ($cssLink,'axZm.css');

        // Scrollpane
        if ($zoom['config']['scrollPane']){
            array_push ($cssLink,'plugins/jScrollPane/style/jquery.jscrollpane.css');
            if ($zoom['config']['scrollPaneTheme']){
                array_push ($cssLink,'plugins/jScrollPane/themes/'.$zoom['config']['scrollPaneTheme'].'/style/jquery.jscrollpane.'.$zoom['config']['scrollPaneTheme'].'.css');
            }
        }

        // UI Slider
        if (!isset($zoom['config']['jsUiSuppressCSS'])){$zoom['config']['jsUiSuppressCSS'] = false;}
        if (!$zoom['config']['jsUiSuppressCSS']){
            if ($zoom['config']['jsUiAll']){
                array_push ($cssLink,'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery-ui.css');
            } else {
                array_push ($cssLink,'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.core.css');
                array_push ($cssLink,'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.theme.css');
                array_push ($cssLink,'plugins/jquery.ui/themes/'.$zoom['config']['jsUiTheme'].'/jquery.ui.slider.css');
            }
        }

        // Only for Demo
        if ($zoom['config']['visualConf']){
            array_push ($cssLink,'plugins/demo/axZm.demo.css');
            array_push ($cssLink,'plugins/demo/colorpicker/css/colorpicker.css');
        }

        foreach ($cssLink as $k=>$v){
            $return .= "\n<link rel=\"stylesheet\" href=\"".$jsPath.$v."\" media=\"screen\" type=\"text/css\">";
        }
        $return .= "\n";

        return $return;
    }

    /**
      * Returns all needed javascript files
      * @access public
      * @param array $zoom
      * @param array $exclude JS files to exclude
      * @return HTML-Output
      **/
    public function drawZoomJs($zoom, $exclude = array()){
        // For application
        /*
        $exclude=array(
            'jquery',
            'ui.core',
            'ui.widjet',
            'ui.mouse'
            'ui.draggable',
            'ui.slider',
            'effects.core',
            'browser',
            'mousewheel',
            'jScrollPane',
            'facebox',
            'axZm'
        );
        */

        // For demo
        //$exclude=array('scrollTo','colorpicker','form','axZmDemo');

        $return = '';
        $jsPath = $zoom['config']['js'];
        $min = $zoom['config']['jsMin'];

        $js = array();

        // Javascripts jquery core
        if (!in_array('jquery',$exclude)){
            array_push ($js,'plugins/jquery-1.8.3.js');
        }

        // Javascripts jquery ui
        if (!isset($zoom['config']['jsUiSuppressJS'])){$zoom['config']['jsUiSuppressJS'] = false;}
        if (!$zoom['config']['jsUiSuppressJS']){
            if ($zoom['config']['jsUiAll']){
                array_push ($js,'plugins/jquery.ui/js/jquery-ui-'.$zoom['config']['jsUiVer'].'.custom.js');
            }else{
                array_push ($js,'plugins/jquery.ui/js/jquery-ui-'.$zoom['config']['jsUiVer'].'.axZm.js');
            }
        }

        ## Javascripts jquery plugins ##

        // Browser detection, removed Ver. 4.2.1
        /*
        if (!in_array('browser',$exclude)){
            array_push ($js,'plugins/jquery.browser.js');
        }*/

        // Mousewheel is needed for scrolling
        if (!in_array('mousewheel',$exclude)){
            array_push ($js,'plugins/jquery.mousewheel.js');
        }

        // Crolling area for vertical gallery
        if (!in_array('jScrollPane',$exclude)){
            array_push ($js,'plugins/jScrollPane/script/jquery.jscrollpane.js');
        }

        // Zoom Main script
        if (!in_array('axZm',$exclude)){
            array_push ($js,'jquery.axZm.js');
        }

        // Only for Demo with visual configuration
        if ($zoom['config']['visualConf']){
            if (!in_array('scrollTo',$exclude)){
                array_push ($js,'plugins/jquery.scrollTo.js');
            }
            if (!in_array('colorpicker',$exclude)){
                array_push ($js,'plugins/demo/colorpicker/js/colorpicker.js');
            }
            if (!in_array('form',$exclude)){
                array_push ($js,'plugins/demo/jquery.form.js');
            }

            if (!in_array('axZmDemo',$exclude)){
                array_push ($js,'plugins/demo/jquery.axZm.demo.js');
            }
        }

        foreach ($js as $k=>$v){
            if ($min && !stristr($v,'axZm')){
                $v = $this->getf('.',$v).'.min.js';
                //$v = str_replace('.js','.min.js',$v);
            }
            $return .= "\n<script type=\"text/javascript\" src=\"$jsPath$v\"></script>";
        }
        $return .= "\n";

        if ($zoom['config']['visualConf']){
            $return .= "
                <script type=\"text/javascript\">
                jQuery.optSubmit = function(){
                    jQuery.ajaxSubmitCustom('demoOptions','zoomOpr','".$zoom['config']['installPath']."/axZm/zoomVisualConf.inc.php');
                };
                </script>
            ";
        }

        return $return;
    }

    /**
      * Returns all needed javascript for onLoad
      * @access public
      * @param array $zoom
      * @param bool $pack Use packer
      * @param bool $windowLoad If true the method should be called in any case in the head section of html
      * @param string $jsObject Options javascript object for jQuery.fn.axZm
      * @return HTML-Output
      **/
    public function drawZoomJsLoad($zoom, $pack = false, $windowLoad = true, $jsObject = '{}'){
        $js='';
        if (!$jsObject){$jsObject = '{}';}
        if ($windowLoad){
            $js='jQuery(window).load(function(){
                    jQuery.fn.axZm('.$jsObject.');
            ';
        }else{
            $js='
                jQuery.fn.axZm('.$jsObject.');
            ';
        }

        if ($zoom['config']['visualConf']){

            $js .= '
                jQuery(\'#demoOptions\').ajaxForm();
                jQuery.colPick(\'demoColorStage\',\'demoColorStage\');
                jQuery.colPick(\'demoBodyColor\',\'demoBodyColor\');
                jQuery.colPick(\'demoColorArea\',\'demoColorArea\');
                jQuery.colPick(\'demoColorOuter\',\'demoColorOuter\');
                jQuery.colPick(\'demoColorBorder\',\'demoColorBorder\');

                jQuery.demoAnm = true;
                jQuery(\'#zoomAjaxDemoButton\').click(function () {
                  jQuery(\'#zoomAjaxDemo\').slideToggle(300);
                });

                jQuery(\'#zoomAjaxDemoButton\').mouseover(function () {
                    jQuery(this).css(\'color\',\'#F4E10A\');
                }).mouseout(function () {
                    jQuery(this).css(\'color\',\'#FFFFFF\');
                });
            ';

        }
        if ($windowLoad){
            $js.="
            });";
        }
        if ($pack){
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        }
        $js = "<script type=\"text/javascript\">$js</script>";
        return $js;
    }

    /**
      * Returns all needed configuration variables in javascript
      * @access public
      * @param array $zoom
      * @param bool $rn Add line break after each line of code
      * @param bool $pack Use packer
      * @return Javascript-Output
      **/
    public function drawZoomJsConf($zoom, $rn = false, $pack = true){
        $rnStr = '';
        if ($rn){$rnStr = "\n";}

        // General
        $js = 'if (jQuery.axZm){delete jQuery.axZm;} jQuery.axZm = {}; ';

        //$js .= 'jQuery.axZm.version = '.$this->ptj($_GET['version']).'; ';
        $js .= 'jQuery.axZm.zoomID = '.$this->ptj($_GET['zoomID']).'; ';
        $js .= 'jQuery.axZm.pZoomID = '.$this->ptj($zoom['config']['pZoomID']).'; ';
        $js .= 'jQuery.axZm.randNum = '.$this->ptj($this->rndNum(24)).'; ';

        $js .= 'jQuery.axZm.icon = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.iconDir = '.$this->ptj($zoom['config']['icon']).'; '; // Alias

        $js .= 'jQuery.axZm.js = '.$this->ptj($zoom['config']['js']).'; ';
        $js .= 'jQuery.axZm.jsDir = '.$this->ptj($zoom['config']['js']).'; ';

        $js .= 'jQuery.axZm.jsDynLoad = '.$this->ptj($zoom['config']['jsDynLoad']).'; ';
        $js .= 'jQuery.axZm.jsMin = '.$this->ptj($zoom['config']['jsMin']).'; ';

        $js .= 'jQuery.axZm.jsUiAll = '.$this->ptj($zoom['config']['jsUiAll']).'; ';
        $js .= 'jQuery.axZm.jsUiVer = '.$this->ptj($zoom['config']['jsUiVer']).'; ';
        $js .= 'jQuery.axZm.jsUiTheme = '.$this->ptj($zoom['config']['jsUiTheme']).'; ';
        $js .= 'jQuery.axZm.jsUiSuppressJS = '.$this->ptj($zoom['config']['jsUiSuppressJS']).'; ';
        $js .= 'jQuery.axZm.jsUiSuppressCSS = '.$this->ptj($zoom['config']['jsUiSuppressCSS']).'; ';


        $js .= 'jQuery.axZm.thumbs = '.$this->ptj($zoom['config']['thumbs']).'; ';
        $js .= 'jQuery.axZm.smallImgPath = '.$this->ptj($zoom['config']['thumbs']).'; '; // Alias

        // smallImageName is composed out of orgImgName + _ + picDim, e.g. test.jpg / test_800x600.jpg
        $js .= 'jQuery.axZm.smallImg = '.$this->ptj($zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']).'; ';


        // Ver. 2.1.5+
        //$js .= 'jQuery.axZm.fileType = '.$this->ptj($this->getl('.', $zoom['config']['orgImgName'])).'; ';
        //$js .= 'jQuery.axZm.fileBase = '.$this->ptj($this->getf('.', $zoom['config']['orgImgName'])).'; ';

        if ($zoom['config']['cropNoObj']){
            $js .= 'jQuery.axZm.pic = '.$this->ptj($zoom['config']['pic']).'; ';
            $js .= 'jQuery.axZm.orgPath = '.$this->ptj($zoom['config']['pic']).'; '; // Alias
        }

        // jQuery.axZm.iw and jQuery.axZm.ih are REAL width and hight of the preview image generated out of big image
        $js .= 'jQuery.axZm.iw = '.$this->ptj($zoom['config']['smallImgSize'][0]).'; ';
        $js .= 'jQuery.axZm.ih = '.$this->ptj($zoom['config']['smallImgSize'][1]).'; ';

        $js .= 'jQuery.axZm.ow = '.$this->ptj($zoom['config']['orgImgSize'][0]).'; ';
        $js .= 'jQuery.axZm.oh = '.$this->ptj($zoom['config']['orgImgSize'][1]).'; ';


        $js .= 'jQuery.axZm.smallFileSize = '.$this->ptj($zoom['config']['smallFileSize']).'; ';
        $js .= 'jQuery.axZm.parToPass = '.$this->ptj($zoom['config']['parToPass']).'; ';

        $js .= 'jQuery.axZm.domain = '.$this->ptj($zoom['config']['domain']).'; ';

        $js .= 'jQuery.axZm.visualConf = '.$this->ptj($zoom['config']['visualConf']).'; ';
        $js .= 'jQuery.axZm.errors = '.$this->ptj($zoom['config']['errors']).'; ';

        // Layout
        $js .= 'jQuery.axZm.keepBoxW = '.$this->ptj($zoom['config']['keepBoxW']).'; ';
        $js .= 'jQuery.axZm.keepBoxH = '.$this->ptj($zoom['config']['keepBoxH']).'; ';
        $js .= 'jQuery.axZm.boxW = '.$this->ptj($zoom['config']['picX']).'; '; // set out of $zoom['config']['picDim']
        $js .= 'jQuery.axZm.boxH = '.$this->ptj($zoom['config']['picY']).'; '; // set out of $zoom['config']['picDim']
        $js .= 'jQuery.axZm.picDim = '.$this->ptj($zoom['config']['picDim']).'; ';
        $js .= 'jQuery.axZm.gravity = '.$this->ptj($zoom['config']['gravity']).'; ';

        $js .= 'jQuery.axZm.traveseGravity = '.$this->ptj($zoom['config']['traveseGravity']).'; ';
        $js .= 'jQuery.axZm.disableZoom = '.$this->ptj($zoom['config']['disableZoom']).'; ';
        $js .= $this->arrayToJSArray($zoom['config']['disableZoomExcept'],'jQuery.axZm.disableZoomExcept').'; ';

        $js .= 'jQuery.axZm.pngMode = '.$this->ptj($zoom['config']['pngMode']).'; ';
        $js .= 'jQuery.axZm.pngKeepTransp = '.$this->ptj($zoom['config']['pngKeepTransp']).'; ';

        $js .= 'jQuery.axZm.forceToPan = '.$this->ptj($zoom['config']['forceToPan']).'; ';
        $js .= 'jQuery.axZm.forceToPanClickDisable = '.$this->ptj($zoom['config']['forceToPanClickDisable']).'; ';


        if ($zoom['config']['pyrTiles']){
            if ($zoom['config']['pyrAutoDetect']){
                $zoom['config']['tileSize'] = $this->getTileSize($zoom, $zoom['config']['orgImgName']);
            }
        }

        $js .= 'jQuery.axZm.tileSize = '.$this->ptj($zoom['config']['tileSize']).'; ';
        $js .= 'jQuery.axZm.pyrLoadTiles = '.$this->ptj($zoom['config']['pyrLoadTiles']).'; ';
        if ($zoom['config']['pyrLoadTiles']){
            $js .= 'jQuery.axZm.pyrTilesPath = '.$this->ptj($zoom['config']['pyrTilesPath']).'; ';
            $js .= 'jQuery.axZm.pyrTilesFadeInSpeed = '.$this->ptj($zoom['config']['pyrTilesFadeInSpeed']).'; ';
            $js .= 'jQuery.axZm.pyrTilesFadeLoad = '.$this->ptj($zoom['config']['pyrTilesFadeLoad']).'; ';
        }

        // Zoom Map
        $js .= 'jQuery.axZm.useMap = '.$this->ptj($zoom['config']['useMap']).'; ';
        $js .= 'jQuery.axZm.mapPath = '.$this->ptj($zoom['config']['mapPath']).'; ';
        $js .= 'jQuery.axZm.mapOwnImage = '.$this->ptj($zoom['config']['mapOwnImage']).'; ';


        $js .= 'jQuery.axZm.mapFract = '.$this->ptj($zoom['config']['mapFract']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mapBorder'],'jQuery.axZm.mapBorder', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.zoomMapVis = '.$this->ptj($zoom['config']['zoomMapVis']).'; ';
        $js .= 'jQuery.axZm.dragMap = '.$this->ptj($zoom['config']['dragMap']).'; ';
        $js .= 'jQuery.axZm.mapHolderHeight = '.$this->ptj($zoom['config']['mapHolderHeight']).'; ';
        $js .= 'jQuery.axZm.mapHolderText = '.$this->ptj($zoom['config']['mapHolderText']).'; ';
        $js .= 'jQuery.axZm.zoomMapDragOpacity = '.$this->ptj($zoom['config']['zoomMapDragOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomMapSelOpacity = '.$this->ptj($zoom['config']['zoomMapSelOpacity'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapSelBorder = '.$this->ptj($zoom['config']['zoomMapSelBorder'] ).'; ';

        $js .= 'jQuery.axZm.zoomMapContainment = '.$this->ptj($zoom['config']['zoomMapContainment']).'; ';
        $js .= 'jQuery.axZm.mapButton = '.$this->ptj($zoom['config']['mapButton']).'; ';
        $js .= 'jQuery.axZm.mapPos = '.$this->ptj($zoom['config']['mapPos']).'; ';

        $js .= 'jQuery.axZm.zoomMapRest = '.$this->ptj($zoom['config']['zoomMapRest'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapAnimate = '.$this->ptj($zoom['config']['zoomMapAnimate'] ).'; ';
        $js .= 'jQuery.axZm.zoomMapSwitchSpeed = '.$this->ptj($zoom['config']['zoomMapSwitchSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDrag = '.$this->ptj($zoom['config']['mapSelSmoothDrag'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDragSpeed = '.$this->ptj($zoom['config']['mapSelSmoothDragSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapSelSmoothDragMotion = '.$this->ptj($zoom['config']['mapSelSmoothDragMotion'] ).'; ';
        $js .= 'jQuery.axZm.mapSelZoomSpeed = '.$this->ptj($zoom['config']['mapSelZoomSpeed'] ).'; ';
        $js .= 'jQuery.axZm.mapParent = '.$this->ptj($zoom['config']['mapParent']).'; ';
        $js .= 'jQuery.axZm.mapParCenter = '.$this->ptj($zoom['config']['mapParCenter']).'; ';

        $js .= 'jQuery.axZm.mapWidth = '.$this->ptj($zoom['config']['mapWidth']).'; ';
        $js .= 'jQuery.axZm.mapHeight = '.$this->ptj($zoom['config']['mapHeight']).'; ';

        $js .= 'jQuery.axZm.mapMouseOver = '.$this->ptj($zoom['config']['mapMouseOver']).'; ';
        $js .= 'jQuery.axZm.mapMouseWheel = '.$this->ptj($zoom['config']['mapMouseWheel']).'; ';

        $js .= 'jQuery.axZm.mapHorzMargin = '.$this->ptj($zoom['config']['mapHorzMargin']).'; ';
        $js .= 'jQuery.axZm.mapVertMargin = '.$this->ptj($zoom['config']['mapVertMargin']).'; ';
        $js .= 'jQuery.axZm.mapOpacity = '.$this->ptj($zoom['config']['mapOpacity']).'; ';
        $js .= 'jQuery.axZm.mapClickZoom = '.$this->ptj($zoom['config']['mapClickZoom']).'; ';

        // Gallery
        $js .= 'jQuery.axZm.galleryRawThumb = '.$this->ptj($zoom['config']['galleryRawThumb']).'; ';

        $js .= 'jQuery.axZm.useGallery = '.$this->ptj($zoom['config']['useGallery']).'; ';
        $js .= 'jQuery.axZm.useFullGallery = '.$this->ptj($zoom['config']['useFullGallery']).'; ';
        $js .= 'jQuery.axZm.useHorGallery = '.$this->ptj($zoom['config']['useHorGallery']).'; ';
        $js .= 'jQuery.axZm.gallery = '.$this->ptj($zoom['config']['gallery']).'; ';
        $js .= 'jQuery.axZm.zoomGalDir = '.$this->ptj($zoom['config']['gallery']).'; '; // Alias

        $js .= 'jQuery.axZm.galleryLines = '.$this->ptj($zoom['config']['galleryLines']).'; ';
        $js .= 'jQuery.axZm.galleryNoThumbs = '.$this->ptj($zoom['config']['galleryNoThumbs']).'; ';


        // Gallery slideshow and navigation buttons
        $js .= 'jQuery.axZm.galleryNavi = '.$this->ptj($zoom['config']['galleryNavi']).'; ';
        $js .= 'jQuery.axZm.galleryNaviCirc = '.$this->ptj($zoom['config']['galleryNaviCirc']).'; ';
        $js .= 'jQuery.axZm.galleryPlayButton = '.$this->ptj($zoom['config']['galleryPlayButton']).'; ';
        $js .= 'jQuery.axZm.galleryButtonSpace = '.$this->ptj($zoom['config']['galleryButtonSpace']).'; ';
        $js .= 'jQuery.axZm.galleryNaviPos = '.$this->ptj($zoom['config']['galleryNaviPos']).'; ';
        $js .= 'jQuery.axZm.galleryNaviHeight = '.$this->ptj($zoom['config']['galleryNaviHeight']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['galleryNaviMargin'],'jQuery.axZm.galleryNaviMargin', false, $rn, false).'; ';
        //$js .= $this->arrayToJSArray($zoom['config']['galleryNaviMargin'],'jQuery.axZm.galleryNaviMargin').'; ';

        $js .= 'jQuery.axZm.galleryPlayInterval = '.$this->ptj($zoom['config']['galleryPlayInterval']).'; ';
        $js .= 'jQuery.axZm.galleryAutoPlay = '.$this->ptj($zoom['config']['galleryAutoPlay']).'; ';
        //$js .= 'jQuery.axZm.galleryAutoPlaySpeed = '.$this->ptj($zoom['config']['galleryAutoPlaySpeed']).'; ';

        $js .= 'jQuery.axZm.gallerySlideNavi = '.$this->ptj($zoom['config']['gallerySlideNavi']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviMouseOver = '.$this->ptj($zoom['config']['gallerySlideNaviMouseOver']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviOnlyFullScreen = '.$this->ptj($zoom['config']['gallerySlideNaviOnlyFullScreen']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviMargin = '.$this->ptj($zoom['config']['gallerySlideNaviMargin']).'; ';
        $js .= 'jQuery.axZm.gallerySlideNaviAnm = '.$this->ptj($zoom['config']['gallerySlideNaviAnm']).'; ';
        $js .= 'jQuery.axZm.gallerySlideSwipeSpeed = '.$this->ptj($zoom['config']['gallerySlideSwipeSpeed']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['gallerySlideTouchSwipe'],'jQuery.axZm.gallerySlideTouchSwipe', false, $rn, false).'; ';

        $js .= 'jQuery.axZm.galleryFadeOutSpeed = '.$this->ptj($zoom['config']['galleryFadeOutSpeed']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInSpeed = '.$this->ptj($zoom['config']['galleryFadeInSpeed']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInMotion = '.$this->ptj($zoom['config']['galleryFadeInMotion']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInOpacity = '.$this->ptj($zoom['config']['galleryFadeInOpacity']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInSize = '.$this->ptj($zoom['config']['galleryFadeInSize']).'; ';
        $js .= 'jQuery.axZm.galleryFadeInAnm = '.$this->ptj($zoom['config']['galleryFadeInAnm']).'; ';
        $js .= 'jQuery.axZm.gallerySwipe = '.$this->ptj($zoom['config']['gallerySwipe']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFade = '.$this->ptj($zoom['config']['galleryInnerFade']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFadeCut = '.$this->ptj($zoom['config']['galleryInnerFadeCut']).'; ';
        $js .= 'jQuery.axZm.galleryInnerFadeMotion = '.$this->ptj($zoom['config']['galleryInnerFadeMotion']).'; ';

        //if ($zoom['config']['useGallery'] || $zoom['config']['useFullGallery'] || $zoom['config']['useHorGallery']){

            $js .= 'jQuery.axZm.galleryThumbFadeOn = '.$this->ptj($zoom['config']['galleryThumbFadeOn']).'; ';

            $js .= 'jQuery.axZm.galleryThumbOverSpeed = '.$this->ptj($zoom['config']['galleryThumbOverSpeed']).'; ';
            $js .= 'jQuery.axZm.galleryThumbOverOpaque = '.$this->ptj($zoom['config']['galleryThumbOverOpaque']).'; ';

            //if ($zoom['config']['useGallery'] || $zoom['config']['useHorGallery']){
                $js .= 'jQuery.axZm.galleryThumbOutSpeed = '.$this->ptj($zoom['config']['galleryThumbOutSpeed']).'; ';
                $js .= 'jQuery.axZm.galleryThumbOutOpaque = '.$this->ptj($zoom['config']['galleryThumbOutOpaque']).'; ';
            //}
        //}

        // Horizontal Gallery
        //if ($zoom['config']['useHorGallery']){
            $js .= 'jQuery.axZm.galHorHeight = '.$this->ptj($zoom['config']['galHorHeight']).'; ';
            $js .= 'jQuery.axZm.galHorPosition = '.$this->ptj($zoom['config']['galHorPosition']).'; ';
            $js .= 'jQuery.axZm.galHorMarginTop = '.$this->ptj($zoom['config']['galHorMarginTop']).'; ';
            $js .= 'jQuery.axZm.galHorMarginBottom = '.$this->ptj($zoom['config']['galHorMarginBottom']).'; ';
            $js .= 'jQuery.axZm.galHorArrowWidth = '.$this->ptj($zoom['config']['galHorArrowWidth']).'; ';
            $js .= 'jQuery.axZm.galleryHorPicDim = '.$this->ptj($zoom['config']['galleryHorPicDim']).'; ';
            $js .= 'jQuery.axZm.galHorPicX = '.$this->ptj($zoom['config']['galHorPicX']).'; ';
            $js .= 'jQuery.axZm.galHorPicY = '.$this->ptj($zoom['config']['galHorPicY']).'; ';
            $js .= 'jQuery.axZm.galHorCssPadding = '.$this->ptj($zoom['config']['galHorCssPadding']).'; ';
            $js .= 'jQuery.axZm.galHorCssBorderWidth = '.$this->ptj($zoom['config']['galHorCssBorderWidth']).'; ';
            $js .= 'jQuery.axZm.galHorCssDescrHeight = '.$this->ptj($zoom['config']['galHorCssDescrHeight']).'; ';
            $js .= 'jQuery.axZm.galHorCssDescrPadding = '.$this->ptj($zoom['config']['galHorCssDescrPadding']).'; ';
            $js .= 'jQuery.axZm.galHorCssMarginBetween = '.$this->ptj($zoom['config']['galHorCssMarginBetween']).'; ';
            $js .= 'jQuery.axZm.galHorCssMarginTop = '.$this->ptj($zoom['config']['galHorCssMarginTop']).'; ';
            $js .= 'jQuery.axZm.galHorScrollPos = '.$this->ptj($zoom['config']['galHorScrollPos']).'; ';
            $js .= 'jQuery.axZm.galHorScrollToCurrent = '.$this->ptj($zoom['config']['galHorScrollToCurrent']).'; ';
            $js .= 'jQuery.axZm.galHorScrollMotion = '.$this->ptj($zoom['config']['galHorScrollMotion']).'; ';
            $js .= 'jQuery.axZm.galHorScrollSpeed = '.$this->ptj($zoom['config']['galHorScrollSpeed']).'; ';
            $js .= 'jQuery.axZm.galHorScrollBy = '.$this->ptj($zoom['config']['galHorScrollBy']).'; ';
            $js .= 'jQuery.axZm.galHorArrows = '.$this->ptj($zoom['config']['galHorArrows']).'; ';
            $js .= 'jQuery.axZm.galHorFlow = '.$this->ptj($zoom['config']['galHorFlow']).'; ';
            $js .= 'jQuery.axZm.galHorMouse = '.$this->ptj($zoom['config']['galHorMouse']).'; ';
            $js .= 'jQuery.axZm.galHorInnerCorner = '.$this->ptj($zoom['config']['galHorInnerCorner']).'; ';
            $js .= 'jQuery.axZm.galHorInnerCornerImage = '.$this->ptj($zoom['config']['galHorInnerCornerImage']).'; ';
            $js .= 'jQuery.axZm.galHorInnerCornerWidth = '.$this->ptj($zoom['config']['galHorInnerCornerWidth']).'; ';
        //}

        // Vertical Gallery
        $js .= 'jQuery.axZm.galleryPicDim = '.$this->ptj($zoom['config']['galleryPicDim']).'; ';
        $js .= 'jQuery.axZm.galPicX = '.$this->ptj($zoom['config']['galPicX']).'; ';
        $js .= 'jQuery.axZm.galPicY = '.$this->ptj($zoom['config']['galPicY']).'; ';
        $js .= 'jQuery.axZm.galleryPos = '.$this->ptj($zoom['config']['galleryPos']).'; ';
        $js .= 'jQuery.axZm.galleryScrollbarWidth = '.$this->ptj($zoom['config']['galleryScrollbarWidth']).'; ';
        $js .= 'jQuery.axZm.galleryScrollTop = '.$this->ptj($zoom['config']['galleryScrollTop']).'; ';
        $js .= 'jQuery.axZm.galleryScrollToCurrent = '.$this->ptj($zoom['config']['galleryScrollToCurrent']).'; ';
        $js .= 'jQuery.axZm.galleryMarginLeft = '.$this->ptj($zoom['config']['galleryMarginLeft']).'; ';
        $js .= 'jQuery.axZm.galleryCssPadding = '.$this->ptj($zoom['config']['galleryCssPadding']).'; ';
        $js .= 'jQuery.axZm.galleryCssBorderWidth = '.$this->ptj($zoom['config']['galleryCssBorderWidth']).'; ';
        $js .= 'jQuery.axZm.galleryCssMargin = '.$this->ptj($zoom['config']['galleryCssMargin']).'; ';
        $js .= 'jQuery.axZm.galleryCssMargin = '.$this->ptj($zoom['config']['galleryCssMargin']).'; ';
        $js .= 'jQuery.axZm.galleryCssFirstTopMargin = '.$this->ptj($zoom['config']['galleryCssFirstTopMargin']).'; ';
        $js .= 'jQuery.axZm.galleryCssDescrPadding = '.$this->ptj($zoom['config']['galleryCssDescrPadding']).'; ';

        // Inline Gallery
        if ($zoom['config']['useFullGallery']){
            $js .= 'jQuery.axZm.galFullScrollCurrent = '.$this->ptj($zoom['config']['galFullScrollCurrent']).'; ';
            $js .= 'jQuery.axZm.galFullAutoStart = '.$this->ptj($zoom['config']['galFullAutoStart']).'; ';
            $js .= 'jQuery.axZm.galFullButton = '.$this->ptj($zoom['config']['galFullButton']).'; ';

            $js .= 'jQuery.axZm.galFullTooltip = '.$this->ptj($zoom['config']['galFullTooltip']).'; ';
            if ($zoom['config']['galFullTooltip']){
                $js .= 'jQuery.axZm.galFullTooltipOffset = '.$this->ptj($zoom['config']['galFullTooltipOffset']).'; ';
                $js .= 'jQuery.axZm.galFullTooltipSpeed = '.$this->ptj($zoom['config']['galFullTooltipSpeed']).'; ';
                $js .= 'jQuery.axZm.galFullTooltipTransp = '.$this->ptj($zoom['config']['galFullTooltipTransp']).'; ';
            }

            // Inline Gallery Thumbs
            $js .= 'jQuery.axZm.galleryFullPicDim = '.$this->ptj($zoom['config']['galleryFullPicDim']).'; ';
            $js .= 'jQuery.axZm.galFullPicX = '.$this->ptj($zoom['config']['galFullPicX']).'; ';
            $js .= 'jQuery.axZm.galFullPicY = '.$this->ptj($zoom['config']['galFullPicY']).'; ';
            $js .= 'jQuery.axZm.galFullCssPadding = '.$this->ptj($zoom['config']['galFullCssPadding']).'; ';
            $js .= 'jQuery.axZm.galFullCssBorderWidth = '.$this->ptj($zoom['config']['galFullCssBorderWidth']).'; ';
            $js .= 'jQuery.axZm.galFullCssMargin = '.$this->ptj($zoom['config']['galFullCssMargin']).'; ';
            $js .= 'jQuery.axZm.galFullCssDescrHeight = '.$this->ptj($zoom['config']['galFullCssDescrHeight']).'; ';
            $js .= 'jQuery.axZm.galFullCssDescrPadding = '.$this->ptj($zoom['config']['galFullCssDescrPadding']).'; ';
        }

        $arrayMods = array('crop', 'spin', 'pan');
        if (!in_array($zoom['config']['firstMod'], $arrayMods)){$zoom['config']['firstMod'] = 'pan';}
        if (!$zoom['config']['spinMod'] && $zoom['config']['firstMod'] == 'spin'){$zoom['config']['firstMod'] = 'pan';}
        $js .= 'jQuery.axZm.firstMod = '.$this->ptj($zoom['config']['firstMod']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['keyPressMod'],'jQuery.axZm.keyPressMod', false, $rn, false).'; ';

        $js .= 'jQuery.axZm.spinMod = '.$this->ptj($zoom['config']['spinMod']).'; ';


        if ($zoom['config']['spinMod']){
            $js .= $this->arrayToJSObject($zoom['config']['spinPreloaderSettings'],'jQuery.axZm.spinPreloaderSettings', false, $rn, false).'; ';
            // 4.2.4
            $js .= $this->arrayToJSObject($zoom['config']['spinCirclePreloader'],'jQuery.axZm.spinCirclePreloader', false, $rn, false).'; ';

            $js .= 'jQuery.axZm.spinSensitivity = '.$this->ptj($zoom['config']['spinSensitivity']).'; ';
            $js .= 'jQuery.axZm.spinReverse = '.$this->ptj($zoom['config']['spinReverse']).'; ';
            $js .= 'jQuery.axZm.spinContra = '.$this->ptj($zoom['config']['spinContra']).'; ';

            $js .= 'jQuery.axZm.spinReverseBtn = '.$this->ptj($zoom['config']['spinReverseBtn']).'; ';
            $js .= 'jQuery.axZm.spinDemo = '.$this->ptj($zoom['config']['spinDemo']).'; ';
            $js .= 'jQuery.axZm.spinDemoTime = '.$this->ptj($zoom['config']['spinDemoTime']).'; ';
            $js .= 'jQuery.axZm.spinDemoRounds = '.$this->ptj($zoom['config']['spinDemoRounds']).'; ';
            $js .= 'jQuery.axZm.spinOnSwitch = '.$this->ptj($zoom['config']['spinOnSwitch']).'; ';
            $js .= 'jQuery.axZm.spinWhilePreload = '.$this->ptj($zoom['config']['spinWhilePreload']).'; ';

            $js .= 'jQuery.axZm.spinMouseOverStop = '.$this->ptj($zoom['config']['spinMouseOverStop']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinEffect'],'jQuery.axZm.spinEffect', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.spinSlider = '.$this->ptj($zoom['config']['spinSlider']).'; ';
            $js .= 'jQuery.axZm.spinSliderContainerHeight = '.$this->ptj($zoom['config']['spinSliderContainerHeight']).'; ';
            $js .= 'jQuery.axZm.spinSliderReverse = '.$this->ptj($zoom['config']['spinSliderReverse']).'; ';
            $js .= 'jQuery.axZm.spinBounce = '.$this->ptj($zoom['config']['spinBounce']).'; ';
            $js .= 'jQuery.axZm.spinSliderClass = '.$this->ptj($zoom['config']['spinSliderClass']).'; ';
            $js .= 'jQuery.axZm.spinSliderClassFS = '.$this->ptj($zoom['config']['spinSliderClassFS']).'; ';

            $js .= $this->arrayToJSObject($zoom['config']['spinNoInit'],'jQuery.axZm.spinNoInit', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['dragToSpin'],'jQuery.axZm.dragToSpin', false, $rn, false).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['spinKeys'],'jQuery.axZm.spinKeys', false, $rn, false).'; ';

            if ($zoom['config']['cueFrames']){
                $js .= 'jQuery.axZm.cueFrames = '.$this->ptj($zoom['config']['cueFrames']).'; ';
            }
            $js .= 'jQuery.axZm.spinSliderPlayButton = '.$this->ptj($zoom['config']['spinSliderPlayButton']).'; ';
            $js .= 'jQuery.axZm.spinSliderFSoffset = '.$this->ptj($zoom['config']['spinSliderFSoffset']).'; ';
            $js .= 'jQuery.axZm.spinAreaDisable = '.$this->ptj($zoom['config']['spinAreaDisable']).'; ';
            $js .= 'jQuery.axZm.spinToMotion = '.$this->ptj($zoom['config']['spinToMotion']).'; ';
            $js .= 'jQuery.axZm.spinOnClick = '.$this->ptj($zoom['config']['spinOnClick']).'; ';

            $js .= 'jQuery.axZm.spinFlip = '.$this->ptj($zoom['config']['spinFlip']).'; ';

            $js .= $this->arrayToJSObject($zoom['config']['spinSmoothing'],'jQuery.axZm.spinSmoothing', false, $rn, false).'; ';

            $js .= 'jQuery.axZm.spinAndDrag = '.$this->ptj($zoom['config']['spinAndDrag']).'; ';
            $js .= 'jQuery.axZm.spinPanRightMouseBtn = '.$this->ptj($zoom['config']['spinPanRightMouseBtn']).'; ';

            if (isset($zoom['config']['zAxis'])){
                $js .= $this->arrayToJSObject($zoom['config']['zAxis'],'jQuery.axZm.zAxis', false, $rn, false).'; ';
                $js .= $this->arrayToJSObject($zoom['config']['zFolder'],'jQuery.axZm.zFolder', false, $rn, true).'; ';
                $js .= 'jQuery.axZm.spinReverseZ = '.$this->ptj($zoom['config']['spinReverseZ']).'; ';
                $js .= 'jQuery.axZm.spinSensitivityZ = '.$this->ptj($zoom['config']['spinSensitivityZ']).'; ';
            }

            if (isset($_GET['firstAxis'])){
                $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($_GET['firstAxis']).'; ';
            } elseif(isset($zoom['config']['firstAxis'])){
                $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($zoom['config']['firstAxis']).'; ';
            } else {
                $js .= 'jQuery.axZm.firstAxis = false; ';
            }
        }else{
            $js .= 'jQuery.axZm.zAxis = false; ';
            $js .= 'jQuery.axZm.zFolder = false; ';
            $js .= 'jQuery.axZm.firstAxis = false; ';
        }

        // Zoom slider
        $js .= 'jQuery.axZm.zoomSlider = '.$this->ptj($zoom['config']['zoomSlider']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHeight = '.$this->ptj($zoom['config']['zoomSliderHeight']).'; ';
        $js .= 'jQuery.axZm.zoomSliderWidth = '.$this->ptj($zoom['config']['zoomSliderWidth']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHandleSize = '.$this->ptj($zoom['config']['zoomSliderHandleSize']).'; ';
        $js .= 'jQuery.axZm.zoomSliderPosition = '.$this->ptj($zoom['config']['zoomSliderPosition']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMarginV = '.$this->ptj($zoom['config']['zoomSliderMarginV']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMarginH = '.$this->ptj($zoom['config']['zoomSliderMarginH']).'; ';
        $js .= 'jQuery.axZm.zoomSliderOpacity = '.$this->ptj($zoom['config']['zoomSliderOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomSliderHorizontal = '.$this->ptj($zoom['config']['zoomSliderHorizontal']).'; ';
        $js .= 'jQuery.axZm.zoomSliderMouseOver = '.$this->ptj($zoom['config']['zoomSliderMouseOver']).'; ';
        $js .= 'jQuery.axZm.zoomSliderContainerPadding = '.$this->ptj($zoom['config']['zoomSliderContainerPadding']).'; ';
        $js .= 'jQuery.axZm.zoomSliderClass = '.$this->ptj($zoom['config']['zoomSliderClass']).'; ';


        // Motion
        $js .= 'jQuery.axZm.pMove= '.$this->ptj($zoom['config']['pMove']).'; ';
        $js .= 'jQuery.axZm.pZoom = '.$this->ptj($zoom['config']['pZoom']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['autoZoom'],'jQuery.axZm.autoZoom', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.pZoomOut = '.$this->ptj($zoom['config']['pZoomOut']).'; ';
        $js .= 'jQuery.axZm.stepZoom = '.$this->ptj($zoom['config']['stepZoom']).'; ';
        $js .= 'jQuery.axZm.zoomOutClick = '.$this->ptj($zoom['config']['zoomOutClick']).'; ';

        $js .= 'jQuery.axZm.zoomSpeedGlobal = '.$this->ptj($zoom['config']['zoomSpeedGlobal']).'; ';
        $js .= 'jQuery.axZm.moveSpeed = '.$this->ptj($zoom['config']['moveSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomSpeed = '.$this->ptj($zoom['config']['zoomSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomOutSpeed = '.$this->ptj($zoom['config']['zoomOutSpeed']).'; ';
        $js .= 'jQuery.axZm.cropSpeed = '.$this->ptj($zoom['config']['cropSpeed']).'; ';
        $js .= 'jQuery.axZm.restoreSpeed = '.$this->ptj($zoom['config']['restoreSpeed']).'; ';
        $js .= 'jQuery.axZm.traverseSpeed = '.$this->ptj($zoom['config']['traverseSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomFade = '.$this->ptj($zoom['config']['zoomFade']).'; ';
        $js .= 'jQuery.axZm.zoomFadeIn = '.$this->ptj($zoom['config']['zoomFadeIn']).'; ';
        $js .= 'jQuery.axZm.buttonAjax = '.$this->ptj($zoom['config']['buttonAjax']).'; ';

        $js .= 'jQuery.axZm.zoomEaseGlobal = '.$this->ptj($zoom['config']['zoomEaseGlobal']).'; ';
        $js .= 'jQuery.axZm.zoomEaseIn = '.$this->ptj($zoom['config']['zoomEaseIn']).'; ';
        $js .= 'jQuery.axZm.zoomEaseCrop = '.$this->ptj($zoom['config']['zoomEaseCrop']).'; ';
        $js .= 'jQuery.axZm.zoomEaseOut = '.$this->ptj($zoom['config']['zoomEaseOut']).'; ';
        $js .= 'jQuery.axZm.zoomEaseMove = '.$this->ptj($zoom['config']['zoomEaseMove']).'; ';
        $js .= 'jQuery.axZm.zoomEaseRestore = '.$this->ptj($zoom['config']['zoomEaseRestore']).'; ';
        $js .= 'jQuery.axZm.zoomEaseTraverse = '.$this->ptj($zoom['config']['zoomEaseTraverse']).'; ';

        $js .= 'jQuery.axZm.fps1 = '.$this->ptj($zoom['config']['fps1']).'; ';
        $js .= 'jQuery.axZm.fps2 = '.$this->ptj($zoom['config']['fps2']).'; ';

        $js .= $this->arrayToJSObject($zoom['config']['gpuAccel'],'jQuery.axZm.gpuAccel', false, $rn, false).'; ';

        $js .= 'jQuery.axZm.zoomLoaderEnable = '.$this->ptj($zoom['config']['zoomLoaderEnable']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderClass = '.$this->ptj($zoom['config']['zoomLoaderClass']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderTransp = '.$this->ptj($zoom['config']['zoomLoaderTransp']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFadeIn = '.$this->ptj($zoom['config']['zoomLoaderFadeIn']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFadeOut = '.$this->ptj($zoom['config']['zoomLoaderFadeOut']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderPos = '.$this->ptj($zoom['config']['zoomLoaderPos']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderMargin = '.$this->ptj($zoom['config']['zoomLoaderMargin']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderFrames = '.$this->ptj($zoom['config']['zoomLoaderFrames']).'; ';
        $js .= 'jQuery.axZm.zoomLoaderCycle = '.$this->ptj($zoom['config']['zoomLoaderCycle']).'; ';


        // Navi
        $js .= 'jQuery.axZm.displayNavi = '.$this->ptj($zoom['config']['displayNavi']).'; ';
        $js .= 'jQuery.axZm.naviZoomBut = '.$this->ptj($zoom['config']['naviZoomBut']).'; ';
        $js .= 'jQuery.axZm.naviPanBut = '.$this->ptj($zoom['config']['naviPanBut']).'; ';
        $js .= 'jQuery.axZm.naviRestoreBut = '.$this->ptj($zoom['config']['naviRestoreBut']).'; ';
        $js .= 'jQuery.axZm.naviHotspotsBut = '.$this->ptj($zoom['config']['naviHotspotsBut']).'; ';
        $js .= 'jQuery.axZm.downloadButton = '.$this->ptj($zoom['config']['downloadButton']).'; ';

        $js .= 'jQuery.axZm.naviCropButSwitch = '.$this->ptj($zoom['config']['naviCropButSwitch']).'; ';
        $js .= 'jQuery.axZm.naviPanButSwitch = '.$this->ptj($zoom['config']['naviPanButSwitch']).'; ';
        $js .= 'jQuery.axZm.naviSpinButSwitch = '.$this->ptj($zoom['config']['naviSpinButSwitch']).'; ';

        $js .= 'jQuery.axZm.deaktTransp = '.$this->ptj($zoom['config']['deaktTransp']).'; ';
        $js .= 'jQuery.axZm.disabledTransp = '.$this->ptj($zoom['config']['disabledTransp']).'; ';
        $js .= 'jQuery.axZm.naviPos = '.$this->ptj($zoom['config']['naviPos']).'; ';
        $js .= 'jQuery.axZm.naviFloat = '.$this->ptj($zoom['config']['naviFloat']).'; ';
        $js .= 'jQuery.axZm.naviHeight = '.$this->ptj($zoom['config']['naviHeight']).'; ';
        $js .= 'jQuery.axZm.naviSpace = '.$this->ptj($zoom['config']['naviSpace']).'; ';
        $js .= 'jQuery.axZm.naviGroupSpace = '.$this->ptj($zoom['config']['naviGroupSpace']).'; ';
        $js .= 'jQuery.axZm.naviMinPadding = '.$this->ptj($zoom['config']['naviMinPadding']).'; ';
        $js .= 'jQuery.axZm.naviTopMargin = '.$this->ptj($zoom['config']['naviTopMargin']).'; ';
        $js .= 'jQuery.axZm.naviBigZoom = '.$this->ptj($zoom['config']['naviBigZoom']).'; ';

        $js .= 'jQuery.axZm.naviDownState = '.$this->ptj($zoom['config']['naviDownState']).'; ';
        $js .= 'jQuery.axZm.naviOverState = '.$this->ptj($zoom['config']['naviOverState']).'; ';

        $js .= 'jQuery.axZm.pssBar = '.$this->ptj($zoom['config']['pssBar']).'; ';

        if ($zoom['config']['pssBar']){
            $js .= 'jQuery.axZm.pssBarH = '.$this->ptj($zoom['config']['pssBarH']).'; ';
            $js .= 'jQuery.axZm.pssBarM = '.$this->ptj($zoom['config']['pssBarM']).'; ';
            $js .= 'jQuery.axZm.pssBarMS = '.$this->ptj($zoom['config']['pssBarMS']).'; ';
            $js .= 'jQuery.axZm.pssBarO = '.$this->ptj($zoom['config']['pssBarO']).'; ';
            $js .= 'jQuery.axZm.pssBarP = '.$this->ptj($zoom['config']['pssBarP']).'; ';
        }

        // Scroll (mousewheel)
        $js .= 'jQuery.axZm.scroll = '.$this->ptj($zoom['config']['scroll']).'; ';
        $js .= 'jQuery.axZm.mouseScrollEnable = '.$this->ptj($zoom['config']['mouseScrollEnable']).'; ';

        $js .= $this->arrayToJSObject($zoom['config']['scrollBrowserExcl'],'jQuery.axZm.scrollBrowserExcl', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['scrollBrowserExclPar'],'jQuery.axZm.scrollBrowserExclPar', false, $rn, false).'; ';

        $js .= 'jQuery.axZm.scrollAnm = '.$this->ptj($zoom['config']['scrollAnm']).'; ';
        $js .= 'jQuery.axZm.scrollSpeed = '.$this->ptj($zoom['config']['scrollSpeed']).'; ';
        $js .= 'jQuery.axZm.scrollZoom = '.$this->ptj($zoom['config']['scrollZoom']).'; ';
        $js .= 'jQuery.axZm.scrollMotion = '.$this->ptj($zoom['config']['scrollMotion']).'; ';
        $js .= 'jQuery.axZm.scrollPanR = '.$this->ptj($zoom['config']['scrollPanR']).'; ';
        $js .= 'jQuery.axZm.scrollAjax = '.$this->ptj($zoom['config']['scrollAjax']).'; ';
        $js .= 'jQuery.axZm.scrollPause = '.$this->ptj($zoom['config']['scrollPause']).'; ';
        $js .= 'jQuery.axZm.scrollOutReversed = '.$this->ptj($zoom['config']['scrollOutReversed']).'; ';
        $js .= 'jQuery.axZm.scrollOutCenter = '.$this->ptj($zoom['config']['scrollOutCenter']).'; ';


        // Selector
        $js .= 'jQuery.axZm.zoomSelectionColor = '.$this->ptj($zoom['config']['zoomSelectionColor']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionOpacity = '.$this->ptj($zoom['config']['zoomSelectionOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomOuterColor = '.$this->ptj($zoom['config']['zoomOuterColor']).'; ';
        $js .= 'jQuery.axZm.zoomOuterOpacity = '.$this->ptj($zoom['config']['zoomOuterOpacity']).'; ';
        $js .= 'jQuery.axZm.zoomBorderColor = '.$this->ptj($zoom['config']['zoomBorderColor']).'; ';
        $js .= 'jQuery.axZm.zoomBorderWidth = '.$this->ptj($zoom['config']['zoomBorderWidth']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionAnm = '.$this->ptj($zoom['config']['zoomSelectionAnm']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionCross = '.$this->ptj($zoom['config']['zoomSelectionCross']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionCrossOp = '.$this->ptj($zoom['config']['zoomSelectionCrossOp']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionMod = '.$this->ptj($zoom['config']['zoomSelectionMod']).'; ';
        $js .= 'jQuery.axZm.zoomSelectionProp = '.$this->ptj($zoom['config']['zoomSelectionProp']).'; ';

        // Description area
        $js .= 'jQuery.axZm.zoomShowButtonDescr = '.$this->ptj($zoom['config']['zoomShowButtonDescr']).'; ';

        //if ($zoom['config']['zoomShowButtonDescr']){
            $js .= $this->arrayToJSObject($zoom['config']['mapButTitle'],'jQuery.axZm.mapButTitle', false, $rn, false).'; ';
        //}

        $js .= 'jQuery.axZm.descrAreaTransp = '.$this->ptj($zoom['config']['descrAreaTransp']).'; ';
        $js .= 'jQuery.axZm.descrAreaHideTimeOut = '.$this->ptj($zoom['config']['descrAreaHideTimeOut']).'; ';
        $js .= 'jQuery.axZm.descrAreaShowTimeOut = '.$this->ptj($zoom['config']['descrAreaShowTimeOut']).'; ';
        $js .= 'jQuery.axZm.descrAreaHideTime = '.$this->ptj($zoom['config']['descrAreaHideTime']).'; ';
        $js .= 'jQuery.axZm.descrAreaShowTime = '.$this->ptj($zoom['config']['descrAreaShowTime']).'; ';
        $js .= 'jQuery.axZm.descrAreaHeight = '.$this->ptj($zoom['config']['descrAreaHeight']).'; ';
        $js .= 'jQuery.axZm.descrAreaMotion = '.$this->ptj($zoom['config']['descrAreaMotion']).'; ';

        // Dragging
        $js .= 'jQuery.axZm.zoomDragPhysics = '.$this->ptj($zoom['config']['zoomDragPhysics']).'; ';
        $js .= 'jQuery.axZm.zoomDragAnm = '.$this->ptj($zoom['config']['zoomDragAnm']).'; ';
        $js .= 'jQuery.axZm.zoomDragSpeed = '.$this->ptj($zoom['config']['zoomDragSpeed']).'; ';
        $js .= 'jQuery.axZm.zoomDragAjax = '.$this->ptj($zoom['config']['zoomDragAjax']).'; ';
        $js .= 'jQuery.axZm.zoomDragMotion = '.$this->ptj($zoom['config']['zoomDragMotion']).'; ';

        // jscrollPane
        $js .= 'jQuery.axZm.scrollPane = '.$this->ptj($zoom['config']['scrollPane']).'; ';
        $js .= 'jQuery.axZm.scrollPaneTheme = '.$this->ptj($zoom['config']['scrollPaneTheme']).'; ';
        $js .= 'jQuery.axZm.gallerySwitchQuick = '.$this->ptj($zoom['config']['gallerySwitchQuick']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['scrollPaneOptionsVert'],'jQuery.axZm.scrollPaneOptionsVert', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['scrollPaneOptionsFull'],'jQuery.axZm.scrollPaneOptionsFull', false, $rn, false).'; ';

        // Helper
        $js .= 'jQuery.axZm.pyrDialog = '.$this->ptj($zoom['config']['pyrDialog']).'; ';
        $js .= 'jQuery.axZm.gPyramidDialog = '.$this->ptj($zoom['config']['gPyramidDialog']).'; ';
        $js .= 'jQuery.axZm.zoomStat = '.$this->ptj($zoom['config']['zoomStat']).'; '; // depreciated
        $js .= 'jQuery.axZm.zoomStatHeight = '.$this->ptj($zoom['config']['zoomStatHeight']).'; '; // depreciated
        $js .= 'jQuery.axZm.useSess = '.$this->ptj($zoom['config']['useSess']).'; ';
        $js .= 'jQuery.axZm.cursorWait = '.$this->ptj($zoom['config']['cursorWait']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['cursor'],'jQuery.axZm.cursor', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['preloadImg'],'jQuery.axZm.preloadImg', false, $rn, false).'; ';


        $js .= 'jQuery.axZm.fullZoomBorder = '.$this->ptj($zoom['config']['fullZoomBorder']).'; ';
        $js .= 'jQuery.axZm.fullZoomOutBorder = '.$this->ptj($zoom['config']['fullZoomOutBorder']).'; ';

        $js .= 'jQuery.axZm.zoomTimeOut = '.$this->ptj($zoom['config']['zoomTimeOut']).'; ';
        $js .= 'jQuery.axZm.quirks = '.$this->ptj($zoom['config']['quirks']).'; ';
        $js .= 'jQuery.axZm.zoomWarningBrowser = '.$this->ptj($zoom['config']['zoomWarningBrowser']).'; ';
        $js .= 'jQuery.axZm.msInterp = '.$this->ptj($zoom['config']['msInterp']).'; ';
        $js .= 'jQuery.axZm.help = '.$this->ptj($zoom['config']['help']).'; ';
        $js .= 'jQuery.axZm.helpTransp = '.$this->ptj($zoom['config']['helpTransp']).'; ';
        $js .= 'jQuery.axZm.helpTime = '.$this->ptj($zoom['config']['helpTime']).'; ';
        $js .= 'jQuery.axZm.zoomLoadFile = '.$this->ptj($zoom['config']['zoomLoadFile']).'; ';
        $js .= 'jQuery.axZm.zoomLoadSess = '.$this->ptj($zoom['config']['zoomLoadSess']).'; ';
        $js .= 'jQuery.axZm.layVertCenter = '.$this->ptj($zoom['config']['layVertCenter']).'; ';
        $js .= 'jQuery.axZm.innerMargin = '.$this->ptj($zoom['config']['innerMargin']).'; ';
        $js .= 'jQuery.axZm.cornerRadius = '.$this->ptj($zoom['config']['cornerRadius']).'; ';
        $js .= 'jQuery.axZm.vWtrmrk = '.$this->ptj($zoom['config']['vWtrmrk']).'; ';

        if (is_array($zoom['config']['notTouchUA']) && !empty($zoom['config']['notTouchUA'])){
            $js .= $this->arrayToJSObject($zoom['config']['notTouchUA'],'jQuery.axZm.notTouchUA', false, $rn, false).'; ';
        }

        // Layers
        $js .= 'jQuery.axZm.backLayer = '.$this->ptj($zoom['config']['backLayer']).'; ';
        $js .= 'jQuery.axZm.backDiv = '.$this->ptj($zoom['config']['backDiv']).'; ';
        $js .= 'jQuery.axZm.backInnerDiv = '.$this->ptj($zoom['config']['backInnerDiv']).'; ';
        $js .= 'jQuery.axZm.picLayer = '.$this->ptj($zoom['config']['picLayer']).'; ';
        $js .= 'jQuery.axZm.overLayer = '.$this->ptj($zoom['config']['overLayer']).'; ';

        // Stat info
        $js .= 'jQuery.axZm.zoomLogInfo = '.$this->ptj($zoom['config']['zoomLogInfo']).'; ';
        $js .= 'jQuery.axZm.zoomLogJustLevel = '.$this->ptj($zoom['config']['zoomLogJustLevel']).'; ';
        $js .= 'jQuery.axZm.zoomLogLevel  = '.$this->ptj($zoom['config']['zoomLogLevel']).'; ';
        $js .= 'jQuery.axZm.zoomLogTime = '.$this->ptj($zoom['config']['zoomLogTime']).'; ';
        $js .= 'jQuery.axZm.zoomLogTraffic = '.$this->ptj($zoom['config']['zoomLogTraffic']).'; ';
        $js .= 'jQuery.axZm.zoomLogSeconds = '.$this->ptj($zoom['config']['zoomLogSeconds']).'; ';
        $js .= 'jQuery.axZm.zoomLogLoading = '.$this->ptj($zoom['config']['zoomLogLoading']).'; ';

        // Help Text
        $js .= 'jQuery.axZm.helpTxt = '.$this->ptj(str_replace('[icon]', $zoom['config']['icon'], $zoom['config']['helpTxt'])).'; ';

        $js .= 'jQuery.axZm.tapHideAll = '.$this->ptj($zoom['config']['tapHideAll']).'; ';
        $js .= 'jQuery.axZm.zoomDoubleClickTap = '.$this->ptj($zoom['config']['zoomDoubleClickTap']).'; ';
        $js .= 'jQuery.axZm.polyfill = '.$this->ptj($zoom['config']['polyfill']).'; ';

        $js .= 'jQuery.axZm.touchDragPageScroll = '.$this->ptj($zoom['config']['touchDragPageScroll']).'; ';
        $js .= 'jQuery.axZm.touchDragPageScrollZoomed = '.$this->ptj($zoom['config']['touchDragPageScrollZoomed']).'; ';
        
        $js .= 'jQuery.axZm.touchSpinPageScroll = '.$this->ptj($zoom['config']['touchSpinPageScroll']).'; ';
        $js .= 'jQuery.axZm.touchPageScrollExcl = '.$this->ptj($zoom['config']['touchPageScrollExcl']).'; ';
        
        
        // Icon files
        if ($zoom['config']['naviBigZoom']){
            $zoom['config']['icons']['zoomIn'] = $zoom['config']['icons']['zoomInBig'];
            $zoom['config']['icons']['zoomOut'] = $zoom['config']['icons']['zoomOutBig'];
        }
        $js .= 'jQuery.axZm.buttonSet = '.$this->ptj($zoom['config']['buttonSet']).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['icons'],'jQuery.axZm.icons', false, $rn, false).'; ';
        $js .= $this->arrayToJSObject($zoom['config']['mNavi'],'jQuery.axZm.mNavi', false, $rn, false).'; ';

        if ($zoom['config']['fullScreenEnable']){
            $js .= 'jQuery.axZm.fullScreenEnable = '.$this->ptj($zoom['config']['fullScreenEnable']).'; ';
            $js .= 'jQuery.axZm.fullScreenNaviBar = '.$this->ptj($zoom['config']['fullScreenNaviBar']).'; ';

            $js .= 'jQuery.axZm.fullScreenCornerButton = '.$this->ptj($zoom['config']['fullScreenCornerButton']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonPos = '.$this->ptj($zoom['config']['fullScreenCornerButtonPos']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMarginX = '.$this->ptj($zoom['config']['fullScreenCornerButtonMarginX']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMarginY = '.$this->ptj($zoom['config']['fullScreenCornerButtonMarginY']).'; ';
            $js .= 'jQuery.axZm.fullScreenCornerButtonMouseOver = '.$this->ptj($zoom['config']['fullScreenCornerButtonMouseOver']).'; ';

            $js .= 'jQuery.axZm.fullScreenNaviButton = '.$this->ptj($zoom['config']['fullScreenNaviButton']).'; ';
            $js .= 'jQuery.axZm.fullScreenExitText = '.$this->ptj($zoom['config']['fullScreenExitText']).'; ';
            $js .= 'jQuery.axZm.fullScreenExitTimeout = '.$this->ptj($zoom['config']['fullScreenExitTimeout']).'; ';

            $js .= 'jQuery.axZm.fullScreenVertGallery = '.$this->ptj($zoom['config']['fullScreenVertGallery']).'; ';
            $js .= 'jQuery.axZm.fullScreenHorzGallery = '.$this->ptj($zoom['config']['fullScreenHorzGallery']).'; ';
            $js .= 'jQuery.axZm.fullScreenRel = '.$this->ptj($zoom['config']['fullScreenRel']).'; ';

            $js .= 'jQuery.axZm.fullScreenMapFract = '.$this->ptj($zoom['config']['fullScreenMapFract']).'; ';
            $js .= 'jQuery.axZm.fullScreenMapWidth = '.$this->ptj($zoom['config']['fullScreenMapWidth']).'; ';
            $js .= 'jQuery.axZm.fullScreenMapHeight = '.$this->ptj($zoom['config']['fullScreenMapHeight']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['fullScreenKeepZoom'],'jQuery.axZm.fullScreenKeepZoom', false, $rn, false).'; ';
            $js .= 'jQuery.axZm.fullScreenApi = '.$this->ptj($zoom['config']['fullScreenApi']).'; ';
            $js .= $this->arrayToJSObject($zoom['config']['fullScreenSpace'],'jQuery.axZm.fullScreenSpace', false, $rn, false).'; ';
        }
        
        $js .= 'jQuery.axZm.autoBackColor = '.$this->ptj($zoom['config']['autoBackColor']).'; ';
        
        if (isset($zoom['config']['iff'])){$js .= 'jQuery.axZm.iff = '.$this->ptj($zoom['config']['iff']).'; ';}
        if (isset($zoom['config']['ift'])){$js .= 'jQuery.axZm.iff = '.$this->ptj($zoom['config']['ift']).'; ';}
         
        if (!empty($this->readTime)){
            $js .= $this->arrayToJSObject($this->readTime,'jQuery.axZm.readTime', false, $rn, false).'; ';
        }

        // Ver. 4.2.1
        $js .= $this->arrayToJSObject($zoom['config']['stepPicDim'],'jQuery.axZm.stepPicDim', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.stepPicPreload = '.$this->ptj($zoom['config']['stepPicPreload']).'; ';
        $js .= 'jQuery.axZm.stepPicOnZoom = '.$this->ptj($zoom['config']['stepPicOnZoom']).'; ';

        $js .= 'jQuery.axZm.subfolderStructure = '.$this->ptj($zoom['config']['subfolderStructure']).'; ';
        $js .= 'jQuery.axZm.lT = '.$this->ptj($zoom['config']['licenceType']).'; ';
        $js .= 'jQuery.axZm.lK = '.$this->ptj(($zoom['config']['licenceKey'] == 'demo' ? 'demo' : true)).'; ';

        // Gallery array
        if ($zoom['config']['galArray']){
            $js .= $this->arrayToJSObject($zoom['config']['galArray'],'jQuery.axZm.zoomGA', false, $rn, false).'; ';
        }

        if (!$zoom['config']['galArray']){
            $js .= 'jQuery.axZm.noImages = true; ';
        }

        if (isset($zoom['config']['folderArray']) && !empty($zoom['config']['folderArray'])){
            $js .= $this->arrayToJSObject($zoom['config']['folderArray'],'jQuery.axZm.folderArray', false, $rn, false).'; ';
        }

        // Pack Javascript
        if ($pack){
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        }

        elseif ($rn){
            $js = str_replace('; ',";".$rnStr,$js);
        }


        $js = "\n<script type=\"text/javascript\">$rnStr$js$rnStr</script>$rnStr";

        return $js;
    }
    
    public function draw360JsVariationSet($zoom){
        $js = array();
        if (!$zoom['config']['galArray']){
            $js['noImages'] = true;
            return json_encode ($js);
        }
        
        $js['ow'] = $zoom['config']['orgImgSize'][0];
        $js['oh'] = $zoom['config']['orgImgSize'][1];
        
        
        $js['thumbs'] = $zoom['config']['thumbs'];
        $js['smallImgPath'] = $zoom['config']['thumbs'];
        $js['smallImg'] = $zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName'];
        
       

        if (isset($zoom['config']['zAxis'])){
            $js['zAxis'] = $zoom['config']['zAxis'];
            $js['zFolder'] = $zoom['config']['zFolder'];
        }
        
        $js['parToPass'] = $zoom['config']['parToPass'];
        
        if ($zoom['config']['cropNoObj']){
            $js['pic'] = $zoom['config']['pic'];
            $js['orgPath'] = $zoom['config']['pic'];
        }
        
        $js['zoomGA'] = $zoom['config']['galArray'];
        
        return json_encode ($js);
    }

    /**
      * Outputs all needed variables in javascript by loading a different gallery set over ajax
      * @access public
      * @param array $zoom
      * @param bool $rn Linebreak after each line of code
      * @param bool $pack Use packer for output
      * @return HTML-Output
      **/
    public function drawZoomJsGallerySet($zoom, $rn = false, $pack = true){
        $rnStr = '';
        if ($rn){$rnStr = "\n";}

        $js = '';

        $js .= 'jQuery.axZm.zoomID = '.$this->ptj($_GET['zoomID']).'; ';
        $js .= 'jQuery.axZm.pZoomID = '.$this->ptj($zoom['config']['pZoomID']).'; ';
        $js .= 'jQuery.axZm.randNum = '.$this->ptj($this->rndNum(24)).'; ';

        $js .= 'jQuery.axZm.icon = '.$this->ptj($zoom['config']['icon']).'; ';
        $js .= 'jQuery.axZm.iconDir = '.$this->ptj($zoom['config']['icon']).'; '; // Alias

        $js .= 'jQuery.axZm.thumbs = '.$this->ptj($zoom['config']['thumbs']).'; ';
        $js .= 'jQuery.axZm.smallImgPath = '.$this->ptj($zoom['config']['thumbs']).'; '; // Alias
        $js .= 'jQuery.axZm.smallImg = '.$this->ptj($zoom['config']['thumbs'].$this->md5path($zoom['config']['smallImgName'], $zoom['config']['subfolderStructure']).$zoom['config']['smallImgName']).'; ';

        $js .= 'jQuery.axZm.iw = '.$this->ptj($zoom['config']['smallImgSize'][0]).'; ';
        $js .= 'jQuery.axZm.ih = '.$this->ptj($zoom['config']['smallImgSize'][1]).'; ';
        $js .= 'jQuery.axZm.ow = '.$this->ptj($zoom['config']['orgImgSize'][0]).'; ';
        $js .= 'jQuery.axZm.oh = '.$this->ptj($zoom['config']['orgImgSize'][1]).'; ';

        $js .= 'jQuery.axZm.smallFileSize = '.$this->ptj($zoom['config']['smallFileSize']).'; ';
        $js .= 'jQuery.axZm.parToPass = '.$this->ptj($zoom['config']['parToPass']).'; ';
        
        
        
        // Ver. 2.1.5+
        //$js .= 'jQuery.axZm.fileType = '.$this->ptj($this->getl('.', $zoom['config']['orgImgName'])).'; ';
        //$js .= 'jQuery.axZm.fileBase = '.$this->ptj($this->getf('.', $zoom['config']['orgImgName'])).'; ';

        if ($zoom['config']['cropNoObj']){
            $js .= 'jQuery.axZm.pic = '.$this->ptj($zoom['config']['pic']).'; ';
            $js .= 'jQuery.axZm.orgPath = '.$this->ptj($zoom['config']['pic']).'; '; // Alias
        }

        // Gallery array
        if ($zoom['config']['galArray']){
            $js .= $this->arrayToJSObject($zoom['config']['galArray'],'jQuery.axZm.zoomGA', false, $rn, false).'; ';
        }


        if (!$zoom['config']['galArray']){
            $js .= 'jQuery.axZm.noImages = true; ';
        }


        if ($zoom['config']['spinMod']){
            if (isset($zoom['config']['zAxis'])){
                $js .= $this->arrayToJSObject($zoom['config']['zAxis'],'jQuery.axZm.zAxis', false, $rn, false).'; ';
                $js .= $this->arrayToJSObject($zoom['config']['zFolder'],'jQuery.axZm.zFolder', false, $rn, true).'; ';
                $js .= 'jQuery.axZm.spinReverseZ = '.$this->ptj($zoom['config']['spinReverseZ']).'; ';
                $js .= 'jQuery.axZm.spinSensitivityZ = '.$this->ptj($zoom['config']['spinSensitivityZ']).'; ';

                if (isset($_GET['firstAxis'])){
                    $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($_GET['firstAxis']).'; ';
                } elseif(isset($zoom['config']['firstAxis'])){
                    $js .= 'jQuery.axZm.firstAxis = '.$this->ptj($zoom['config']['firstAxis']).'; ';
                } else {
                    $js .= 'jQuery.axZm.firstAxis = false; ';
                }

            }else{
                $js .= 'jQuery.axZm.zAxis = false; ';
                $js .= 'jQuery.axZm.zFolder = false; ';
                $js .= 'jQuery.axZm.firstAxis = false; ';
            }
        }

        // Ver. 4.2.1
        $js .= $this->arrayToJSObject($zoom['config']['stepPicDim'],'jQuery.axZm.stepPicDim', false, $rn, false).'; ';
        $js .= 'jQuery.axZm.stepPicPreload = '.$this->ptj($zoom['config']['stepPicPreload']).'; ';

        if (!empty($this->readTime)){
            $js .= $this->arrayToJSObject($this->readTime,'jQuery.axZm.readTime', false, $rn, false).'; ';
        }

        // Dialog when cTimeCompare deleted old tiles
        if ($zoom['config']['cTimeCompareDialog'] == true && is_array($this->returnCTimeCompare)){
            $js .= 'setTimeout(function(){jQuery.fn.axZm.zoomAlert(\'Option cTimeCompare considered to regenerate tiles and all other dynamically generated images: <br><br>'.implode(', ', $this->returnCTimeCompare).';<br><br>If you did not change the source images or AJAX-ZOOM mistakenly regenerates these images, then please disable cTimeCompare in zoomConfig.inc.php and zoomConfigCustom.inc.php<br><br>\',\'Old tiles deleted! Why that?\', \''.$this->msgNoteInstr.'\'); },1000);';
        }

        // Dialog if first image has been made...
        if (isset($this->returnMakeFirstImage)){
            if (!is_bool($this->returnMakeFirstImage)){
                $js .= $this->removeScriptTags($this->returnMakeFirstImage);
            }
        }

        // Dialog if zoom tiles have been made...
        if (isset($this->returnMakeZoomTiles)){
            if (!is_bool($this->returnMakeZoomTiles)){
                $js .= $this->removeScriptTags($this->returnMakeZoomTiles);
            }
        }

        // Dialog after thumbs generation
        if (isset($this->returnMakeAllThumbs)){
            if (!is_bool($this->returnMakeAllThumbs)){
                $js .= $this->removeScriptTags($this->returnMakeAllThumbs);
            }
        }

        // Error dialog if images missing on filesystem
        if (isset($this->fileErrorDialog)){
            if (!is_bool($this->fileErrorDialog)){
                $js .= $this->removeScriptTags($this->fileErrorDialog);
            }
        }

        // Pack Javascript
        if ($pack){
            $myPacker = new JavaScriptPacker($js, 'Normal', true, false);
            $js = $myPacker->pack();
        }

        elseif ($rn){
            $js = str_replace('; ',";".$rnStr,$js);
        }


        /*$js = "\n<script type=\"text/javascript\">$rnStr$js$rnStr</script>$rnStr";*/
        return $js;
    }

    function getBrowserInfo() {
        $SUPERCLASS_NAMES  = "gecko,mozilla,mosaic,webkit";
        $SUPERCLASSES_REGX = "(?:".str_replace(",", ")|(?:", $SUPERCLASS_NAMES).")";

        $SUBCLASS_NAMES    = "opera,msie,firefox,chrome,safari";
        $SUBCLASSES_REGX   = "(?:".str_replace(",", ")|(?:", $SUBCLASS_NAMES).")";

        $browser      = "unsupported";
        $majorVersion = "0";
        $minorVersion = "0";
        $fullVersion  = "0.0";
        $os           = 'unsupported';

        $userAgent    = strtolower($_SERVER['HTTP_USER_AGENT']);

        $found = preg_match("/(?P<browser>".$SUBCLASSES_REGX.")(?:\D*)(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches);
        if (!$found) {
            $found = preg_match("/(?P<browser>".$SUPERCLASSES_REGX.")(?:\D*)(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches);
        }

        if ($found) {
            $browser      = $matches["browser"];
            $majorVersion = $matches["majorVersion"];
            $minorVersion = $matches["minorVersion"];
            $fullVersion  = $matches["majorVersion"].$matches["minorVersion"];
            if ($browser != "safari") {
                if (preg_match("/version\/(?P<majorVersion>\d*)(?P<minorVersion>(?:\.\d*)*)/i",$userAgent, $matches)){
                    $majorVersion = $matches["majorVersion"];
                    $minorVersion = $matches["minorVersion"];
                    $fullVersion  = $majorVersion.".".$minorVersion;
                }
            }
            if ($browser == "msie") {
                if (stristr($userAgent, 'Trident/5.0')){
                    $majorVersion = 9;
                    $minorVersion = 0;
                    $fullVersion  = $majorVersion.".".$minorVersion;
                }
            }
        }

        if (strpos($userAgent, 'linux')) {
            $os = 'linux';
        }
        else if (strpos($userAgent, 'macintosh') || strpos($userAgent, 'mac os x')) {
            $os = 'mac';
        }
        else if (strpos($userAgent, 'windows') || strpos($userAgent, 'win32')) {
            $os = 'windows';
        }

        return array(
            "browser"      => $browser,
            "majorVersion" => $majorVersion,
            "minorVersion" => $minorVersion,
            "fullVersion"  => $fullVersion,
            "os"           => $os);
    }

    function icon($zoom, $name, $ins = ''){
        $exclArr1 = array('prev', 'next', 'play');
        $exclArr2 = array('arrowLeft', 'arrowRight');

        if ($zoom['config']['displayNavi']
            || $zoom['config']['fullScreenNaviBar']
            || ($zoom['config']['galleryNavi'] && $zoom['config']['galleryNaviPos'] && in_array($name, $exclArr1))
            || (($zoom['config']['useHorGallery'] || $zoom['config']['fullScreenHorzGallery']) && in_array($name, $exclArr2))
        ){
            $iconSrc = $zoom['config']['icon'].$zoom['config']['icons'][$name]['file'].$ins.'.'.$zoom['config']['icons'][$name]['ext'];
        }else{
            $iconSrc = $zoom['config']['icon'].'empty.gif';
        }
        return "src=\"".$iconSrc."\" width=\"".$zoom['config']['icons'][$name]['w']."\" height=\"".$zoom['config']['icons'][$name]['h']."\" alt=\"".$zoom['config']['mapButTitle'][$name]."\" unselectable=\"on\" title=\"\"";
    }

    /**
      * This method outputs the main html for zoom
      * @access public
      * @param array $zoom
      * @param array $zoomTmp
      * @param array $op Options
      * @return HTML-Output
      **/
    public function drawZoomBox($zoom, $zoomTmp){

        // Browser
        $browser = $this->getBrowserInfo();

        $return='';

        // $zoomW=$zoom['config']['smallImgSize'][0];
        $zoomW = 924;
        $zoomH=$zoom['config']['smallImgSize'][1];

        // if ($zoom['config']['keepBoxW']){$zoomW=$zoom['config']['picX'];}
        if ($zoom['config']['keepBoxH']){$zoomH=$zoom['config']['picY'];}

        $extPix = intval($zoom['config']['innerMargin']*2);
        $extPixBoth = 0;
        $extPixGal = 0;
        $zoomGalWidth = 0;

        if ($zoom['config']['useGallery'] AND $zoom['config']['galleryMarginLeft']){
            $extPix += $zoom['config']['galleryMarginLeft'];
            $extPixBoth += $zoom['config']['galleryMarginLeft'];
        }



        // Vertical gallery
        if ($zoom['config']['useGallery']){
            $galleryThumbSpace = $zoom['config']['galPicX'] +
            $zoom['config']['galleryCssMargin'] +
            $zoom['config']['galleryCssBorderWidth'] * 2 +
            $zoom['config']['galleryCssPadding'] * 2;

            $gallerySpace = $zoom['config']['galleryScrollbarWidth'] + $galleryThumbSpace;

            if ($zoom['config']['galleryLines'] > 1){
                $gallerySpace += ($zoom['config']['galleryLines'] - 1) * $galleryThumbSpace;
            }

            $extPixGal = $gallerySpace + $extPix;
            $zoomGalWidth = $gallerySpace;
        }else{
            $extPixGal = $extPix;
        }

        $zoomGalHeight = $zoomH + $extPix;

        if ($zoom['config']['displayNavi']){
            $zoomGalHeight += $zoom['config']['naviHeight'];
        }


        if ($zoom['config']['zoomStat'] AND $zoom['config']['zoomStatHeight']){
            $zoomGalHeight += (int)$zoom['config']['zoomStatHeight'];
        }

        // Add height for horizontal gallery
        if ($zoom['config']['useHorGallery']){
            $zoomGalHeight += (int)$zoom['config']['galHorHeight'] + $zoom['config']['galHorMarginTop'] + $zoom['config']['galHorMarginBottom'];
        }

        // Add height for the slider
        if ($zoom['config']['spinMod'] && $zoom['config']['spinSlider']){
            $zoomGalHeight += $zoom['config']['spinSliderContainerHeight'];
        }


        $deviderTD = "<td style='width: ".($zoom['config']['naviGroupSpace'])."px'>";
        $deviderTD .= "<img src='".$zoom['config']['icon']."empty.gif' style='width: ".round($zoom['config']['naviGroupSpace']/2)."px; height: 10px;' alt='' title=''>";
        $deviderTD .= "</td>";

        // Prev Next buttons
        $galleryNavi = '';
        if ($zoom['config']['galleryNavi']){

            $galleryNavi = "<table cellspacing='0' cellpadding='0' style='height: ".$zoom['config']['galleryNaviHeight']."px'><tbody><tr>";
                $galleryNavi .= "<td style='width: ".($zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['prev']['w'])."px; text-align: left; vertical-align: middle;'>";
                    $galleryNavi .= "<img id='axZm_zoomNaviPrev' ".$this->icon($zoom, 'prev').">";
                $galleryNavi .= "</td>";

                if ($zoom['config']['galleryPlayButton']){
                    $galleryNavi .= "<td style='width: ".($zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['play']['w'])."px; text-align: left; vertical-align: middle;'>";
                        $galleryNavi .= "<img id='axZm_zoomNaviPlayPause' ".$this->icon($zoom, 'play').">";
                    $galleryNavi .= "</td>";
                }

                $galleryNavi .= "<td style='width: ".($zoom['config']['icons']['next']['w'])."px; text-align: left; vertical-align: middle;'>";
                    $galleryNavi .= "<img id='axZm_zoomNaviNext' ".$this->icon($zoom, 'next').">";
                $galleryNavi .= "</td>";
            $galleryNavi .= "</tr></tbody></table>";

            $galleryNavi = "<div id='axZm_zoomGalleryNaviButtons' style='float: right'>".$galleryNavi."</div>";
        }


        // Horizontal Gallery
        $horGallery = '';
        if ($zoom['config']['useHorGallery']){
            $horGalHeightExt = 0;
            if($zoom['config']['quirks'] AND $browser['browser'] == 'msie'){
                $horGalHeightExt = $zoom['config']['galHorMarginTop'] + $zoom['config']['galHorMarginBottom'];
            }
            $horGallery .= "<div id='axZm_zoomGalHorCont' class='axZm_zoomGalleryHorizontalContainer' style='padding: ".$zoom['config']['galHorMarginTop']."px 0px ".$zoom['config']['galHorMarginBottom']."px 0px; width:".($zoomW+$extPix)."px; height: ".($zoom['config']['galHorHeight']+$horGalHeightExt)."px'>";
                $horGallery .= "<div id='axZm_zoomGalHor' class='axZm_zoomGalleryHorizontal' style='margin: 0px 0px 0px ".$zoom['config']['innerMargin']."px; width:".$zoomW."px; height: ".$zoom['config']['galHorHeight']."px'>";

                    $horGalArrowMarginTop = floor(($zoom['config']['galHorHeight'] - $zoom['config']['icons']['arrowLeft']['h'])/2);

                    if ($zoom['config']['galHorArrows']){
                        $horGallery .= "<div id='axZm_zoomGalHorArrowLeft' class='axZm_zoomGalleryHorizontalArrow' style='float: left; height: ".$zoom['config']['galHorHeight']."px; width: ".$zoom['config']['galHorArrowWidth']."px'>";
                            $horGallery .= "<img id='axZm_horGalLeft' align='left' style='margin-top: ".$horGalArrowMarginTop."px;' ".$this->icon($zoom, 'arrowLeft').">";
                        $horGallery .= "</div>";
                    }

                    $horGalleryInnerWidth = $zoomW - ( ($zoom['config']['galHorArrows'] === true) ? ($zoom['config']['galHorArrowWidth']*2) : 0);

                    $horGalleryInnerCorner = '';
                    if ($zoom['config']['galHorInnerCorner'] AND $zoom['config']['galHorInnerCornerWidth']){
                        $horGalCornW = $zoom['config']['galHorInnerCornerWidth'];
                        $horGalleryInnerCornerImage = $zoom['config']['icon'].$zoom['config']['galHorInnerCornerImage'];
                        $horGalleryInnerCorner = "
                        <div class='axZm_zoomGalleryHorizontalCorner' style='left: 0px; top: 0px; width: ".$horGalCornW."px; height: ".$horGalCornW."px; background-image: url($horGalleryInnerCornerImage);'></div>
                        <div class='axZm_zoomGalleryHorizontalCorner' style='right: 0px; top: 0px; width: ".$horGalCornW."px; height: ".$horGalCornW."px; background-image: url($horGalleryInnerCornerImage); background-position: -".$horGalCornW."px 0px;'></div>
                        <div class='axZm_zoomGalleryHorizontalCorner' style='right: 0px; bottom: 0px; width: ".$horGalCornW."px; height: ".$horGalCornW."px; background-image: url($horGalleryInnerCornerImage); background-position: -".$horGalCornW."px -".$horGalCornW."px;'></div>
                        <div class='axZm_zoomGalleryHorizontalCorner' style='left: 0px; bottom: 0px; width: ".$horGalCornW."px; height: ".$horGalCornW."px; background-image: url($horGalleryInnerCornerImage); background-position: 0px -".$horGalCornW."px;'></div>
                        ";
                    }

                    $horGallery .= "
                    <div id='axZm_zoomGalHorArea' style='position: relative; float: left; overflow: hidden; width: ".$horGalleryInnerWidth."px; height: ".$zoom['config']['galHorHeight']."px;'>
                        <div id='axZm_zoomGalHorDiv' style='position: absolute; width:99999px; height: ".$zoom['config']['galHorHeight']."px;'></div>
                        $horGalleryInnerCorner
                    </div>";

                    if ($zoom['config']['galHorArrows']){
                        $horGallery .= "<div id='axZm_zoomGalHorArrowRight' class='axZm_zoomGalleryHorizontalArrow' style='float: right; height: ".$zoom['config']['galHorHeight']."px; width: ".$zoom['config']['galHorArrowWidth']."px'>";
                            $horGallery .= "<img id='axZm_horGalRight' align='right' style='margin-top: ".$horGalArrowMarginTop."px;' ".$this->icon($zoom, 'arrowRight').">";
                        $horGallery .= "</div>";
                    }


                $horGallery .= "</div>";
            $horGallery .= "</div>";
        }

        // Slider for 360 spin
        $zoomSliderSpin = '';
        if ($zoom['config']['spinMod'] && $zoom['config']['spinSlider']){
            if ($zoom['config']['spinSliderWidth'] && $zoom['config']['spinSliderContainerPadding']['left'] ==  $zoom['config']['spinSliderContainerPadding']['right']){
                $zoom['config']['spinSliderContainerPadding']['left'] = ($zoomW+$extPix - $zoom['config']['spinSliderWidth'])/2;
                $zoom['config']['spinSliderContainerPadding']['right'] = $zoom['config']['spinSliderContainerPadding']['left'];
            }

            $zoomSliderSpin .= "<div id='axZm_zoomSliderSpinContainer' class='".$zoom['config']['spinSliderClass']."' style='width:".($zoomW+$extPix)."px; height:".$zoom['config']['spinSliderContainerHeight']."px;'>";
                $zoomSliderSpin .= "<div style='height: 30px; margin: ".$zoom['config']['spinSliderContainerPadding']['top']."px ".$zoom['config']['spinSliderContainerPadding']['right']."px ".$zoom['config']['spinSliderContainerPadding']['bottom']."px  ".$zoom['config']['spinSliderContainerPadding']['left']."px;'>";
                    $zoomSliderWrapWidth = $zoomW+$extPix-$zoom['config']['spinSliderContainerPadding']['right'] - $zoom['config']['spinSliderContainerPadding']['left'];

                    if ($zoom['config']['spinSliderPlayButton']){
                        $zoomSliderSpin .= "<div style='margin-right: 20px; width: ".$zoom['config']['icons']['spinPlay']['w']."px; height: ".$zoom['config']['icons']['spinPlay']['h']."px; float: left;'>";
                            $zoomSliderSpin .= "<img id='axZm_spinPlayPause' ".$this->icon($zoom, 'spinPlay')." style='display: none'>";
                        $zoomSliderSpin .= "</div>";

                        $zoomSliderWrapWidth = $zoomSliderWrapWidth - $zoom['config']['icons']['spinPlay']['w'] - 20;
                    }

                    $zoomSliderSpin .= "<div style='float: left; width: ".$zoomSliderWrapWidth."px; padding-top: ".$zoom['config']['spinSliderTopMargin']."px;'>";
                        $zoomSliderSpin .= "<div id='axZm_zoomSliderSpin' style='font-size: ".$zoom['config']['spinSliderHandleSize']."px; height: ".$zoom['config']['spinSliderHeight']."px; ".($zoom['config']['spinSliderWidth'] ? ' width: '.$zoom['config']['spinSliderWidth'].'px;' : '')."'></div>";
                    $zoomSliderSpin .= "</div>";

                $zoomSliderSpin .= "</div>";
            $zoomSliderSpin .= "</div>";
        }

        // Navigation
        $zoomNavi = '';

        if ($zoom['config']['spinSliderPosition'] == 'naviTop'){
            $zoomNavi .= $zoomSliderSpin;
        }

        $zoomNavi .= "<div id='axZm_zoomNavigation' class='axZm_zoomNavigation' style='width:".($zoomW+$extPix)."px; height:".$zoom['config']['naviHeight']."px; display: ".( $zoom['config']['displayNavi'] ? 'block' : 'none' )."'>"; //
            // $zoom['config']['innerMargin']
            // $zoom['config']['cornerRadius']

            $navFloat = 'left';

            if ($zoom['config']['useGallery'] AND $zoom['config']['galleryMarginLeft'] AND $zoom['config']['galleryPos'] == 'left'){
                $navFloat = 'right';
            }

            $navMargin = "margin: ".$zoom['config']['naviTopMargin']."px ".$zoom['config']['innerMargin']."px 0px ".$zoom['config']['innerMargin']."px;";
            $navWidth = $zoomW;

            // Min margin
            if ($zoom['config']['innerMargin'] < $zoom['config']['naviMinPadding']){
                $dMargin = $zoom['config']['naviMinPadding'] - $zoom['config']['innerMargin'];
                if ($zoom['config']['useGallery']){ // only on side
                    $navWidth = $navWidth - $dMargin;
                    if ($zoom['config']['galleryPos'] == 'left'){
                        $navMargin = "margin: ".$zoom['config']['naviTopMargin']."px ".($dMargin+$zoom['config']['innerMargin'])."px 0px 0px;";
                    }elseif($zoom['config']['galleryPos'] == 'right'){
                        $navMargin = "margin: ".$zoom['config']['naviTopMargin']."px 0px 0px ".($dMargin+$zoom['config']['innerMargin'])."px;";
                    }
                }else{
                    $navWidth = $navWidth - ($dMargin * 2);
                    $navMargin = "margin: ".$zoom['config']['naviTopMargin']."px ".($dMargin+$zoom['config']['innerMargin'])."px 0px ".($dMargin+$zoom['config']['innerMargin'])."px;";
                }
            }

            $zoomNavi .= "<div id='axZm_zoomNaviInner' style='display: inline; float: $navFloat; text-align: left; padding: 0px; width: ".$navWidth."px; $navMargin'>";

                $zoomNavi .= "<table id='axZm_zoomNaviTableOuter' cellspacing='0' cellpadding='0' style='padding: 0px; margin: 0px; width:".($navWidth)."px; height: ".($zoom['config']['naviHeight']-$zoom['config']['naviTopMargin'])."px'><tbody><tr>";

                    $naviInfo = '';
                    $naviInfoAlign = ($zoom['config']['naviFloat'] == 'right') ? 'left' : 'right';

                    // Optionaly disable zoom level
                    if (!$zoom['config']['zoomLogInfoDisabled']){
                        if ($zoom['config']['zoomLogInfo']){
                            $naviInfo .= "<td>";
                                $naviInfo .= "<div id='axZm_zoomLogHolder' class='axZm_zoomLogHolder' style='float: ".$naviInfoAlign."; text-align: ".$naviInfoAlign.";'>";
                                    $naviInfo .= "<div id='axZm_zoomTime' class='axZm_zoomLog'></div>";
                                    $naviInfo .= "<div id='axZm_zoomLevel' class='axZm_zoomLog'></div>";
                                    $naviInfo .= "<div id='axZm_zoomTraffic' class='axZm_zoomLog'></div>";
                                $naviInfo .= "</div>";
                            $naviInfo .= "</td>";
                        }elseif ($zoom['config']['zoomLogJustLevel']){
                            $naviInfo .= "<td style='vertical-align: top;'>";
                                $naviInfo .= "<div id='axZm_zoomLogHolder' class='axZm_zoomLogHolder'  style='float: ".$naviInfoAlign."; text-align: ".$naviInfoAlign.";'>";
                                    $naviInfo .= "<div id='axZm_zoomLevel' class='axZm_zoomLogJustLevel'></div>";
                                $naviInfo .= "</div>";
                            $naviInfo .= "</td>";
                        }
                    }

                    $naviButtons = "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle;'>";

                        // Button Navi
                        $naviButtons .= "<table id='axZm_zoomNaviTable' cellspacing='0' cellpadding='0' style='float: ".$zoom['config']['naviFloat']."'><tbody><tr>";

                            $toolsSpacer = false;

                            // Pan button
                            if ($zoom['config']['naviPanButSwitch']){
                                $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['pan']['w'] + $zoom['config']['naviSpace'])."px'>";
                                    $naviButtons .= "<img id='axZm_zoomNaviPan' ".$this->icon($zoom, 'pan').">";
                                $naviButtons .= "</td>";
                                $toolsSpacer = true;
                            }

                            // Spin button
                            if ($zoom['config']['spinMod'] && $zoom['config']['naviSpinButSwitch']){
                                $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['spin']['w'] + $zoom['config']['naviSpace'])."px'>";
                                    $naviButtons .= "<img id='axZm_zoomNaviSpin' ".$this->icon($zoom, 'spin').">";
                                $naviButtons .= "</td>";
                                $toolsSpacer = true;
                            }

                            // Crop button
                            if ($zoom['config']['naviCropButSwitch']){
                                $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['crop']['w'] + $zoom['config']['naviSpace'])."px'>";
                                    $naviButtons .= "<img id='axZm_zoomNaviCrop' ".$this->icon($zoom, 'crop').">";
                                $naviButtons .= "</td>";
                                $toolsSpacer = true;
                            }

                            // Spacer cell
                            if ($toolsSpacer){
                                $naviButtons .= $deviderTD;
                            }

                            // Zoom In, Out
                            if ($zoom['config']['naviZoomBut']){
                                if ($zoom['config']['naviBigZoom']){

                                    $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['zoomOutBig']['w'] + $zoom['config']['naviSpace'])."px'>";
                                        $naviButtons .= "<img id='axZm_zoomNaviOut' ".$this->icon($zoom, 'zoomOutBig').">";
                                    $naviButtons .= "</td>";

                                    $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['zoomInBig']['w'] + $zoom['config']['naviSpace'])."px'>";
                                        $naviButtons .= "<img id='axZm_zoomNaviIn' ".$this->icon($zoom, 'zoomInBig').">";
                                    $naviButtons .= "</td>";

                                } else {
                                    $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['zoomIn']['w'] + $zoom['config']['naviSpace'])."px'>";
                                        $naviButtons .= "<table cellspacing='0' cellpadding='0'><tbody>";
                                            $naviButtons .= "<tr><td style='width: ".($zoom['config']['icons']['zoomIn']['w'])."px;'><img id='axZm_zoomNaviIn' style='vertical-align: bottom; margin-bottom: 3px' ".$this->icon($zoom, 'zoomIn')."></td></tr>";
                                            $naviButtons .= "<tr><td style='width: ".($zoom['config']['icons']['zoomOut']['w'])."px; vertical-align: top;'><img id='axZm_zoomNaviOut' ".$this->icon($zoom, 'zoomOut')."></td></tr>";
                                        $naviButtons .= "</tbody></table>";
                                    $naviButtons .= "</td>";
                                }

                                // Devider
                                $naviButtons .= $deviderTD;
                            }

                            // Top, left, right, bottom NAVI
                            if ($zoom['config']['naviPanBut']){

                                $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['moveLeft']['w']+4 + $zoom['config']['icons']['moveTop']['w'] + $zoom['config']['icons']['moveRight']['w']+2)."px'>";

                                    $naviButtons .= "<table cellspacing='0' cellpadding='0'><tbody><tr>";
                                        $naviButtons .= "<td style='width: ".($zoom['config']['icons']['moveLeft']['w']+2)."px; vertical-align: middle;'><img id='axZm_zoomNaviML' style='margin-right:2px' ".$this->icon($zoom, 'moveLeft')."></td>";
                                        $naviButtons .= "<td style='width: ".($zoom['config']['icons']['moveTop']['w'])."px; vertical-align: middle;'>";
                                        $naviButtons .= "<img id='axZm_zoomNaviMT' style='vertical-align: bottom; margin-bottom: 2px' ".$this->icon($zoom, 'moveTop').">";
                                        $naviButtons .= "<img id='axZm_zoomNaviMB' style='vertical-align: top;' ".$this->icon($zoom, 'moveBottom').">";
                                        $naviButtons .= '</td>';
                                        $naviButtons .= "<td style='width: ".($zoom['config']['icons']['moveRight']['w']+2)."px; vertical-align: middle;'><img id='axZm_zoomNaviMR' style='margin-left:2px' ".$this->icon($zoom, 'moveRight')."></td>";
                                    $naviButtons .= "</tr></tbody></table>";

                                $naviButtons .= "</td>";

                                // Devider
                                $naviButtons .= $deviderTD;
                            }

                            // Restore
                            if ($zoom['config']['naviRestoreBut']){
                                $naviButtons .= "<td valign='middle' style='text-align: left; width: ".($zoom['config']['icons']['reset']['w'] + $zoom['config']['naviSpace'])."px'>";
                                    $naviButtons .= "<img id='axZm_zoomNavi100' ".$this->icon($zoom, 'reset').">";
                                $naviButtons .= "</td>";
                            }

                        $naviButtons .= "</tr></tbody></table>";

                    $naviButtons .= "</td>";

                    // Navi other controls
                    if (
                        ($zoom['config']['useFullGallery'] && $zoom['config']['galFullButton']) ||
                        ($zoom['config']['mapButton'] && $zoom['config']['useMap']) ||
                        $zoom['config']['help'] ||
                        $zoom['config']['naviHotspotsBut'] ||
                        ($zoom['config']['fullScreenNaviButton'] && $zoom['config']['fullScreenEnable']) ||
                        ($zoom['config']['downloadButton'] && $zoom['config']['allowDownload']) ||
                        ($zoom['config']['fullScreenEnable'] && $zoom['config']['fullScreenNaviButton'])
                    ){


                        $zoomNaviControls = "<table id='axZm_zoomNaviControls' cellspacing='0' cellpadding='0' style='float: ".$zoom['config']['naviFloat']."'><tbody><tr>";
                        $zoomNaviControlsWidth = 0;

                        // Inline Gallery
                        if ($zoom['config']['useFullGallery'] AND $zoom['config']['galFullButton']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['gallery']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['gallery']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomGalButton' ".$this->icon($zoom, 'gallery').">";
                            $zoomNaviControls .= "</td>";
                        }

                        // Map on / off
                        if ($zoom['config']['mapButton'] AND $zoom['config']['useMap']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['map']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['map']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomMapButton' ".$this->icon($zoom, 'map', '_switched').">";
                            $zoomNaviControls .= "</td>";
                        }

                        // Help
                        if ($zoom['config']['help']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['help']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['help']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomHelp' ".$this->icon($zoom, 'help').">";
                            $zoomNaviControls .= "</td>";
                        }

                        // Download Buton
                        if ($zoom['config']['downloadButton'] && $zoom['config']['allowDownload']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['download']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['download']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomDownload' ".$this->icon($zoom, 'download').">";
                            $zoomNaviControls .= "</td>";
                        }

                        if ($zoom['config']['naviHotspotsBut']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['hotspots']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['hotspots']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomHotspots' ".$this->icon($zoom, 'hotspots').">";
                            $zoomNaviControls .= "</td>";
                        }

                        // Fullscreen button
                        if ($zoom['config']['fullScreenEnable'] AND $zoom['config']['fullScreenNaviButton']){
                            $zoomNaviControlsWidth += ($zoom['config']['icons']['fullScreen']['w'] + $zoom['config']['naviSpace']);

                            $zoomNaviControls .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".($zoom['config']['icons']['fullScreen']['w'] + $zoom['config']['naviSpace'])."px'>";
                                $zoomNaviControls .= "<img id='axZm_zoomFullScreenButton' ".$this->icon($zoom, 'fullScreen').">";
                            $zoomNaviControls .= "</td>";
                        }

                        $zoomNaviControls .= "</tr></tbody></table>";

                        $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle;'>"; //width: ".$zoomNaviControlsWidth."px
                            $naviButtons .= $zoomNaviControls;
                        $naviButtons .= "</td>";

                    }

                    // Gallery Navi
                    if ($zoom['config']['galleryNavi'] AND $zoom['config']['galleryNaviPos'] == 'navi'){
                        $galleryNaviWidth = $zoom['config']['icons']['prev']['w'] + $zoom['config']['icons']['next']['w'] + $zoom['config']['galleryButtonSpace'];
                        if ($zoom['config']['galleryPlayButton']){
                            $galleryNaviWidth += $zoom['config']['galleryButtonSpace'] + $zoom['config']['icons']['play']['w'];
                        }
                        $galleryNaviWidth += $zoom['config']['naviGroupSpace'];
                        $naviButtons .= "<td style='text-align: ".$zoom['config']['naviFloat']."; vertical-align: middle; width: ".$galleryNaviWidth."px'>";
                        $naviButtons .= $galleryNavi;
                        $naviButtons .= "</td>";
                    }


                    // End Button Navi


                if ($zoom['config']['naviFloat'] == 'right'){
                    $zoomNavi .= $naviInfo . $naviButtons;
                }else{
                    $zoomNavi .= $naviButtons . $naviInfo;
                }


                $zoomNavi .= "</tr></tbody></table>";

            $zoomNavi .= "</div>";
        // End zoomNavigation
        $zoomNavi .= "</div>";

        if ($zoom['config']['spinSliderPosition'] == 'naviBottom'){
            $zoomNavi .= $zoomSliderSpin;
        }

        // Vertical gallery
        $vertGallery = '';
        if ($zoom['config']['useGallery']){
            $vertGallery = "<div id='axZm_zoomGalleryVerticalContainer' class='axZm_zoomGalleryVerticalContainer' style='float: ".$zoom['config']['galleryPos']."; width: ".($extPixGal-$extPix)."px; height:".($zoomGalHeight-$extPixBoth)."px;'>";

                // Gallery Navigation
                if ($zoom['config']['galleryNavi'] AND in_array($zoom['config']['galleryNaviPos'], array('top', 'bottom'))){
                    $galleryNaviVert = "<div class='axZm_zoomGalleryVerticalNavi' id='axZm_zoomGalleryNavi' style='text-align: left; padding: 0px; width: ".($zoomGalWidth)."px; height: ".$zoom['config']['galleryNaviHeight']."px;'>";
                        foreach ($zoom['config']['galleryNaviMargin'] as $k=>$v){$galleryNaviMargin.=$v.'px ';}
                        $galleryNaviVert .= "<div style='display: inline; margin: $galleryNaviMargin; float: right; padding: 0px;'>";
                        $galleryNaviVert .= $galleryNavi;
                        $galleryNaviVert .= "</div>";
                    $galleryNaviVert .= "</div>";
                }

                if ($zoom['config']['galleryNavi'] AND $zoom['config']['galleryNaviPos'] == 'top'){
                    $vertGallery .= $galleryNaviVert;
                }


                $galHeightReduce = 0;
                if ($zoom['config']['galleryNavi'] AND in_array($zoom['config']['galleryNaviPos'], array('top', 'bottom'))){

                    $galHeightReduce = $zoom['config']['galleryNaviHeight'];
                }

                $vertGallery .= "<div id='axZm_zoomGallery' class='axZm_zoomGalleryVertical' style='width: ".$zoomGalWidth."px; height:".($zoomGalHeight - $extPixBoth - $galHeightReduce)."px;'></div>";

                if ($zoom['config']['galleryNavi'] AND $zoom['config']['galleryNaviPos'] == 'bottom'){
                    $vertGallery .= $galleryNaviVert;
                }

            $vertGallery .= "</div>";
        }


        //////////////////////
        //// Start return ////
        //////////////////////

        // Outer Div
        if ($zoom['config']['layHorCenter']){
            if ($zoom['config']['quirks'] AND $browser['browser'] == 'msie'){
                // Centering layout for transitional
                $return .= "<div id='axZm_zoomAll' class='axZm_zoomAll' style='margin: 0 auto; width: ".($zoomW+$extPixGal)."px; overflow-x: hidden; text-align: center;'>";
            }else{
                $return .= "<div id='axZm_zoomAll' class='axZm_zoomAll' style='margin: 0 auto; width: ".($zoomW+$extPixGal)."px; overflow-x: hidden;'>";
            }
        }else{
            $return .= "<div id='axZm_zoomAll' class='axZm_zoomAll' style='margin: 0; width: ".($zoomW+$extPixGal)."px; overflow-x: hidden;'>";
        }


            // Top Margin
            if ($zoom['config']['layVertCenter'] === true){
                $return .= "<div id='axZm_zoomTopMargin' style='clear: both; float: left; width:".($zoomW+$extPixGal)."px; height: 0px; line-height: 0px;'></div>";
            }
            elseif (intval($zoom['config']['layVertCenter']) >= 1){
                $return .= "<div id='axZm_zoomTopMargin' style='clear: both; float: left; width:".($zoomW+$extPixGal)."px; height: ".$zoom['config']['layVertCenter']."px; line-height: 1px;'></div>";
            }

            // Vertical gallery
            if ($zoom['config']['useGallery']){
                $return .= $vertGallery;
            }

            // Horizontal gallery
            if ($zoom['config']['useHorGallery'] AND $zoom['config']['galHorPosition'] == 'top1'){
                $return .= $horGallery;
            }

            // Position Navi
            if ($zoom['config']['naviPos'] == 'top'){
                $return .= $zoomNavi;
            }

            // Position Slider
            if ($zoom['config']['spinSliderPosition'] == 'top'){
                $return .= $zoomSliderSpin;
            }

            // Horizontal gallery
            if ($zoom['config']['useHorGallery'] AND $zoom['config']['galHorPosition'] == 'top2'){
                $return .= $horGallery;
            }


            $return .= "<div id='axZm_zoomBorder' class='axZm_zoomBorder' style='width:".($zoomW+$extPix)."px; height:".($zoomH+$extPix-$extPixBoth)."px;'>";

                $zoomContainerFloat = 'float: left;';
                if ($zoom['config']['useGallery'] AND $zoom['config']['galleryMarginLeft'] AND $zoom['config']['galleryPos'] == 'left'){
                    $zoomContainerFloat = 'float: right;';
                }

                $return .= "<div id='axZm_zoomContainer' class='axZm_zoomContainer' style='width:".($zoomW)."px; height:".($zoomH)."px; text-align: left; margin: ".$zoom['config']['innerMargin']."px; $zoomContainerFloat'>";

                    $return .= "<div id='axZm_zoomLoaderHolder' class='axZm_zoomLoaderHolder'>";
                        $return .= "<div id='axZm_zoomLoader' class='".$zoom['config']['zoomLoaderClass']."'></div>";
                    $return .= "</div>";

                    // Warning
                    $return .= "<div id='axZm_zoomWarning' class='axZm_zoomWarning'></div>";

                    // Back Pic
                    $return .= "<div id='".$zoom['config']['backDiv']."' class='axZm_zoomedBack' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                        $return .= "<div id='".$zoom['config']['backInnerDiv']."' class='axZm_zoomedBackImage' style='width:".($zoomW)."px; height:".($zoomH)."px;'><img src='".$zoom['config']['icon']."empty.gif' id='".$zoom['config']['backLayer']."' style='position: static; width:".($zoom['config']['smallImgSize'][0])."px; height:".($zoom['config']['smallImgSize'][1])."px;' unselectable=\"on\"></div>";
                    $return .= "</div>";


                    // Zoomed Image
                    $return .= "<div id='axZm_zoomedImageContainer' class='axZm_zoomedImageContainer' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                        $return .= "<div id='axZm_zoomedImage' class='axZm_zoomedImage' style='width:".($zoomW)."px; height:".($zoomH)."px;'><img src=\"".$zoom['config']['icon']."empty.gif\" id=\"".$zoom['config']['picLayer']."\" style=\"position: static; width:".($zoom['config']['smallImgSize'][0])."px; height:".($zoom['config']['smallImgSize'][1])."px;\" unselectable=\"on\"></div>";
                    $return .= "</div>";

                    // Transparent Overpic
                    $return .= "<div id='axZm_zoomLayer' class='axZm_zoomLayer' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                        if ($zoom['config']['vWtrmrk']){
                            $return .= "<div id='axZm_zoomWtrmrk' class='".$zoom['config']['vWtrmrk']."' style='width:".($zoomW)."px; height:".($zoomH)."px;'></div>";
                        }
                        //$return .= "<div style='opacity: 0.75; z-index: 2; background-color: red; position: absolute; left: ".($zoomW-12)."px; top: 10px; width: 2px; height:".($zoomH-20)."px;'></div>";
                        if ($browser['browser'] == 'msie'){
                            $return .= "<img src='".$zoom['config']['icon']."empty.gif' id='".$zoom['config']['overLayer']."' class='axZm_zoomLayerImg' style='width:".($zoomW)."px; height:".($zoomH)."px; z-index: 1' alt='' unselectable='on'>";
                        }else{
                            $return .= "<div id='".$zoom['config']['overLayer']."' class='axZm_zoomLayerImg' style='width:".($zoomW)."px; height:".($zoomH)."px; z-index: 1; background-image: url(".$zoom['config']['icon']."empty.gif);' unselectable='on'></div>";
                        }
                    $return .= "</div>";

                    // Full Area Gallery
                    if ($zoom['config']['useFullGallery'] && !$zoom['config']['spinMod']){
                        $return .= "<div id='axZm_zoomFullGalleryHolder' class='axZm_zoomFullGalleryHolder' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                            $return .= "<div id='axZm_zoomFullGallery' class='axZm_zoomFullGallery' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                            $return .= "</div>";
                        $return .= "</div>";
                    }

                    // Help
                    if ($zoom['config']['help']){
                        $return .= "<div id='axZm_zoomedHelpHolder' class='axZm_zoomedHelpHolder' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                            $return .= "<div id='axZm_zoomedHelp' class='axZm_zoomedHelp' style='left: ".$zoom['config']['helpMargin']."px; top: ".$zoom['config']['helpMargin']."px; width:".($zoomW-($zoom['config']['helpMargin']*2))."px; height:".($zoomH-($zoom['config']['helpMargin']*2))."px;'>";

                            if ($zoom['config']['helpUrl']){
                                $return .= "<iframe SRC='".$zoom['config']['helpUrl']."' WIDTH='".($zoomW-($zoom['config']['helpMargin']*2))."' HEIGHT='".($zoomH-($zoom['config']['helpMargin']*2))."' FRAMEBORDER='0'></iframe>";
                            }

                            $return .= "</div>";
                        $return .= "</div>";
                    }

                    // Description
                    $return .= "<div id='axZm_zoomDescrHolder' class='axZm_zoomDescrHolder' style='width:".($zoomW)."px; height:".($zoomH)."px;'>";
                        $return .= "<div id='axZm_zoomDescr' class='axZm_zoomDescr' style='width:".($zoomW)."px; height: ".$zoom['config']['descrAreaHeight']."px; top: ".($zoomH-$zoom['config']['descrAreaHeight'])."px;'></div>";
                    $return .= "</div>";


                // End zoomContainer
                $return .= "</div>";

            // End zoomBorder
            $return .= "</div>";

            if ($zoom['config']['useHorGallery'] AND $zoom['config']['galHorPosition'] == 'bottom1'){
                $return .= $horGallery;
            }

            if ($zoom['config']['naviPos'] == 'bottom'){
                $return .= $zoomNavi;
            }

            if ($zoom['config']['spinSliderPosition'] == 'bottom'){
                $return .= $zoomSliderSpin;
            }

            if ($zoom['config']['useHorGallery'] AND $zoom['config']['galHorPosition'] == 'bottom2'){
                $return .= $horGallery;
            }

            if ($zoom['config']['zoomStat']){
                $return .= "<div id='axZm_zoomAdmin' class='axZm_zoomAdmin' style='width:".($zoomW+$extPix)."px; height:".$zoom['config']['zoomStatHeight']."px'><div id='axZm_zoomAdminHtml' style='padding:0 5px'></div></div>";
            }

            // Pseudo Div for ajax
            $return .= "<div id='axZm_zoomOpr' style='height: 0px; visibility: hidden; display: none; overflow: hidden;'><a href='http://www.ajax-zoom.com'>jQuery Image Zoom & Pan Gallery</a></div>";

            // Visual configuration block
            if ($zoom['config']['visualConf']){
                $return .= $this->visualConf($zoom, $zoomTmp, $zoomW, $extPixGal);
            }

            if ($zoom['config']['layVertBotMrg'] === true){
                $return .= "<div style='clear: both; float: left; width:".($zoomW+$extPixGal)."px; height: 0px; line-height: 0px;'></div>";
            } elseif (intval($zoom['config']['layVertBotMrg']) >= 1){
                $return .= "<div style='clear: both; float: left; width:".($zoomW+$extPixGal)."px; height: ".$zoom['config']['layVertBotMrg']."px; line-height: 1px;'></div>";
            }

        // End Layout
        $return .= "</div>";

        if ($zoom['config']['cornerRadius'] > 0){
            $return = "<div id='axZm_zoomCornerRadius' class='axZm_zoomCornerRadius' style='display: block; width: ".($zoomW+$extPixGal)."px; padding: ".$zoom['config']['cornerRadius']."px;'>".$return."</div>";
        }

         // Dialog when cTimeCompare deleted old tiles
        if ($zoom['config']['cTimeCompareDialog'] == true && is_array($this->returnCTimeCompare)){
            $return .= '<script type="text/javascript">setTimeout(function(){jQuery.fn.axZm.zoomAlert(\'Option cTimeCompare considered to regenerate tiles and all other dynamically generated images: <br><br>'.implode(', ', $this->returnCTimeCompare).';<br><br>If you did not change the source images or AJAX-ZOOM mistakenly regenerates these images, then please disable cTimeCompare in zoomConfig.inc.php and zoomConfigCustom.inc.php<br><br>\',\'Old tiles deleted! Why that?\', \''.$this->msgNoteInstr.'\'); },1000);</script>';
        }

        // Dialog if first image has been made...
        if (isset($this->returnMakeFirstImage)){
            if (!is_bool($this->returnMakeFirstImage)){
                $return .= $this->returnMakeFirstImage;
            }
        }

        // Dialog if zoom tiles have been made...
        if (isset($this->returnMakeZoomTiles)){
            if (!is_bool($this->returnMakeZoomTiles)){
                $return .= $this->returnMakeZoomTiles;
            }
        }

        // Dialog after thumbs generation
        if (isset($this->returnMakeAllThumbs)){
            if (!is_bool($this->returnMakeAllThumbs)){
                $return .= $this->returnMakeAllThumbs;
            }
        }

        // Error dialog if images missing on filesystem
        if (isset($this->fileErrorDialog)){
            if (!is_bool($this->fileErrorDialog)){
                $return .= $this->fileErrorDialog;
            }
        }

        return $return;
    }

    /**
      * Forms for visial configuration or demo
      * @access public
      * @param array $zoom
      * @param array $zoomTmp
      * @param int $zoomW Calculated width
      * @param int $extPixGal Calculated width
      * @return HTML-Output
      **/
    function visualConf($zoom,$zoomTmp,$zoomW,$extPixGal){
        $autoSubmit = false; // 'this.form.submit()' or false

        $return = '';
        $return .= "<div style='clear: both; float: left; height:15px; line-height:1px;'>&nbsp;</div>";

        // Options Ajax for Demo
        // Top Border

        $return .= "<div id='zoomDemoContainer' style='float: left;'>";
            /*
            if ($zoom['config']['cornerRadius']){
                $return .= "<div class='zoom-border-container' style='width:".($zoomW+$extPixGal)."px;'><div class='zoom-top-left'></div><div class='zoom-top-right'></div></div>";
            }
            */

            $return .= "<div id='zoomAjaxDemoButton' class='zoomAjaxDemoButton' style='width:".($zoomW+$extPixGal)."px;'><div style='padding: 0px 5px;'><p style='margin-top:11px'>>> VISUAL CONFIGURATION FOR SOME PARAMETERS</p></div></div>";

            $return .= '<div id="zoomAjaxDemo" style="float: left; display: none; width:'.($zoomW+$extPixGal).'px; background-color:#000000;" >'; // onMouseOver="jQuery(function(){jQuery.noDemoHide=true;});"

                $arrayMotion=array(
                    'swing',
                    'jswing',
                    'linear',
                    'easeInQuad',
                    'easeOutQuad',
                    'easeInOutQuad',
                    'easeInCubic',
                    'easeOutCubic',
                    'easeInOutCubic',
                    'easeInQuart',
                    'easeOutQuart',
                    'easeInOutQuart',
                    'easeInQuint',
                    'easeOutQuint',
                    'easeInOutQuint',
                    'easeInSine',
                    'easeOutSine',
                    'easeInOutSine',
                    'easeInExpo',
                    'easeOutExpo',
                    'easeInOutExpo',
                    'easeInCirc',
                    'easeOutCirc',
                    'easeInOutCirc',
                    'easeInElastic',
                    'easeOutElastic',
                    'easeInOutElastic',
                    'easeInBack',
                    'easeOutBack',
                    'easeInOutBack',
                    'easeInBounce',
                    'easeOutBounce',
                    'easeInOutBounce'
                );


                $arrayJpgQual=array(10,20,30,40,50,60,65,70,75,80,85,90,95,97,100);
                $arrayDigits=array(0,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100);
                $arrayZoomBy=array(20,25,30,35,40,45,50,60,65,70,75,100,125,150,175,200,250,300,400,500,750,1000,1500,2000);
                $arrayZoomClick=array(50,100,200,300,400,500,750,1000,1250,1500,2000,2500,3000,4000,5000);
                $arrayMoveBy=array(20,25,30,35,40,45,50,60,65,70,75,100,125,150,175,200,250);
                $arrayZoomMove=array(50,100,200,300,400,500,750,1000,1250,1500,2000,2500,3000);
                $arrayOpacity=array(0,0.5,1,1.5,2,2.5,3,4,5,6,7,8,9,9.5,10);
                $arrayBorderWidth=array(1,2,3,4,5);
                $arrayLoaderPos=array('Center', 'TopLeft', 'TopRight', 'BottomLeft', 'BottomRight');
                $arrayMapFract=array(10,15,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,70,80,90,100);
                $arrayBg=array('wallpaper1.jpg', 'wallpaper2.jpg');

                $return .= "<table cellspacing='0' cellpadding='0' style='margin: 10px 5px 5px 5px; display: block;'><tbody><tr><td style='width:49%' valign='top'>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; color: #F4E10A">MOTION SETTINGS</div>';

                        $return .= '<form id="aniForm" action="" onsubmit="return false;">';

                        $return .= '<div class="axZm_zoomText">';
                            $return .= "<input type='checkBox' id='motionSwitch' value='1' onClick=\"demoShowSwitch(); this.blur();\" checked> - Preview motion settings. Note: the preview will not perform serverside resizing";
                        $return .= '</div>';

                        // Zoom In
                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoClickRatio(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomBy, $zoom['config']['pZoom'], $opr=false, $add='%');
                        $return .= '</select> - Click ZOOM IN</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoClickOutRatio(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomBy, $zoom['config']['pZoomOut'], $opr=false, $add='%');
                        $return .= "</select> - Click ZOOM OUT</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMoveRatio(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayMoveBy, $zoom['config']['pMove'], $opr=false, $add='%');
                        $return .= "</select> - Move buttons by</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoClickSpeed(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomClick, $zoom['config']['zoomSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Click/Plus ZOOM IN Speed</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoClickZoomOut(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomClick, $zoom['config']['zoomOutSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Right Click / Minus ZOOM OUT Speed</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMoveSpeed(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['moveSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Sidewards (buttons) speed</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoRestoreSpeed(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['restoreSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Restore speed</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoTraverseSpeed(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['traverseSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Traverse speed</div>";

                        // Motion functions
                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionIn(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseIn'], $opr='ucfirst', $add=false);
                        $return .= "</select> - ZOOM IN Motion</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionOut(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseOut'], $opr='ucfirst', $add=false);
                        $return .= "</select> - ZOOM OUT Motion</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionMove(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseMove'], $opr='ucfirst', $add=false);
                        $return .= "</select> - Sidewards Motion</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionRestore(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseRestore'], $opr='ucfirst', $add=false);
                        $return .= "</select> - Restore Motion</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionTraverse(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseTraverse'], $opr='ucfirst', $add=false);
                        $return .= "</select> - Traverse Motion</div>";

                        // Image status loader
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">IMAGE LOADER</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoLoaderPos(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayLoaderPos, $zoom['config']['zoomLoaderPos'], $opr=false, $add=false);
                        $return .= "</select> - Loader Position</div>";


                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoLoaderTransp(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayDigits, ($zoom['config']['zoomLoaderTransp']*100), $opr=false, $add='%');
                        $return .= "</select> - Loader Transparency</div>";
                        /* Where is loader position ??? */

                        $return .= "</form>"; // END aniForm

                        // PHP
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">IMAGE QUALITY AND PHP</div>';

                        $return .= '<form id="demoOptions" action="" onsubmit="return false;">';
                        $return .= "<div style='display: none'><input type='hidden' name='submitO' value='1'></div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<select name='demoQ' onChange=\"jQuery.optSubmit();this.blur();\" style='width:80px'>";
                            $return .= $this->sOptions($arrayJpgQual, $zoom['config']['qual'], $opr=false, $add=false);
                            $return .= "</select> - JPG Quality";
                        $return .= '</div>';


                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<input type='radio' name='demoO' value='gd' onClick=\"jQuery.optSubmit();this.blur();\"";
                            if (!$zoom['config']['im']){$return .= ' checked';}
                            $return .= "> - GD&nbsp;&nbsp;";
                            $return .= "<input type='radio' name='demoO' onClick=\"jQuery.optSubmit();this.blur();\" value='im'";
                            if ($zoom['config']['im']){$return .= ' checked';}
                            $return .= "> - ImageMagick";
                        $return .= '</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">CROPPING METHOD</div>';
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<div>";
                                $return .= "<input type='radio' name='demoP' value='1' onClick=\"jQuery.optSubmit();this.blur();\"";
                                if (!$zoom['config']['gPyramid'] AND !$zoom['config']['pyrTiles']){$return .= " checked";}
                                $return .= "> - Crop from Original (slow) OK < 5-7 MP";
                            $return .= "</div>";

                            $return .= "<div>";

                                $return .= "<input type='radio' name='demoP' value='2' onClick=\"jQuery.optSubmit();this.blur();\"";
                                if ($zoom['config']['gPyramid']){$return .= " checked";}
                                $return .= "> - Image Pyramid (faster) OK < 11-15 MP";
                            $return .= "</div>";

                            $return .= "<div>";
                                $return .= "<input type='radio' name='demoP' value='3' onClick=\"jQuery.optSubmit();this.blur();\"";
                                if ($zoom['config']['pyrTiles']){$return .= " checked";}
                                $return .= "> - Image Pyramid with Tiles (very fast) ";
                            $return .= "</div>";
                        $return .= '</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">WATERMARK</div>';
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<input type='checkBox' name='demoW' value='1' onClick=\"jQuery.optSubmit();this.blur();\"";
                            if ($zoom['config']['watermark']){$return .= ' checked';}
                            $return .= "> - Watermark PNG Image Demo";
                        $return .= '</div>';

                        $return .= '<div class="axZm_zoomText">';
                            $return .= "<input type='checkBox' name='demoT' value='1' onClick=\"jQuery.optSubmit();this.blur();\"";
                            if ($zoom['config']['text']){$return .= ' checked';}
                            $return .= "> - Watermark Text Demo";
                        $return .= '</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<span class='zoomTextS'>You can set a bunch of other settings for watermarking</span>";
                        $return .= '</div>';

                        $return .= "</form>"; // end demoOptions

                    $return .= "</td><td style='width:49%' valign='top'>";

                        // Slector
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; color: #F4E10A">SELECTOR SPECIFIC SETTINGS</div>';

                        $return .= '<form id="selForm" action="" onsubmit="return false;">';
                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
                        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="008000" id="demoColorArea">';
                        $return .= " - Selector color</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoSelOpacity(this.value);this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayOpacity, ($zoom['config']['zoomSelectionOpacity']*10), $opr=create_function('$a','return ($a*10);'), $add='%');
                        $return .= "</select> - Selector opacity</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
                        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="000000" id="demoColorOuter">';
                        $return .= " - Outer color</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoOuterOpacity(this.value);this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayOpacity, ($zoom['config']['zoomOuterOpacity']*10), $opr=create_function('$a','return ($a*10);'), $add='%');
                        $return .= "</select> - Outer opacity</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
                        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="ff0000" id="demoColorBorder">';
                        $return .= " - Selector border color</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoBorder(this.value);this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayBorderWidth, $zoom['config']['zoomBorderWidth'], $opr=false, $add='px');
                        $return .= "</select> - Selector border thickness</div>";


                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoCropSpeed(this.value); this.blur();" style="width:80px">';
                        $return .= $this->sOptions($arrayZoomMove, $zoom['config']['cropSpeed'], $opr=false, $add='ms');
                        $return .= "</select> - Selector ZOOM IN speed</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoMotionCrop(this.value);this.blur();" style="width:120px">';
                        $return .= $this->sOptions($arrayMotion, $zoom['config']['zoomEaseCrop'], $opr='ucfirst', $add=false);
                        $return .= "</select> - S. ZOOM IN Motion</div>";

                        $return .= "</form>"; // END selForm

                        // LAYOUT
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">LAYOUT</div>';

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
                        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="3E3E3E" id="demoColorStage">';
                        $return .= " - Stage color</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px">';
                        $return .= '<span class="colHex">#</span><input type="text" class="txt" value="FFFFFF" id="demoBodyColor">';
                        $return .= " - Body color</div>";

                        $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select onChange="demoBodyBack(this.value); this.blur();" style="width:80px">';
                        $return .= "<option value=''>None</option>";
                        $return .= $this->sOptions($arrayBg, false, $opr='ucfirst', $add=false);
                        $return .= "</select> - Body background</div>";

                        $return .= '<form id="demoMix" action="'.$_SERVER['PHP_SELF'].'" style="background-color: #1A1A1A; padding: 5px; border: #FFFFFF 1px solid;">';

                            $return .= "<div style='display:none'><input type='hidden' name='zoomID' value='".$_GET['zoomID']."'></div>";
                            $return .= "<div style='display:none'><input type=\"hidden\" name=\"demoMix\" value=\"1\"></div>";

                            $return .= "<div class='axZm_zoomText' style='margin-bottom: 5px; color: #F4E10A;'>[The following settings will reload page]</div>";

                            // Resolution
                            $return .= '<div class="axZm_zoomText"><select name="demoRes" onChange="'.$autoSubmit.'" style="width:80px">';
                            $return .= $this->sOptions($zoom['config']['posRes'], $zoom['config']['picDim'], $opr=false, $add='px');
                            $return .= "</select> - Demo Resolutions</div>";

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<span class='zoomTextS'>You can configure whatever resolution you want</span>";
                            $return .= '</div>';

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">VERTICAL GALLERY</div>';

                            // Vertical gallery switch
                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<input type='radio' name='demoGal' value='yes' onClick=\"".$autoSubmit." jQuery('#zoomDemoVertGal').css('display','block');\"";
                                if ($zoom['config']['useGallery']){$return .= ' checked';}
                                $return .= "> - Yes ";
                                $return .= "<input type='radio' name='demoGal' value='no' onClick=\"".$autoSubmit." jQuery('#zoomDemoVertGal').css('display','none');\"";
                                if (!$zoom['config']['useGallery']){$return .= ' checked';}
                                $return .= "> - No veritval Gallery";
                                //$return .= "<input type='checkbox' id='demoGal' name='demoGal' value='yes' onClick=\"".$autoSubmit." subOpt('demoGal', 'zoomDemoVertGal');\"> - Use veritval Gallery";
                            $return .= '</div>';

                            $return .= "<div id='zoomDemoVertGal' style='background-color: #3C3C3C; padding: 5px; display: ".($zoom['config']['useGallery'] ? 'block' : 'none')."'>";

                                // Vertical gallery columns
                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalCol" onChange="'.$autoSubmit.'" style="width:80px">';
                                $return .= $this->sOptions($zoom['config']['posColumns'], $zoom['config']['galleryLines'], $opr=false, $add=false);
                                $return .= "</select> - Vertical Gallery Columns</div>";

                                // Vertical gallery Resolution
                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalRes" onChange="'.$autoSubmit.'" style="width:80px">';
                                $return .= $this->sOptions($zoom['config']['galRes'], $zoom['config']['galleryPicDim'], $opr=false, $add='px');
                                $return .= "</select> - Vertical Gallery Resolution</div>";

                                // Vertical gallery Position

                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalPos" onChange="'.$autoSubmit.'" style="width:80px">';
                                $return .= $this->sOptions(array('left', 'right'), $zoom['config']['galleryPos'], $opr='ucfirst', $add=false);
                                $return .= "</select> - Vertical Gallery Position</div>";

                            $return .= '</div>';

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">INLINE GALLERY</div>';

                            // Gallery switch inline
                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<input type='radio' name='demoFullGal' value='yes' onClick=\"".$autoSubmit." jQuery('#zoomDemoInlineGal').css('display','block');\"";
                                if ($zoom['config']['useFullGallery']){$return .= ' checked';}
                                $return .= "> - Yes ";
                                $return .= "<input type='radio' name='demoFullGal' value='no' onClick=\"".$autoSubmit." jQuery('#zoomDemoInlineGal').css('display','none');\"";
                                if (!$zoom['config']['useFullGallery']){$return .= ' checked';}
                                $return .= "> - No Inline Gallery";
                            $return .= '</div>';

                            $return .= "<div id='zoomDemoInlineGal' style='background-color: #3C3C3C; padding: 5px; display: ".($zoom['config']['useFullGallery'] ? 'block' : 'none')."'>";

                                $return .= '<div class="axZm_zoomText"><select name="demoFullGalRes" onChange="'.$autoSubmit.'" style="width:80px">';
                                $return .= $this->sOptions($zoom['config']['galRes'], $zoom['config']['galleryFullPicDim'], $opr=false, $add='px');
                                $return .= "</select> - Inline Gallery Resolution</div>";

                                $return .= '<div class="axZm_zoomText" style="margin-top: 3px;">';
                                    $return .= "<input type='radio' name='demoFullGalAuto' value='yes' onClick=\"".$autoSubmit."\"";
                                    if ($zoom['config']['galFullAutoStart']){$return .= ' checked';}
                                    $return .= "> - Yes ";
                                    $return .= "<input type='radio' name='demoFullGalAuto' value='no' onClick=\"".$autoSubmit."\"";
                                    if (!$zoom['config']['galFullAutoStart']){$return .= ' checked';}
                                    $return .= "> - No Inline Gallery Autostart";
                                $return .= '</div>';


                            $return .= '</div>';

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">HORIZONTAL GALLERY</div>';

                            // Gallery switch Horizontal
                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<input type='radio' name='demoHorGal' value='yes' onClick=\"".$autoSubmit."jQuery('#zoomDemoHorGal').css('display','block');\"";
                                if ($zoom['config']['useHorGallery']){$return .= ' checked';}
                                $return .= "> - Yes ";
                                $return .= "<input type='radio' name='demoHorGal' value='no' onClick=\"".$autoSubmit."jQuery('#zoomDemoHorGal').css('display','none');\"";
                                if (!$zoom['config']['useHorGallery']){$return .= ' checked';}
                                $return .= "> - No Horizontal Gallery";
                            $return .= '</div>';

                            $return .= "<div id='zoomDemoHorGal' style='background-color: #3C3C3C; padding: 5px; display: ".($zoom['config']['useHorGallery'] ? 'block' : 'none')."'>";
                                // Hor gallery Position
                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoGalHorPos" onChange="'.$autoSubmit.'" style="width:80px">';
                                $return .= $this->sOptions(array('top1'=>'Top 1', 'top2'=>'Top 2', 'bottom1'=>'Bottom 1', 'bottom2'=>'Bottom 2'), $zoom['config']['galHorPosition'], $opr=false, $add=false);
                                $return .= "</select> - Horizontal Gallery Position</div>";
                            $return .= '</div>';

                            // Gallery Navi
                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">GALLERY NAVI</div>';

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<input type='radio' name='demoGalNavi' value='yes' onClick=\"".$autoSubmit."\"";
                                if ($zoom['config']['galleryNavi']){$return .= ' checked';}
                                $return .= "> - Yes ";
                                $return .= "<input type='radio' name='demoGalNavi' value='no' onClick=\"".$autoSubmit."\"";
                                if (!$zoom['config']['galleryNavi']){$return .= ' checked';}
                                $return .= "> - No Prev / Next buttons";
                            $return .= '</div>';

                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">ZOOM MAP</div>';

                            // Map show / hide
                            $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                $return .= "<input type='radio' name='demoMap' value='no' onClick=\"".$autoSubmit."jQuery('#zoomDemoMapProp').css('display','none');\"";
                                if (!$zoom['config']['useMap']){$return .= ' checked';}
                                $return .= "> - Hide ";
                                $return .= "<input type='radio' name='demoMap' value='yes' onClick=\"".$autoSubmit."jQuery('#zoomDemoMapProp').css('display','block');\"";
                                if ($zoom['config']['useMap']){$return .= ' checked';}
                                $return .= "> - Show map";
                            $return .= '</div>';

                            $return .= "<div id='zoomDemoMapProp' style='background-color: #3C3C3C; padding: 5px; display: ".($zoom['config']['useMap'] ? 'block' : 'none')."'>";

                                // Map Draggable
                                $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                    $return .= "<input type='radio' name='demoMapDrag' value='no' onClick=\"".$autoSubmit."\"";
                                    if (!$zoom['config']['dragMap']){$return .= ' checked';}
                                    $return .= "> - No ";
                                    $return .= "<input type='radio' name='demoMapDrag' value='yes' onClick=\"".$autoSubmit."\"";
                                    if ($zoom['config']['dragMap']){$return .= ' checked';}
                                    $return .= "> - Map draggable";
                                $return .= '</div>';

                                // Map Autohide
                                $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                    $return .= "<input type='radio' name='demoMapVis' value='no' onClick=\"".$autoSubmit."\"";
                                    if (!$zoom['config']['zoomMapVis']){$return .= ' checked';}
                                    $return .= "> - No ";
                                    $return .= "<input type='radio' name='demoMapVis' value='yes' onClick=\"".$autoSubmit."\"";
                                    if ($zoom['config']['zoomMapVis']){$return .= ' checked';}
                                    $return .= "> - Map visible on start";
                                $return .= '</div>';

                                // Map Animate
                                $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                                    $return .= "<input type='radio' name='demoMapAnim' value='no' onClick=\"".$autoSubmit."\"";
                                    if (!$zoom['config']['zoomMapAnimate']){$return .= ' checked';}
                                    $return .= "> - No ";
                                    $return .= "<input type='radio' name='demoMapAnim' value='yes' onClick=\"".$autoSubmit."\"";
                                    if ($zoom['config']['zoomMapAnimate']){$return .= ' checked';}
                                    $return .= "> - Animate Map";
                                $return .= '</div>';

                                // Map Size in persentage of area
                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoMapSize" onChange="'.$autoSubmit.'" style="width:80px">';
                                foreach ($arrayMapFract as $k){
                                    $return .= "<option value='$k'";
                                    if ($k/100 == $zoom['config']['mapFract']){$return .= " selected";}
                                    $return .= ">".($k)." %</option>";
                                }
                                $return .= "</select> - Map size</div>";

                            $return .= '</div>';

                            // Navigation Position
                            $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoNavPos" onChange="'.$autoSubmit.'" style="width:80px">';
                            $return .= $this->sOptions(array('top', 'bottom'), $zoom['config']['naviPos'], $opr='ucfirst', $add=false);
                            $return .= "</select> - Navigation Position</div>";

                            if (!$autoSubmit){
                                $return .= '<div class="axZm_zoomText" style="margin-bottom:3px; text-align: right;">';
                                    $return .= '<input type="button" onClick="this.form.submit()" value="Submit">';
                                $return .= "</div>";
                            }


                        $return .= "</form>";


                        // Other
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px; margin-top: 7px; color: #F4E10A">OTHER</div>';
                        $return .= '<form id="demoOther" action="" onsubmit="return false;">';
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<input type='checkbox' name='msInterp' value='1' onClick=\"demoIeInterp(this.checked); this.blur();\" ".($zoom['config']['msInterp'] ? ' checked' : '')."> - Bicubic interpolation (IE < 8)";
                        $return .= '</div>';
                        $return .= '<div class="axZm_zoomText" style="margin-bottom: 3px;">';
                            $return .= "<input type='checkbox' name='demoPhysics' value='1' onClick=\"demoPhys(this.checked); this.blur();\" ".($zoom['config']['zoomDragPhysics'] ? ' checked' : '')."> - Smooth dragging (throw picture)";
                        $return .= '</div>';
                        $return .= "</form>";

                        // DOCTYPE
                        $return .= '<form id="demoDoctype" action="">';
                            $serverPar = $this->zoomServerPar('arr','demoDoctype',false,$_SERVER['QUERY_STRING']);
                            if (is_array($serverPar)){
                                foreach ($serverPar as $k=>$v){
                                    $return .= "<div><input type=\"hidden\" name=\"$k\" value=\"$v\"></div>";
                                }
                            }

                            $return .= '<div class="axZm_zoomText" style="margin-bottom:3px"><select name="demoDoctype" onChange="this.form.submit()" style="width:160px">';
                            foreach ($this->doctype as $k => $v){
                                $doc = array_keys($v);
                                $return .= "<option value='$k'";
                                if ($k == $zoom['config']['doctype']){$return .= " selected";}
                                $return .= ">".($doc[0])."</option>";
                            }
                            $return .= "</select> - Doctype</div>";

                        $return .= "</form>";

                    $return .= "</td></tr></tbody></table>";

                // End zoomAjaxDemo
                $return .= "</div>";
            /*
            if ($zoom['config']['cornerRadius']){
                $return .= "<div class='zoom-border-container' style='width:".($zoomW+$extPixGal)."px;'><div class='zoom-bottom-left'></div><div class='zoom-bottom-right'></div></div>";
            }
            */

        $return .= "<div style='clear: both; float: left; height:10px; line-height:1px;'>&nbsp;</div>";

        // http pic navigation
        /*
        if ($zoom['config']['cornerRadius']){
            $return .= "<div class='zoom-border-container' style='width:".($zoomW+$extPixGal)."px;'><div class='zoom-top-left'></div><div class='zoom-top-right'></div></div>";
        }
        */

        // Dropdown for folders
        $zoomTmp['folderSelect']="<form style=\"margin:0px; padding:0px\" method=\"GET\" action=\"".$_SERVER['PHP_SELF']."\">";
            $zoomTmp['zoomServerPar'] = $this->zoomServerPar('arr',array('zoomID','zoomDir'),false,$_SERVER['QUERY_STRING']);
            if (!empty($zoomTmp['zoomServerPar'])){
                foreach ($zoomTmp['zoomServerPar'] as $k=>$v){
                    $zoomTmp['folderSelect'].="<div style='display: none'><input type=\"hidden\" name=\"$k\" value=\"$v\"></div>";
                }
            }
            $zoomTmp['folderSelect'].="<div><select name=\"zoomDir\" onChange=\"this.form.submit()\" style=\"\">";
                foreach ($zoomTmp['folderArray'] as $k=>$v){
                    $zoomTmp['folderSelect'].="<option value='$v'";
                    if ($k==$_GET['zoomDir'] || $v==$_GET['zoomDir']){$zoomTmp['folderSelect'].=" selected";}
                    $zoomTmp['folderSelect'].=">$k. ".ucfirst($v)."</option>";
                }
            $zoomTmp['folderSelect'].="</select></div>";
        $zoomTmp['folderSelect'].="</form>";

        // Dropdown for images
        $zoomTmp['dropSelect']="<form style=\"margin:0px; padding:0px\" method=\"GET\" action=\"".$_SERVER['PHP_SELF']."\">";
            $zoomTmp['zoomServerPar'] = $this->zoomServerPar('arr',array('zoomID'),false,$_SERVER['QUERY_STRING']);
            if (!empty($zoomTmp['zoomServerPar'])){
                foreach ($zoomTmp['zoomServerPar'] as $k=>$v){
                    $zoomTmp['dropSelect'].="<div style='display: none'><input type=\"hidden\" name=\"$k\" value=\"$v\"></div>";
                }
            }

            $zoomTmp['dropSelect'].="<div><select name=\"zoomID\" onChange=\"this.form.submit()\" style=\"\" id=\"axZmComboExample\">";
                foreach ($zoom['config']['pic_list_array'] as $k=>$v){
                    $zoomTmp['dropSelect'] .= "<option value='$k'";
                    if ($k==$_GET['zoomID']){$zoomTmp['dropSelect'].=" selected";}
                    $v = $k.'. '.str_replace('_',' ',ucfirst($this->getf('.',$v))).' &rarr; ';
                    $v .= $zoom['config']['pic_list_data'][$k]['imgSize'][0].'x'.$zoom['config']['pic_list_data'][$k]['imgSize'][1].' PX &rarr; ';
                    $v .= round((($zoom['config']['pic_list_data'][$k]['imgSize'][0]*$zoom['config']['pic_list_data'][$k]['imgSize'][1])/1000000),1).' MP &rarr; ';
                    $v .= $this->zoomFileSmartSize($zoom['config']['pic_list_data'][$k]['fileSize'],1);

                    $zoomTmp['dropSelect'].='>'.$v."</option>";
                }
            $zoomTmp['dropSelect'] .= "</select></div>";

        $zoomTmp['dropSelect'] .= "</form>";


        $return.= "<div id='zoomPicSelect' class='zoomAjaxDemoButton' style='width:".($zoomW+$extPixGal)."px;'>";
            $return.= "<div style='clear: both; margin:10px 5px; text-align: right;'>";
            $return.= isset($zoomTmp['dropSelect']) ? "<div style='float: right'>".$zoomTmp['dropSelect']."</div>" : '';
            $return.= isset($zoomTmp['folderSelect']) ? "<div style='float: left'>".$zoomTmp['folderSelect']."</div>" : '';
            $return.= "</div>";
        $return.= "</div>";
        /*
        if ($zoom['config']['cornerRadius']){
            $return .= "<div class='zoom-border-container' style='width:".($zoomW+$extPixGal)."px;'><div class='zoom-bottom-left'></div><div class='zoom-bottom-right'></div></div>";
        }
        */

        // End zoomDemoContainer
        $return .= "</div>";
        return $return;
    }
}
?>