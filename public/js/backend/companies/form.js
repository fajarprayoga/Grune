$(function () {
    // init: side menu for current page
    $('li#menu-companies').addClass('menu-open active');
    $('li#menu-companies').find('.treeview-menu').css('display', 'block');
    $('li#menu-companies').find('.treeview-menu').find('.edit-companies a').addClass('sub-menu-active');

    $('#companies-form').validationEngine('attach', {
        promptPosition : 'topLeft',
        scroll: false
    });

    

    // init: show tooltip on hover
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    
});

// Email

function checkEmail(field){
    var email = field.val();
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.match(mailformat))
    {
        var n = email.indexOf("@company.com");
        if (n < 0) {
            return '* Please email must @company.com ' 
        }
    }else{
        return '* Please insert your email';
    }

}


function checkImage() {
    if( document.getElementById("image_file").files.length > 0 ){
        var img_file = document.getElementById("image_file").files[0]
	    var extensions = new Array("jpg","jpeg","png",);
        var img_name =img_file.name;
        var pos = img_name.split(".");
        var ext = pos[pos.length - 1];
        var final_ext = ext.toLowerCase();


        if(!extensions.includes(final_ext)){
            return 'File not is image'
        }else{
            let fileSize = Math.round(img_file.size / 1024);
            if (fileSize >= 1048576) {
                return "File cant be uploaded too big max 1mb";
            } 
        }
    }else{
        return '* Select file image'
    }

}
