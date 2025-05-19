console.log('live search loaded');
document.addEventListener("DOMContentLoaded",()=>{

    const search = document.getElementById('search');
    const search_results=document.getElementById('search_results');
    var data=null;
    let last_query='';
   
    search.addEventListener("input",async()=>{
        search_results.innerHTML='';

        const query=search.value.trim();
        last_query=query;
        if (!query) {
            // console.log('lolwa and polwa');
            // search.innerHTML='';
            data=null;
            // console.log('query emptied');
            search_results.innerHTML=''
            return;
            
        }
        try {
        const  res=await fetch(`index.php?route=posts/search&q=${encodeURIComponent(query)}`);
            const result_json =await res.json();
            data=result_json.data;

            if(last_query!==query){
                return;
            }

            if(data && data.length>0){
                data.forEach(element => {
                const item =document.createElement('p');
                item.textContent=element.title;
                search_results.appendChild(item);
            });


            }
                                   
        
        } catch (error_log) {
            console.error("fetch failed",error_log);
            // search_results.innerHTML=result_json.error;
        }
      

    })



})
