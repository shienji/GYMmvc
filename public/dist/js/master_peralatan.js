$(function () {

    flashpesan("flashpesan");
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

    setInterval(updateTime,1000);
   loadListNewMember("#master_peralatan");
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
                       "data": "peralatan_id",
                       "width": "8%"
                   }, {
                       "data": "fasilitas_nama",
                       "width": "15%"
                   }, {
                       "data": "peralatan_nama",
                       "width": "15%"
                   },{
                    "data": "peralatan_status",
                    "width": "15%"
                     }
               ],
                order: [[0, "asc"], [1, "desc"]]

           });

           $(namanya + ' tbody').on('click', 'tr', function () {
               data = nmTabel.row(this).data();
               exDate = moment(new Date(), "DD-MM-YYYY").add(1, 'Month').format("YYYY-MM-DD");
               $('#peralatan_id').val(data.peralatan_id);
               $('#peralatan_id2').val(data.peralatan_id);
               $('#fasilitas_nama').val(data.fasilitas_nama);
               $('#nama').val(data.peralatan_nama);

           });
       }
   }

});
