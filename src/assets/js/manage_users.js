
console.log('script manager users success!!!');

const update_form = document.getElementById("jhopat");


const handle_update  = async(e)=>{

    e.preventDefault();
    console.log("handling update")
    const form_data = new FormData(update_form);

    console.clear();

for (let [key, value] of form_data.entries()) {
    console.log(key, value);
}

    fetch(
        update_form.action,{ method:'POST',body:form_data}
    ).
        then(response =>response.json()).then(result=>{

            if(result.redirect){
                // window.location.replace(result.redirect);
                console.log("redirecting to ",result.redirect);
            }else{
                alert('ERRor'+result.msg);
                console.log("rrror aa gya lol");
            }

            
        }
        ).catch(err=>{
            
            console.log("dafuq");

        });





}
document.addEventListener("DOMContentLoaded",()=>{


update_form.addEventListener("submit",handle_update);


})

