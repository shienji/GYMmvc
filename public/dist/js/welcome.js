$(function () {
    $("#btnbmi").click(function(e){        
        w=$("#bmiw").val();
        h=$('#bmih').val();
        aa=bmiState(w,h);                    
        Swal.fire({
            title: aa,
            text: "",
            icon: 'success',
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    }); 
    
    function calcBMI(weight,height){
        var bmi = weight / (height * height);
        return bmi.toFixed(2);
    }
    
    function bmiState(weight,height){
        if(calcBMI(weight,height) < 16.9 ){
            return "Very underweight";
        }
        if(calcBMI(weight,height) > 17 && calcBMI(weight,height) < 18.4 ){
            return "Under weight";
        }
        if(calcBMI(weight,height) > 18.5 && calcBMI(weight,height) < 24.9 ){
            return "Normal weight";
        }
        if(calcBMI(weight,height) > 25 && calcBMI(weight,height) < 29.9 ){
            return "Overweight";
        }
        if(calcBMI(weight,height) > 30 && calcBMI(weight,height) < 34.9 ){
            return "Overweight class 1";
        }
        if(calcBMI(weight,height) > 35 && calcBMI(weight,height) < 40 ){
            return "Overweight class 2";
        }
        if(calcBMI(weight,height) > 40){
            return "Overweight class 3";
        }
    }
});



