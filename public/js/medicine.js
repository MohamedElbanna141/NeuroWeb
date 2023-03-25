//start the taps
//buttons
const btns=document.querySelectorAll(".btn2");
const btnsdiv=document.querySelector(".btns2");
const heads=document.querySelectorAll(".content");

btnsdiv.addEventListener('click',function (e){
    //console.log('hello')
    const mark=e.target.dataset.mark;
   // console.log(mark)
   if(mark){
       btns.forEach((btn)=>{
           btn.classList.remove('active');
           e.target.classList.add('active');
           heads.forEach((head)=>{
            head.classList.remove('active1');
            const text=document.getElementById(mark);
            text.classList.add('active1');
        })
       })
   }
})
//end buttons
const taps=document.getElementById('taps');
slide.addEventListener('click',()=>{
    taps.style.display='block';
})

const close2=document.getElementById('close2');
close2.addEventListener('click',()=>{
    taps.style.display='none'
})