$(function () {
    setInterval(updateTime,1000);
    loadListEvent("#tabel_reg");
    flashpesan("flashpesan");
    loadAwal();
    
    $("form").on( "reset", function(e) {

    });
    $("form").on( "submit", function(e) {
        
    });
    $("#btnsubmit").on("click", function(e) {
        xtglawal = $('#tglawal').datetimepicker('viewDate');
        tglawal=$("#valtglawal").val();
        tglakhir=$("#valtglakhir").val();
        
        cektglawal=moment(tglawal,true).isValid();
        if(!cektglawal){
            alert("Tanggal awal tidak valid");
            return;
        }
        cektglawal=moment(tglakhir,true).isValid();
        if(!cektglawal){
            alert("Tanggal akhir tidak valid");            
            return;
        }

        nama=$("#nama").val();
        tglawal=moment(tglawal).format("YYYY-MM-DD");
        tglakhir=moment(tglakhir).format("YYYY-MM-DD");
        
    });

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
                    url: $(namanya).attr('dataLoad'),
                    dataSrc: ""
                },
                columns: [{
                        "data": "created_at",
                        "width": "15%"                        
                    }, {
                        "data": "user_nama",
                        "width": "8%"
                    }, {
                        "data": "user_nohp",
                        "width": "15%"
                    }, {
                        "data": "user_role",
                        "width": "5%"
                    }, {
                        "data": "user_alamat",
                        "visible": false
                    }, {
                        "data": "user_email",
                        "visible": false
                    }, {
                        "data": "user_tgllahir",
                        "visible": false
                    }, {
                        "data": "user_nik",
                        "visible": false
                        
                    }, {
                        "data": "user_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]]
                
            });
        
            $(namanya + ' tbody').on('click', 'tr', function () {
                data = nmTabel.row(this).data();
                $('#email').val(data.user_email);
                $('#nama').val(data.user_nama);
                $('#nohp').val(data.user_nohp);
                $('#nik').val(data.user_nik);
                $('#tgllahir').val(data.user_tgllahir);
                $('#alamat').val(data.user_alamat);
                $('#role').val(data.user_role);
                $('#user_id').val(data.user_id);

                $('#role').addClass( "is-warning" );
                $('#nohp').addClass( "is-valid" );                
                $('#tglexpired').addClass( "is-valid" ); 
                $('#totalbyr').addClass( "is-valid" );
                $('#role').addClass( "is-valid" );
                $('#role').trigger("change");
            });
        }
    }

});