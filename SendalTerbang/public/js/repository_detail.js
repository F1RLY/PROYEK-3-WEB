let prevCode = "";  
let mahasiswaData = [];
let urlParam = new URLSearchParams(window.location.search);
setPage();

console.log(mahasiswaContrib);

function setPage(){
    if(urlParam.has("mahasiswa")){
        showMahasiswa(urlParam.get("mahasiswa"));
    }else{
        hideMahasiswa();
    }
}

function showMahasiswa(index){
    $(".detail-mahasiswa-container").show();
    $("body").css("overflow", "hidden");
    updateURL(mahasiswaContrib[index]['nim']);
    setMahasiswaPanel(index);
}
function hideMahasiswa(){
    $(".detail-mahasiswa-container").hide();
    $("body").css("overflow", "auto");
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.delete("mahasiswa");
    let newUrl = window.location.pathname + "?" + urlParam.toString();
    window.history.replaceState({}, "", newUrl);
}
function updateURL(code){
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.delete("mahasiswa");
    urlParam.append("mahasiswa", code);
    let newUrl = window.location.pathname + "?" + urlParam.toString();
    window.history.replaceState({}, "", newUrl);
}

function setMahasiswaPanel(index){
    $(".profile-name").text(mahasiswaContrib[index]['nama']);
    $(".info-list").html(`NIM: ${mahasiswaContrib[index]['nim']}<br>Kelas: ${mahasiswaContrib[index]['kelas']}<br>Tahun Angkatan: ${mahasiswaContrib[index]['angkatan']}<br>Email: ${mahasiswaContrib[index]['email']}`);
    $(".sosialMedia-header").text(`Kontak & Sosial Media (${mahasiswaContrib[index]['sosial_media'].length})`);
    $(".proyek-header").text(`Project yang Pernah Dikontribusikan (${mahasiswaContrib[index]['proyek'].length})`);
    $(".project-list").html(" ");
    for(let i=0; i < mahasiswaContrib[index]['proyek'].length; i++){
        $(".project-list").append(`<a href="${ mahasiswaContrib[index]['proyek'][i]['repoCode'] }">${ mahasiswaContrib[index]['proyek'][i]['judul'] }</a>`);
    }
}

function setNextImage(){
    const lebarPanel = $('.gallery-item').width();

    $('.gallery-track').animate({
        scrollLeft : `+=${lebarPanel}`
    }, 800, 'swing');
}

function setPrevImage(){
    const lebarPanel = $('.gallery-item').width();

    $('.gallery-track').animate({
        scrollLeft : `-=${lebarPanel}`
    }, 800, 'swing');
}

function setNextVideo(){
    const lebarPanel = $('.video-item').width();

    $('.video-track').animate({
        scrollLeft : `+=${lebarPanel}`
    }, 800, 'swing');
}

function setPrevVideo(){
    const lebarPanel = $('.video-item').width();

    $('.video-track').animate({
        scrollLeft : `-=${lebarPanel}`
    }, 800, 'swing');
}