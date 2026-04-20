let urlParam = new URLSearchParams(window.location.search);

$(".add-mahasiswa-container").hide();
$(".set-dosen-container").hide();
setMahasiswaList();

function hide_add_mahasiswa_container(){
    $(".add-mahasiswa-container").hide();
    $("body").css("overflow", "auto");
}

function show_add_mahasiswa_container(){
    $(".add-mahasiswa-container").show();
    $("body").css("overflow", "hidden");
}

async function setMahasiswaList(){
    $("#anggota-list").html("");
    $(".team-list").html("");

    let mahasiswaList = mahasiswa_old_team_list;
    showMahasiswaList(mahasiswaList, true)
    .then(response => mahasiswaList = mahasiswa_new_team_list)
    .then(response => showMahasiswaList(mahasiswaList));

    for(let i=0; i<mahasiswa_new_team_list.length; i++){
        const mahasiswa = mahasiswa_new_team_list[i];
        $('.team-list').append(
            `<input type='hidden' name='mahasiswa-nim-list[]' value='${mahasiswa['nim']}'>`+
            `<input type='hidden' name='mahasiswa-nama-list[]' value='${mahasiswa['nama']}'>`
        );
    }
}

async function showMahasiswaList(mahasiswaList = [], old = false){
    for(let i=0; i<mahasiswaList.length; i++){
        if( mahasiswaList[i]['nim'] == self_nim ){
            $("#anggota-list").append(
                "<div class='d-flex justify-content-between align-items-center border p-2 rounded mb-2'>"+
                    "<div>"+
                        "<strong>"+mahasiswaList[i]['nama']+"</strong><br>"+
                        "<small class='text-muted'>"+mahasiswaList[i]['nim']+"</small>"+
                    "</div>"+
                "</div>"
            );
        }else{
            if(old){
                $("#anggota-list").append(
                    "<div class='d-flex justify-content-between align-items-center border p-2 rounded mb-2'>"+
                        "<div>"+
                            "<strong>"+mahasiswaList[i]['nama']+"</strong><br>"+
                            "<small class='text-muted'>"+mahasiswaList[i]['nim']+"</small>"+
                        "</div>"+
                        `<button onclick='deleteOldMahasiswa(this.value)' value='${i}' class='btn btn-sm btn-danger'>Hapus</button>`+
                    "</div>"
                );
            }
            else{
                $("#anggota-list").append(
                    "<div class='d-flex justify-content-between align-items-center border p-2 rounded mb-2'>"+
                        "<div>"+
                            "<strong>"+mahasiswaList[i]['nama']+"</strong><br>"+
                            "<small class='text-muted'>"+mahasiswaList[i]['nim']+"</small>"+
                        "</div>"+
                        `<button onclick='deleteNewMahasiswa(${i})' value='${i}' class='btn btn-sm btn-danger'>Hapus</button>`+
                    "</div>"
                );
            }
        }
    }
}

async function addNewMahasiswa(nama, nim){
    hide_add_mahasiswa_container();
    let new_team = {"nama": nama, "nim": nim};
    if( !is_mahasiswa_on_list(new_team) ){
        mahasiswa_new_team_list.push(new_team);
        setMahasiswaList();
    }
}

async function deleteNewMahasiswa(index){
    const mahasiswa = mahasiswa_new_team_list[index];
    mahasiswa_new_team_list.splice(index, 1);
    setMahasiswaList();
}

function deleteOldMahasiswa(index){
    const mahasiswaTarget = mahasiswa_old_team_list[index];
    mahasiswa_old_team_list.splice(index, 1);
    $('.delete-mahasiswa-list').append(
        `<input type='hidden' name='mahasiswa-delete-list[]' value='${mahasiswaTarget['nim']}' >`
    );
    setMahasiswaList();
}

function find_mahasiswa(value){
    urlParam.delete("error");
    let link = `${urlParam}/mahasiswa-list/`+value;

    fetch(link)
    .then(Response => Response.json())
    .then(response => mahasiswa_list = response['data'])
    .then(data => show_mahasiswa_by_keyword());
}

function show_mahasiswa_by_keyword(){
    $(".student-list").html("");
    try {
        for( let i=0; i< mahasiswa_list.length; i++){
            let nama = mahasiswa_list[i]['nama'];
            let nim = mahasiswa_list[i]['nim'];
            if( nama == mahasiswa_team_list[0]['nama'] || nim == mahasiswa_team_list[0]['nim']){
                $(".student-list").append(
                    `<button disabled type="button" onclick="addNewMahasiswa(this.name, this.value)" name="${nama}" value="${nim}" class="student-item">${nama}<br>(${nim})</button>`
                );
            }else{
                $(".student-list").append(
                    `<button type="button" onclick="addNewMahasiswa(this.name, this.value)" name="${nama}" value="${nim}" class="student-item">${nama}<br>(${nim})</button>`
                );
            }
        }
    } catch (error) {
        mahasiswa_list = mahasiswa_list_default;
        show_mahasiswa_by_keyword();
    }
    
}

function is_mahasiswa_on_list(mahasiswa){
    let nama = mahasiswa['nama'];
    let nim = mahasiswa['nim'];

    for(let i=0; i<mahasiswa_old_team_list.length; i++){
        if(mahasiswa_old_team_list[i]['nim'] == nim){
            return true;
        }
    }
    for(let i=0; i<mahasiswa_new_team_list.length; i++){
        if(mahasiswa_new_team_list[i]['nim'] == nim){
            return true;
        }
    }
    return false;
}

function show_dosen_list(){
    $(".set-dosen-container").show();
    $("body").css('overflow', 'hidden');
}
function hide_dosen_list(){
    $(".set-dosen-container").hide();
    $("body").css('overflow', 'auto');
}

function find_dosen(value = ""){
    urlParam.delete("error");
    const link = `${urlParam}/dosen-list/${value}`;
    fetch(link).then(response => response.json())
    .then(data => dosen_list = data['data'])
    .then(data => show_dosen_by_keyword());
}

function show_dosen_by_keyword(){
    const data = dosen_list;
    $(".dosen-list").html("");
    for(let i=0; i< data.length; i++){
        $(".dosen-list").append(
            `<button onclick="set_dosen(${i})" value="${data[i]['kode']}" class="student-item">${data[i]['nama']}</button>`
        );
    }
}

function set_dosen(index){
    hide_dosen_list();
    const dosen_data = dosen_list[index];
    $(".dosen-selected-input").html(
        `<input type='hidden' name="dosen_selected[]" value='${dosen_data['kode']}'>`+
        `<input type='hidden' name="dosen_selected[]" value='${dosen_data['nama']}'>`
    );
    $(".dosen-name-selected").html( "<b>"+dosen_data['nama']+"</b>" );
}

const max_images_amount = 10;
let images_amount = 0;

set_image_proyek();
set_add_image_button();
updated_form_data_image();

function add_image_proyek(hehe){
    if(images_amount < max_images_amount){
        images_list.push(hehe.files[0]);
        images_amount += 1;
        show_image_proyek();
        updated_form_data_image();
    }
}

function delete_image_proyek(wkwk){
    let imgIndex = wkwk.dataset.imageIndex;
    images_list.splice(imgIndex, 1);
    images_amount -= 1;
    show_image_proyek();
    updated_form_data_image();
}
function delete_default_image_proyek(wkwk){
    let imgIndex = wkwk.dataset.imageIndex;
    $('.image-delete-list').append(
        `<input type='hidden' name='image-delete-list[]' value='${default_images_list[imgIndex]['imageID']}'>`
    );
    default_images_list.splice(imgIndex, 1);
    images_amount -= 1;
    show_image_proyek();
    console.log(default_images_list);
}

function set_image_proyek(){
    $(".gallery-scroll").html("");
    for(let i=0; i<default_images_list.length; i++){
        $(".gallery-scroll").append(
            `<div onclick='delete_default_image_proyek(this)' class="gallery-item" data-image-index='${i}' >`+
                `<img src="${images_location}\\${default_images_list[i]['lokasi']}">`+
                `<div class="gallery-overlay">`+
                    `<i class="bi bi-trash"></i>`+
                `</div>`+
            `</div>`
        );
    }
}

function show_image_proyek(){
    $(".gallery-scroll").html("");
    set_image_proyek();
    for(let i=0; i<images_list.length; i++){
        $(".gallery-scroll").append(
            `<div onclick='delete_image_proyek(this)' class="gallery-item" data-image-index='${i}' >`+
                `<img src="${URL.createObjectURL( images_list[i] )}">`+
                `<div class="gallery-overlay">`+
                    `<i class="bi bi-trash"></i>`+
                `</div>`+
            `</div>`
        );
    }
    set_add_image_button();
}

function updated_form_data_image(){
    $(".image-list").html('');
    $('.images-amount').html(
        `<input type='hidden' name="image-amount" value="${images_amount}" hidden />`
    );
    for(let i=0; i<images_list.length; i++){
        
        let newId = `image-list-${i}`;
        $(".image-list").append(
            `<input type='file' name="image-proyek-${i}" id='${newId}' hidden />`
        );

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(images_list[i]);

        const inputId = document.getElementById(newId);
        inputId.files = dataTransfer.files;
    }
}

function set_add_image_button(){
    if(images_amount < max_images_amount){
        $(".gallery-scroll").append(
            `<label class="gallery-add">`+
                `<input onchange="add_image_proyek(this)" class="btn-add-photo" type="file" accept="image/png, image/jpeg" hidden />`+
                `<span>+</span>`+
                `<small>Tambah Gambar</small>`+
            `</label>`
        );
    }
}

const MAX_VIDEO_AMOUNT = 5;
let video_amount = 0;

let newVideoList = []
 
show_new_video_proyek();

async function set_add_video_button(){
    $('.video-amount').html(
        `<input type='hidden' name='video-amount' value='${video_amount}' >`
    );
    if(video_amount < MAX_VIDEO_AMOUNT){
        $(".video-scroll").append(
            `<label class="video-add">`+
                `<input onchange="add_video_proyek(this)" type="file" accept="video/*" hidden />`+
                `<span>+</span>`+
                `<small>Tambah Video</small>`+
            `</label>`
        );
    }
}
async function show_new_video_proyek(){
    $(".video-scroll").html("");
    for(let i=0; i<default_video_list.length; i++){
        $(".video-scroll").append(
            `<div class="video-item">`+
                `<video src="${videos_location}/${ default_video_list[i]['lokasi'] }" controls></video>`+
                `<button onclick='delete_old_video_proyek(this.value)' value='${i}'  class="video-delete">Hapus Video</button>`+
            `</div>`
        );
    }
    for(let i=0; i<newVideoList.length; i++){
        $(".video-scroll").append(
            `<div class="video-item">`+
                `<video src="${URL.createObjectURL( newVideoList[i] )}" controls></video>`+
                `<button onclick='delete_video_proyek(this.value)' value='${i}'  class="video-delete">Hapus Video</button>`+
            `</div>`
        );
    }
    set_add_video_button();
}

function set_video_add_input(){
    $(".video-add-list").html("");
    for(let i=0; i<newVideoList.length; i++){

        const newID = `video-list-${i}`;
        $(".video-add-list").append(
            `<input type='file' id='${newID}' name='video-proyek-${i}' hidden />`
        );

        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(newVideoList[i]);

        const inputId = document.getElementById(newID);
        inputId.files = dataTransfer.files;
    }
}

function add_video_proyek(wkwk){
    video_amount += 1;
    newVideoList.push(wkwk.files[0]);
    set_video_add_input();
    show_new_video_proyek();
    set_video_scroll_bar(video_amount);
}

function delete_video_proyek(index){
    newVideoList.splice(index, 1);
    video_amount -= 1;
    set_video_add_input();
    $(".video-scroll").html('');
    show_new_video_proyek();
}

function delete_old_video_proyek(index){
    const video = default_video_list[index];
    $('.video-del-list').append(
        `<input type='hidden' name='video-del-list[]' value='${video['videoCode']}' >`
    );
    default_video_list.splice(index, 1);
    show_new_video_proyek();
}

function set_video_scroll_bar(index){
    const lebarPanel = $('.video-item').width();

    $('.video-scroll').animate({
        scrollLeft : lebarPanel * index
    }, 800, 'swing');
}

function setPptFile(file){
    $('.ppt-file').html(
        `<input type='file' name='ppt-file' id='ppt-file' hidden />`
    );

    let dataTransfer = new DataTransfer();
    dataTransfer.items.add(file.files[0]);

    const pptID = document.getElementById('ppt-file');
    pptID.files = dataTransfer.files;

    $('.ppt-name').text('Power Point.pptx');
    $('.pdf-link').attr('href', URL.createObjectURL(file.files[0]));
}

function setLaporanFile(file){
    $('.laporan-file').html(
        `<input type='file' name='laporan-file' id='laporan-file' hidden />`
    );

    let dataTransfer = new DataTransfer();
    dataTransfer.items.add(file.files[0]);

    const pptID = document.getElementById('laporan-file');
    pptID.files = dataTransfer.files;

    $('.laporan-name').text('Laporan Project.pdf');
    $('.laporan-link').attr('href', URL.createObjectURL(file.files[0]));
}