console.log('live search loaded');
document.addEventListener("DOMContentLoaded",()=>{

    const search = document.getElementById('search');
    const search_results=document.getElementById('search_results');
    var data=null;
    let last_query='';

    const query_data=async (query)=>{
   
    last_query=query;
    search_results.innerHTML='';
    
    if(!query) return;
    try {
      const result=await fetch(`index.php?route=posts/search&q=${encodeURIComponent(query)}`);
        const json_data= await result.json();
        const data =json_data.data;

            if(query!=last_query) return;
            
            if(data?.length){
                
                data.forEach(item=> {
                    const element = document.createElement('p');
                   element.textContent=item.title;
                    search_results.appendChild(element);
                

                });



            }else{

                    const element = document.createElement('p');
                    element.textConten="data did not avaialble";
                    element.style.color="gray";
                    search_results.appendChild(element);
            


            }
    


    } catch (error) {
       console.error("aya re error",error);
        
    }



    }

    function debounce(fn,delay){
        let timer;
        return function(...args){
            clearTimeout(timer);
            timer=setTimeout(()=>fn.apply(this,args),delay);
            
        }
    }

    const debounced_search =debounce(query_data,300);

    search.addEventListener("input",(e)=>{
        const query = e.target.value;
        debounced_search(query);
    })
   



})
