function upload_hinhanh(path = "") {
    $(".hinhanh_files").change(function () {
        var formData = new FormData($("#dinhkemform")[0]);
        $("#progressbar").show();
        $.ajax({
            url: path,
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener(
                        "progress",
                        function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil((position / total) * 100);
                            }
                            //update progressbar
                            $(".progress .progress-bar").css(
                                "width",
                                +percent + "%",
                            );
                            $(".progress .progress-bar").text(percent + "%");
                            if (percent == 100) {
                                $("#progressbar").fadeOut();
                            }
                        },
                        true,
                    );
                }
                return xhr;
            },
            success: function (datas) {
                if (datas == "Failed") {
                    alert("Lỗi không thể Upload hình ảnh.");
                } else {
                    $("#list_hinhanh").prepend(datas);
                    $(".draggable-element").arrangeable();
                    popup_images();
                    delete_file();
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        }).fail(function () {
            alert("Lỗi không thể Upload hình ảnh.");
        });
    });
}
function upload_files(path) {
    $(".dinhkem_files").change(function () {
        var formData = new FormData($("#dinhkemform")[0]);
        $("#progressbar").show();
        $.ajax({
            url: path,
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener(
                        "progress",
                        function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil((position / total) * 100);
                            }
                            //update progressbar
                            $(".progress .progress-bar").css(
                                "width",
                                +percent + "%",
                            );
                            $(".progress .progress-bar").text(percent + "%");
                            if (percent == 100) {
                                $("#progressbar").fadeOut();
                            }
                        },
                        true,
                    );
                }
                return xhr;
            },
            success: function (datas) {
                if (datas == "Failed") {
                    alert("Lỗi không thể Upload tập tin.");
                } else {
                    $("#list_files").prepend(datas);
                    delete_file();
                    $(".draggable-element").arrangeable();
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        }).fail(function () {
            alert("Lỗi không thể Upload tập tin.");
        });
    });
}
function delete_file() {
    $(document)
        .off("click", ".delete_file")
        .on("click", ".delete_file", function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            var item = $(this).closest(".items");

            if (confirm("Bạn có chắc chắn muốn xóa hình ảnh này không?")) {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (response) {
                        item.fadeOut("slow", function () {
                            $(this).remove();
                        });
                    },
                    error: function () {
                        alert("Không thể xóa ảnh, vui lòng thử lại.");
                    },
                });
            }
            return false;
        });
}

function chontinh(app_url) {
    $("#address_1").change(function () {
        $.get(app_url + "admin/dia-chi/get/" + $(this).val(), function (tinh) {
            $("#address_2").html(tinh);
            chonhuyen();
        });
    });
}

function chonhuyen(app_url) {
    $("#address_2").change(function () {
        var path = app_url + "admin/dia-chi/get/" + $(this).val();
        $.get(path, function (huyen) {
            $("#address_3").html(huyen);
        });
    });
}
function popup_images() {
    $(".image-popup").magnificPopup({
        type: "image",
        closeOnContentClick: true,
        mainClass: "mfp-fade",
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1],
        },
    });
}

function convertToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, ""); // trim
    str = str.toLowerCase();
    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }
    str = str
        .replace(/[^a-z0-9 -]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-");
    return str;
}
