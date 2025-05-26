console.log('filter.js loaded');

document.addEventListener("DOMContentLoaded",()=>{

const hamburger = document.querySelector('.hamburger');

const close_hamburger = document.querySelector('.close_hamburger');
    
const sidebar = document.querySelector('.sidebar');
const filters =document.getElementById('filters');
hamburger.addEventListener("click",()=>{

    sidebar.classList.add("show_sidebar");



})

close_hamburger.addEventListener("click",()=>{
    

        sidebar.classList.remove('show_sidebar');


})

//besides why using paginate logic here i mean what if user want to clear filters and data resets to default




filters.addEventListener("submit",function(e){
        const title = this.filter_title.value.trim();
        console.log('title is ',title);
        const params=new URLSearchParams(window.location.search);
        sidebar.classList.remove('show_sidebar');
        if(title){
            
            params.set('filter_title',title);

        }else{
            params.delete('filter_title');

        }

        params.set('page',1);

        window.location.href=`index.php?route=posts&${params.toString()}`;
        


    }); 







})




