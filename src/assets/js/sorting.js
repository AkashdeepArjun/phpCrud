console.log('script loaded yay');

const options = document.getElementById('sorting');


options.addEventListener("change",()=>{


    const selected_option = options.value;
    const params= new URLSearchParams(window.location.search);
    params.set("sort",selected_option);
    params.set("page",1);
    window.location.replace(`index.php?route=posts&${params.toString()}`);


// thanks it worked but everytime i sort its stacking like addding url to stack history on client side is it a good idea ? coz its stacking
//coz on pressing back it goes to previous sorted opton 



    

})

window.addEventListener("DOMContentLoaded",()=>{

    const params= new URLSearchParams(window.location.search);
    const current_option =params.get("sort");
    if(current_option){
        options.value=current_option;
    }



})
