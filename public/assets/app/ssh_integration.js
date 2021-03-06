var App = App || {};

App.ssh_integration = (function () {
    "use strict";

    // -- local properties
    var bt_connect_txt = '.bt-connect',

        form_connect_txt = '#form-connect',

        div_ssh_connect_txt = '#div-ssh-connect',
        div_ssh_command_txt = '#div-ssh-command',

        status_txt = '#status',
        select_device = '#device_id',

        output_txt = '#output';


    /**
     * Setup function
     */
    function setup()
    {
        // -- connect to ssh
        bindConnect();
    }

    /**
     * Connect to ssh
     */
    function bindConnect()
    {
        $(bt_connect_txt).on('click', function(ev)
        {
            $.ajax({
                method: "POST",
                url: $(form_connect_txt).attr('action'),
                data: $(form_connect_txt).serialize(),
                beforeSend: function () {
                    showCommand('Enviando comando...');
                },
                error: function (request, error)
                {
                    var msg = request.responseJSON == undefined ? request.responseText : request.responseJSON.output;
                    setStatus( $('<span style="color: red;">'+msg+'</span>') );
                },
                success: function (response)
                {
                    setStatus( '=> ' + $(select_device + ' option:selected').text() );
                    closeDivConnect();
                    openDivCommand();
                    showCommand(response.output);
                }
            });
        });
    }

    /**
     * Set status
     */
    function setStatus(text) {
        $(status_txt).html( text );
    }

    /**
     * Open
     */
    function openDivConnect()
    {
        $(div_ssh_connect_txt).fadeIn();
    }

    /**
     * Close
     */
    function closeDivConnect()
    {
        $(div_ssh_connect_txt).fadeOut(100);
    }

    /**
     * Open
     */
    function openDivCommand()
    {
        $(div_ssh_command_txt).fadeIn();
    }

    /**
     * Close
     */
    function closeDivCommand()
    {
        $(div_ssh_command_txt).fadeOut(100);
    }

    /**
     * Close
     */
    function showCommand(text)
    {
        $(output_txt).hide();
        $(output_txt).text();
        $(output_txt).text(text);
        $(output_txt).fadeIn();
    }

    /**
     * Constructor
     */
    function init() {
        setup();
    }

    // -- set public methods
    return {
        init: init
    }

}());

$(document).ready(function(){
    App.ssh_integration.init(); // is initialized by other places
});