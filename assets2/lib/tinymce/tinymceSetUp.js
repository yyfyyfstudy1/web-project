tinymce.init({
    selector: '#myTextarea',
    // plugins: 'image code',
    //方向从左到右
     directionality: 'ltr',

    plugins: [
    'advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code insertdatetime nonbreaking',
    'save table contextmenu directionality template paste textcolor',
    'codesample imageupload'
    ],
    toolbar: 'undo redo | image code',
     //高度为400
     height: 300,
    statusbar: false,
     width: '100%',
    //工具栏的补丁按钮
    toolbar:
    'insertfile undo redo | \
    styleselect | \
    bold italic | \
    alignleft aligncenter alignright alignjustify | \
    bullist numlist outdent indent | \
    image | \
    preview | \
    forecolor emoticons |\
    codesample fontsizeselect |\
    imageupload',

     //字体大小
    fontsize_formats: '10pt 12pt 14pt 18pt 24pt 36pt',
    //按tab不换行
    nonbreaking_force_tab: true,

    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'infs3202/upload',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'upload/rich_Upload');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});