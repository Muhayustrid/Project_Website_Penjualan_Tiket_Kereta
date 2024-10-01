const sidebar = document.querySelector('nav');
const toggle = document.querySelector(".toggle");
const searchBtn = document.querySelector(".search-box");


toggle.addEventListener("click" , () =>{
sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
sidebar.classList.remove("close");
})