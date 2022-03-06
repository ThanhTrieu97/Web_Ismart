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

$(document).ready(function() {
    $("input[name='list_check[]']").on('change', function() {
        var id = $(this).attr('id');
        return id;
    });
    $("input[name='btn_action']").on('click', function() {;
        var action = $("select[name='action']").val();
        var checkbox = document.getElementById('checkall');
        var user_checked = checkbox.checked;
        if (user_checked == true && action == 'deleteForever') {
            return confirm('Dá»¯ liá»‡u cá»§a nhá»¯ng user nÃ y sáº½ máº¥t náº¿u báº¡n thá»±c hiá»‡n thao tÃ¡c nÃ y !');
        }
    });
});
//
$(document).ready(function() {
    var val = $(".switch input[name='fea']").val();
    if (val == 1) {
        $(".switch .slider").toggleClass('active');
    }
    $(".switch").click(function() {
        $(".switch input[name='fea']").attr('value', function(index, attr) {
            return attr == 1 ? 0 : 1;
        });
        $(".switch .slider").toggleClass('active');
    });
});
//Pháº§n Color
$(document).ready(function() {
    $('#color').change(function() {
        var data = $(this).val();
        $('p.color').html(data);
    });

});
//pháº§n thumbnail
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
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//tooll tip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
//show hide chá»n color
$(document).ready(function() {
    $('.choose-color').click(function() {
        $('.list-color').stop().slideToggle();
        return false;
    });
});


//Tiềm kiếm ajax
// $(document).ready(function(){
//     $("#keyword").autocomplete({
//             serviceUrl:"http://thanh.unitopcv.com/unimart/admin/handle/product/search",
//             paramName: "keyword",
//             onSelect: function(suggestion) {
//                 $("#keyword").val(suggestion.value);
//             },
//             transformResult: function(response) {
//                 return {
//                     suggestions: $.map($.parseJSON(response), function(item) {
//                         return {
//                             value: item.name,
//                         };
//                     })
//                 };
//             },
//         });
// });


$(document).ready(function() {
    LoadData();
});

function LoadData() {
    $.ajax({
        type: "GET",
        url: "http://localhost:8080/unitop.vn/laravelpro/unimart",
        // dataType: "json",
        success: function(rs) {
            console.log(rs);

        }
    });
} <


$(document).ready(function() {
    $("table").on('click', 'td#product-detail', function() {
        var data_id = $(this).attr('data-id');
        var data = { data_id: data_id }
        $.ajax({
            url: "http://thanh.unitopcv.com/unimart/admin/handle/product/detail",
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function(data) {
                $(".modal .modal-body .user p").html(data.user_id);
                $(".modal .modal-body .id p").html(data.id);
                $(".modal .modal-body .code p").html(data.code);
                $(".modal .modal-body .name p").html(data.name);
                $(".modal .modal-body .price p").html(data.price);
                $(".modal .modal-body .cat p").html(data.cat);
                $(".modal .modal-body .color p").html(data.color);
                $(".modal .modal-body .featured p").html(data.featured);
                $(".modal .modal-body .status p").html(data.status);
                $(".modal .modal-body .date-created p").html(data.created_ad);
                $(".modal .modal-body .date-updated p").html(data.updated_at);
                $(".modal .modal-body .date-delete p").html(data.deleted_at);
                if (data.thumbnail != '') {
                    $(".modal .modal-body p img").attr('src', data.thumbnail);
                }
                $(".modal .modal-body .desc p").click(function() {
                    alert('ok');
                });
                $(".modal .modal-body .content p").click(function() {
                    alert('ke');
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    });
});


$(document).ready(function() {
    $("table").on('click', 'td#page-detail', function() {
        var data_id = $(this).attr('data-id');
        var data = { data_id: data_id }
        $.ajax({
            url: "http://thanh.unitopcv.com/unimart/admin/handle/page/detail",
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function(data) {
                $(".modal .modal-body .user p").html(data.user_id);
                $(".modal .modal-body .id p").html(data.id);
                $(".modal .modal-body .slug p").html(data.slug);
                $(".modal .modal-body .model-title p").html(data.title);
                $(".modal .modal-body .status p").html(data.status);
                $(".modal .modal-body .date-created p").html(data.created_ad);
                $(".modal .modal-body .date-updated p").html(data.updated_at);
                $(".modal .modal-body .date-delete p").html(data.deleted_at);
                if (data.deleted_at != '') {
                    $(".modal .modal-body p img").attr('src', data.deleted_at);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    });
});


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
//
$(document).ready(function() {
    $("input[name='list_check[]']").on('change', function() {
        var id = $(this).attr('id');
        return id;
    });
    $("input[name='btn_action']").on('click', function() {;
        var action = $("select[name='action']").val();
        var checkbox = document.getElementById('checkall');
        var user_checked = checkbox.checked;
        if (user_checked == true && action == 'deleteForever') {
            return confirm('Dữ liệu của những user này sẽ mất nếu bạn thực hiện thao tác này !');
        }
    });
});
//
$(document).ready(function() {
    var val = $(".switch input[name='fea']").val();
    if (val == 1) {
        $(".switch .slider").toggleClass('active');
    }
    $(".switch").click(function() {
        $(".switch input[name='fea']").attr('value', function(index, attr) {
            return attr == 1 ? 0 : 1;
        });
        $(".switch .slider").toggleClass('active');
    });
});
//Phần Color
$(document).ready(function() {
    $('#color').change(function() {
        var data = $(this).val();
        $('p.color').html(data);
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
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//tooll tip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
//show hide chọn color
$(document).ready(function() {
    $('.choose-color').click(function() {
        $('.list-color').stop().slideToggle();
        return false;
    });
});