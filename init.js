/*
 *  Copyright (c) Codiad & daeks, distributed
 *  as-is and without warranty under the MIT License. See
 *  [root]/license.txt for more. This information must remain intact.
 */

(function(global, $){

    var codiad = global.codiad,
        scripts = document.getElementsByTagName('script'),
        path = scripts[scripts.length-1].src.split('?')[0],
        curpath = path.split('/').slice(0, -1).join('/')+'/';

    $(function() {
        codiad.git.init();
    });

    codiad.git = {
        
        controller: curpath + 'controller.php',
        dialog: curpath + 'dialog.php',

        init: function() {
        },
        
        pull: function() {
            var _this = this;
            codiad.modal.load(550, _this.dialog + '?action=pull');
            $('#modal-content form')
                .live('submit', function(e) {
                e.preventDefault();
                var root = codiad.project.getCurrent(),
                    path = root + '/' + $('#modal-content form input[name="path"]')
                    .val(),
                    gitRepo = $('#modal-content form input[name="git_repo"]')
                    .val(),
                    gitBranch = $('#modal-content form input[name="git_branch"]')
                    .val();
                    $('#modal-content').html('<div id="modal-loading"></div><div align="center">Contacting GitHub...</div><br>');
                    $.get(_this.controller + '?action=pull&path=' + path + '&git_repo=' + gitRepo + '&git_branch=' + gitBranch, function(data) {
                        createResponse = codiad.jsend.parse(data);
                        if (createResponse != 'error') {
                            codiad.message.success(createResponse.message);
                            codiad.filemanager.rescan(root);
                        } else {
                            codiad.message.error(createResponse.message);
                        }
                        codiad.modal.unload();
                    });
            });
        },
                
        open: function(path) {
        }
        
    };

})(this, jQuery);
