<?php

    /*
    *  Copyright (c) Codiad & daeks, distributed
    *  as-is and without warranty under the MIT License. See
    *  [root]/license.txt for more. This information must remain intact.
    */


    require_once('../../common.php');
    require_once('class.git.php');

    //////////////////////////////////////////////////////////////////
    // Verify Session or Key
    //////////////////////////////////////////////////////////////////

    checkSession();

    $Git = new Git();

    //////////////////////////////////////////////////////////////////
    // Pull Repo
    //////////////////////////////////////////////////////////////////

    if($_GET['action']=='pull'){
        $Git->path = $_GET['path'];
        $Git->gitrepo = $_GET['git_repo'];
        $Git->gitbranch = $_GET['git_branch'];
        $Git->Pull();
    }
   
?>