function tampilkanSemuaMenu() {
    $.getJSON('data/pizza.json', function (data) {
        let menu = data.menu;

        $.each(menu, function (i, data) {
            $('#daftar-menu').append(`<div class="col-md-4">
                <div class="card mb-3">
                  <img src="img/pizza/${data.gambar}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">${data.nama}</h5>
                    <p class="card-text">${data.deskripsi}</p>
                    <h4>${data.harga}</h4>
                    <a href="#" class="btn btn-primary">Pesan Sekarang</a>
                  </div>
                </div>
              </div>`)
        })
    })
}

tampilkanSemuaMenu();


$('body').on('click', function (e) {
    // console.log(e.target.classList[1]);
    if (e.target.classList[1] == "nav-link") {
        $('.nav-link').removeClass('active');
        e.target.classList.add('active');
        let kategori = e.target.innerHTML;
        $('h1').html(kategori);

        if (kategori == "All Menu") {
            $('#daftar-menu').empty();
            tampilkanSemuaMenu();
            return;
        }

        $.getJSON('data/pizza.json', function (data) {
            let menu = data.menu;
            let content = '';
            $.each(menu, function (i, data) {
                if (data.kategori == kategori.toLowerCase()) {
                    content += '<div class="col-md-4"><div class="card mb-3"><img src="img/pizza/' + data.gambar + '" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title">' + data.nama + '</h5><p class="card-text">' + data.deskripsi + '</p><h4>' + data.harga + '</h4><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>'
                }
            })
            $('#daftar-menu').html(content);
        })
    }
})