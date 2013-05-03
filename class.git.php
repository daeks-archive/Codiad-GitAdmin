<?php

    /*
    *  Copyright (c) Codiad & daeks, distributed
    *  as-is and without warranty under the MIT License. See 
    *  [root]/license.txt for more. This information must remain intact.
    */
    
require_once('../../common.php');

class Git extends Common {
  
    //////////////////////////////////////////////////////////////////
    // PROPERTIES
    //////////////////////////////////////////////////////////////////
    
    public $path         = '';
    public $gitrepo      = false;
    public $gitbranch    = '';
    public $command_exec = '';
    
    //////////////////////////////////////////////////////////////////
    // METHODS
    //////////////////////////////////////////////////////////////////

    // -----------------------------||----------------------------- //

    //////////////////////////////////////////////////////////////////
    // Construct
    //////////////////////////////////////////////////////////////////

    public function __construct(){
    }
    
    //////////////////////////////////////////////////////////////////
    // Pull Repo
    //////////////////////////////////////////////////////////////////
    
    public function pull(){
        if($this->gitrepo){
            if(!$this->isAbsPath($this->path)) {
                if(!file_exists(WORKSPACE . '/' . $this->path)) {
                    mkdir(WORKSPACE . '/' . $this->path);
                    $this->command_exec = "cd " . WORKSPACE . '/' . $this->path . " && git init && git pull " . $this->gitrepo . " " . $this->gitbranch;
                } else {
                    die(formatJSEND("success",array("message"=>"Folder already exists")));
                }
            } else {
                if(!file_exists($this->path)) {
                    mkdir($this->path);
                    $this->command_exec = "cd " . $this->path . " && git init && git pull " . $this->gitrepo . " " . $this->gitbranch;
                } else {
                    die(formatJSEND("success",array("message"=>"Folder already exists")));
                }
            }
            $this->ExecuteCMD();
            echo formatJSEND("success",array("message"=>"Repo cloned"));
        } else {
            echo formatJSEND("error",array("message"=>"No Repo specified"));
        }
    }
    
    //////////////////////////////////////////////////////////////////
    // Execute Command
    //////////////////////////////////////////////////////////////////
    
    public function ExecuteCMD(){
        if(function_exists('system')){
            ob_start();
            system($this->command_exec);
            ob_end_clean();
        }
        //passthru
        else if(function_exists('passthru')){
            ob_start();
            passthru($this->command_exec);
            ob_end_clean();
        }
        //exec
        else if(function_exists('exec')){
            exec($this->command_exec , $this->output);
        }
        //shell_exec
        else if(function_exists('shell_exec')){
            shell_exec($this->command_exec);
        }
    }
   
}

?>
