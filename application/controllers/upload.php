<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
    public function __construct()
    {
        // Call the  constructor
        parent::__construct();			
        $this->root_directory = $this->config->item('base_path')."/";
    }

    function checkUpdateDir($dateDir = array(),$subTargetPath = null) {
        $arrayReturn = array();
        if($dateDir!=null){
            $targetDir = $newDir = "";
            foreach($dateDir as $value){
                if($newDir == ""){
                    $newDir = $value;
                }else{
                    $newDir .= "/".$value;
                }
                if($subTargetPath != null){
                    $targetDir = $this->root_directory.$subTargetPath."/".$newDir."/";
                }else{
                    $targetDir = $this->root_directory.$newDir."/";
                }
                $checkDir = is_dir($targetDir);
                if($checkDir == false){
                    mkdir($targetDir, 0777, true);
                }
            }
            
            $arrayReturn['newDir'] 		= $newDir;
            $arrayReturn['targetDir'] 	= $targetDir;
            if($subTargetPath != null){
                $relativePath 				=  $subTargetPath."/".$newDir."/";
            }else{
                $relativePath 				=  $newDir."/";
            }
            $arrayReturn['relativePath']	= str_replace('\/','/',$relativePath);
            return $arrayReturn;
        }else{
            return;
        }
    }

    function go($paramUpload = null) {
        $this->allowed_ext 		= $this->config->item('allowed_ext');
        $this->root_directory 	= $this->config->item('base_path')."/";    
        $subTargetPath			= null;
        $subDirectory           = 'static/upload';

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $dateDir 		= array();
        $dateDir['Y']	= date("Y");
        $dateDir['m']	= date("m");
        $dateDir['d']	= date("d");
        $newTargetDir 	= $this->checkUpdateDir($dateDir,$subDirectory);
        $targetDir      = $newTargetDir['targetDir'];
        $relativePath   = $newTargetDir['relativePath'];

        $cleanupTargetDir 	= true; // Remove old files
        $maxFileAge     	= 5 * 3600;

        @set_time_limit(5 * 60);

        $chunk      = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks     = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName   = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

        $ext = GetExtention($fileName);
        if (!in_array($ext, $this->allowed_ext)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Tipe file tidak valid atau tidak cocok dengan platform aplikasi.."} }');
        }
        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
        
        if($chunks < 2 && file_exists($targetDir . "/" . $fileName)){
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . "/" . $fileName_a . '_' . $count . $fileName_b))
            $count++;
            
            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }else if(file_exists($targetDir . "/" . $fileName)){
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);
            
            $count = 1;
            while (file_exists($targetDir . "/" . $fileName_a . '_' . $count . $fileName_b))
            $count++;
            
            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir .$fileName;

        if (!file_exists($targetDir)){
            @mkdir($targetDir);
        }

        if ($cleanupTargetDir) {
            if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                while (($file = readdir($dir)) !== false) {
                    $tmpfilePath = $targetDir . "/" . $file;
                    if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                        @unlink($tmpfilePath);
                    }
                }
                closedir($dir);
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
        }

        if (isset($_SERVER["HTTP_CONTENT_TYPE"])){
			$contentType = $_SERVER["HTTP_CONTENT_TYPE"];
        }
            
        if (isset($_SERVER["CONTENT_TYPE"])){
			$contentType = $_SERVER["CONTENT_TYPE"];
        }

        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, "multipart") !== false) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                // Open temp file
                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = @fopen($_FILES['file']['tmp_name'], "rb");
                    
                    if ($in) {
                        while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                    } else {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                    @fclose($in);
                    @fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                } else {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                }
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }
        } else {
            // Open temp file
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = @fopen("php://input", "rb");
                
                if ($in) {
                    while ($buff = fread($in, 4096))
                    fwrite($out, $buff);
                } else{
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                }
                
                @fclose($in);
                @fclose($out);
            } else{
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
        }

        if (!$chunks || $chunk == $chunks - 1) {
            rename("{$filePath}.part", $filePath);
        }

        if ( !empty($_GET['screenshot']) ) {
            $config2 = array(
                'image_library' => 'gd2',
                'source_image' => $filePath,
                'maintain_ratio' => true,
                'width' => 450,
                'height' => 350,
            );
            $this->load->library('image_lib', $config2);
            if($this->image_lib->resize()) {
                $config2['create_thumb'] = true;
                $config2['thumb_marker'] = '_thumb';
                $config2['width'] = 150;
                $config2['height'] = 150;
                
                $this->image_lib->initialize($config2);
                
                if ($this->image_lib->resize()) {
                    $thumb = substr($this->image_lib->full_dst_path, strlen($this->image_lib->dest_folder));
                    $result['thumbName'] = $thumb;
                }
            }
        } else if (!empty($_GET['icon'])) {
            list($width, $height, $type, $attr) = getimagesize($filePath);
            if ($width > $height) {
                $config2 = array(
                    'image_library' => 'gd2',
                    'source_image' => $filePath,
                    'width' => $height,
                    'height' => $height,
                    'x_axis' => ($width-$height) / 2
                );
            } else {
                $config2 = array(
                    'image_library' => 'gd2',
                    'source_image' => $filePath,
                    'width' => $width,
                    'height' => $width,
                    'x_axis' => ($height-$width)/2
                );
            }
            
            $this->load->library('image_lib', $config2);
            if($this->image_lib->crop()) {
                $config2 = array(
                    'image_library' => 'gd2',
                    'source_image' => $filePath,
                    'maintain_ratio' => true,
                    'width' => 150,
                    'height' => 150,
                );
                
                $this->image_lib->initialize($config2);
                if ($this->image_lib->resize()) {
                    $thumb = substr($this->image_lib->full_dst_path, strlen($this->image_lib->dest_folder));
                    $result['thumbName'] = $thumb;
                }
            }
        }

        $resultUpload = pathinfo($filePath);

        $result['tgl_upload'] = date('Y-m-d H:i:s');
        
        $filteredFilename = substr($resultUpload["filename"], 0, 50);
        $renameFile = $filteredFilename."_".time().".".$resultUpload['extension'];
        if(file_exists($filePath)){
            if(rename($filePath, $resultUpload['dirname']."/".$renameFile));
        }
        $result['fileName'] = $renameFile;
        $result['jsonrpc'] 		= '2.0';
        $result['filePath'] 	= $targetDir;
        $result['relativePath'] = $relativePath;
        $result['new_dir'] 		= $newTargetDir['newDir'];

        die(json_encode($result));
    }

    public function delUnsaveDokumen(){
        $this->root_directory 	= $this->config->item('base_path')."/";
        $result = array();
        $result["success"] 	= "0";
        $result['message']	= "";
        if(count(array($_POST['deleteUploadedDokumen'])))
        {
            foreach($_POST['deleteUploadedDokumen'] as $key=>$value)
            {
                if(file_exists($this->root_directory.$value))
                {
                    if(!(unlink($this->root_directory.$value)))
                        {
                            $result["success"] 	= "0";
                            $result['message']	.= "File ".$value." gagal dihapus";
                        }else{
                            $this->Task_model->delLampiranTask($value);
                            $result["success"] = "1";
                            $result['message']	.= "File ".$value." berhasil dihapus";
                        }
                }
            }
        }
        echo json_encode($result);
    }
}