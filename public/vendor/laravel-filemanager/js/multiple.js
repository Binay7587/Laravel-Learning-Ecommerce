$.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        localStorage.setItem('target_input', $(this).data('input'));
        localStorage.setItem('target_preview', $(this).data('preview'));
        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            var target_input = $('#' + localStorage.getItem('target_input'));
            var current_input = $('#'+localStorage.getItem('target_input')).val();

            var target_preview = $('#' + localStorage.getItem('target_preview'));

            if(current_input == ''){
                target_input.val(file_path).trigger('change');
            }else {
                target_input.val(current_input+','+file_path);
            }
            var img = "<div class='lfm-image col-sm-3' >";
            img += "<img src='"+url+"' class='img img-responsive img-thumbnail' style='padding-left:20px; margin-right: 10px;'>";
            img += "<a href='javascript:;' class='lfm-img-close-btn' onclick='deleteThis(this)' data-value='"+file_path+"' >X</a></div>"
            target_preview.append(img);
        };
        return false;
    });
}
function arrayRemove(array, value) {

    var index = array.indexOf(value);
    if (index > -1) {
        array.splice(index, 1);
    }
    return array;

}

function deleteThis(elem){
    var image = $(elem).data('value');
    var image_data = $('#' + localStorage.getItem('target_input')).val();

    image_data =  image_data.split(',');
    image_data = arrayRemove(image_data, image);

    $('#' + localStorage.getItem('target_input')).val(image_data.toString());
    var parent = $(elem).parent();
    parent.remove();

}

