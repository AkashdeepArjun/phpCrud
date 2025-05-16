console.log("js loaded");

const form =document.getElementById("myform");

const redirect_logic = async(e)=>{
    e.preventDefault();
    const form_data=  new FormData(form);
        const res = await fetch(url,{
        method:'POST',
        body:form_data
    });
    const data =await res.json();
    try {
        if(data.redirect){             
            window.location.replace(data.redirect);       

    }else{
        document.body.innerText=data.error;
    }

        
} catch(jsonerror) {
    console.log('error aaya re');
    document.body.innerText=data;

    }


}

form.addEventListener("submit",redirect_logic);

