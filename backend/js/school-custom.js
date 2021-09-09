 $(document).on('focus', ':input', function() {
     $(this).attr('autocomplete', 'off');
 });
 $(document).ready(function() {


     $('#sessionModal').modal({
         backdrop: 'static',
         keyboard: false,
         show: false
     })
     $('#activelicmodal').modal({
         backdrop: false,
         keyboard: false,
         show: false
     });
       $('#activelicmodal').on('show.bs.modal', function(event) {
         $('#purchase_code').trigger("reset");
          $('.lic_modal-body .error_message').html("");
        
       });
     $('#sessionModal').on('show.bs.modal', function(event) {
         var $modalDiv = $(event.delegateTarget);
         $('.sessionmodal_body').html("");
         $.ajax({
             type: "POST",
             url: baseurl + "admin/admin/getSession",
             dataType: 'text',
             data: {},
             beforeSend: function() {
                 $modalDiv.addClass('modal_loading');
             },
             success: function(data) {
                 $('.sessionmodal_body').html(data);
             },
             error: function(xhr) { // if error occured
                 $modalDiv.removeClass('modal_loading');
             },
             complete: function() {
                 $modalDiv.removeClass('modal_loading');
             },
         });
     })
     $(document).on('click', '.submit_session', function() {
         var $this = $(this);
         var datastring = $("form#form_modal_session").serialize();
         $.ajax({
             type: "POST",
             url: baseurl + "admin/admin/updateSession",
             dataType: "json",
             data: datastring,
             beforeSend: function() {
                 $this.button('loading');
             },
             success: function(data) {
                 if (data.status == 1) {
                     $('#sessionModal').modal('hide');
                     window.location.href = baseurl + "admin/admin/dashboard";
                       successMsg(data.message);
                 }
             },
             error: function(xhr) {
                 $this.button('reset');
             },
             complete: function() {
                 $this.button('reset');
             },
         });
     });
    
     //=============Sticky header==============
     $('#alert').affix({
         offset: {
             top: 10,
             bottom: function() {}
         }
     })
     $('#alert2').affix({
         offset: {
             top: 20,
             bottom: function() {}
         }
     })
     //========================================
     //==============User Quick session============
     $('#user_sessionModal').modal({
         backdrop: 'static',
         keyboard: false,
         show: false
     })
     $('#user_sessionModal').on('show.bs.modal', function(event) {
         var $modalDiv = $(event.delegateTarget);
         $('.user_sessionmodal_body').html("");
         $.ajax({
             type: "POST",
             url: baseurl + "common/getSudentSessions",
             dataType: 'text',
             data: {},
             beforeSend: function() {
                 $modalDiv.addClass('modal_loading');
             },
             success: function(data) {
                 $('.user_sessionmodal_body').html(data);
             },
             error: function(xhr) { // if error occured
                 $modalDiv.removeClass('modal_loading');
             },
             complete: function() {
                 $modalDiv.removeClass('modal_loading');
             },
         });
     });
     $(document).on('click', '.submit_usersession', function() {
         var $this = $(this);
         var datastring = $("form#form_modal_usersession").serialize();
         $.ajax({
             type: "POST",
             url: baseurl + "common/updateSession",
             dataType: "json",
             data: datastring,
             beforeSend: function() {
                 $this.button('loading');
             },
             success: function(data) {
                 if (data.status == 1) {
                     $('#sessionModal').modal('hide');
                     window.location.href = baseurl + "user/user/dashboard";
                      successMsg(data.message);
                 }
             },
             error: function(xhr) {
                 $this.button('reset');
             },
             complete: function() {
                 $this.button('reset');
             },
         });
     });
     //====================
     $('#commanSessionModal').modal({
         backdrop: 'static',
         keyboard: false,
         show: false
     });
     $('#commanSessionModal').on('show.bs.modal', function(event) {
         var $modalDiv = $(event.delegateTarget);
         $('.commonsessionmodal_body').html("");
         $.ajax({
             type: "POST",
             url: baseurl + "common/getAllSession",
             dataType: 'text',
             data: {},
             beforeSend: function() {
                 $modalDiv.addClass('modal_loading');
             },
             success: function(data) {
                 $('.commonsessionmodal_body').html(data);
             },
             error: function(xhr) { // if error occured
                 $modalDiv.removeClass('modal_loading');
             },
             complete: function() {
                 $modalDiv.removeClass('modal_loading');
             },
         });
     });
     $(document).on('click', '.submit_common_session', function() {
         var $this = $(this);
         var datastring = $("form#form_modal_commonsession").serialize();
         $.ajax({
             type: "POST",
             url: baseurl + "common/updateSession",
             dataType: "json",
             data: datastring,
             beforeSend: function() {
                 $this.button('loading');
             },
             success: function(data) {
                 if (data.status == 1) {
                     $('#sessionModal').modal('hide');
                     window.location.href = data.redirect_url;
                   successMsg(data.message);
                 }
             },
             error: function(xhr) {
                 $this.button('reset');
             },
             complete: function() {
                 $this.button('reset');
             },
         });
     });
     $("#purchase_code").submit(function(e) {
         var form = $(this);
         var url = form.attr('action');
         var $this = $(this);
         var $btn = $this.find("button[type=submit]");
         $.ajax({
             type: "POST",
             url: url,
             data: form.serialize(),
             dataType: 'JSON',
             beforeSend: function() {
                  $('.lic_modal-body .error_message').html("");
                 $btn.button('loading');
             },
             success: function(response, textStatus, xhr) {


                 if (xhr.status != 200) {
                     var $newmsgDiv = $("<div/>") // creates a div element              
                         .addClass("alert alert-danger") // add a class
                         .html(response.response);
                     $('.lic_modal-body .error_message').append($newmsgDiv);
                 }else if(xhr.status == 200){

                 if (response.status == 2) {
                     $.each(response.error, function(key, value) {
                         $('#input-' + key).parents('.form-group').find('#error').html(value);
                     });
                 }else if (response.status == 1) {
                     successMsg(response.message);
                     window.location.href=baseurl+'admin/admin/dashboard';
                     $('#activelicmodal').modal('hide');
                 }
             }
                 
             },
             error: function(xhr, status, error) {
               $btn.button('reset');
               var r = jQuery.parseJSON(xhr.responseText);          
               var $newmsgDiv = $("<div/>") // creates a div element              
                         .addClass("alert alert-danger") // add a class
                         .html(r.response);
                     $('.lic_modal-body .error_message').append($newmsgDiv);
              
             },
             complete: function() {
                 $btn.button('reset');
             },
         });
         e.preventDefault();
     });
 });

 
 $(document).ready(function () {
         $('#andappModal').modal({
         backdrop: 'static',
         keyboard: false,
         show: false
     })

      $("#andapp_code").on('submit', (function (e) {
        e.preventDefault();

        var _this = $(this);
        var $this = _this.find("button[type=submit]:focus");

        $.ajax({
             type: "POST",
             url: _this.attr('action'),
             data: _this.serialize(),
             dataType: 'JSON',
            beforeSend: function () {
                $('.andapp_modal-body .error_message').html("");
                $("[class^='input-error']").html("");
                $this.button('loading');

            },
             success: function(response, textStatus, xhr) {
                 if (xhr.status != 200) {
                     var $newmsgDiv = $("<div/>") // creates a div element
                         .addClass("alert alert-danger") // add a class
                         .html(response.response);
                     $('.lic_modal-body .error_message').append($newmsgDiv);
                 }else if(xhr.status == 200){

                 if (response.status == 2) {
                     $.each(response.error, function(key, value) {
                         $('#input-' + key).parents('.form-group').find('#error').html(value);
                     });
                 }else if (response.status == 1) {
                     successMsg(response.message);
                     window.location.href=baseurl+'schsettings';
                     $('#andappModal').modal('hide');
                 }
             }
             },
            error: function (xhr) { // if error occured
                 $this.button('reset');
               var r = jQuery.parseJSON(xhr.responseText);
               var $newmsgDiv = $("<div/>") // creates a div element
                         .addClass("alert alert-danger") // add a class
                         .html(r.response);
                     $('.andapp_modal-body .error_message').append($newmsgDiv);
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
$('#addonModal').modal({
             backdrop: 'static',
             keyboard: false,
             show: false
         });
        $('#addonModal').on('shown.bs.modal', function(e) { 
        $('.addon_type',this).val($(e.relatedTarget).data('addon'));
        $('.addon_version',this).val($(e.relatedTarget).data('addonVersion'));
       }) ;

      $("#addon_verify").on('submit', (function (e) {
        e.preventDefault();

        var _this = $(this);
        var $this = _this.find("button[type=submit]:focus");

        $.ajax({
             type: "POST",
             url: _this.attr('action'),
             data: _this.serialize(),
             dataType: 'JSON',
            beforeSend: function () {
                $('.addon_modal-body .error_message').html("");
                $("[class^='input-error']").html("");
                $this.button('loading');

            },
             success: function(response, textStatus, xhr) {
                 if (xhr.status != 200) {
                     var $newmsgDiv = $("<div/>") // creates a div element
                         .addClass("alert alert-danger") // add a class
                         .html(response.response);
                     $('.addon_modal-body .error_message').append($newmsgDiv);
                 }else if(xhr.status == 200){

                 if (response.status == 2) {
                     $.each(response.error, function(key, value) {
                         $('#input-' + key).parents('.form-group').find('#error').html(value);
                     });
                 }else if (response.status == 1) {
                     successMsg(response.message);
                     window.location.href=response.back;
                     $('#addonModal').modal('hide');
                 }
             }
             },
            error: function (xhr) { // if error occured
                 $this.button('reset');
               var r = jQuery.parseJSON(xhr.responseText);
               var $newmsgDiv = $("<div/>") // creates a div element
                         .addClass("alert alert-danger") // add a class
                         .html(r.response);
                     $('.addon_modal-body .error_message').append($newmsgDiv);
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
      
    });

  