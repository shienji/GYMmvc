$(function () {
    flashpesan("flashpesan");
    setInterval(updateTime,1000);
   loadListNewMember("#master_role");
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
                       "data": "role_id",
                       "width": "8%"
                   }, {
                       "data": "role_nama",
                       "width": "15%"
                   }, {
                       "data": "role_harga",
                       "width": "15%"
                   },{
                    "data": "role_status",
                    "width": "15%"
                }
               ],
                order: [[0, "asc"], [1, "desc"]]

           });

           $(namanya + ' tbody').on('click', 'tr', function () {
               data = nmTabel.row(this).data();
               exDate = moment(new Date(), "DD-MM-YYYY").add(1, 'Month').format("YYYY-MM-DD");
               $('#role_id').val(data.role_id);
               $('#role_id2').val(data.role_id);
               $('#nama').val(data.role_nama);
               $('#Harga').val(data.role_harga);
           });
       }
   }

});
