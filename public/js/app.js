$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
});

//phần thumbnail
$(document).ready(function() {
    $("#file").change(function() {
        var data = $(this).val();
        if (data != '') {
            $('#thumbnail').css('display', "block");
        } else {
            $('#thumbnail').css('display', "none");
        }
    });
});

function showThumbNail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#thumbnail').css('width', "150px");
            $('#thumbnail').css('height', "150px");
            $('#thumbnail').css('margin-top', "10px");
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// phan
// $(document).ready(function() {
//     $('.list-color li').click(function() {
//         var code_name = $(this).find('span').attr('code');
//         var data = { code: code_name };
//         $.ajax({
//             url: "http://localhost:8080/unitop.vn/laravelpro/unimart/",
//             method: 'GET',
//             data: data,
//             dataType: 'json',
//             success: function(data) {
//                 if (data.error) {
//                     $(".error").html(data.error);
//                 } else {
//                     $(".list-selected-color").html(data);
//                     $(".error").html(null);
//                 }
//             },
//             error: function(xhr, ajaxOptions, thrownError) {
//                 // alert(xhr.status);
//                 // alert(thrownError);
//             }
//         });
//     });

// $('.list-selected-color').on('click', 'span', function(e) {
//     e.preventDefault();
//     var id = $(this).attr('data-code');
//     var data = { id: id };
//     $.ajax({
//         url: "http://thanh.unitopcv.com/unimart/admin/handle/color/product/delete",
//         method: 'GET',
//         data: data,
//         dataType: 'json',
//         success: function(data) {
//             $(".list-selected-color").html(data);
//         },
//         error: function(xhr, ajaxOptions, thrownError) {
//             // alert(xhr.status);
//             // alert(thrownError);
//         }
//     });
// });
// });


// });
