let prevCode = "";  
let mahasiswaData = [];
let urlParam = new URLSearchParams(window.location.search);
setPage();

$(".mahasiswa-contrib-panel").on('click', function(){
    const code = $(this).data('nim');
    showMahasiswa(code);
});

$(".close-mahasiswa-panel").on('click', function(){
    hideMahasiswa();
});

function setPage(){
    if(urlParam.has("mahasiswa")){
        showMahasiswa(urlParam.get("mahasiswa"));
    }else{
        hideMahasiswa();
    }
}

function showMahasiswa(code){
    $(".detail-mahasiswa-container").show();
    $("body").css("overflow", "hidden");
    loadMahasiswaData(code);
}
function hideMahasiswa(){
    $(".detail-mahasiswa-container").hide();
    $("body").css("overflow", "auto");
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.delete("mahasiswa");
    let newUrl = window.location.pathname + "?" + urlParam.toString();
    window.history.replaceState({}, "", newUrl);
}

function loadMahasiswaData(code){
    console.log(code);
    if(code != prevCode){
        prevCode = code;
        let link = `/api/v3/mahasiswa/${code}`;
        fetch(link).then(data => data.json())
        .then(data => mahasiswaData = data['data'])
        .then(set => setMahasiswaPanel())
        .then(set => updateURL());
    }
}

function updateURL(){
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.delete("mahasiswa");
    urlParam.append("mahasiswa", mahasiswaData['nim']);
    let newUrl = window.location.pathname + "?" + urlParam.toString();
    window.history.replaceState({}, "", newUrl);
}

function setMahasiswaPanel(){
    $(".profile-name").text(mahasiswaData['nama']);
    $(".info-list").html(`NIM: ${mahasiswaData['nim']}<br>Kelas: ${mahasiswaData['kelas']}<br>Tahun Angkatan: ${mahasiswaData['angkatan']}<br>Email: ${mahasiswaData['email']}`);
    $(".sosialMedia-header").text(`Kontak & Sosial Media (${mahasiswaData['sosial_media'].length})`);
    $(".proyek-header").text(`Project yang Pernah Dikontribusikan (${mahasiswaData['proyek'].length})`);
    $(".project-list").html(" ");
    for(let i=0; i < mahasiswaData['proyek'].length; i++){
        $(".project-list").append(`<a href="${ mahasiswaData['proyek'][i]['repoCode'] }">${ mahasiswaData['proyek'][i]['judul'] }</a>`);
    }
}
