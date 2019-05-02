// simpan pilihan computer (random)

function getPilComputer() {
    var comp = Math.random();
    if (comp < 0.34) return 'gajah';
    if (comp >= 0.34 && comp < 0.67) return 'orang';
    return 'semut';
}


// rules

let nilaicom = 0;
let nilaipla = 0;
let pointp = 0;
let pointc = 0;

function getHasil(comp, player) {
    if (player == comp) {
        pointc = 0;
        pointp = 0;
        return 'SERI!';
    }
    if (player == 'gajah')
        if (comp == 'orang') {
            pointp = 1;
            pointc = 0;
            return 'MENANG!';
        } else {
            pointp = 0;
            pointc = 1;
            return 'KALAH!';
        }
    if (player == 'orang')
        if (comp == 'gajah') {
            pointp = 0;
            pointc = 1;
            return 'KALAH!';
        } else {
            pointp = 1;
            pointc = 0;
            return 'MENANG!';
        };

    if (player == 'semut')
        if (comp == 'orang') {
            pointp = 0;
            pointc = 1;
            return 'KALAH';
        } else {
            pointp = 1;
            pointc = 0;
            return 'MENANG!';
        }


}

function putar() {
    const imgComputer = document.querySelector('.img-komputer');
    const gambar = ['gajah', 'orang', 'semut'];
    const time = new Date().getTime();
    let i = 0;
    setInterval(function () {
        if (new Date().getTime() - time > 1000) {
            clearInterval;
            return;
        }
        imgComputer.setAttribute('src', 'img/' + gambar[i++] + '.png');
        if (i == gambar.length) {
            i = 0;
        }
    }, 100)
}

const nilCom = document.querySelector('.komputer');
const nilPla = document.querySelector('.player');
const pilihan = document.querySelectorAll('li img')
pilihan.forEach(function (pil) {
    pil.addEventListener('click', function () {
        const pilihanComputer = getPilComputer();
        const pilihanPlayer = pil.className;
        const hasil = getHasil(pilihanComputer, pilihanPlayer);

        putar();

        setTimeout(function () {

            const gambar = document.querySelector('.img-komputer');
            gambar.setAttribute('src', 'img/' + pilihanComputer + '.png');

            const info = document.querySelectorAll('.info')[1];
            info.innerHTML = hasil;
            nilaicom += pointc;
            nilCom.innerHTML = nilaicom;
            nilaipla = nilaipla + pointp;
            // console.log('nilai C = ' + pointc);
            // console.log('nilai P = ' + nilaipla);
            nilPla.innerHTML = nilaipla;
            if (nilaicom == 3) {
                alert('Computer Menang');
            } else if (nilaipla == 3) {
                alert("Player Menang");
            }
        }, 1000)
    });
});



// simpan pilihan player
// const pGajah = document.querySelector('.gajah');

// pGajah.addEventListener('click', function () {
//     const pilihanComputer = getPilComputer();
//     const pilihanPlayer = pGajah.className;
//     const hasil = getHasil(pilihanComputer, pilihanPlayer);

//     const gambar = document.querySelector('.img-komputer');
//     gambar.setAttribute('src', 'img/' + pilihanComputer + '.png');

//     const info = document.querySelector('.info');
//     info.innerHTML = hasil;
// });

// const pOrang = document.querySelector('.orang');

// pOrang.addEventListener('click', function () {
//     const pilihanComputer = getPilComputer();
//     const pilihanPlayer = pOrang.className;
//     const hasil = getHasil(pilihanComputer, pilihanPlayer);

//     const gambar = document.querySelector('.img-komputer');
//     gambar.setAttribute('src', 'img/' + pilihanComputer + '.png');

//     const info = document.querySelector('.info');
//     info.innerHTML = hasil;
// });

// const pSemut = document.querySelector('.semut');

// pSemut.addEventListener('click', function () {
//     const pilihanComputer = getPilComputer();
//     const pilihanPlayer = pSemut.className;
//     const hasil = getHasil(pilihanComputer, pilihanPlayer);

//     const gambar = document.querySelector('.img-komputer');
//     gambar.setAttribute('src', 'img/' + pilihanComputer + '.png');

//     const info = document.querySelector('.info');
//     info.innerHTML = hasil;
// });