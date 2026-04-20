let urlParam = new URLSearchParams(window.location.search);

$(".add-mahasiswa-container").hide();
$(".set-dosen-container").hide();
set_mahasiswa_team();

function hide_add_mahasiswa_container(){
    $(".add-mahasiswa-container").hide();
    $("body").css("overflow", "auto");
}

function show_add_mahasiswa_container(){
    $(".add-mahasiswa-container").show();
    $("body").css("overflow", "hidden");
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
    console.log(mahasiswa_list.length);
    try {
        for( let i=0; i< mahasiswa_list.length; i++){
            let nama = mahasiswa_list[i]['nama'];
            let nim = mahasiswa_list[i]['nim'];
            if( nama == mahasiswa_team_list[0]['nama'] || nim == mahasiswa_team_list[0]['nim']){
                $(".student-list").append(
                    `<button disabled type="button" onclick="add_mahasiswa_on_list(this.name, this.value)" name="${nama}" value="${nim}" class="student-item">${nama}<br>(${nim})</button>`
                );
            }else{
                $(".student-list").append(
                    `<button type="button" onclick="add_mahasiswa_on_list(this.name, this.value)" name="${nama}" value="${nim}" class="student-item">${nama}<br>(${nim})</button>`
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

    for(let i=0; i<mahasiswa_team_list.length; i++){
        if(mahasiswa_team_list[i]['nim'] == nim){
            return true;
        }
    }
    return false;
}

function add_mahasiswa_on_list(nama, nim){
    hide_add_mahasiswa_container();
    let new_team = {"nama": nama, "nim": nim};
    if( !is_mahasiswa_on_list(new_team) ){
        mahasiswa_team_list.push(new_team);
        set_mahasiswa_team();
    }
}

function delete_mahasiswa_on_list(nim){
    let index = 0;
    for(let i=0; i<mahasiswa_team_list.length; i++){
        if(mahasiswa_team_list[i]['nim'] == nim){
            index = i;
            break;
        }
    }
    for(let i=index; i<mahasiswa_team_list.length-1; i++){
        mahasiswa_team_list[i] = mahasiswa_team_list[i+1];
    }
    mahasiswa_team_list.pop();
    set_mahasiswa_team()
}

function set_mahasiswa_team(){
    console.log(mahasiswa_team_list);
    $("#anggota-list").html("");
    $(".team-list").html("");
    for(let i=0; i<mahasiswa_team_list.length; i++){
        if( mahasiswa_team_list[i]['nim'] == self_nim ){
            $("#anggota-list").append(
                "<div class='d-flex justify-content-between align-items-center border p-2 rounded mb-2'>"+
                    "<div>"+
                        "<strong>"+mahasiswa_team_list[i]['nama']+"</strong><br>"+
                        "<small class='text-muted'>"+mahasiswa_team_list[i]['nim']+"</small>"+
                    "</div>"+
                "</div>"
            );
        }else{
            $("#anggota-list").append(
                "<div class='d-flex justify-content-between align-items-center border p-2 rounded mb-2'>"+
                    "<div>"+
                        "<strong>"+mahasiswa_team_list[i]['nama']+"</strong><br>"+
                        "<small class='text-muted'>"+mahasiswa_team_list[i]['nim']+"</small>"+
                    "</div>"+
                    `<button onclick='delete_mahasiswa_on_list(this.value)' value='${mahasiswa_team_list[i]['nim']}' class='btn btn-sm btn-danger'>Hapus</button>`+
                "</div>"
            );
        }
        $(".team-list").append(
            `<input type='hidden' name="mahasiswa-nama-list[]" value='${mahasiswa_team_list[i]['nama']}'>`+
            `<input type='hidden' name="mahasiswa-nim-list[]" value='${mahasiswa_team_list[i]['nim']}'>`
        );
    }
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