"use strict";

// DropzoneJS
if (window.Dropzone) {
    Dropzone.autoDiscover = false;
}

// Basic confirm box
$("[data-confirm]").each(function () {
    var me = $(this),
        me_data = me.data("confirm");

    me_data = me_data.split("|");
    me.fireModal({
        title: me_data[0],
        body: me_data[1],
        buttons: [
            {
                text: me.data("confirm-text-yes") || "Yes",
                class: "btn btn-danger btn-shadow",
                handler: function () {
                    eval(me.data("confirm-yes"));
                },
            },
            {
                text: me.data("confirm-text-cancel") || "Cancel",
                class: "btn btn-secondary",
                handler: function (modal) {
                    $.destroyModal(modal);
                    eval(me.data("confirm-no"));
                },
            },
        ],
    });
});

// Global
$(function () {
    let sidebar_nicescroll_opts = {
            cursoropacitymin: 0,
            cursoropacitymax: 0.8,
            zindex: 892,
        },
        now_layout_class = null;

    var sidebar_sticky = function () {
        if ($("body").hasClass("layout-2")) {
            $("body.layout-2 #sidebar-wrapper").stick_in_parent({
                parent: $("body"),
            });
            $("body.layout-2 #sidebar-wrapper").stick_in_parent({
                recalc_every: 1,
            });
        }
    };
    sidebar_sticky();

    // var sidebar_nicescroll;
    // var update_sidebar_nicescroll = function() {
    //   let a = setInterval(function() {
    //     if(sidebar_nicescroll != null)
    //       sidebar_nicescroll.resize();
    //   }, 10);

    //   setTimeout(function() {
    //     clearInterval(a);
    //   }, 600);
    // }

    var sidebar_dropdown = function () {
        if ($(".main-sidebar").length) {
            // $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
            // sidebar_nicescroll = $(".main-sidebar").getNiceScroll();

            $(".main-sidebar .sidebar-menu li a.has-dropdown")
                .off("click")
                .on("click", function () {
                    var me = $(this);

                    me.parent()
                        .find("> .dropdown-menu")
                        .slideToggle(500, function () {
                            // update_sidebar_nicescroll();
                            return false;
                        });
                    return false;
                });
        }
    };
    sidebar_dropdown();

    if ($("#top-5-scroll").length) {
        $("#top-5-scroll")
            .css({
                height: 315,
            })
            .niceScroll();
    }

    $(".main-content").css({
        minHeight: $(window).outerHeight() - 95,
    });

    $(".nav-collapse-toggle").click(function () {
        $(this).parent().find(".navbar-nav").toggleClass("show");
        return false;
    });

    $(document).on("click", function (e) {
        $(".nav-collapse .navbar-nav").removeClass("show");
    });

    var toggle_sidebar_mini = function (mini) {
        let body = $("body");

        if (!mini) {
            body.removeClass("sidebar-mini");
            $(".main-sidebar").css({
                overflow: "hidden",
            });
            // setTimeout(function() {
            //   $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
            //   sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
            // }, 500);
            $(".main-sidebar .sidebar-menu > li > ul .dropdown-title").remove();
            $(".main-sidebar .sidebar-menu > li > a").removeAttr("data-toggle");
            $(".main-sidebar .sidebar-menu > li > a").removeAttr(
                "data-original-title"
            );
            $(".main-sidebar .sidebar-menu > li > a").removeAttr("title");
        } else {
            body.addClass("sidebar-mini");
            body.removeClass("sidebar-show");
            // sidebar_nicescroll.remove();
            // sidebar_nicescroll = null;
            $(".main-sidebar .sidebar-menu > li").each(function () {
                let me = $(this);

                if (me.find("> .dropdown-menu").length) {
                    me.find("> .dropdown-menu").hide();
                    me.find("> .dropdown-menu").prepend(
                        '<li class="dropdown-title pt-3">' +
                            me.find("> a").text() +
                            "</li>"
                    );
                } else {
                    me.find("> a").attr("data-toggle");
                    me.find("> a").attr(
                        "data-original-title",
                        me.find("> a").text()
                    );
                    // $("[data-toggle='tooltip']").tooltip({
                    //   placement: 'right'
                    // });
                }
            });
        }
    };

    $("[data-toggle='sidebar']").click(function () {
        var body = $("body"),
            w = $(window);

        if (w.outerWidth() <= 1024) {
            body.removeClass("search-show search-gone");
            if (body.hasClass("sidebar-gone")) {
                body.removeClass("sidebar-gone");
                body.addClass("sidebar-show");
            } else {
                body.addClass("sidebar-gone");
                body.removeClass("sidebar-show");
            }

            // update_sidebar_nicescroll();
        } else {
            body.removeClass("search-show search-gone");
            if (body.hasClass("sidebar-mini")) {
                toggle_sidebar_mini(false);
            } else {
                toggle_sidebar_mini(true);
            }
        }

        return false;
    });

    // var toggleLayout = function() {
    //   var w = $(window),
    //     layout_class = $('body').attr('class') || '',
    //     layout_classes = (layout_class.trim().length > 0 ? layout_class.split(' ') : '');

    //   if(layout_classes.length > 0) {
    //     layout_classes.forEach(function(item) {
    //       if(item.indexOf('layout-') != -1) {
    //         now_layout_class = item;
    //       }
    //     });
    //   }

    //   if(w.outerWidth() <= 1024) {
    //     if($('body').hasClass('sidebar-mini')) {
    //       toggle_sidebar_mini(false);
    //       $('.main-sidebar').niceScroll(sidebar_nicescroll_opts);
    //       sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
    //     }

    //     $("body").addClass("sidebar-gone");
    //     $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
    //     $("body").off('click').on('click', function(e) {
    //       if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
    //         $("body").removeClass("sidebar-show");
    //         $("body").addClass("sidebar-gone");
    //         $("body").removeClass("search-show");

    //         update_sidebar_nicescroll();
    //       }
    //     });

    //     update_sidebar_nicescroll();

    //     if(now_layout_class == 'layout-3') {
    //       let nav_second_classes = $(".navbar-secondary").attr('class'),
    //         nav_second = $(".navbar-secondary");

    //       nav_second.attr('data-nav-classes', nav_second_classes);
    //       nav_second.removeAttr('class');
    //       nav_second.addClass('main-sidebar');

    //       let main_sidebar = $(".main-sidebar");
    //       main_sidebar.find('.container').addClass('sidebar-wrapper').removeClass('container');
    //       main_sidebar.find('.navbar-nav').addClass('sidebar-menu').removeClass('navbar-nav');
    //       main_sidebar.find('.sidebar-menu .nav-item.dropdown.show a').click();
    //       main_sidebar.find('.sidebar-brand').remove();
    //       main_sidebar.find('.sidebar-menu').before($('<div>', {
    //         class: 'sidebar-brand'
    //       }).append(
    //         $('<a>', {
    //           href: $('.navbar-brand').attr('href'),
    //         }).html($('.navbar-brand').html())
    //       ));
    //       setTimeout(function() {
    //         sidebar_nicescroll = main_sidebar.niceScroll(sidebar_nicescroll_opts);
    //         sidebar_nicescroll = main_sidebar.getNiceScroll();
    //       }, 700);

    //       sidebar_dropdown();
    //       $(".main-wrapper").removeClass("container");
    //     }
    //   }else{
    //     $("body").removeClass("sidebar-gone sidebar-show");
    //     if(now_layout_class)
    //       $("body").addClass(now_layout_class);

    //     let nav_second_classes = $(".main-sidebar").attr('data-nav-classes'),
    //       nav_second = $(".main-sidebar");

    //     if(now_layout_class == 'layout-3' && nav_second.hasClass('main-sidebar')) {
    //       nav_second.find(".sidebar-menu li a.has-dropdown").off('click');
    //       nav_second.find('.sidebar-brand').remove();
    //       nav_second.removeAttr('class');
    //       nav_second.addClass(nav_second_classes);

    //       let main_sidebar = $(".navbar-secondary");
    //       main_sidebar.find('.sidebar-wrapper').addClass('container').removeClass('sidebar-wrapper');
    //       main_sidebar.find('.sidebar-menu').addClass('navbar-nav').removeClass('sidebar-menu');
    //       main_sidebar.find('.dropdown-menu').hide();
    //       main_sidebar.removeAttr('style');
    //       main_sidebar.removeAttr('tabindex');
    //       main_sidebar.removeAttr('data-nav-classes');
    //       $(".main-wrapper").addClass("container");
    //       // if(sidebar_nicescroll != null)
    //       //   sidebar_nicescroll.remove();
    //     }else if(now_layout_class == 'layout-2') {
    //       $("body").addClass("layout-2");
    //     }else{
    //       update_sidebar_nicescroll();
    //     }
    //   }
    // }
    // toggleLayout();
    // $(window).resize(toggleLayout);

    // $("[data-toggle='search']").click(function() {
    //   var body = $("body");

    //   if(body.hasClass('search-gone')) {
    //     body.addClass('search-gone');
    //     body.removeClass('search-show');
    //   }else{
    //     body.removeClass('search-gone');
    //     body.addClass('search-show');
    //   }
    // });

    // // tooltip
    // $("[data-toggle='tooltip']").tooltip();

    // // popover
    // $('[data-toggle="popover"]').popover({
    //   container: 'body'
    // });

    // Select2
    if (jQuery().select2) {
        $(".select2").select2();
    }

    // // Selectric
    // if(jQuery().selectric) {
    //   $(".selectric").selectric({
    //     disableOnMobile: false,
    //     nativeOnMobile: false
    //   });
    // }

    // $(".notification-toggle").dropdown();
    // $(".notification-toggle").parent().on('shown.bs.dropdown', function() {
    //   $(".dropdown-list-icons").niceScroll({
    //     cursoropacitymin: .3,
    //     cursoropacitymax: .8,
    //     cursorwidth: 7
    //   });
    // });

    // $(".message-toggle").dropdown();
    // $(".message-toggle").parent().on('shown.bs.dropdown', function() {
    //   $(".dropdown-list-message").niceScroll({
    //     cursoropacitymin: .3,
    //     cursoropacitymax: .8,
    //     cursorwidth: 7
    //   });
    // });

    // if($(".chat-content").length) {
    //   $(".chat-content").niceScroll({
    //       cursoropacitymin: .3,
    //       cursoropacitymax: .8,
    //   });
    //   $('.chat-content').getNiceScroll(0).doScrollTop($('.chat-content').height());
    // }

    if (jQuery().summernote) {
        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 250,
        });
        $(".summernote-simple").summernote({
            dialogsInBody: true,
            minHeight: 150,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["font", ["strikethrough"]],
                ["para", ["paragraph"]],
            ],
        });
    }

    if (window.CodeMirror) {
        $(".codeeditor").each(function () {
            let editor = CodeMirror.fromTextArea(this, {
                lineNumbers: true,
                theme: "duotone-dark",
                mode: "javascript",
                height: 200,
            });
            editor.setSize("100%", 200);
        });
    }

    // Follow function
    $(".follow-btn, .following-btn").each(function () {
        var me = $(this),
            follow_text = "Follow",
            unfollow_text = "Following";

        me.click(function () {
            if (me.hasClass("following-btn")) {
                me.removeClass("btn-danger");
                me.removeClass("following-btn");
                me.addClass("btn-primary");
                me.html(follow_text);

                eval(me.data("unfollow-action"));
            } else {
                me.removeClass("btn-primary");
                me.addClass("btn-danger");
                me.addClass("following-btn");
                me.html(unfollow_text);

                eval(me.data("follow-action"));
            }
            return false;
        });
    });

    // Dismiss function
    $("[data-dismiss]").each(function () {
        var me = $(this),
            target = me.data("dismiss");

        me.click(function () {
            $(target).fadeOut(function () {
                $(target).remove();
            });
            return false;
        });
    });

    // Collapsable
    $("[data-collapse]").each(function () {
        var me = $(this),
            target = me.data("collapse");

        me.click(function () {
            $(target).collapse("toggle");
            $(target).on("shown.bs.collapse", function () {
                me.html('<i class="fas fa-minus"></i>');
            });
            $(target).on("hidden.bs.collapse", function () {
                me.html('<i class="fas fa-plus"></i>');
            });
            return false;
        });
    });

    // Gallery
    $(".gallery .gallery-item").each(function () {
        var me = $(this);

        me.attr("href", me.data("image"));
        me.attr("title", me.data("title"));
        if (me.parent().hasClass("gallery-fw")) {
            me.css({
                height: me.parent().data("item-height"),
            });
            me.find("div").css({
                lineHeight: me.parent().data("item-height") + "px",
            });
        }
        me.css({
            backgroundImage: 'url("' + me.data("image") + '")',
        });
    });
    if (jQuery().Chocolat) {
        $(".gallery").Chocolat({
            className: "gallery",
            imageSelector: ".gallery-item",
        });
    }

    // Background
    $("[data-background]").each(function () {
        var me = $(this);
        me.css({
            backgroundImage: "url(" + me.data("background") + ")",
        });
    });

    // Custom Tab
    $("[data-tab]").each(function () {
        var me = $(this);

        me.click(function () {
            if (!me.hasClass("active")) {
                var tab_group = $('[data-tab-group="' + me.data("tab") + '"]'),
                    tab_group_active = $(
                        '[data-tab-group="' + me.data("tab") + '"].active'
                    ),
                    target = $(me.attr("href")),
                    links = $('[data-tab="' + me.data("tab") + '"]');

                links.removeClass("active");
                me.addClass("active");
                target.addClass("active");
                tab_group_active.removeClass("active");
            }
            return false;
        });
    });

    // Bootstrap 4 Validation
    $(".needs-validation").submit(function () {
        var form = $(this);
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.addClass("was-validated");
    });

    // alert dismissible
    $(".alert-dismissible").each(function () {
        var me = $(this);

        me.find(".close").click(function () {
            me.alert("close");
        });
    });

    if ($(".main-navbar").length) {
    }

    // Image cropper
    $("[data-crop-image]").each(function (e) {
        $(this).css({
            overflow: "hidden",
            position: "relative",
            height: $(this).data("crop-image"),
        });
    });

    // Slide Toggle
    $("[data-toggle-slide]").click(function () {
        let target = $(this).data("toggle-slide");

        $(target).slideToggle();
        return false;
    });

    // Dismiss modal
    $("[data-dismiss=modal]").click(function () {
        $(this).closest(".modal").modal("hide");

        return false;
    });

    // Width attribute
    $("[data-width]").each(function () {
        $(this).css({
            width: $(this).data("width"),
        });
    });

    // Height attribute
    $("[data-height]").each(function () {
        $(this).css({
            height: $(this).data("height"),
        });
    });

    // Chocolat
    if ($(".chocolat-parent").length && jQuery().Chocolat) {
        $(".chocolat-parent").Chocolat();
    }

    // Sortable card
    if ($(".sortable-card").length && jQuery().sortable) {
        $(".sortable-card").sortable({
            handle: ".card-header",
            opacity: 0.8,
            tolerance: "pointer",
        });
    }

    // Daterangepicker
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $(".datepicker").daterangepicker({
                locale: { format: "YYYY-MM-DD" },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $(".datetimepicker").daterangepicker({
                locale: { format: "YYYY-MM-DD hh:mm" },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }

        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#reportrange span").html(
                start.format("DD MMM YYYY") + " - " + end.format("DD MMM YYYY")
            );
        }

        if ($("#daterange").length) {
            $("#daterange").daterangepicker(
                {
                    locale: { format: "DD MMM YYYY" },
                    drops: "down",
                    opens: "left",
                    startDate: start,
                    endDate: end,
                    ranges: {
                        "Hari ini": [moment(), moment()],
                        Kemarin: [
                            moment().subtract(1, "days"),
                            moment().subtract(1, "days"),
                        ],
                        "7 Hari Terakhir": [
                            moment().subtract(6, "days"),
                            moment(),
                        ],
                        "30 Hari Terakhir": [
                            moment().subtract(29, "days"),
                            moment(),
                        ],
                        "Bulan ini": [
                            moment().startOf("month"),
                            moment().endOf("month"),
                        ],
                        "Bulan kemarin": [
                            moment().subtract(1, "month").startOf("month"),
                            moment().subtract(1, "month").endOf("month"),
                        ],
                    },
                },
                cb(start, end)
            );
        }
    }

    // Timepicker
    if (jQuery().timepicker && $(".timepicker").length) {
        $(".timepicker").timepicker({
            icons: {
                up: "fas fa-chevron-up",
                down: "fas fa-chevron-down",
            },
        });
    }
});

$(document).ready(function () {
    var table2 = $("#example").DataTable();
    var table = $("#laporan").DataTable({
        dom: "Bfrtip",
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === "string"
                    ? i.replace("Rp.", "").replaceAll(".", "") * 1
                    : typeof i === "number"
                    ? i
                    : 0;
            };

            // Total over this page
           
            var pageTotal = api
            .column(13, {search:"applied"})
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(13).footer()).html(
                "Rp. " +
                pageTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            );
        },
        init: function (api, node, config) {
            $(node).removeClass("dt-button");
        },
        buttons: [
            {
                text: '<i class="fas fa-file-export"><a class="ml-2 font-export">Export PDF</a></i>',
                extend: "pdfHtml5",
                download: "open",
                className: "btn btn-primary btn-sm",
                extension: ".pdf",
                pageSize: "A4",
                orientation: "landscape",
                title: " ",
                footer: true,
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.tableFooter.fontSize = 10;
                    doc.styles.message.alignment = "center";
                    doc.content.splice(1, 0, {
                        margin: [0, 0, 0, 12],
                        alignment: "center",
                        image: "data:image/png;base64,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",
                        width: 200,
                    });
                },
                messageTop:
                    "Jual Beli Sepeda Motor / Mobil - Cash - Kredit / Tukar Tambah.\r\n Jl. Basuki Rahmat No.129A, Rangge, Sukorejo, Kec. Lamongan, Kabupaten Lamongan, Jawa Timur 62216. \r\n (0322) 314810 / 085780938091 / 08223347431. \r\n  (100 meter barat Kantor BRI Lamongan) \r\n  CABANG BABAT: Jl. Bedahan No. 11A Barat Pasar Baru 100 meter Babat (0322) 456463.",
                alignment: "center",
                init: function (api, node, config) {
                    $(node).removeClass("dt-button buttons-pdf buttons-html5");
                },
            },
            
        ],
    });

    $(".tipe-pembayaran").on("click", function () {
        table.search($(this).val()).draw();
    });

    var minDate, maxDate;

    var DateFilterFunction = function (settings, data, dataIndex) {
        if (settings.nTable.id !== "laporan") {
            return true;
        }

        var min = new Date(minDate);
        var max = new Date(maxDate);

        var date = new Date(data[1]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    };

    $(document).ready(function () {
        $("#daterange").on("apply.daterangepicker", function (ev, picker) {
            $(this).val(
                picker.startDate.format("DD MMM YYYY") +
                    " - " +
                    picker.endDate.format("DD MMM YYYY")
            );
            minDate = picker.startDate.format("DD MMM YYYY");
            maxDate = picker.endDate.format("DD MMM YYYY");
            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            table.draw();
        });

        $("#daterange").on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
            minDate = "";
            maxDate = "";
            $.fn.dataTable.ext.search.splice(
                $.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1)
            );
            $table.draw();
        });
    });
});

var flash = $("#flash").data("flash");
if (flash) {
    Swal.fire({
        icon: "success",
        title: "success",
        text: flash,
        showConfirmButton: false,
        timer: 1500,
    });
}
var flasherror = $("#flasherror").data("flash");
if (flasherror) {
    Swal.fire({
        icon: "error",
        title: "error",
        text: flasherror,
    });
}
function dosomething(id){
    id = "#" + id.replace(/\s/g, "");
    Swal.fire({
        title: "Are you sure ?",
        text: "You won't be able to revert this !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $(id).submit();
        }
    });
}
