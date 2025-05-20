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
                    const element = document.createElement('a');
                   element.href=`index.php?route=posts/details&id=${encodeURIComponent(item.id)}`;
                    element.style.display='block';
                    element.textContent=item.title;
                    element.target='_blank';
                    search_results.appendChild(element);
                

                });
 //
 // before proceeding i want one basic thing that on live search apparently our logic shows $post['title']
 //                but i want make it clickable when user clicks it i have made route and view   index.php?route=details&id ..it goes to detail page 
 //

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
