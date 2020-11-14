const menuBtn = document.querySelector('.menu-btn');
let menuOpen = false;
menuBtn.addEventListener('click', () => {
    if(!menuOpen){
        menuBtn.classList.add('open');
        menuOpen = true;
    }else {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }
});

function openMenu(){
    document.getElementById('sideMenu').style.marginLeft = '0';
    document.getElementById('expandbtn').style.marginLeft = '250px';
}

function closeMenu(){
    document.getElementById('sideMenu').style.marginLeft = '-250px';
    document.getElementById('expandbtn').style.marginLeft = '0';
}

function toggleNav() {
    var sidemenu = document.getElementById('sideMenu');
    var expandbtn = document.getElementById('expandbtn');
    if (sidemenu.style.marginLeft == '-250px' && expandbtn.style.marginLeft == '10px') {
        sidemenu.style.marginLeft = '0';
        expandbtn.style.marginLeft = '260px';
    } else {
        sidemenu.style.marginLeft = '-250px';
        expandbtn.style.marginLeft = '10px';
    }
}
//agenda
// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('.to-do-list ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}

//calendr javascript

const date = new Date();

const renderCalendar = () => {

    date.setDate(1);

    const monthDays = document.querySelector(".days");

    const lastDay = new Date(date.getFullYear(),date.getMonth() + 1, 0).getDate();

    const prevLastDay = new Date(date.getFullYear(),date.getMonth(), 0).getDate();

    const firstDayIndex = date.getDay();

    const lastDayIndex = new Date(date.getFullYear(),date.getMonth() + 1, 0).getDay();

    const nextDays = 7 - lastDayIndex - 1;


    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    document.querySelector('.right-side .date h1').innerHTML = months[date.getMonth()];

    document.querySelector('.right-side .date p').innerHTML = new Date().toDateString();

    let days = "";

    for(let j = firstDayIndex; j > 0; j--){
        days += `<div class="prev-date">${prevLastDay - j + 1}</div>`;
    }

    for(let i = 1; i <= lastDay; i++){
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
            days += `<div class="today">${i}</div>`;
        } else{
            days += `<div>${i}</div>`;
        }
    }

    for(let y = 1; y <= nextDays; y++){
        days += `<div class="next-date">${y}</div>`;
        monthDays.innerHTML = days;
    }

};

document.querySelector(".previous-btn").addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});
  
document.querySelector(".next-btn").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});
  
renderCalendar();
  