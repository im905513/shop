function fb_login(){
    var fbid = null;
    var signed_request = null;
    var at = null;
    var get_permissions = "https://graph.facebook.com/me/permissions?access_token=";

    show_loading();
    
    FB.getLoginStatus(function(response) {
        console.log("fb_login_response====================="+response.status);
        if (response.status === 'connected'){
            var uri = base_url + 'user/fblogin';
            fbid = response.authResponse.userID;
            signed_request = response.authResponse.signedRequest;

            $.ajax({
                url: uri,
                type: 'POST',
                dataType: 'json',
                data: {'fbid': fbid, 'signed_request': signed_request},
            })
            .done(function(data) {
                if(data.status == 1){

                    hide_loading();
                    
                    if(data.cli_mobile == -1)
                    {
                        location.href = base_url + 'case/help/step2';
                    }
                    else if( typeof data.cli_mobile != "undefined")
                    {
                        location.href = base_url + 'case/help/step3';
                    }
                    else
                    {
                        location.href = base_url;
                    }
                    
                }
                else if(data.status == -3)
                {
                    var user_data = fb_get_personal_data(fbid);
                    
                }
                else
                {
                    alert("登入失敗");
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
            //signin_fb(fbuid, signed_request);
            //fb_get_personal_data(fbuid);
            
        }
        else {
            // the user isn't logged in to Facebook.
            window.location = "https://www.facebook.com/dialog/oauth?client_id=" + fb_app_id+ 
                                "&redirect_uri="+encodeURIComponent(window.location)+
                                "&state=signin"+
                                "&response_type=token&scope=user_about_me,user_status,email,read_stream,user_likes,friends_likes";   
        } 

    });
}

function fb_comm_login(){
    alert("111");
    var fbid = null;
    var signed_request = null;
    var at = null;
    var get_permissions = "https://graph.facebook.com/me/permissions?access_token=";

    show_loading();

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected'){
            var uri = base_url + 'user/fblogin';
            fbid = response.authResponse.userID;
            signed_request = response.authResponse.signedRequest;

            $.ajax({
                url: uri,
                type: 'POST',
                dataType: 'json',
                data: {'fbid': fbid, 'signed_request': signed_request},
            })
            .done(function(data) {
                if(data.status == 1){
                    hide_loading();
                    
                    location.href = base_url;
                }
                else if(data.status == -3)
                {
                    var user_data = fb_get_personal_data(fbid);
                    
                }
                else
                {
                    alert("登入失敗");
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
            //signin_fb(fbuid, signed_request);
            //fb_get_personal_data(fbuid);
            
        }
        else {
            // the user isn't logged in to Facebook.
            window.location = "https://www.facebook.com/dialog/oauth?client_id=" + fb_app_id+ 
                                "&redirect_uri="+encodeURIComponent(window.location)+
                                "&state=signin"+
                                "&response_type=token&scope=user_about_me,user_status,email,read_stream,user_likes,friends_likes";   
        } 

    });
}

function fb_get_personal_data(fbuid){
    
    var api_qry = '/'+fbuid+'?fields=id,name,first_name,last_name,gender,email,address, '+
                  'locale,timezone,link,picture.type(square).width(200).height(200)';

    FB.api(api_qry,function(response){
        if(response){
            //unblockElement($('#btn_fb_signon'));
            fb_callback(response);
            return true;
        }
        else
        {
            return false;
        }
        
    });
}

function fb_callback(user_data)
{
    
    $.ajax({
        url: base_url + 'user/fbreg',
        type: 'POST',
        dataType: 'json',
        data: {"fbid": user_data.id, "cli_email": user_data.email, "cli_title": user_data.name}
    })
    .done(function(data) {
        if(data.status == 1)
        {
            hide_loading();
            location.href = base_url + 'case/help/step2';
        }
        else
        {
            alert(data.msg);
        }
    })
    .fail(function() {
        console.log("error");
    })
}

function get_url_parameter(name)
{
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null ){
      return null;  
    }else{
      return results[1];
    }
}

function get_url_ancer(name)
{
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\#&]"+name+"=([^&?]*)";
    var regex = new RegExp( regexS );
    var results = regex.exec( window.location.href );
    if( results == null ){
      return null;  
    }else{
      return results[1];
    }
}

