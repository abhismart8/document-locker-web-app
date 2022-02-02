const uploadFile = (url) => {
    console.log(url);
    var formData = new FormData();
    var imagefile = document.querySelector('#file');
    formData.append("file", imagefile.files[0]);
    axios.post(url, formData, {
        headers: {
        'Content-Type': 'multipart/form-data'
        }
    })
    .then(function (response) {
        if(response.data.status == 'success'){
            iziToast.success({
                message: response.data.message,
            });
            setTimeout(function(){
                window.location.reload();
            }, 1000);
        }

        if(response.data.status == 'failed'){
            var errors = response.data.data;
            for (const [key, value] of Object.entries(errors)) {
                value.forEach((val,index) => {
                    iziToast.error({
                        title: localMsg.error,
                        timeout: 5000,
                        message: val
                    })
                })
            }
        }
    })
    .catch(function (err) {
        iziToast.error({
            title: 'Invalid file type',
            message: 'File not supported'
        })
    })
}

$('.upload-file').on('click', function(e){
    e.preventDefault();
    $('#file').trigger('click');
})

$('#file').on('change', function(){
    uploadFile($(this).next('a').attr('href'));
})

// view file
$('.view-file').on('click', function(e){
    e.preventDefault();
    $('iframe#file_iframe').attr('src', $(this).attr('href'));

    // current pdf active, siblings inactive
    $(this).parent('div').addClass('active')
    $(this).parent('div').siblings().removeClass('active');

    // show file name
    $('#show-file-name').find('h4').html($(this).find('h5').html());
})