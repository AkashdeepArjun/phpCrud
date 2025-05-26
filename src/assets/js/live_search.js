console.log('live search loaded');
document.addEventListener("DOMContentLoaded",()=>{

    const search = document.getElementById('search');
    const search_results=document.getElementById('search_results');
    const suggestion_box=document.getElementById('suggestions');
    const search_container =document.querySelector('.search_container');
    var data=null;
    let last_query='';
    search_container.style.display='none';

    const log_query = async (query)=>{

    if(!query) return;
        try {
            
            const res = await fetch(`input.php?route=posts/log&q=${encodeURIComponent(query)}`,{
                
                method:"POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body:new URLSearchParams({q:query})

            });
        const json  = await res.json();
        if(json.status){
            console.log(json.status);
        }else{
            console.log(json.fail);
        }
        } catch (error) {
           console.log(error); 
        }


//i am getting mysql mariadb syntax here inspect my code if i am writing right queries


// check 

    }



    const query_data=async (query)=>{
   
    last_query=query;
    search_results.innerHTML='';
    // search_container.style.display='none';
    
    if(!query){
    search_container.style.display='none';
    return;

    }
    try {
      const result=await fetch(`index.php?route=posts/search&q=${encodeURIComponent(query)}`);
        const json_data= await result.json();
        const data=json_data.data;
            if(query!=last_query) return;
            if(data?.length){
                search_container.style.display='block';
                data.forEach(item=> {
                    const element = document.createElement('a');
                   element.href=`index.php?route=posts/details&id=${encodeURIComponent(item.id)}`;
                    element.style.display='block';
                    element.textContent=item.title;
                    element.target='_blank';
                    element.addEventListener("click",(e)=>{
                        log_query(query);
                        setTimeout(()=>{
                        e.preventDefault();
                        search_container.style.display='none';
                            search.value='';
                        },100)
                    });
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

    const show_suggestions=async (query)=>{

        // its gonna show live search results and suggestions in same div?

            // i will choose 2 divs method for now  and make sure you work according t debounce query logic as we did before

        suggestion_box.innerHTML='';
        suggestion_box.style.display='none';

        if(!query) return;

        try {
        
            const result = await fetch(`index.php?route=posts/suggestions&q=${encodeURIComponent(query)}`);
            const json = await result.json();
            const suggestions = json.suggestions;
            console.log('suggestions are ',suggestions);
            if(suggestions?.length){
                
                suggestions.forEach(suggestion => {
                    
                    const ui_item = document.createElement('p');
                    ui_item.textContent=suggestion;
                    ui_item.onclick=(e)=>{
                        search.value=suggestion;
                        search_results.innerHTML='';
                        suggestion_box.innerHTML='';
                        suggestion_box.style.display='none';
                        setTimeout(()=>{
                           e.preventDefault();
                            search_container.style.display='none';
                            log_query(query);

                        },100);
                        query_data(query);

                    };
                    suggestion_box.appendChild(ui_item);


                });

                suggestion_box.style.display='block';



            }


        } catch (error) {
           console.error('suggestions failed with werror',error);
            
        }





    }






// its storing queries on database on every input change which is costly i mean query is valid if user presses enter or clicks only then query should be logged
//beside this its not showing suggestions on div 


    function debounce(fn,delay){
        let timer;
        return function(...args){
            clearTimeout(timer);
            timer=setTimeout(()=>fn.apply(this,args),delay);
            
        }
    }

    const debounced_search =debounce(query_data,300);

    const handle_search = debounce ((q)=>{
        query_data(q);
        show_suggestions(q);
    },300)

    search.addEventListener("input",(e)=>{
        console.log('typed',e.target.value);
        const query = e.target.value.trim(); 
        handle_search(query);
    })
//checked console log it s complaining about non whitepspace character after json 
    search.addEventListener("keydown",(e)=>{

        if(e.key=="Enter"){
            const query=e.target.value.trim();
            if(query){
                log_query(query);
                search.value='';
                search_container.style.display='none';

            }

        }


    })

    document.addEventListener("click",(event)=>{

        if(!search_container.contains(event.target)){
            suggestion_box.style.display='none';
        } 

// apparently i am logging query only on clicking items in search results or suggestions an now considering to log query when user presses enter after typng query
    })

    // search.addEventListener("keydown",(e)=>{
    //
    //     if(e.key!="Enter") return;
    //     const query=search.value.trim();
    //
    //     const suggestion_visible = suggestion_box.style.display!=='none'&&suggestion_box.innerHTML.trim()!=='';
    //
    //     const results_visible = search_results.style.display!=='none' && search_results.innerHTML.trim()!=='';
    //
    //     if( query && (suggestion_visible|| results_visible )){
    //         log_query(query);
    //     }
    //
    //
    //
    // });
   
 // i have not set search container so how i add click event at last you mentioned 


})
