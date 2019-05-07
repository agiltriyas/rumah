$('#search-bar').on('click', function () {
    $('#data-movie').empty();

    $.ajax({
        url: 'http://omdbapi.com',
        type: 'get',
        dataType: 'json',
        data: {
            'apikey': '789787a6',
            's': $('#cari-data').val()
        },
        success: function (r) {
            if (r.Response == "True") {
                let movies = r.Search;
                $.each(movies, function (i, data) {

                    $('#data-movie').append(`
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="${data.Poster}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">${data.Title}</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        `)

                })
                console.log(movies);
            } else {
                $('#data-movie').append(`
                <h1>
                ${r.Error}
                </h1>`)
            }
        }
    })
})