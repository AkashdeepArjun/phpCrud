console.log('filter.js loaded');

document.addEventListener("DOMContentLoaded",()=>{

const hamburger = document.querySelector('.hamburger');

const close_hamburger = document.querySelector('.close_hamburger');
    
const sidebar = document.querySelector('.sidebar');

const filters =document.getElementById('filters');

const params=new URLSearchParams();

const clear_filters=document.querySelector('.clear_filters');


    hamburger.addEventListener("click",()=>{

    sidebar.classList.add("show_sidebar");
    filters.classList.remove("hide_form");



})

close_hamburger.addEventListener("click",()=>{
    

        sidebar.classList.remove('show_sidebar');
        filters.classList.add("hide_form");


})

//besides why using paginate logic here i mean what if user want to clear filters and data resets to default




filters.addEventListener("submit",function(e){
        e.preventDefault();
        const title = this.filter_title.value.trim();
        const filter_from =this.filter_from.value.trim();
        const filter_to=this.filter_to.value.trim();

        console.log("from",filter_from);
        console.log('title is ',title);
        sidebar.classList.remove('show_sidebar');
        if(title){
            
            params.set('filter_title',title);

        }else{
            params.delete('filter_title');

        }

        if(filter_from){
            params.set('filter_from',filter_from);
        }else{
            params.delete('filter_from');
        }




        if(filter_to){
            params.set('filter_to',filter_to);
        }else{
            params.delete('filter_to');
        }




        params.set('page',1);

        window.location.href=`index.php?route=posts&${params.toString()}`;
        


    }); 


    clear_filters.addEventListener("click",()=>{
        params.delete('filter_title');
        params.delete('filter_to');
        params.delete('filter_from');
        params.set('page',1);
        window.location.href=`index.php?route=posts&${params.toString()}`
    })




})




