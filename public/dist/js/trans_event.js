$(function () {    
    setInterval(updateTime,1000);
    flashpesan("flashpesan"); 
    loadAwal();

    function loadAwal(){
       
    }
    
    function updateTime(){
        var serverOffset=0;
        timestamp=moment().add(serverOffset,'ms').format('DD-MM-YYYY HH:mm:ss');
        $('.timestamp').val(timestamp);
    }
});

