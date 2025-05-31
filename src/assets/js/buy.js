console.log('lets settle this with final logic');
document.addEventListener("DOMContentLoaded",()=>{


const uid = document.body.dataset.userid;

    paypal.Buttons({
        createOrder:(data,actions)=>{
            return actions.order.create({

                purchase_units:[{
                
                    amount:{
                        value:'1.00'
                    }

                }]



            });} ,

        onApprove:(data,actions)=>{
            return actions.order.capture().then((details)=>{
            
                fetch('actions/verify_payment.php',{
                    method: 'POST',
                    credentials: 'include',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        user_id:uid
                    })
                })
                .then(res=>res.json())
                .then(data=>{
                if(data.status=='success'){
                
                alert("payment success");

                window.location.replace('index.php?route=posts');

                }else{
                alert(data.msg);
                }

                })



            })




        }


    }).render('#paypal_cont');



})


