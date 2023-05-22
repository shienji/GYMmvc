$(function () {
    setInterval(updateTime,1000);
    loadListNewMember("#tabel_reg");
    function updateTime(){
        var serverOffset=0;
        timestamp=moment().add(serverOffset,'ms').format('DD-MM-YYYY HH:mm:ss');
        $('.timestamp').val(timestamp);
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
                exDate = moment(new Date(), "DD-MM-YYYY").add(1, 'Month').format("YYYY-MM-DD");
                $('#nik').val(data.user_nik);
                $('#nama').val(data.user_nama);
                $('#nohp').val(data.user_nohp);
                $('#role').val(data.user_role);
                $('#expired').val(exDate);
            });         
        }
    }

});