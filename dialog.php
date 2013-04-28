<?php

    /*
    *  Copyright (c) Codiad & daeks, distributed
    *  as-is and without warranty under the MIT License. See 
    *  [root]/license.txt for more. This information must remain intact.
    */

    require_once('../../common.php');
    
    //////////////////////////////////////////////////////////////////
    // Verify Session or Key
    //////////////////////////////////////////////////////////////////
    
    checkSession();

    switch($_GET['action']){
            
        //////////////////////////////////////////////////////////////////////
        // Pull Repo
        //////////////////////////////////////////////////////////////////////
        
        case 'pull':
        
            ?>
            <form>
            <label>Folder Name</label>
            <input name="path" autofocus="autofocus" autocomplete="off">            
            <!-- Clone From GitHub -->
            <div style="width: 500px;">
            <table id="git-clone">
                <tr>
                    <td>
                        <label>Git Repository</label>
                        <input name="git_repo">
                    </td>
                    <td width="5%">&nbsp;</td>
                    <td width="25%">
                        <label>Branch</label>
                        <input name="git_branch" value="master">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="note">Note: This will only work if your Git repo DOES NOT require interactive authentication and your server has git installed.</td>
                </tr>
            </table>
            </div>
            <!-- /Clone From GitHub -->        
            <button class="btn-left">Execute</button><button class="btn-right" onclick="codiad.modal.unload();return false;">Cancel</button>
            <form>
            <?php
            break;
            
    }
    
?>
