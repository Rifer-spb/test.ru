document.querySelector('.product-upload-image input[type=file]').addEventListener('change', e => {
    const productImageUrl = '/admin/widgets/product/upload-image';
    const files = e.target.files || e.dataTransfer.files;
    if (!files.length) {
        return;
    }
    const input = e.target,
        id = e.target.getAttribute('data-id'),
        parent = input.closest('.product-upload-image'),
        error = parent.querySelector('.error'),
        progress = parent.querySelector('.progress-wrap'),
        imageList = parent.querySelector('.image-list'),
        file = files[0];
    if(file.size>1048576) {
        error.innerHTML = 'Максимально допустимы размер 1мб';
        return;
    }
    progress.style.opacity = 1;
    e.preventDefault();
    const formData = new FormData();
    formData.append('UploadForm[id]',id);
    formData.append('UploadForm[file]',files[0]);
    formData.append(yii.getCsrfParam(),yii.getCsrfToken());
    xhr = new XMLHttpRequest();
    xhr.upload.onprogress = function(evt) {
        if (evt.lengthComputable) {
            const percentComplete = parseInt((evt.loaded / evt.total) * 100);
            progress.querySelector('.progress-bar').style.width = percentComplete+'%';
        }
    };
    xhr.onload = () => {
        const data = xhr.response;
        if(data) {
            progress.style.opacity = 0;
            if(!data.error) {
                imageList.innerHTML = data.html;
                progress.querySelector('.progress-bar').style.width = '0';
                productImageActions();
            } else {
                const e = data.error;
                error.innerHTML = e['uploadform-file'][0];
            }
        }
    };
    error.innerHTML = '';
    xhr.responseType = 'json';
    xhr.open('POST', productImageUrl+'/upload');
    xhr.send(formData);
});

document.querySelector('.product-upload-image .abort').addEventListener('click', e => {
    e.preventDefault();
    if(xhr){
        xhr.abort();
        const progress = document.querySelector('.product-upload-image .progress-wrap');
        progress.querySelector('.progress-bar').style.width = '0';
        progress.style.opacity = 0;
    }
});

function productImageItemActions() {
    const productImageUrl = '/admin/widgets/product/upload-image';
    document.querySelectorAll('.product-upload-image .image-item').forEach(el => {
        el.querySelector('.delete>a').addEventListener('click', e => {
            e.preventDefault();
            const elm = e.target,
                item = elm.closest('.image-item'),
                id = item.getAttribute('data-id'),
                imageList = document.querySelector('.product-upload-image .image-list');
            const xhr = new XMLHttpRequest();
            xhr.onload = () => {
                const data = xhr.response;
                if(data) {
                    imageList.innerHTML = data.html;
                    productImageActions();
                }
            };
            xhr.responseType = 'json';
            xhr.open('GET', productImageUrl+'/delete?id='+id);
            xhr.send();
        });
        el.querySelector('.default>input[type=radio]').addEventListener('click', e => {
            const elm = e.target,
                item = elm.closest('.image-item'),
                id = item.getAttribute('data-id'),
                imageList = document.querySelector('.product-upload-image .image-list');
            const xhr = new XMLHttpRequest();
            xhr.onload = () => {
                const data = xhr.response;
                if(data) {
                    imageList.innerHTML = data.html;
                    productImageActions();
                }
            };
            xhr.responseType = 'json';
            xhr.open('GET', productImageUrl+'/set-default?id='+id);
            xhr.send();
        });
    });
}

productImageItemActions();