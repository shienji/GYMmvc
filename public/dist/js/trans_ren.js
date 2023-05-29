$(function () {
    $(".card-tools .btn-group").hide();
    setInterval(updateTime,1000);
    loadListNewMember("#tabel_reg");
    loadListHisMember("#tabel_history",0);
    loadListEventMember("#tabel_event",0);
    flashpesan("flashpesan"); 
    loadAwal();

    $("form").on( "reset", function(e) {
        resetClass();
        $(".card-tools .btn-group").hide();
    });
    $("#jmlbulan").on("change", function(e) {
        updateBayar();
    });
    $("#role").on("change", function(e) {
        option = $('option:selected', this).attr('value2');
        $('#role_harga').val(option);        
        updateBayar();
    });
    $("#modal-transaksi").on("shown.bs.modal",function(){
        uid=$('#user_id').val();
        xurl=$("#tabel_history").attr('dataLoad')+"?user_id="+uid;
        $('#tabel_history').DataTable().ajax.url(xurl).load();
    });
    $("#modal-transaksi").on("hidden.bs.modal",function(){        
        location.reload();
    });

    function loadAwal(){
        resetClass();
        // $("#role_harga").mask('00000000');
        // $("#totalbyr").mask("999.999.999,99");
    }
    function resetClass(){
        $('#role').removeClass( "is-warning is-valid is-invalid" );
        $('#nohp').removeClass( "is-warning is-valid is-invalid" );
        $('#tglexpiredold').removeClass( "is-warning is-valid is-invalid" );
        $('#tglexpired').removeClass( "is-warning is-valid is-invalid" );
        $('#usiakadaluarsa').removeClass( "is-warning is-valid is-invalid" );
    }
    function updateBayar(){
        tglsekarang=moment().format("YYYY-MM-DD");
        tglexpired=$('#tglexpiredold').val();        
        cektgl=moment(tglexpired,true).isValid();
        if(cektgl){
            tglexpired=moment(tglexpired).format("YYYY-MM-DD");
        }else{
            tglexpired=tglsekarang;
        }
        
        if(tglexpired<tglsekarang){
            tglexpired=tglsekarang;
        }

        harga=$('#role_harga').val();
        jmlbulan=$('#jmlbulan').val();
        if(jmlbulan<=0){jmlbulan=1;}
        total=parseInt(harga)*parseInt(jmlbulan);
        // total = total.toLocaleString();
        
        exDate = moment(tglexpired).add(jmlbulan, 'Month').format("YYYY-MM-DD");
        $('#tglexpired').val(exDate);
        $('#totalbyr').val(total);  

        $('#tglexpired').removeClass( "is-warning is-valid is-invalid" );
        xusiakad=0-moment().diff(exDate,'month');
        if(xusiakad<0){
            $('#tglexpired').addClass( "is-invalid" );
        }else if(xusiakad==0){
            xusiakad=0-moment().diff(exDate,'days');
            if(xusiakad<=0){
                $('#tglexpired').addClass( "is-invalid" );
            }else if(xusiakad<=27){
                $('#tglexpired').addClass( "is-warning" );
            }else{
                $('#tglexpired').addClass( "is-valid" );
            }
        }else{
            $('#tglexpired').addClass( "is-valid" );
        }
    };

    function updateTime(){
        var serverOffset=0;
        timestamp=moment().add(serverOffset,'ms').format('DD-MM-YYYY HH:mm:ss');
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
                        "data": "transaksi_daftar",
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
                        "data": "transaksi_expired",
                        "visible": false
                    }, {
                        "data": "user_id",
                        "visible": false
                    }, {
                        "data": "transaksi_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]]
                
            });
        
            $(namanya + ' tbody').on('click', 'tr', function () {
                resetClass();
                data = nmTabel.row(this).data();
                xtglsekarang=moment().format("YYYY-MM-DD");
                xtglexpiredold=moment(data.transaksi_expired).format("YYYY-MM-DD");
                xcreated_at=moment(data.created_at).format("YYYY-MM-DD");

                xusia =Math.abs(moment(xtglsekarang).diff(data.user_tgllahir,'year'))+" Tahun";
                xusiam =Math.abs(moment(xtglsekarang).diff(data.created_at,'month'))+" Bulan";
                xusiakad=moment(xtglexpiredold).diff(xtglsekarang,'month');
                xusiak =(xusiakad)+" Bulan";

                $('#trans_id').val(data.transaksi_id);
                $('#user_id').val(data.user_id);
                $('#created_at').val(xcreated_at);
                $('#email').val(data.user_email);
                $('#nama').val(data.user_nama);
                $('#nohp').val(data.user_nohp);
                $('#nik').val(data.user_nik);
                $('#tgllahir').val(data.user_tgllahir);
                $('#alamat').val(data.user_alamat);
                $('#role').val(data.user_role);
                $('#tglexpiredold').val(xtglexpiredold);
                
                $('#usia').val(xusia);
                $('#usiamember').val(xusiam);
                $('#usiakadaluarsa').val(xusiak);

                if(xusiakad<=0){
                    $('#usiakadaluarsa').addClass( "is-invalid" );
                }else{
                    $('#usiakadaluarsa').addClass( "is-valid" );
                }
                $('#role').addClass( "is-warning" );
                $('#nohp').addClass( "is-warning" );
                $('#tglexpiredold').addClass( "is-warning" );
                $('#role').trigger("change");

                $(".card-tools .btn-group").show();
            });         
        }
    }

    function loadListHisMember(namanya,uid) {
        if (namanya) {
            var xurl=$(namanya).attr('dataLoad')+"?user_id="+uid;
            var xurldel=$(namanya).attr('dataDel');
            var nmTabel2 = $(namanya).DataTable({
                scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: false,
                searching: true,
                lengthChange: true,
                cache: false,
                autoWidth: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
                dom: "<'row'<'col-md-2' f><'col-md-6'><'col-md-4'> >" + "<'row'<'col-md-12'rt>> <'row'<'col-md-4'i><'col-md-8'p>>",
                ajax: {
                    url: xurl,
                    dataSrc: ""
                },
                columns: [{
                        "data": "transaksi_daftar",
                        "width": "15%"                        
                    }, {
                        "data": "transaksi_role",
                        "width": "8%"
                    }, {
                        "data": "transaksi_harga",
                        "width": "15%"
                    }, {
                        "data": "transaksi_bulan",
                        "width": "5%"
                    }, {
                        "data": "transaksi_expired",
                        "width": "5%"
                    },{
                        "data": null,
                        "className": "center",
                        "defaultContent": "<input type='button' value='Hapus' class='btn btn-block btn-danger'>"
                    }, {
                        "data": "transaksi_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]]
            });
        
            $(namanya + ' tbody').on('click', 'td input:button', function (e) {
                indexRow=$(this).closest('tr');
                data = nmTabel2.row(indexRow).data();
                xtglsekarang=moment().format("YYYY-MM-DD");                                
                $.ajax({
                    url: xurldel,
                    type: 'DELETE',
                    data:{
                        'id': data.transaksi_id,
                        'userid': data.user_id,
                        '_token': $('#tokennya').val(),
                    },
                    success: function(result) {
                        if(result=="success"){
                            nmTabel2.ajax.reload();
                            $("form").trigger('reset');
                        }
                    },
                    error:function(result) {
                        alert(JSON.stringify(result));
                    }
                });
            });

            
        }
    }

    function loadListEventMember(namanya,uid) {
        if (namanya) {
            var xurl=$(namanya).attr('dataLoad')+"?user_id="+uid;
            var xurldel=$(namanya).attr('dataDel');
            var nmTabel2 = $(namanya).DataTable({
                scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: false,
                searching: true,
                lengthChange: true,
                cache: false,
                autoWidth: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
                dom: "<'row'<'col-md-2' f><'col-md-6'><'col-md-4'> >" + "<'row'<'col-md-12'rt>> <'row'<'col-md-4'i><'col-md-8'p>>",
                ajax: {
                    url: xurl,
                    dataSrc: ""
                },
                columns: [{
                        "data": "transaksi_daftar",
                        "width": "15%"                        
                    }, {
                        "data": "transaksi_role",
                        "width": "8%"
                    }, {
                        "data": "transaksi_harga",
                        "width": "15%"
                    }, {
                        "data": "transaksi_bulan",
                        "width": "5%"
                    }, {
                        "data": "transaksi_expired",
                        "width": "5%"
                    },{
                        "data": null,
                        "className": "center",
                        "defaultContent": "<input type='button' value='Hapus' class='btn btn-block btn-danger'>"
                    }, {
                        "data": "transaksi_id",
                        "visible": false
                    }
                ],
                order: [[0, "desc"], [1, "desc"]]
            });
        
            $(namanya + ' tbody').on('click', 'td input:button', function (e) {
                indexRow=$(this).closest('tr');
                data = nmTabel2.row(indexRow).data();
                xtglsekarang=moment().format("YYYY-MM-DD");                                
                $.ajax({
                    url: xurldel,
                    type: 'DELETE',
                    data:{
                        'id': data.transaksi_id,
                        'userid': data.user_id,
                        '_token': $('#tokennya').val(),
                    },
                    success: function(result) {
                        if(result=="success"){
                            nmTabel2.ajax.reload();
                            $("form").trigger('reset');
                        }
                    },
                    error:function(result) {
                        alert(JSON.stringify(result));
                    }
                });
            });

            
        }
    }
});

