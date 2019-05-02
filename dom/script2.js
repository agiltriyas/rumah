const ubah = document.getElementById('ubahwarna');

ubah.addEventListener('click', function () {
    document.body.classList.toggle('biru-muda');
})


const tAcakWarna = document.createElement('button');
const isiTombol = document.createTextNode('Acak Warna');

tAcakWarna.appendChild(isiTombol);
tAcakWarna.setAttribute('type', 'button');
ubah.after(tAcakWarna);

tAcakWarna.addEventListener('click', function () {
    const r = Math.round(Math.random() * 255 + 1);
    const g = Math.round(Math.random() * 255 + 1);
    const b = Math.round(Math.random() * 255 + 1);
    console.log(r);
    document.body.style.backgroundColor = 'rgb(' + r + ',' + g + ',' + b + ')';
})

const sMerah = document.querySelector('input[name=sMerah]');
const sBiru = document.querySelector('input[name=sBiru]');
const sHijau = document.querySelector('input[name=sHijau]');

sMerah.addEventListener('input', function () {
    const r2 = sMerah.value;
    const g2 = sHijau.value;
    const b2 = sBiru.value;
    document.body.style.backgroundColor = 'rgb(' + r2 + ',' + g2 + ',' + b2 + ')';
})

sHijau.addEventListener('input', function () {
    const r2 = sMerah.value;
    const g2 = sHijau.value;
    const b2 = sBiru.value;
    document.body.style.backgroundColor = 'rgb(' + r2 + ',' + g2 + ',' + b2 + ')';
})

sBiru.addEventListener('input', function () {
    const r2 = sMerah.value;
    const g2 = sHijau.value;
    const b2 = sBiru.value;
    document.body.style.backgroundColor = 'rgb(' + r2 + ',' + g2 + ',' + b2 + ')';
})

document.body.addEventListener('mousemove', function (e) {
    const xPos = Math.round(e.clientX / window.innerWidth * 255);
    const yPos = Math.round(e.clientY / window.innerWidth * 255);
    document.body.style.backgroundColor = 'rgb(' + xPos + ',' + yPos + ',120)'
})