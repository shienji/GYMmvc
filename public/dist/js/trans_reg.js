$(function () {
    setInterval(updateTime,1000);
    loadListNewMember("#tabel_reg");
    flashpesan("flashpesan");
    loadAwal();
    
    $("form").on( "reset", function(e) {        
        $('#role').removeClass( "is-warning" );
        $('#nohp').removeClass( "is-warning" );
        $('#tglexpiredold').removeClass( "is-warning" );
        $('#tglexpired').removeClass( "is-valid" );
        $('#totalbyr').removeClass( "is-valid" );

    });
    $("#jmlbulan").on("change", function(e) {        
        updateBayar();
    });
    $("#role").on("change", function(e) {        
        option = $('option:selected', this).attr('value2');
        $('#role_harga').val(option);        
        updateBayar();
    });

    function loadAwal(){
        // $("#role_harga").mask('00000000');
        // $("#totalbyr").mask("999.999.999,99");
    }
    function updateBayar(){
        harga=$('#role_harga').val();
        jmlbulan=$('#jmlbulan').val();
        if(jmlbulan<=0){jmlbulan=1;}
        total=parseInt(harga)*parseInt(jmlbulan);
        // total = total.toLocaleString();

        exDate = moment().add(jmlbulan, 'Month').format("YYYY-MM-DD");
        $('#tglexpired').val(exDate);
        $('#totalbyr').val(total);
        
    };
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

    function loadListNewMember(namanya) {
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