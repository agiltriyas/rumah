const p3 = document.querySelector(".p3");

function ubahWarna2() {
    p2.style.backgroundColor = "lightblue";
};

function ubahWarna() {
    p3.style.backgroundColor = "lightblue";
};

const p2 = document.querySelector(".p2");
p2.onmouseenter = ubahWarna2;


const p4 = document.querySelector("section#b p");

p4.addEventListener('click', function () {
    const ul = document.querySelector("ul");

    const liBaru = document.createElement('li');

    const isiLiBaru = document.createTextNode('Item baru');

    liBaru.appendChild(isiLiBaru);

    ul.appendChild(liBaru);

})