$(function () {
    setInterval(updateTime,1000);
    loadListEvent("#tabel_reg");
    flashpesan("flashpesan");
    loadAwal();

    $("form").on( "reset", function(e) {

    });
    $("form").on( "submit", function(e) {

    });
    $("#modal-event").on("shown.bs.modal",function(){
        uid=$('#modal_eventid').val();
        xurl=$("#tabel_history").attr('dataLoad')+"?user_id="+uid;
        $('#tabel_history').DataTable().ajax.url(xurl).load();
    });

    // $("#btnsubmit").on("click", function(e) {
    //     xtglawal = $('#tglawal').datetimepicker('viewDate');
    //     tglawal=$("#valtglawal").val();
    //     tglakhir=$("#valtglakhir").val();

    //     cektglawal=moment(tglawal,true).isValid();
    //     if(!cektglawal){
    //         alert("Tanggal awal tidak valid");
    //         return;
    //     }
    //     cektglawal=moment(tglakhir,true).isValid();
    //     if(!cektglawal){
    //         alert("Tanggal akhir tidak valid");
    //         return;
    //     }

    //     $.ajax({
    //         url: xurl,
    //         type: 'POST',
    //         data:{
    //             'nama': data.transaksi_id,
    //             'tglawal': data.user_id,
    //             'tglakhir': data.user_id,
    //             '_token': $('#tokennya').val(),
    //         },
    //         success: function(result) {
    //             if(result=="success"){
    //                 nmTabel2.ajax.reload();
    //                 $("form").trigger('reset');
    //             }
    //         },
    //         error:function(result) {
    //             alert(JSON.stringify(result));
    //         }
    //     });

    // });

    function loadAwal(){
        // document.getElementById('tglawal').valueAsDate = new Date();
        // document.getElementById('tglakhir').valueAsDate = new Date();
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
                        "data": null,
                        "width": "5%",
                        "className": "center",
                        "defaultContent": "0"
                    }, {
                        "data": "event_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]]

            });

            $(namanya + ' tbody').on('click', 'tr', function () {
                data = nmTabel.row(this).data();
                $('#modal_eventid').val(data.event_id);
                $('#modal-event').modal("show");
            });
        }
    }

});
