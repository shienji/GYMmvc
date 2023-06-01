$(function () {
    setInterval(updateTime,1000);
    loadListEvent("#tabel_reg");
    loadListPeserta("#tabel_event",0);
    flashpesan("flashpesan");
    loadAwal();

    $("form").on( "reset", function(e) {

    });
    $("form").on( "submit", function(e) {

    });
    $("#modal-event").on("shown.bs.modal",function(){
        uid=$('#modal_eventid').val();
        xurl=$("#tabel_event").attr('dataLoad')+"?event_id="+uid;        
        $('#tabel_event').DataTable().ajax.url(xurl).load();
    });

    function loadAwal(){        
        $('#tglawal').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#tglakhir').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    }

    function updateTime(){
        var serverOffset=0;
        timestamp=moment().add(serverOffset,'ms').format('YYYY-MM-DD HH:mm:ss');
        $('.timestamp').val(timestamp);
    }

    function flashpesan(el){
        myEle = document.getElementById(el);
        if (myEle) {
            xicon=myEle.getAttribute("icon");
            xtitle=myEle.value;
            xToast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            }).fire({
                icon: xicon,
                title: xtitle
            });
        }
    }

    function loadListEvent(namanya) {
        if (namanya) {
            let xurl=$(namanya).attr('dataLoad');            
            var nmTabel = $(namanya).DataTable({
                scrollY: false,
                scrollX: true,
                scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: false,
                searching: true,
                lengthChange: true,
                cache: false,
                autoWidth: true,
                select: {
                    style: 'single'
                },
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
                dom: "<'row'<'col-md-2' f><'col-md-6'><'col-md-4'> >" + "<'row'<'col-md-12'rt>> <'row'<'col-md-4'i><'col-md-8'p>>",
                ajax: {
                    url: xurl,
                    dataSrc: ""
                },
                columns: [{
                        "data": "event_nama",
                        "width": "15%"
                    }, {
                        "data": "event_start",
                        "width": "8%"
                    }, {
                        "data": "event_end",
                        "width": "8%"
                    },{
                        "data": "totalpeserta",
                        "width": "5%"
                        // "className": "center",
                        // "defaultContent": "0"
                    }, {
                        "data": "event_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]],
                columnDefs: [{
                        targets: 1,
                        render: $.fn.dataTable.render.moment( '', 'YYYY-MM-DD')
                    },{
                        targets: 2,
                        render: $.fn.dataTable.render.moment( '', 'YYYY-MM-DD')
                    }
                ]
            });

            $(namanya + ' tbody').on('click', 'tr', function () {
                data = nmTabel.row(this).data();
                $('#modal_eventid').val(data.event_id);
                $('#modal-event').modal("show");
            });
        }
    }
    function loadListPeserta(namanya,id) {
        if (namanya) {
            let xurl=$(namanya).attr('dataLoad')+"?event_id="+id;
            var nmTabel = $(namanya).DataTable({
                scrollY: false,
                scrollX: true,
                scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: false,
                searching: true,
                lengthChange: true,
                cache: false,
                autoWidth: true,
                select: {
                    style: 'single'
                },
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
                dom: "<'row'<'col-md-2' f><'col-md-6'><'col-md-4'> >" + "<'row'<'col-md-12'rt>> <'row'<'col-md-4'i><'col-md-8'p>>",
                ajax: {
                    url: xurl,
                    dataSrc: ""
                },
                columns: [{
                        "data": "tgldaftar",
                        "width": "15%"
                    }, {
                        "data": "user_nama",
                        "width": "8%"
                    }, {
                        "data": "user_nohp",
                        "width": "8%"
                    },{
                        "data": "user_alamat",
                        "width": "5%"
                    },{
                        "data": "created_at",
                        "width": "5%"                        
                    }, {
                        "data": "user_id",
                        "visible": false
                    }, {
                        "data": "event_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]],
                columnDefs: [{
                        targets: 0,
                        render: $.fn.dataTable.render.moment( '', 'YYYY-MM-DD')
                    },{
                        targets: 4,
                        render: $.fn.dataTable.render.moment( '', 'YYYY-MM-DD')
                    }
                ]
            });
        }
    }
});
